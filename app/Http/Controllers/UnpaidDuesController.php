<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class UnpaidDuesController extends Controller
{
    /**
     * Display a listing of unpaid dues and delinquent accounts.
     */
    public function index()
    {
        // Get loans that are overdue or have payments due within 7 days
        $dues = Loan::whereIn('status', ['approved', 'overdue'])
            ->with('borrower', 'payments')
            ->get()
            ->map(function ($loan) {
                $loan->is_overdue = $loan->status === 'overdue' || (now()->greaterThan($loan->end_date ?? now()));
                $loan->days_remaining = now()->diffInDays($loan->end_date, false);
                return $loan;
            })
            ->filter(function ($loan) {
                return $loan->is_overdue || $loan->days_remaining <= 7;
            })
            ->values();

        return view('waykabayad.index', compact('dues'));
    }
}
