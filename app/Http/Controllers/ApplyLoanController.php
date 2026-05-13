<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoanRequest;
use App\Models\Loan;
use App\Services\LoanService;
use App\Services\NotificationService;
use App\Services\AuditService;

class ApplyLoanController extends Controller
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

    public function index()
    {
        $defaultInterestRate = 8.5; // Default interest rate (can be made configurable)
        return view('user.loans.apply', ['defaultInterestRate' => $defaultInterestRate]);
    }

    public function store(StoreLoanRequest $request)
    {
        $user = auth()->user();
        $defaultInterestRate = 8.5; // Default interest rate

        $loan = $this->loanService->createLoan(
            $user->id,
            (float) $request->loan_amount,
            (int) $request->loan_term,
            $defaultInterestRate
        );

        // Log the action
        $this->auditService->logLoanCreated(
            $loan->id,
            $loan->toArray(),
            $request
        );

        // Create notification
        $this->notificationService->notifyLoanApplicationCreated($loan);

        // Notify admins about new application
        $this->notificationService->notifyAdmins(
            'New Loan Application',
            "{$user->name} has submitted a loan application for ₱" . number_format($loan->loan_amount, 2),
            'info',
            'new_application',
            get_class($loan),
            $loan->id
        );

        return redirect()->route('user.loans.active')
            ->with('success', 'Loan application submitted successfully! Your application is now pending review.');
    }
}
