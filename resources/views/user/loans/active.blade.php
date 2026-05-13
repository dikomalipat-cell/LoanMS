@extends('layouts.app')

@section('title', 'Active Loan')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Active Loans</h1>
    <p class="text-slate-300 mt-1">View details of your currently active loans.</p>
</div>

@forelse($loanDetails as $detail)
@php
    $loan = $detail['loan'];
    $status = $detail['status'];
@endphp
<div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6 mb-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="p-4 bg-primary-dark rounded-lg border border-slate-700">
            <p class="text-sm text-gold font-medium mb-1">Total Loan Amount</p>
            <p class="text-2xl font-bold text-white">₱ {{ number_format($loan->loan_amount, 2) }}</p>
        </div>
        <div class="p-4 bg-primary-dark rounded-lg border border-slate-700">
            <p class="text-sm text-blue-400 font-medium mb-1">Remaining Balance</p>
            <p class="text-2xl font-bold text-white">₱ {{ number_format($status['remaining_balance'], 2) }}</p>
        </div>
        <div class="p-4 bg-primary-dark rounded-lg border border-slate-700">
            <p class="text-sm text-yellow-400 font-medium mb-1">Monthly Payment</p>
            <p class="text-2xl font-bold text-white">₱ {{ number_format($loan->monthly_payment, 2) }}</p>
            <p class="text-xs text-slate-400 mt-1">Next: {{ $status['next_payment_date'] ? \Carbon\Carbon::parse($status['next_payment_date'])->format('M d, Y') : 'N/A' }}</p>
        </div>
    </div>

    <h2 class="text-lg font-semibold text-white mb-4">Loan Details</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-8">
        <div class="border-b border-slate-700 pb-2">
            <p class="text-sm text-slate-400">Loan Reference ID</p>
            <p class="font-medium text-white">LOAN-{{ str_pad($loan->id, 4, '0', STR_PAD_LEFT) }}</p>
        </div>
        <div class="border-b border-slate-700 pb-2">
            <p class="text-sm text-slate-400">Disbursement Date</p>
            <p class="font-medium text-white">{{ $loan->disbursement_date ? $loan->disbursement_date->format('M d, Y') : 'Awaiting Disbursement' }}</p>
        </div>
        <div class="border-b border-slate-700 pb-2">
            <p class="text-sm text-slate-400">Interest Rate</p>
            <p class="font-medium text-white">{{ $loan->interest_rate }}% per month</p>
        </div>
        <div class="border-b border-slate-700 pb-2">
            <p class="text-sm text-slate-400">Status</p>
            <p class="font-medium text-{{ $loan->status === 'approved' ? 'green' : 'yellow' }}-400 capitalize">
                <i class="fas fa-circle text-[10px] mr-1"></i> {{ $loan->status }}
            </p>
        </div>
    </div>
    
    <div class="mt-6 flex gap-4">
        <a href="{{ route('user.payments.make') }}" class="bg-gold text-primary-dark px-6 py-2 rounded-lg font-bold hover:bg-gold-hover transition">
            Make a Payment
        </a>
        <a href="{{ route('user.loans.history') }}" class="border border-slate-700 text-slate-300 px-6 py-2 rounded-lg font-semibold hover:bg-primary-dark transition">
            Payment History
        </a>
    </div>
</div>
@empty
<div class="p-12 text-center bg-primary rounded-xl border border-slate-700 shadow-sm">
    <div class="w-16 h-16 bg-primary-dark rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
        <i class="fas fa-hand-holding-usd text-2xl"></i>
    </div>
    <h3 class="text-lg font-medium text-white mb-2">No Active Loan Found</h3>
    <p class="text-slate-400 mb-6 max-w-sm mx-auto">You don't have any active loans at the moment. Need financial assistance?</p>
    <a href="{{ route('dashboard') }}" class="inline-block bg-gold text-primary-dark px-6 py-2 rounded-lg font-semibold hover:bg-gold-hover transition">
        Back to Dashboard
    </a>
</div>
@endforelse
@endsection
