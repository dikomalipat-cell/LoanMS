<?php

namespace App\Services;

use App\Models\Loan;
use App\Models\Payment;

class LoanService
{
    /**
     * Calculate interest on a loan
     */
    public function calculateInterest(float $principal, float $rate, int $months): float
    {
        return round(($principal * $rate * $months) / (100 * 12), 2);
    }

    /**
     * Calculate monthly payment using the formula: PMT = P * [r(1+r)^n] / [(1+r)^n - 1]
     */
    public function calculateMonthlyPayment(float $principal, float $annualRate, int $months): float
    {
        $monthlyRate = ($annualRate / 100) / 12;

        if ($monthlyRate === 0) {
            return round($principal / $months, 2);
        }

        $numerator = $principal * ($monthlyRate * pow(1 + $monthlyRate, $months));
        $denominator = pow(1 + $monthlyRate, $months) - 1;

        return round($numerator / $denominator, 2);
    }

    /**
     * Calculate total payment (principal + interest)
     */
    public function calculateTotalPayment(float $principal, float $rate, int $months): float
    {
        $interest = $this->calculateInterest($principal, $rate, $months);
        return round($principal + $interest, 2);
    }

    /**
     * Create a new loan application
     */
    public function createLoan(int $userId, float $amount, int $term, float $interestRate): Loan
    {
        $interest = $this->calculateInterest($amount, $interestRate, $term);
        $totalPayment = $this->calculateTotalPayment($amount, $interestRate, $term);
        $monthlyPayment = $this->calculateMonthlyPayment($amount, $interestRate, $term);

        return Loan::create([
            'user_id' => $userId,
            'loan_amount' => $amount,
            'interest_rate' => $interestRate,
            'total_payment' => $totalPayment,
            'monthly_payment' => $monthlyPayment,
            'loan_term' => $term,
            'status' => 'pending',
        ]);
    }

    /**
     * Approve a loan
     */
    public function approveLoan(Loan $loan, int $approvedBy): Loan
    {
        $loan->update([
            'status' => 'approved',
            'approved_by' => $approvedBy,
            'disbursement_date' => now()->toDateString(),
            'start_date' => now()->toDateString(),
            'end_date' => now()->addMonths($loan->loan_term)->toDateString(),
        ]);

        return $loan;
    }

    /**
     * Reject a loan
     */
    public function rejectLoan(Loan $loan, string $reason): Loan
    {
        $loan->update([
            'status' => 'rejected',
            'rejection_reason' => $reason,
        ]);

        return $loan;
    }

    /**
     * Record a payment for a loan
     */
    public function recordPayment(
        Loan $loan,
        float $amount,
        string $paymentDate,
        int $receivedBy,
        string $paymentMethod = 'cash',
        ?string $referenceNumber = null,
        ?string $notes = null
    ): Payment {
        // Calculate remaining balance
        $totalPaid = $loan->payments()->sum('amount_paid');
        $remainingBalance = $loan->total_payment - ($totalPaid + $amount);

        $payment = Payment::create([
            'loan_id' => $loan->id,
            'amount_paid' => $amount,
            'remaining_balance' => max(0, $remainingBalance),
            'payment_date' => $paymentDate,
            'received_by' => $receivedBy,
            'payment_method' => $paymentMethod,
            'reference_number' => $referenceNumber,
            'notes' => $notes,
        ]);

        // Update loan status if fully paid
        if ($remainingBalance <= 0) {
            $loan->update(['status' => 'paid']);
        }

        return $payment;
    }

    /**
     * Calculate payment schedule for a loan
     */
    public function generatePaymentSchedule(Loan $loan): array
    {
        $schedule = [];
        $startDate = $loan->start_date ?? now();

        for ($i = 1; $i <= $loan->loan_term; $i++) {
            $dueDate = now()
                ->parse($startDate)
                ->addMonths($i - 1)
                ->toDateString();

            $schedule[] = [
                'month' => $i,
                'due_date' => $dueDate,
                'monthly_payment' => $loan->monthly_payment,
                'cumulative_payment' => $loan->monthly_payment * $i,
            ];
        }

        return $schedule;
    }

    /**
     * Get loan status with details
     */
    public function getLoanStatus(Loan $loan): array
    {
        $totalPaid = $loan->payments()->sum('amount_paid');
        $remainingBalance = $loan->total_payment - $totalPaid;
        $paymentsCount = $loan->payments()->count();
        $expectedPayments = $loan->loan_term;

        return [
            'status' => $loan->status,
            'loan_amount' => $loan->loan_amount,
            'interest_rate' => $loan->interest_rate,
            'total_payment' => $loan->total_payment,
            'monthly_payment' => $loan->monthly_payment,
            'loan_term' => $loan->loan_term,
            'total_paid' => $totalPaid,
            'remaining_balance' => $remainingBalance,
            'payments_count' => $paymentsCount,
            'payments_remaining' => $expectedPayments - $paymentsCount,
            'percentage_paid' => round(($totalPaid / $loan->total_payment) * 100, 2),
            'next_payment_date' => $this->getNextPaymentDate($loan),
        ];
    }

    /**
     * Calculate next payment due date
     */
    public function getNextPaymentDate(Loan $loan): ?string
    {
        if ($loan->status === 'paid' || !$loan->start_date) {
            return null;
        }

        $paymentsCount = $loan->payments()->count();
        $nextMonth = $paymentsCount + 1;

        if ($nextMonth > $loan->loan_term) {
            return null;
        }

        return now()
            ->parse($loan->start_date)
            ->addMonths($nextMonth - 1)
            ->toDateString();
    }

    /**
     * Calculate overdue loans
     */
    public function getOverdueLoans(): int
    {
        $overdueDate = now()->subMonth()->startOfMonth();

        return Loan::where('status', 'approved')
            ->where('end_date', '<', now())
            ->orWhere(function ($query) use ($overdueDate) {
                $query->where('status', 'approved')
                    ->whereHas('payments', function ($q) use ($overdueDate) {
                        $q->whereRaw('payment_date < DATE_ADD(date_add(payments.payment_date, INTERVAL 1 MONTH), INTERVAL 5 DAY)');
                    }, '<', 1);
            })
            ->count();
    }
}
