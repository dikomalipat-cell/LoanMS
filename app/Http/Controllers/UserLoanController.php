<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Services\LoanService;

class UserLoanController extends Controller
{
    protected LoanService $loanService;

    public function __construct(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    public function active()
    {
        $loans = auth()->user()->loans()
            ->where('status', 'approved')
            ->orWhere('status', 'overdue')
            ->with('payments')
            ->get();

        $loanDetails = $loans->map(fn ($loan) => [
            'loan' => $loan,
            'status' => $this->loanService->getLoanStatus($loan),
            'payments' => $loan->payments()->latest()->take(5)->get(),
        ]);

        return view('user.loans.active', ['loanDetails' => $loanDetails]);
    }

    public function history()
    {
        $loans = auth()->user()->loans()
            ->whereIn('status', ['paid', 'rejected'])
            ->with('payments')
            ->latest()
            ->paginate(10);

        return view('user.loans.history', compact('loans'));
    }

    public function show(Loan $loan)
    {
        // Verify user owns this loan
        if ($loan->user_id !== auth()->id()) {
            abort(403);
        }

        $loanStatus = $this->loanService->getLoanStatus($loan);
        $paymentSchedule = $this->loanService->generatePaymentSchedule($loan);
        $payments = $loan->payments()->latest()->get();

        return view('user.loans.show', compact('loan', 'loanStatus', 'paymentSchedule', 'payments'));
    }
}
