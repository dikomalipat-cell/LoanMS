<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Payment;
use App\Models\User;
use App\Services\LoanService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected LoanService $loanService;

    public function __construct(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    public function index(): \Illuminate\View\View
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

    /**
     * ADMIN DASHBOARD
     * Shows: total borrowers, active loans, overdue loans, disbursement/collection totals
     */
    private function adminDashboard(string $role): \Illuminate\View\View
    {
        $stats = [
            'total_borrowers' => User::where('role', 'user')->count(),
            'active_loans' => Loan::whereIn('status', ['approved', 'overdue'])->count(),
            'overdue_followups' => Loan::where('status', 'overdue')->count(),
            'total_disbursed' => Loan::sum('loan_amount'),
            'total_collected' => Payment::sum('amount_paid'),
            'pending_applications' => Loan::where('status', 'pending')->count(),
        ];

        $recentLoans = Loan::with('borrower')->latest()->take(5)->get();
        $recentPayments = Payment::with('loan.borrower')->latest()->take(5)->get();

        return view('dashboard', compact('role', 'stats', 'recentLoans', 'recentPayments'));
    }

    /**
     * STAFF DASHBOARD
     * Shows: pending applications, payments to verify, due/overdue counts
     */
    private function staffDashboard(string $role): \Illuminate\View\View
    {
        $stats = [
            'pending_apps' => Loan::where('status', 'pending')->count(),
            'payments_to_verify' => Payment::where('created_at', '>=', now()->subDay())->count(),
            'due_today' => Loan::where('status', 'approved')
                ->whereNotNull('start_date')
                ->get()
                ->filter(function ($loan) {
                    $nextDate = $this->loanService->getNextPaymentDate($loan);

                    return $nextDate && $nextDate === now()->toDateString();
                })
                ->count(),
            'overdue_followups' => Loan::where('status', 'overdue')
                ->orWhere(function ($q) {
                    $q->where('status', 'approved')->where('end_date', '<', now());
                })
                ->count(),
        ];

        $pendingLoans = Loan::where('status', 'pending')->with('borrower')->latest()->take(10)->get();
        $duePayments = Loan::where('status', 'approved')->with('payments', 'borrower')->get();

        return view('dashboard', compact('role', 'stats', 'pendingLoans', 'duePayments'));
    }

    /**
     * USER / BORROWER DASHBOARD
     * Shows: active loan details, payment schedule, remaining balance
     */
    private function userDashboard(string $role): \Illuminate\View\View
    {
        $user = Auth::user();
        $activeLoan = $user->loans()
            ->whereIn('status', ['approved', 'overdue'])
            ->first();

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
        $unreadNotifications = $user->notifications()->where('is_read', false)->count();

        return view('dashboard', compact(
            'activeLoan',
            'stats',
            'nextPaymentDate',
            'remainingBalance',
            'recentPayments',
            'pendingLoans',
            'unreadNotifications',
            'role'
        ));
    }
}
