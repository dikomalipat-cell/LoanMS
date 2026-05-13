<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Loan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'loan_amount',
        'interest_rate',
        'total_payment',
        'monthly_payment',
        'loan_term',
        'status',
        'approved_by',
        'rejection_reason',
        'disbursement_date',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'loan_amount' => 'decimal:2',
        'interest_rate' => 'decimal:2',
        'total_payment' => 'decimal:2',
        'monthly_payment' => 'decimal:2',
        'disbursement_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Relationships
    public function borrower(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'notifiable_id')
            ->where('notifiable_type', Loan::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeVerified($query)
    {
        return $query->where('status', 'verified');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopeOverdue($query)
    {
        return $query->where('status', 'overdue');
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['approved', 'overdue']);
    }

    // Accessors
    public function getRemainingBalanceAttribute()
    {
        $totalPaid = $this->payments()->sum('amount_paid');
        return $this->total_payment - $totalPaid;
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'warning',
            'verified' => 'info',
            'approved' => 'success',
            'rejected' => 'danger',
            'paid' => 'info',
            'overdue' => 'danger',
        ];
        return $badges[$this->status] ?? 'secondary';
    }

    public function getFormattedAmountAttribute()
    {
        return '₱' . number_format($this->loan_amount, 2);
    }

    public function getFormattedMonthlyPaymentAttribute()
    {
        return '₱' . number_format($this->monthly_payment, 2);
    }

    public function getPaymentsDueAttribute()
    {
        $totalPaid = $this->payments()->sum('amount_paid');
        $monthsPassed = now()->diffInMonths($this->start_date ?? $this->created_at);
        $expectedPayments = min($monthsPassed, $this->loan_term);
        $expectedTotal = $this->monthly_payment * $expectedPayments;
        return max(0, $expectedTotal - $totalPaid);
    }
}
