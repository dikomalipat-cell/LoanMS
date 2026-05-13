<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Payment;
use App\Services\LoanService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected LoanService $loanService;

    public function __construct(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    public function index()
    {
        $user = Auth::user();
        $role = $user->role ?? 'user';

        if ($role === 'admin') {
            return $this->adminDashboard();
        } elseif ($role === 'staff') {
            return $this->staffDashboard();
        } else {
            return $this->userDashboard();
        }
    }

    private function adminDashboard()
    {
        $stats = [
            'total_users' => \App\Models\User::where('role', 'user')->count(),
            'total_staff' => \App\Models\User::where('role', 'staff')->count(),
            'total_loans' => Loan::count(),
            'pending_loans' => Loan::where('status', 'pending')->count(),
            'approved_loans' => Loan::where('status', 'approved')->count(),
            'rejected_loans' => Loan::where('status', 'rejected')->count(),
            'total_disbursed' => Loan::sum('loan_amount'),
            'total_collected' => Payment::sum('amount_paid'),
        ];

        $recentLoans = Loan::with('borrower')->latest()->take(5)->get();
        $recentPayments = Payment::with('loan.borrower')->latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentLoans', 'recentPayments'));
    }

    private function staffDashboard()
    {
        $stats = [
            'pending_applications' => Loan::where('status', 'pending')->count(),
            'payments_to_verify' => Payment::where('created_at', '>=', now()->subDay())->count(),
            'due_today' => Loan::whereApproved()
                ->get()
                ->filter(function ($loan) {
                    return $this->loanService->getNextPaymentDate($loan) === now()->toDateString();
                })
                ->count(),
            'overdue_followups' => Loan::where('status', 'overdue')->orWhere('end_date', '<', now())->count(),
            'verified_borrowers' => Loan::where('status', 'approved')->distinct('user_id')->count('user_id'),
        ];

        $pendingLoans = Loan::where('status', 'pending')->with('borrower')->latest()->take(10)->get();
        $duePayments = Loan::where('status', 'approved')->with('payments', 'borrower')->get();

        return view('dashboard', compact('stats', 'pendingLoans', 'duePayments'));
    }

    private function userDashboard()
    {
        $user = Auth::user();
        $activeLoan = $user->loans()->where('status', 'approved')->orWhere('status', 'overdue')->first();

        $stats = null;
        $nextPaymentDate = null;
        $remainingBalance = null;
        $recentPayments = null;

        if ($activeLoan) {
            $stats = $this->loanService->getLoanStatus($activeLoan);
            $nextPaymentDate = $this->loanService->getNextPaymentDate($activeLoan);
            $remainingBalance = $activeLoan->total_payment - $activeLoan->payments()->sum('amount_paid');
            $recentPayments = $activeLoan->payments()->latest()->take(5)->get();
        }

        $pendingLoans = $user->loans()->where('status', 'pending')->count();
        $unreadNotifications = $user->getUnreadNotificationsCount();

        return view('dashboard', compact(
            'activeLoan',
            'stats',
            'nextPaymentDate',
            'remainingBalance',
            'recentPayments',
            'pendingLoans',
            'unreadNotifications'
        ));
    }
}
