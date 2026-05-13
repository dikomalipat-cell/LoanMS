<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Services\LoanService;
use App\Services\NotificationService;
use App\Services\AuditService;
use Illuminate\Http\Request;

class AdminLoanController extends Controller
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
        $loans = Loan::with('borrower', 'approvedBy', 'payments')
            ->latest()
            ->paginate(15);

        return view('admin.loans.index', compact('loans'));
    }

    public function show(Loan $loan)
    {
        $loan->load('borrower', 'approvedBy', 'payments');
        $loanStatus = $this->loanService->getLoanStatus($loan);
        $paymentSchedule = $this->loanService->generatePaymentSchedule($loan);

        return view('admin.loans.show', compact('loan', 'loanStatus', 'paymentSchedule'));
    }

    public function approve(Loan $loan, Request $request)
    {
        if ($loan->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending loans can be approved.');
        }

        $this->loanService->approveLoan($loan, auth()->id());

        // Log the action
        $this->auditService->logLoanApproved(
            $loan->id,
            auth()->user()->name,
            $request
        );

        // Send notification to borrower
        $this->notificationService->notifyLoanApproved($loan->user_id, $loan->loan_amount);

        return redirect()->back()->with('success', 'Loan approved successfully!');
    }

    public function reject(Loan $loan, Request $request)
    {
        $request->validate([
            'rejection_reason' => ['required', 'string', 'max:500'],
        ]);

        if ($loan->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending loans can be rejected.');
        }

        $this->loanService->rejectLoan($loan, $request->rejection_reason);

        // Log the action
        $this->auditService->logLoanRejected(
            $loan->id,
            $request->rejection_reason,
            $request
        );

        // Send notification to borrower
        $this->notificationService->notifyLoanRejected($loan->user_id, $request->rejection_reason);

        return redirect()->back()->with('success', 'Loan rejected successfully!');
    }

    public function destroy(Loan $loan)
    {
        if ($loan->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending loans can be deleted.');
        }

        $loanId = $loan->id;
        $loan->delete();

        $this->auditService->log(
            'delete',
            'Loan',
            $loanId,
            'Loan deleted'
        );

        return redirect()->back()->with('success', 'Loan deleted successfully!');
    }

    public function pending()
    {
        $loans = Loan::where('status', 'pending')
            ->with('borrower', 'payments')
            ->latest()
            ->paginate(15);

        return view('admin.loans.pending', compact('loans'));
    }

    public function approved()
    {
        $loans = Loan::where('status', 'approved')
            ->with('borrower', 'approvedBy', 'payments')
            ->latest()
            ->paginate(15);

        return view('admin.loans.approved', compact('loans'));
    }

    public function rejected()
    {
        $loans = Loan::where('status', 'rejected')
            ->with('borrower', 'payments')
            ->latest()
            ->paginate(15);

        return view('admin.loans.rejected', compact('loans'));
    }

    public function paid()
    {
        $loans = Loan::where('status', 'paid')
            ->with('borrower', 'approvedBy', 'payments')
            ->latest()
            ->paginate(15);

        return view('admin.loans.paid', compact('loans'));
    }
}
