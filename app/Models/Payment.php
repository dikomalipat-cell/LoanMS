<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'loan_id',
        'amount_paid',
        'remaining_balance',
        'payment_date',
        'received_by',
        'payment_method',
        'reference_number',
        'notes',
    ];

    protected $casts = [
        'amount_paid' => 'decimal:2',
        'remaining_balance' => 'decimal:2',
        'payment_date' => 'date',
    ];

    // Relationships
    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }

    public function receivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    // Accessors
    public function getFormattedAmountAttribute()
    {
        return '₱' . number_format($this->amount_paid, 2);
    }

    public function getFormattedBalanceAttribute()
    {
        return '₱' . number_format($this->remaining_balance, 2);
    }
}
