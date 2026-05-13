@extends('layouts.app')
@section('title', 'Loan Reports')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Loan Reports</h1>
    <p class="text-slate-400 text-sm mt-1">Analytics and summary of all loan activities.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-primary rounded-xl p-5 border border-slate-700 shadow-sm">
        <p class="text-xs text-slate-400 uppercase tracking-wider mb-1">Total Disbursed</p>
        <p class="text-2xl font-bold text-white">₱{{ number_format($totalDisbursed, 2) }}</p>
        <p class="text-xs text-gold mt-1"><i class="fas fa-arrow-up"></i> Live Tracking</p>
    </div>
    <div class="bg-primary rounded-xl p-5 border border-slate-700 shadow-sm">
        <p class="text-xs text-slate-400 uppercase tracking-wider mb-1">Total Collected</p>
        <p class="text-2xl font-bold text-white">₱{{ number_format($totalCollected, 2) }}</p>
        <p class="text-xs text-gold mt-1"><i class="fas fa-arrow-up"></i> Verified Payments</p>
    </div>
    <div class="bg-primary rounded-xl p-5 border border-slate-700 shadow-sm">
        <p class="text-xs text-slate-400 uppercase tracking-wider mb-1">Outstanding Balance</p>
        <p class="text-2xl font-bold text-white">₱{{ number_format($outstandingBalance, 2) }}</p>
        <p class="text-xs text-blue-600 mt-1"><i class="fas fa-info-circle"></i> Current Receivables</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-primary rounded-xl p-6 border border-slate-700 shadow-sm">
        <h3 class="font-bold text-white mb-4">Monthly Loan Volume (Last 5 Months)</h3>
        <div class="space-y-4">
            @forelse($monthlyVolume as $mo)
            <div>
                <div class="flex justify-between items-center mb-1">
                    <span class="text-xs font-semibold text-slate-300 uppercase">{{ $mo['m'] }}</span>
                    <span class="text-xs font-bold text-white">{{ $mo['v'] }} Applications</span>
                </div>
                <div class="w-full bg-primary-dark rounded-full h-2.5">
                    <div class="bg-primary-light0 h-2.5 rounded-full" style="width: {{ $mo['pct'] }}%"></div>
                </div>
            </div>
            @empty
            <p class="text-sm text-slate-400 text-center py-4">No data available for the last 5 months.</p>
            @endforelse
        </div>
    </div>

    <div class="bg-primary rounded-xl p-6 border border-slate-700 shadow-sm">
        <h3 class="font-bold text-white mb-4">Latest Loan Activity</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-400 border-b border-gray-50">
                        <th class="pb-3 font-medium">Borrower</th>
                        <th class="pb-3 font-medium">Amount</th>
                        <th class="pb-3 font-medium">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @php 
                        $latestLoans = \App\Models\Client::latest()->take(5)->get();
                    @endphp
                    @forelse($latestLoans as $loan)
                    <tr>
                        <td class="py-3 font-medium text-white">{{ $loan->full_name }}</td>
                        <td class="py-3 text-slate-300">₱{{ number_format($loan->loan_amount, 2) }}</td>
                        <td class="py-3">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $loan->status == 'approved' ? 'bg-gold/20 text-gold' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ $loan->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-4 text-center text-slate-400">No recent activity.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection