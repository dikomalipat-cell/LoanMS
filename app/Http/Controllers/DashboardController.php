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
            return $this->adminDashboard($role);
        } elseif ($role === 'staff') {
            return $this->staffDashboard($role);
        } else {
            return $this->userDashboard($role);
        }
    }

    private function adminDashboard(string $role)
    {
        $stats = [
            'total_borrowers' => \App\Models\User::where('role', 'user')->count(),
            'active_loans' => Loan::whereIn('status', ['approved', 'overdue'])->count(),
            'overdue_followups' => Loan::where('status', 'overdue')->count(),
            'total_disbursed' => Loan::sum('loan_amount'),
            'total_collected' => Payment::sum('amount_paid'),
        ];

        $recentLoans = Loan::with('borrower')->latest()->take(5)->get();
        $recentPayments = Payment::with('loan.borrower')->latest()->take(5)->get();
        $client = null;

        return view('dashboard', compact('role', 'stats', 'recentLoans', 'recentPayments', 'client'));
    }

    private function staffDashboard(string $role)
    {
        $stats = [
            'pending_apps' => Loan::where('status', 'pending')->count(),
            'payments_to_verify' => Payment::where('created_at', '>=', now()->subDay())->count(),
            'due_today' => Loan::where('status', 'approved')
                ->get()
                ->filter(function ($loan) {
                    return $this->loanService->getNextPaymentDate($loan) === now()->toDateString();
                })
                ->count(),
            'overdue_followups' => Loan::where('status', 'overdue')->orWhere('end_date', '<', now())->count(),
        ];

        $pendingLoans = Loan::where('status', 'pending')->with('borrower')->latest()->take(10)->get();
        $duePayments = Loan::where('status', 'approved')->with('payments', 'borrower')->get();
        $client = null;

        return view('dashboard', compact('role', 'stats', 'pendingLoans', 'duePayments', 'client'));
    }

    private function userDashboard(string $role)
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
        $client = $user->client;

        return view('dashboard', compact(
            'activeLoan',
            'stats',
            'nextPaymentDate',
            'remainingBalance',
            'recentPayments',
            'pendingLoans',
            'unreadNotifications',
            'role',
            'client'
        ));
    }
}
