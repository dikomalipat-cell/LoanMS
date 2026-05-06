<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function reportsLoans()
    {
        $totalDisbursed = \App\Models\Client::sum('loan_amount');
        $outstandingBalance = \App\Models\Client::sum('balance');
        $totalCollected = $totalDisbursed - $outstandingBalance;

        $monthlyVolume = \App\Models\Client::selectRaw('MONTHNAME(created_at) as month_name, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(5))
            ->groupBy('month_name')
            ->orderByRaw('MIN(created_at) DESC')
            ->get()
            ->map(function ($item) {
                return [
                    'm' => substr($item->month_name, 0, 3),
                    'v' => $item->count,
                    'pct' => min(100, ($item->count / 10) * 100), // Scale to 10 for demo-like bars
                ];
            });

        return view('admin.reports.loans', compact('totalDisbursed', 'totalCollected', 'outstandingBalance', 'monthlyVolume'));
    }

    public function loansIndex()
    {
        $loans = \App\Models\Client::latest()->paginate(15);
        $stats = [
            'total' => \App\Models\Client::count(),
            'approved' => \App\Models\Client::where('status', 'approved')->count(),
            'pending' => \App\Models\Client::where('status', 'pending')->count(),
            'overdue' => \App\Models\Client::where('status', 'approved')->where('due_date', '<', now())->count(),
        ];

        return view('admin.loans.index', compact('loans', 'stats'));
    }

    public function loansPending()
    {
        $loans = \App\Models\Client::where('status', 'pending')->latest()->paginate(10);

        return view('admin.loans.pending', compact('loans'));
    }

    public function loansApproved()
    {
        $loans = \App\Models\Client::where('status', 'approved')->latest()->paginate(10);

        return view('admin.loans.approved', compact('loans'));
    }

    public function loansRejected()
    {
        $loans = \App\Models\Client::where('status', 'rejected')->latest()->paginate(10);

        return view('admin.loans.rejected', compact('loans'));
    }

    public function loansOverdue()
    {
        $loans = \App\Models\Client::where('status', 'approved')
            ->where('due_date', '<', now())
            ->latest()
            ->paginate(10);

        return view('admin.loans.overdue', compact('loans'));
    }

    public function reportsOverdue()
    {
        $loans = \App\Models\Client::where('status', 'approved')
            ->where('due_date', '<', now())
            ->latest()
            ->paginate(10);

        return view('admin.loans.overdue', compact('loans'));
    }

    public function reportsActivity()
    {
        $users = \App\Models\User::latest()->take(10)->get()->map(function ($user) {
            return [
                'user' => $user->name,
                'action' => 'joined the system as '.$user->role,
                'type' => 'auth',
                'time' => $user->created_at->diffForHumans(),
                'icon' => 'fa-user-plus',
                'color' => 'blue',
            ];
        });

        $loans = \App\Models\Client::latest()->take(10)->get()->map(function ($loan) {
            return [
                'user' => $loan->full_name,
                'action' => 'submitted a loan application for ₱'.number_format($loan->loan_amount, 2),
                'type' => 'loan',
                'time' => $loan->created_at->diffForHumans(),
                'icon' => 'fa-file-invoice-dollar',
                'color' => 'yellow',
            ];
        });

        $logs = $users->concat($loans)->sortByDesc('time')->take(15);

        return view('admin.reports.activity', compact('logs'));
    }

    public function reportsPayments()
    {
        $totalDisbursed = \App\Models\Client::sum('loan_amount');
        $outstandingBalance = \App\Models\Client::sum('balance');
        $totalCollected = $totalDisbursed - $outstandingBalance;

        $avgPayment = \App\Models\Client::whereRaw('loan_amount - balance > 0')->get()->avg(function ($client) {
            return $client->loan_amount - $client->balance;
        }) ?? 0;

        $collectionRate = $totalDisbursed > 0
            ? round(($totalCollected / $totalDisbursed) * 100)
            : 0;

        $recentPayments = \App\Models\Client::whereRaw('loan_amount - balance > 0')
            ->latest('updated_at')
            ->take(10)
            ->get();

        return view('admin.reports.payments', compact('totalCollected', 'avgPayment', 'collectionRate', 'recentPayments'));
    }
}
