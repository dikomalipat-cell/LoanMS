<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Payment;
use App\Services\AuditService;
use App\Services\LoanService;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class StaffPaymentController extends Controller
{
    protected LoanService $loanService;
    protected AuditService $auditService;
    protected NotificationService $notificationService;

    public function __construct(
        LoanService $loanService,
        AuditService $auditService,
        NotificationService $notificationService
    ) {
        $this->loanService = $loanService;
        $this->auditService = $auditService;
        $this->notificationService = $notificationService;
    }

    /**
     * Show active loans where payments can be recorded.
     */
    public function tracking(): \Illuminate\View\View
    {
        $loans = Loan::whereIn('status', ['approved', 'overdue'])
            ->with('borrower', 'payments')
            ->latest()
            ->paginate(10);

        return view('staff.payments.tracking', compact('loans'));
    }

    /**
     * Staff records a payment on behalf of a borrower.
     * Workflow: User makes payment → STAFF RECORDS IT → Admin monitors reports
     */
    public function recordPayment(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'loan_id' => ['required', 'exists:loans,id'],
            'amount_paid' => ['required', 'numeric', 'min:0.01'],
            'payment_date' => ['required', 'date', 'before_or_equal:today'],
            'payment_method' => ['required', 'in:cash,check,bank_transfer,online'],
            'reference_number' => ['nullable', 'string', 'max:100'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $loan = Loan::findOrFail($request->loan_id);

        // Validate the amount doesn't exceed remaining balance
        $totalPaid = $loan->payments()->sum('amount_paid');
        $remaining = $loan->total_payment - $totalPaid;

        if ($request->amount_paid > $remaining) {
            return redirect()->back()->with('error', 'Payment amount exceeds remaining balance of ₱'.number_format($remaining, 2));
        }

        // Record payment through the LoanService
        $payment = $this->loanService->recordPayment(
            $loan,
            (float) $request->amount_paid,
            $request->payment_date,
            auth()->id(),
            $request->payment_method,
            $request->reference_number,
            $request->notes
        );

        // Audit log
        $this->auditService->logPaymentRecorded(
            $payment->id,
            $payment->amount_paid,
            $loan->id,
            $request
        );

        // Notify borrower
        $this->notificationService->notifyPaymentReceived(
            $loan->user_id,
            $payment->amount_paid,
            $payment->remaining_balance
        );

        // If loan is fully paid, notify everyone
        if ($loan->fresh()->status === 'paid') {
            $this->notificationService->notifyLoanFullyPaid($loan->user_id, $loan->total_payment);
            $this->notificationService->notifyAdmins(
                'Loan Fully Paid',
                "Loan #{$loan->id} for {$loan->borrower->name} has been fully paid.",
                'success',
                'loan_paid'
            );
        }

        return redirect()->route('staff.payments.tracking')
            ->with('success', 'Payment of ₱'.number_format($payment->amount_paid, 2).' recorded successfully for '.$loan->borrower->name);
    }

    /**
     * Show all payment history.
     */
    public function history(): \Illuminate\View\View
    {
        $payments = Payment::with('loan.borrower', 'receivedBy')
            ->latest()
            ->paginate(15);

        return view('staff.payments.history', compact('payments'));
    }
}
