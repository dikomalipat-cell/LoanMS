<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditService
{
    /**
     * Log an action
     */
    public function log(
        string $action,
        string $model,
        int $modelId,
        ?string $description = null,
        ?array $oldValues = null,
        ?array $newValues = null,
        ?Request $request = null
    ): AuditLog {
        $userId = Auth::id();
        $ipAddress = $request?->ip() ?? request()->ip();
        $userAgent = $request?->userAgent() ?? request()->userAgent();

        return AuditLog::create([
            'user_id' => $userId,
            'action' => $action,
            'model' => $model,
            'model_id' => $modelId,
            'description' => $description,
            'old_values' => $oldValues ? json_encode($oldValues) : null,
            'new_values' => $newValues ? json_encode($newValues) : null,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
        ]);
    }

    /**
     * Log loan created
     */
    public function logLoanCreated(int $loanId, array $loanData, ?Request $request = null): void
    {
        $this->log(
            'create',
            'Loan',
            $loanId,
            "New loan application created: ₱" . number_format($loanData['loan_amount'] ?? 0, 2),
            null,
            $loanData,
            $request
        );
    }

    /**
     * Log loan approved
     */
    public function logLoanApproved(int $loanId, string $approvedBy, ?Request $request = null): void
    {
        $this->log(
            'approve',
            'Loan',
            $loanId,
            "Loan approved by {$approvedBy}",
            null,
            ['approved_by' => $approvedBy, 'status' => 'approved'],
            $request
        );
    }

    /**
     * Log loan rejected
     */
    public function logLoanRejected(int $loanId, string $reason, ?Request $request = null): void
    {
        $this->log(
            'reject',
            'Loan',
            $loanId,
            "Loan rejected. Reason: {$reason}",
            null,
            ['status' => 'rejected', 'rejection_reason' => $reason],
            $request
        );
    }

    /**
     * Log payment recorded
     */
    public function logPaymentRecorded(int $paymentId, float $amount, int $loanId, ?Request $request = null): void
    {
        $this->log(
            'record_payment',
            'Payment',
            $paymentId,
            "Payment of ₱" . number_format($amount, 2) . " recorded for loan #{$loanId}",
            null,
            ['amount_paid' => $amount, 'loan_id' => $loanId],
            $request
        );
    }

    /**
     * Log user created
     */
    public function logUserCreated(int $userId, array $userData, ?Request $request = null): void
    {
        $this->log(
            'create',
            'User',
            $userId,
            "New user created: {$userData['email'] ?? ''}",
            null,
            $userData,
            $request
        );
    }

    /**
     * Log user updated
     */
    public function logUserUpdated(int $userId, array $oldData, array $newData, ?Request $request = null): void
    {
        $this->log(
            'update',
            'User',
            $userId,
            "User updated",
            $oldData,
            $newData,
            $request
        );
    }

    /**
     * Log user deleted
     */
    public function logUserDeleted(int $userId, string $email, ?Request $request = null): void
    {
        $this->log(
            'delete',
            'User',
            $userId,
            "User deleted: {$email}",
            null,
            null,
            $request
        );
    }

    /**
     * Log user role changed
     */
    public function logUserRoleChanged(int $userId, string $oldRole, string $newRole, ?Request $request = null): void
    {
        $this->log(
            'update',
            'User',
            $userId,
            "User role changed from {$oldRole} to {$newRole}",
            ['role' => $oldRole],
            ['role' => $newRole],
            $request
        );
    }

    /**
     * Log login
     */
    public function logLogin(int $userId, ?Request $request = null): void
    {
        $this->log(
            'login',
            'User',
            $userId,
            "User logged in",
            null,
            null,
            $request
        );
    }

    /**
     * Log logout
     */
    public function logLogout(int $userId, ?Request $request = null): void
    {
        $this->log(
            'logout',
            'User',
            $userId,
            "User logged out",
            null,
            null,
            $request
        );
    }

    /**
     * Get audit logs for model
     */
    public function getLogsForModel(string $model, int $modelId)
    {
        return AuditLog::forModel($model)
            ->where('model_id', $modelId)
            ->with('user')
            ->orderByDesc('created_at')
            ->get();
    }

    /**
     * Get recent audit logs
     */
    public function getRecentLogs(int $days = 7, int $limit = 100)
    {
        return AuditLog::recent($days)
            ->with('user')
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Get user activity logs
     */
    public function getUserActivity(int $userId, int $limit = 50)
    {
        return AuditLog::byUser($userId)
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Get action summary
     */
    public function getActionSummary(string $action, int $days = 7): int
    {
        return AuditLog::forAction($action)
            ->where('created_at', '>=', now()->subDays($days))
            ->count();
    }
}
