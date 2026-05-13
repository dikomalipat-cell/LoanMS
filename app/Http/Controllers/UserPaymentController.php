<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordPaymentRequest;
use App\Models\Loan;
use App\Models\Payment;
use App\Services\LoanService;
use App\Services\NotificationService;
use App\Services\AuditService;
use Illuminate\Http\Request;

class UserPaymentController extends Controller
{
    protected LoanService $loanService;
    protected NotificationService $notificationService;
    protected AuditService $auditService;

    public function __construct(
        LoanService $loanService,
        NotificationService $notificationService,
        AuditService $auditService
    ) {
        $this->loanService = $loanService;
        $this->notificationService = $notificationService;
        $this->auditService = $auditService;
    }

    public function make()
    {
        $loans = auth()->user()->loans()
            ->where('status', 'approved')
            ->orWhere('status', 'overdue')
            ->get();

        return view('user.payments.make', compact('loans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'loan_id' => ['required', 'exists:loans,id'],
            'amount_paid' => ['required', 'numeric', 'min:0.01'],
            'payment_date' => ['required', 'date', 'before_or_equal:today'],
            'payment_method' => ['required', 'in:cash,check,bank_transfer,online'],
            'reference_number' => ['nullable', 'string', 'max:100'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $loan = Loan::find($request->loan_id);

        // Verify user owns this loan
        if ($loan->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You cannot make a payment for this loan.');
        }

        // Validate the amount
        $totalPaid = $loan->payments()->sum('amount_paid');
        $remaining = $loan->total_payment - $totalPaid;

        if ($request->amount_paid > $remaining) {
            return redirect()->back()->with('error', 'Payment amount exceeds remaining balance.');
        }

        // Record payment
        $payment = $this->loanService->recordPayment(
            $loan,
            (float) $request->amount_paid,
            $request->payment_date,
            auth()->id(),
            $request->payment_method,
            $request->reference_number,
            $request->notes
        );

        // Log the action
        $this->auditService->logPaymentRecorded(
            $payment->id,
            $payment->amount_paid,
            $loan->id,
            $request
        );

        // Send notification
        $this->notificationService->notifyPaymentReceived(
            auth()->id(),
            $payment->amount_paid,
            $payment->remaining_balance
        );

        // Notify staff about payment
        $this->notificationService->notifyStaff(
            'Payment Received',
            "Payment of ₱" . number_format($payment->amount_paid, 2) . " received from " . auth()->user()->name,
            'success',
            'payment_received'
        );

        // Notify if loan is fully paid
        if ($loan->status === 'paid') {
            $this->notificationService->notifyLoanFullyPaid(auth()->id(), $loan->total_payment);
        }

        return redirect()->route('user.payments.history')
            ->with('success', 'Payment recorded successfully! Remaining balance: ₱' . number_format($payment->remaining_balance, 2));
    }

    public function history()
    {
        $payments = Payment::whereHas('loan', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->with('loan')
        ->latest()
        ->paginate(15);

        return view('user.payments.history', compact('payments'));
    }
}
