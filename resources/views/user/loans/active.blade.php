@extends('layouts.app')

@section('title', 'Active Loan')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Active Loan</h1>
    <p class="text-slate-300 mt-1">View details of your currently active loan.</p>
</div>

@if($client)
<div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="p-4 bg-primary-light rounded-lg border border-green-100">
            <p class="text-sm text-gold font-medium mb-1">Total Loan Amount</p>
            <p class="text-2xl font-bold text-white">₱ {{ number_format($client->loan_amount, 2) }}</p>
        </div>
        <div class="p-4 bg-blue-50 rounded-lg border border-blue-100">
            <p class="text-sm text-blue-600 font-medium mb-1">Remaining Balance</p>
            <p class="text-2xl font-bold text-white">₱ {{ number_format($client->balance, 2) }}</p>
        </div>
        <div class="p-4 bg-yellow-50 rounded-lg border border-yellow-100">
            <p class="text-sm text-yellow-600 font-medium mb-1">Next Payment Due</p>
            <p class="text-2xl font-bold text-white">{{ $client->due_date ? \Carbon\Carbon::parse($client->due_date)->format('M d, Y') : 'N/A' }}</p>
            <p class="text-xs text-yellow-600 mt-1">₱ {{ number_format($client->balance / 6, 2) }}</p>
        </div>
    </div>

    <h2 class="text-lg font-semibold text-white mb-4">Loan Details</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-8">
        <div class="border-b border-slate-700 pb-2">
            <p class="text-sm text-slate-400">Loan Reference ID</p>
            <p class="font-medium text-white">LN-{{ date('Y') }}-{{ str_pad($client->id, 4, '0', STR_PAD_LEFT) }}</p>
        </div>
        <div class="border-b border-slate-700 pb-2">
            <p class="text-sm text-slate-400">Date Approved</p>
            <p class="font-medium text-white">{{ $client->loan_date ? \Carbon\Carbon::parse($client->loan_date)->format('M d, Y') : 'N/A' }}</p>
        </div>
        <div class="border-b border-slate-700 pb-2">
            <p class="text-sm text-slate-400">Interest Rate</p>
            <p class="font-medium text-white">5% per month</p>
        </div>
        <div class="border-b border-slate-700 pb-2">
            <p class="text-sm text-slate-400">Status</p>
            <p class="font-medium text-{{ $client->status === 'approved' ? 'green' : 'yellow' }}-600"><i class="fas fa-circle text-[10px] mr-1"></i> {{ ucfirst($client->status) }}</p>
        </div>
    </div>
</div>
@else
<div class="p-12 text-center bg-primary rounded-xl border border-slate-700 shadow-sm">
    <div class="w-16 h-16 bg-primary-dark rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
        <i class="fas fa-hand-holding-usd text-2xl"></i>
    </div>
    <h3 class="text-lg font-medium text-white mb-2">No Active Loan Found</h3>
    <p class="text-slate-400 mb-6 max-w-sm mx-auto">You don't have any active loans at the moment. Need financial assistance?</p>
    <a href="{{ route('user.loans.apply') }}" class="inline-block bg-gold text-primary-dark text-white px-6 py-2 rounded-lg font-semibold hover-bg-gold transition">
        Apply for a Loan
    </a>
</div>
@endif
@endsection
