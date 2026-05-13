<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Payment;
use App\Models\AuditLog;
use App\Models\User;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    // Dashboard methods
    public function loansIndex()
    {
        $loans = Loan::with('borrower', 'approvedBy')->latest()->paginate(15);
        $stats = [
            'total' => Loan::count(),
            'approved' => Loan::where('status', 'approved')->count(),
            'pending' => Loan::where('status', 'pending')->count(),
            'paid' => Loan::where('status', 'paid')->count(),
            'rejected' => Loan::where('status', 'rejected')->count(),
        ];

        return view('admin.loans.index', compact('loans', 'stats'));
    }

    public function loansPending()
    {
        $loans = Loan::where('status', 'pending')->with('borrower')->latest()->paginate(15);
        return view('admin.loans.pending', compact('loans'));
    }

    public function loansApproved()
    {
        $loans = Loan::where('status', 'approved')->with('borrower', 'approvedBy')->latest()->paginate(15);
        return view('admin.loans.approved', compact('loans'));
    }

    public function loansRejected()
    {
        $loans = Loan::where('status', 'rejected')->with('borrower')->latest()->paginate(15);
        return view('admin.loans.rejected', compact('loans'));
    }

    public function loansOverdue()
    {
        $loans = Loan::where('status', 'approved')
            ->orWhere('status', 'overdue')
            ->with('borrower', 'payments')
            ->latest()
            ->paginate(15);

        return view('admin.loans.overdue', compact('loans'));
    }

    // Reports
    public function reportsLoans()
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

        $monthlyLoans = Loan::selectRaw('MONTH(created_at) as month, COUNT(*) as count, SUM(loan_amount) as amount')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->get();

        return view('admin.reports.loans', compact('totalDisbursed', 'totalCollected', 'outstandingBalance', 'loansByStatus', 'monthlyLoans'));
    }

    public function reportsPayments()
    {
        $totalDisbursed = Loan::sum('loan_amount');
        $totalCollected = Payment::sum('amount_paid');
        $outstandingBalance = $totalDisbursed - $totalCollected;

        $avgPayment = Payment::avg('amount_paid');
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

    public function reportsActivity()
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

