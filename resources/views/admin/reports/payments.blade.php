@extends('layouts.app')
@section('title', 'Payment Reports')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Payment Reports</h1>
    <p class="text-gray-500 text-sm mt-1">Track and analyze all payment transactions.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
        <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Total Collections</p>
        <p class="text-2xl font-bold text-gray-800">₱{{ number_format($totalCollected, 2) }}</p>
        <p class="text-xs text-gray-500 mt-1">Life-time verified</p>
    </div>
    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
        <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Avg. Payment Size</p>
        <p class="text-2xl font-bold text-gray-800">₱{{ number_format($avgPayment, 2) }}</p>
        <p class="text-xs text-green-600 mt-1"><i class="fas fa-chart-line"></i> Real-time average</p>
    </div>
    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
        <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Collection Rate</p>
        <p class="text-2xl font-bold text-green-600">{{ $collectionRate }}%</p>
        <p class="text-xs text-gray-500 mt-1">Disbursed vs Collected</p>
    </div>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-100">
    <div class="p-4 border-b border-gray-100 flex items-center justify-between">
        <h3 class="font-bold text-gray-800">Recent Collection Activity</h3>
        <div class="flex gap-2">
            <button class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-700"><i class="fas fa-download mr-1"></i> Export Data</button>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider">
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
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-mono text-xs font-semibold text-gray-500">PAY-{{ $p->id }}</td>
                    <td class="px-4 py-3 font-medium text-gray-800">{{ $p->full_name }}</td>
                    <td class="px-4 py-3 font-semibold text-green-600">₱{{ number_format($p->loan_amount - $p->balance, 2) }}</td>
                    <td class="px-4 py-3 text-gray-600">₱{{ number_format($p->balance, 2) }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $p->updated_at->format('M d, Y') }}</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 rounded-full text-[10px] font-bold uppercase bg-green-100 text-green-700">Verified</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-gray-500">No payment activity recorded yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection