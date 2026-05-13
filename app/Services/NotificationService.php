<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    /**
     * Create a notification for a user
     */
    public function createNotification(
        int $userId,
        string $title,
        string $message,
        string $type = 'info',
        ?string $notificationType = null,
        ?string $notifiableType = null,
        ?int $notifiableId = null
    ): Notification {
        return Notification::create([
            'user_id' => $userId,
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'notification_type' => $notificationType,
            'notifiable_type' => $notifiableType,
            'notifiable_id' => $notifiableId,
        ]);
    }

    /**
     * Create multiple notifications for users
     */
    public function createBulkNotifications(
        array $userIds,
        string $title,
        string $message,
        string $type = 'info',
        ?string $notificationType = null,
        ?string $notifiableType = null,
        ?int $notifiableId = null
    ): void {
        foreach ($userIds as $userId) {
            $this->createNotification($userId, $title, $message, $type, $notificationType, $notifiableType, $notifiableId);
        }
    }

    /**
     * Notify all staff about an event
     */
    public function notifyStaff(
        string $title,
        string $message,
        string $type = 'info',
        ?string $notificationType = null,
        ?string $notifiableType = null,
        ?int $notifiableId = null
    ): void {
        $staffUsers = User::where('role', 'staff')->pluck('id');
        $this->createBulkNotifications($staffUsers->toArray(), $title, $message, $type, $notificationType, $notifiableType, $notifiableId);
    }

    /**
     * Notify all admins about an event
     */
    public function notifyAdmins(
        string $title,
        string $message,
        string $type = 'info',
        ?string $notificationType = null,
        ?string $notifiableType = null,
        ?int $notifiableId = null
    ): void {
        $adminUsers = User::where('role', 'admin')->pluck('id');
        $this->createBulkNotifications($adminUsers->toArray(), $title, $message, $type, $notificationType, $notifiableType, $notifiableId);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead(Notification $notification): Notification
    {
        return $notification->markAsRead();
    }

    /**
     * Mark multiple notifications as read
     */
    public function markMultipleAsRead(array $notificationIds): void
    {
        Notification::whereIn('id', $notificationIds)->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
    }

    /**
     * Mark all user notifications as read
     */
    public function markAllUserNotificationsAsRead(int $userId): void
    {
        User::find($userId)
            ->notifications()
            ->unread()
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
    }

    /**
     * Get unread notification count for user
     */
    public function getUnreadCount(int $userId): int
    {
        return Notification::where('user_id', $userId)
            ->unread()
            ->count();
    }

    /**
     * Delete notification
     */
    public function deleteNotification(Notification $notification): bool
    {
        return $notification->delete();
    }

    /**
     * Delete old notifications
     */
    public function deleteOldNotifications(int $daysOld = 30): int
    {
        return Notification::where('created_at', '<', now()->subDays($daysOld))->delete();
    }

    /**
     * Send email notification (optional - integrate with Mail later)
     */
    public function sendEmailNotification(
        User $user,
        string $subject,
        string $message,
        ?string $actionUrl = null
    ): void {
        // TODO: Integrate with Mail::send() when email is configured
        // For now, just create the notification record
        $this->createNotification(
            $user->id,
            $subject,
            $message,
            'info'
        );
    }

    /**
     * Create loan application notification
     */
    public function notifyLoanApplicationCreated(\App\Models\Loan $loan): void
    {
        $this->createNotification(
            $loan->user_id,
            'Loan Application Submitted',
            "Your loan application for ₱" . number_format($loan->loan_amount, 2) . " for {$loan->loan_term} months has been submitted.",
            'success',
            'loan_applied',
            get_class($loan),
            $loan->id
        );
    }

    /**
     * Create loan approved notification
     */
    public function notifyLoanApproved(\App\Models\Loan $loan): void
    {
        $this->createNotification(
            $loan->user_id,
            'Loan Approved',
            "Your loan application of ₱" . number_format($loan->loan_amount, 2) . " has been approved!",
            'success',
            'loan_approved',
            get_class($loan),
            $loan->id
        );

        // Also notify staff
        $this->notifyStaff(
            'Loan Approved',
            "A loan of ₱" . number_format($loan->loan_amount, 2) . " has been approved for {$loan->borrower->name}.",
            'info',
            'loan_approved',
            get_class($loan),
            $loan->id
        );
    }

    /**
     * Create loan rejected notification
     */
    public function notifyLoanRejected(int $userId, string $reason = ''): void
    {
        $message = "Your loan application has been rejected.";
        if ($reason) {
            $message .= " Reason: {$reason}";
        }

        $this->createNotification(
            $userId,
            'Loan Application Rejected',
            $message,
            'danger',
            'loan_rejected'
        );
    }

    /**
     * Create payment received notification
     */
    public function notifyPaymentReceived(int $userId, float $amount, float $remainingBalance): void
    {
        $this->createNotification(
            $userId,
            'Payment Received',
            "Payment of ₱" . number_format($amount, 2) . " received. Remaining balance: ₱" . number_format($remainingBalance, 2),
            'success',
            'payment_received'
        );
    }

    /**
     * Create payment due notification
     */
    public function notifyPaymentDue(int $userId, float $amount): void
    {
        $this->createNotification(
            $userId,
            'Payment Due Today',
            "Your monthly payment of ₱" . number_format($amount, 2) . " is due today.",
            'warning',
            'payment_due'
        );
    }

    /**
     * Create payment overdue notification
     */
    public function notifyPaymentOverdue(int $userId, float $amount, int $daysOverdue): void
    {
        $this->createNotification(
            $userId,
            'Payment Overdue',
            "Your payment of ₱" . number_format($amount, 2) . " is {$daysOverdue} days overdue.",
            'danger',
            'payment_overdue'
        );
    }

    /**
     * Create loan fully paid notification
     */
    public function notifyLoanFullyPaid(int $userId, float $totalPaid): void
    {
        $this->createNotification(
            $userId,
            'Loan Fully Paid',
            "Congratulations! Your loan of ₱" . number_format($totalPaid, 2) . " has been fully paid.",
            'success',
            'loan_paid'
        );
    }
}
