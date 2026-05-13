@extends('layouts.app')
@section('title', 'Payment Tracking')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Payment Tracking</h1>
    <p class="text-slate-300 mt-1">Record payments from borrowers for active loans.</p>
</div>

@if(session('success'))
<div class="mb-4 bg-green-500/20 border border-green-500/30 text-green-400 px-4 py-3 rounded-xl text-sm">
    <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="mb-4 bg-red-500/20 border border-red-500/30 text-red-400 px-4 py-3 rounded-xl text-sm">
    <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
</div>
@endif

<!-- Record Payment Form -->
<div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6 mb-6">
    <h3 class="text-lg font-bold text-white mb-4"><i class="fas fa-money-bill-wave text-gold mr-2"></i>Record New Payment</h3>
    <form action="{{ route('staff.payments.record') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-slate-300 mb-1">Loan</label>
            <select name="loan_id" class="w-full bg-primary-dark border border-slate-600 rounded-lg px-3 py-2.5 text-white focus:border-gold focus:outline-none" required>
                <option value="">Select a loan...</option>
                @foreach($loans as $loan)
                <option value="{{ $loan->id }}">LOAN-{{ str_pad($loan->id, 4, '0', STR_PAD_LEFT) }} — {{ $loan->borrower->name ?? 'Unknown' }} (Balance: ₱{{ number_format($loan->remaining_balance, 2) }})</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-300 mb-1">Amount Paid</label>
            <input type="number" name="amount_paid" step="0.01" min="0.01" class="w-full bg-primary-dark border border-slate-600 rounded-lg px-3 py-2.5 text-white focus:border-gold focus:outline-none" placeholder="0.00" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-300 mb-1">Payment Date</label>
            <input type="date" name="payment_date" value="{{ date('Y-m-d') }}" class="w-full bg-primary-dark border border-slate-600 rounded-lg px-3 py-2.5 text-white focus:border-gold focus:outline-none" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-300 mb-1">Payment Method</label>
            <select name="payment_method" class="w-full bg-primary-dark border border-slate-600 rounded-lg px-3 py-2.5 text-white focus:border-gold focus:outline-none" required>
                <option value="cash">Cash</option>
                <option value="check">Check</option>
                <option value="bank_transfer">Bank Transfer</option>
                <option value="online">Online Payment</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-300 mb-1">Reference # (optional)</label>
            <input type="text" name="reference_number" class="w-full bg-primary-dark border border-slate-600 rounded-lg px-3 py-2.5 text-white focus:border-gold focus:outline-none" placeholder="e.g. CHK-001">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-300 mb-1">Notes (optional)</label>
            <input type="text" name="notes" class="w-full bg-primary-dark border border-slate-600 rounded-lg px-3 py-2.5 text-white focus:border-gold focus:outline-none" placeholder="Additional details">
        </div>
        <div class="md:col-span-3">
            <button type="submit" class="bg-gold text-primary-dark px-6 py-2.5 rounded-lg font-bold hover:bg-gold-hover transition">
                <i class="fas fa-save mr-1"></i> Record Payment
            </button>
        </div>
    </form>
</div>

<!-- Active Loans Table -->
<div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6">
    <h3 class="text-lg font-bold text-white mb-4"><i class="fas fa-list text-gold mr-2"></i>Active Loans</h3>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-primary-dark border-b border-slate-700">
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Loan ID</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Borrower</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Loan Amount</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Monthly</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Balance</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                <tr class="border-b border-slate-700 hover:bg-primary-dark transition">
                    <td class="p-4 text-sm font-medium text-white">LOAN-{{ str_pad($loan->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td class="p-4 text-sm text-slate-300">{{ $loan->borrower->name ?? 'Unknown' }}</td>
                    <td class="p-4 text-sm text-white">₱{{ number_format($loan->loan_amount, 2) }}</td>
                    <td class="p-4 text-sm text-slate-300">₱{{ number_format($loan->monthly_payment, 2) }}</td>
                    <td class="p-4 text-sm font-semibold text-gold">₱{{ number_format($loan->remaining_balance, 2) }}</td>
                    <td class="p-4">
                        @if($loan->status === 'approved')
                        <span class="bg-green-500/20 text-green-400 px-2 py-1 rounded-full text-xs font-semibold">Active</span>
                        @else
                        <span class="bg-red-500/20 text-red-400 px-2 py-1 rounded-full text-xs font-semibold">Overdue</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-slate-400 text-sm">No active loans found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $loans->links() }}
    </div>
</div>
@endsection
