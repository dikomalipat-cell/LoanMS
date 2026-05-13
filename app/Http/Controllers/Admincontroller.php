<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Loan;
use App\Models\Payment;
use App\Models\User;
use App\Services\AuditService;
use App\Services\LoanService;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class AdminController extends Controller
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

    public function login(): \Illuminate\View\View
    {
        return view('admin.login');
    }

    // ── Loan Listing ──────────────────────────────────────────

    public function loansIndex(): \Illuminate\View\View
    {
        $loans = Loan::with('borrower', 'approvedBy')->latest()->paginate(15);
        $stats = [
            'total' => Loan::count(),
            'approved' => Loan::where('status', 'approved')->count(),
            'pending' => Loan::where('status', 'pending')->count(),
            'paid' => Loan::where('status', 'paid')->count(),
            'rejected' => Loan::where('status', 'rejected')->count(),
            'overdue' => Loan::where('status', 'overdue')->count(),
        ];

        return view('admin.loans.index', compact('loans', 'stats'));
    }

    public function loansPending(): \Illuminate\View\View
    {
        $loans = Loan::where('status', 'pending')->with('borrower')->latest()->paginate(15);

        return view('admin.loans.pending', compact('loans'));
    }

    public function loansApproved(): \Illuminate\View\View
    {
        $loans = Loan::where('status', 'approved')->with('borrower', 'approvedBy')->latest()->paginate(15);

        return view('admin.loans.approved', compact('loans'));
    }

    public function loansRejected(): \Illuminate\View\View
    {
        $loans = Loan::where('status', 'rejected')->with('borrower')->latest()->paginate(15);

        return view('admin.loans.rejected', compact('loans'));
    }

    public function loansOverdue(): \Illuminate\View\View
    {
        $loans = Loan::where('status', 'approved')
            ->orWhere('status', 'overdue')
            ->with('borrower', 'payments')
            ->latest()
            ->paginate(15);

        return view('admin.loans.overdue', compact('loans'));
    }

    // ── Loan Actions (Approve / Reject) ──────────────────────

    /**
     * Admin approves a loan application.
     * This is the final step in the workflow:
     *   User applies → Staff verifies → Admin approves
     */
    public function approveLoan(Request $request, Loan $loan): \Illuminate\Http\RedirectResponse
    {
        if ($loan->status !== 'pending') {
            return redirect()->back()->with('error', 'This loan is not in pending status.');
        }

        $this->loanService->approveLoan($loan, auth()->id());

        // Audit log
        $this->auditService->logLoanApproved($loan->id, auth()->user()->name, $request);

        // Notify borrower
        $this->notificationService->notifyLoanApproved($loan->user_id, $loan->loan_amount);

        return redirect()->back()->with('success', "Loan #{$loan->id} for {$loan->borrower->name} has been approved.");
    }

    /**
     * Admin rejects a loan application.
     */
    public function rejectLoan(Request $request, Loan $loan): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'rejection_reason' => ['required', 'string', 'max:500'],
        ]);

        if ($loan->status !== 'pending') {
            return redirect()->back()->with('error', 'This loan is not in pending status.');
        }

        $this->loanService->rejectLoan($loan, $request->rejection_reason);

        // Audit log
        $this->auditService->logLoanRejected($loan->id, $request->rejection_reason, $request);

        // Notify borrower
        $this->notificationService->notifyLoanRejected($loan->user_id, $request->rejection_reason);

        return redirect()->back()->with('success', "Loan #{$loan->id} has been rejected.");
    }

    // ── Reports ──────────────────────────────────────────────

    public function reportsLoans(): \Illuminate\View\View
    {
        $totalDisbursed = Loan::sum('loan_amount');
        $totalCollected = Payment::sum('amount_paid');
        $outstandingBalance = $totalDisbursed - $totalCollected;

        $loansByStatus = [
            'pending' => Loan::where('status', 'pending')->count(),
            'approved' => Loan::where('status', 'approved')->count(),
            'paid' => Loan::where('status', 'paid')->count(),
            'rejected' => Loan::where('status', 'rejected')->count(),
        ];

        $monthlyVolume = [];
        for ($i = 4; $i >= 0; $i--) {
            $monthDate = now()->subMonths($i);
            $count = Loan::whereMonth('created_at', $monthDate->month)
                ->whereYear('created_at', $monthDate->year)
                ->count();

            $monthlyVolume[] = [
                'm' => $monthDate->format('M'),
                'v' => $count,
                'pct' => $count > 0 ? min(100, ($count / max(Loan::count(), 1)) * 100) : 0,
            ];
        }

        return view('admin.reports.loans', compact('totalDisbursed', 'totalCollected', 'outstandingBalance', 'loansByStatus', 'monthlyVolume'));
    }

    public function reportsPayments(): \Illuminate\View\View
    {
        $totalDisbursed = Loan::sum('loan_amount');
        $totalCollected = Payment::sum('amount_paid');
        $outstandingBalance = $totalDisbursed - $totalCollected;

        $avgPayment = Payment::avg('amount_paid') ?? 0;
        $collectionRate = $totalDisbursed > 0 ? round(($totalCollected / $totalDisbursed) * 100, 2) : 0;

        $recentPayments = Payment::with('loan.borrower', 'receivedBy')
            ->latest()
            ->take(15)
            ->get();

        $monthlyPayments = Payment::selectRaw('MONTH(payment_date) as month, COUNT(*) as count, SUM(amount_paid) as amount')
            ->whereYear('payment_date', now()->year)
            ->groupBy('month')
            ->get();

        return view('admin.reports.payments', compact('totalCollected', 'avgPayment', 'collectionRate', 'recentPayments', 'monthlyPayments', 'outstandingBalance'));
    }

    public function reportsActivity(): \Illuminate\View\View
    {
        $auditLogs = AuditLog::with('user')
            ->latest()
            ->take(20)
            ->get()
            ->map(function ($log) {
                return [
                    'user' => $log->user?->name ?? 'System',
                    'action' => $log->action,
                    'description' => $log->description,
                    'time' => $log->created_at->diffForHumans(),
                    'model' => $log->model,
                ];
            });

        return view('admin.reports.activity', compact('auditLogs'));
    }
}
