@extends('layouts.app')

@section('title', 'Make Payment')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Make a Payment</h1>
    <p class="text-slate-300 mt-1">Settle your active loan dues easily.</p>
</div>

<div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6 max-w-2xl">
    @if(count($loans) > 0)
    <form action="{{ route('user.payments.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">Select Loan to Pay</label>
            <select name="loan_id" class="w-full bg-primary-dark border border-slate-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-gold transition">
                @foreach($loans as $loan)
                    <option value="{{ $loan->id }}">
                        LOAN-{{ str_pad($loan->id, 4, '0', STR_PAD_LEFT) }} - Balance: ₱{{ number_format($loan->total_payment - $loan->payments()->sum('amount_paid'), 2) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">Payment Amount (₱)</label>
            <input type="number" name="amount_paid" step="0.01" required placeholder="0.00" class="w-full bg-primary-dark border border-slate-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-gold transition">
            <p class="text-xs text-slate-400 mt-2">Enter the amount you wish to pay towards your balance.</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">Payment Date</label>
            <input type="date" name="payment_date" value="{{ date('Y-m-d') }}" required class="w-full bg-primary-dark border border-slate-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-gold transition">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">Payment Method</label>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <label class="bg-primary-dark border border-slate-700 rounded-lg p-4 flex items-center cursor-pointer hover:border-gold transition">
                    <input type="radio" name="payment_method" value="bank_transfer" class="text-gold focus:ring-gold mr-3" checked>
                    <div>
                        <p class="font-medium text-white">Bank Transfer</p>
                        <p class="text-xs text-slate-400">BDO, BPI, UnionBank</p>
                    </div>
                </label>
                <label class="bg-primary-dark border border-slate-700 rounded-lg p-4 flex items-center cursor-pointer hover:border-gold transition">
                    <input type="radio" name="payment_method" value="online" class="text-gold focus:ring-gold mr-3">
                    <div>
                        <p class="font-medium text-white">E-Wallet</p>
                        <p class="text-xs text-slate-400">GCash, Maya, PayPal</p>
                    </div>
                </label>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">Reference Number (Optional)</label>
            <input type="text" name="reference_number" placeholder="e.g. TRN-12345678" class="w-full bg-primary-dark border border-slate-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-gold transition">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">Notes (Optional)</label>
            <textarea name="notes" rows="2" class="w-full bg-primary-dark border border-slate-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-gold transition"></textarea>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="bg-gold text-primary-dark px-8 py-3 rounded-lg font-bold hover:bg-gold-hover transition w-full shadow-lg">
                Submit Payment Request
            </button>
        </div>
    </form>
    @else
    <div class="text-center py-8">
        <div class="w-16 h-16 bg-primary-dark rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400">
            <i class="fas fa-info-circle text-2xl"></i>
        </div>
        <h3 class="text-lg font-medium text-white mb-2">No Active Loans to Pay</h3>
        <p class="text-slate-400 mb-6 max-w-sm mx-auto">You don't have any approved or overdue loans that require payment at this time.</p>
        <a href="{{ route('dashboard') }}" class="inline-block bg-gold text-primary-dark px-6 py-2 rounded-lg font-semibold hover-bg-gold transition">
            Return to Dashboard
        </a>
    </div>
    @endif
</div>
@endsection
