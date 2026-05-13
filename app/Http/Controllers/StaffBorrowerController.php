<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;

class StaffBorrowerController extends Controller
{
    /**
     * Show all borrowers (users with role=user).
     */
    public function all(): \Illuminate\View\View
    {
        $borrowers = User::where('role', 'user')
            ->withCount('loans')
            ->latest()
            ->paginate(10);

        return view('staff.borrowers.all', compact('borrowers'));
    }

    /**
     * Show borrowers who have at least one approved/active loan.
     */
    public function verified(): \Illuminate\View\View
    {
        $borrowers = User::where('role', 'user')
            ->whereHas('loans', function ($query) {
                $query->whereIn('status', ['approved', 'paid', 'overdue']);
            })
            ->withCount('loans')
            ->latest()
            ->paginate(10);

        return view('staff.borrowers.verified', compact('borrowers'));
    }
}
