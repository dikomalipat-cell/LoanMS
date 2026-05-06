<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role ?? 'user';
        $client = null;

        if ($role === 'user' || $role === 'staff') {
            $client = Client::where('user_id', $user->id)->first();
        }

        $stats = [
            'pending_apps' => Client::where('status', 'pending')->count(),
            'payments_to_verify' => 0, // Placeholder
            'due_today' => Client::whereDate('due_date', now())->where('status', 'approved')->count(),
            'overdue_followups' => Client::where('due_date', '<', now())->where('status', 'approved')->count(),
            'total_borrowers' => Client::count(),
            'active_loans' => Client::where('status', 'approved')->count(),
            'total_disbursed' => Client::where('status', 'approved')->sum('loan_amount'),
        ];

        return view('dashboard', compact('role', 'client', 'stats'));
    }
}
