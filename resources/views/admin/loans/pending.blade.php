@extends('layouts.app')
@section('title', 'Pending Applications')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Pending Applications</h1>
    <p class="text-slate-400 text-sm mt-1">Loan applications awaiting review and approval.</p>
</div>
<div class="space-y-4">
    @forelse($loans as $loan)
    <div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-5">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-gold/20 flex items-center justify-center text-gold font-bold">{{ strtoupper(substr($loan->borrower->name ?? 'U',0,1)) }}</div>
                <div>
                    <h3 class="font-bold text-white">{{ $loan->borrower->name ?? 'Unknown' }}</h3>
                    <p class="text-sm text-slate-400">Applied: {{ $loan->created_at->format('M d, Y') }}</p>
                </div>
            </div>
            <div class="flex items-center gap-6 text-sm">
                <div class="text-center"><p class="text-xs text-slate-400">Amount</p><p class="font-bold text-white">₱{{ number_format($loan->loan_amount, 2) }}</p></div>
                <div class="text-center"><p class="text-xs text-slate-400">Interest Rate</p><p class="font-medium text-gray-700">5% Monthly</p></div>
                <div class="text-center"><p class="text-xs text-slate-400">Loan ID</p><p class="font-medium text-gray-700">LN-{{ $loan->id }}</p></div>
            </div>
            <div class="flex gap-2">
                <form action="{{ route('admin.loans.approve', $loan) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-gold text-primary-dark font-bold px-4 py-2 rounded-lg text-sm hover:bg-gold-hover transition" onclick="return confirm('Are you sure you want to approve this loan?')">
                        <i class="fas fa-check mr-1"></i> Approve
                    </button>
                </form>
                
                <form action="{{ route('admin.loans.reject', $loan) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to reject this loan?')">
                    @csrf
                    <input type="hidden" name="rejection_reason" value="Rejected by admin">
                    <button type="submit" class="bg-red-500/20 text-red-400 border border-red-500/30 px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-500/30 transition">
                        <i class="fas fa-times mr-1"></i> Reject
                    </button>
                </form>
                
                <a href="{{ route('admin.loans.index') }}" class="bg-primary-light text-slate-300 px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-light/80 hover:text-white transition">
                    <i class="fas fa-eye mr-1"></i> Details
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-8 text-center text-slate-400">
        No pending applications found.
    </div>
    @endforelse

    <div class="mt-6">
        {{ $loans->links() }}
    </div>
</div>
@endsection