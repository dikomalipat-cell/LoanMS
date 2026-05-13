<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Services\LoanService;

class StaffScheduleController extends Controller
{
    protected LoanService $loanService;

    public function __construct(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    /**
     * Show loans with payments due today or in the near future.
     */
    public function due(): \Illuminate\View\View
    {
        $loans = Loan::where('status', 'approved')
            ->with('borrower', 'payments')
            ->get();

        // Filter to loans where next payment is due within 7 days
        $schedules = $loans->filter(function ($loan) {
            $nextDate = $this->loanService->getNextPaymentDate($loan);
            if (!$nextDate) {
                return false;
            }

            return now()->diffInDays($nextDate, false) <= 7 && now()->diffInDays($nextDate, false) >= 0;
        })->values();

        return view('staff.schedule.due', compact('schedules'));
    }

    /**
     * Show loans that are overdue (past end_date or missed payments).
     */
    public function overdue(): \Illuminate\View\View
    {
        $schedules = Loan::where(function ($query) {
            $query->where('status', 'overdue')
                ->orWhere(function ($q) {
                    $q->where('status', 'approved')
                        ->where('end_date', '<', now());
                });
        })
            ->with('borrower', 'payments')
            ->latest()
            ->paginate(10);

        return view('staff.schedule.overdue', compact('schedules'));
    }
}
