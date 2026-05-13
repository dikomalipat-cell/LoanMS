@extends('layouts.app')
@section('title', 'Review Loan Application')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Review Loan Application</h1>
    <p class="text-slate-300 mt-1">Verify borrower information and forward to Admin for approval.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Loan Details -->
    <div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6">
        <h3 class="text-lg font-bold text-white mb-4"><i class="fas fa-file-alt text-gold mr-2"></i>Loan Details</h3>
        <div class="space-y-3">
            <div class="flex justify-between border-b border-slate-700 pb-2">
                <span class="text-slate-400">Loan ID</span>
                <span class="text-white font-semibold">LOAN-{{ str_pad($loan->id, 4, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="flex justify-between border-b border-slate-700 pb-2">
                <span class="text-slate-400">Amount Requested</span>
                <span class="text-gold font-bold">₱{{ number_format($loan->loan_amount, 2) }}</span>
            </div>
            <div class="flex justify-between border-b border-slate-700 pb-2">
                <span class="text-slate-400">Interest Rate</span>
                <span class="text-white">{{ $loan->interest_rate }}%</span>
            </div>
            <div class="flex justify-between border-b border-slate-700 pb-2">
                <span class="text-slate-400">Term</span>
                <span class="text-white">{{ $loan->loan_term }} months</span>
            </div>
            <div class="flex justify-between border-b border-slate-700 pb-2">
                <span class="text-slate-400">Monthly Payment</span>
                <span class="text-white">₱{{ number_format($loan->monthly_payment, 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-400">Total Payment</span>
                <span class="text-white font-bold">₱{{ number_format($loan->total_payment, 2) }}</span>
            </div>
        </div>
    </div>

    <!-- Borrower Information -->
    <div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6">
        <h3 class="text-lg font-bold text-white mb-4"><i class="fas fa-user text-gold mr-2"></i>Borrower Information</h3>
        <div class="space-y-3">
            <div class="flex justify-between border-b border-slate-700 pb-2">
                <span class="text-slate-400">Name</span>
                <span class="text-white font-semibold">{{ $loan->borrower->name ?? 'Unknown' }}</span>
            </div>
            <div class="flex justify-between border-b border-slate-700 pb-2">
                <span class="text-slate-400">Email</span>
                <span class="text-white">{{ $loan->borrower->email ?? 'N/A' }}</span>
            </div>
            <div class="flex justify-between border-b border-slate-700 pb-2">
                <span class="text-slate-400">Applied On</span>
                <span class="text-white">{{ $loan->created_at->format('M d, Y h:i A') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-400">Status</span>
                <span class="bg-yellow-500/20 text-yellow-400 px-2 py-1 rounded-full text-xs font-semibold">{{ ucfirst($loan->status) }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Staff Action -->
<div class="mt-6 bg-primary rounded-xl shadow-sm border border-slate-700 p-6">
    <h3 class="text-lg font-bold text-white mb-4"><i class="fas fa-clipboard-check text-gold mr-2"></i>Staff Verification</h3>
    <form action="{{ route('staff.applications.verify', $loan) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="staff_notes" class="block text-sm font-medium text-slate-300 mb-2">Verification Notes (optional)</label>
            <textarea name="staff_notes" id="staff_notes" rows="3" class="w-full bg-primary-dark border border-slate-600 rounded-lg px-4 py-3 text-white placeholder-slate-500 focus:border-gold focus:ring-gold focus:outline-none" placeholder="Add any notes about document verification, borrower status, etc."></textarea>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-gold text-primary-dark px-6 py-2.5 rounded-lg font-bold hover:bg-gold-hover transition">
                <i class="fas fa-check mr-1"></i> Verify & Forward to Admin
            </button>
            <a href="{{ route('staff.applications.pending') }}" class="bg-primary-light text-slate-300 px-6 py-2.5 rounded-lg font-medium hover:text-white transition">
                <i class="fas fa-arrow-left mr-1"></i> Back to List
            </a>
        </div>
    </form>
</div>
@endsection
