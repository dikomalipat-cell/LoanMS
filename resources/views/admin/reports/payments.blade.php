@extends('layouts.app')
@section('title', 'Payment Reports')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Payment Reports</h1>
    <p class="text-slate-400 text-sm mt-1">Track and analyze all payment transactions.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-primary rounded-xl p-5 border border-slate-700 shadow-sm">
        <p class="text-xs text-slate-400 uppercase tracking-wider mb-1">Total Collections</p>
        <p class="text-2xl font-bold text-white">₱{{ number_format($totalCollected, 2) }}</p>
        <p class="text-xs text-slate-400 mt-1">Life-time verified</p>
    </div>
    <div class="bg-primary rounded-xl p-5 border border-slate-700 shadow-sm">
        <p class="text-xs text-slate-400 uppercase tracking-wider mb-1">Avg. Payment Size</p>
        <p class="text-2xl font-bold text-white">₱{{ number_format($avgPayment, 2) }}</p>
        <p class="text-xs text-gold mt-1"><i class="fas fa-chart-line"></i> Real-time average</p>
    </div>
    <div class="bg-primary rounded-xl p-5 border border-slate-700 shadow-sm">
        <p class="text-xs text-slate-400 uppercase tracking-wider mb-1">Collection Rate</p>
        <p class="text-2xl font-bold text-gold">{{ $collectionRate }}%</p>
        <p class="text-xs text-slate-400 mt-1">Disbursed vs Collected</p>
    </div>
</div>
<div class="bg-primary rounded-xl shadow-sm border border-slate-700">
    <div class="p-4 border-b border-slate-700 flex items-center justify-between">
        <h3 class="font-bold text-white">Recent Collection Activity</h3>
        <div class="flex gap-2">
            <button class="bg-gold text-primary-dark text-white px-4 py-2 rounded-lg text-sm font-medium hover-bg-gold"><i class="fas fa-download mr-1"></i> Export Data</button>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-primary-dark text-slate-300 text-xs uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3 text-left">Ref #</th>
                    <th class="px-4 py-3 text-left">Borrower</th>
                    <th class="px-4 py-3 text-left">Paid Amount</th>
                    <th class="px-4 py-3 text-left">Loan Balance</th>
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3 text-left">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($recentPayments as $p)
                <tr class="hover:bg-primary-dark">
                    <td class="px-4 py-3 font-mono text-xs font-semibold text-slate-400">PAY-{{ $p->id }}</td>
                    <td class="px-4 py-3 font-medium text-white">{{ $p->full_name }}</td>
                    <td class="px-4 py-3 font-semibold text-gold">₱{{ number_format($p->loan_amount - $p->balance, 2) }}</td>
                    <td class="px-4 py-3 text-slate-300">₱{{ number_format($p->balance, 2) }}</td>
                    <td class="px-4 py-3 text-slate-400">{{ $p->updated_at->format('M d, Y') }}</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 rounded-full text-[10px] font-bold uppercase bg-gold/20 text-gold">Verified</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-slate-400">No payment activity recorded yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection