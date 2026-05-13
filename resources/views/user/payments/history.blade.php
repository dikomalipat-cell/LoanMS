@extends('layouts.app')

@section('title', 'Payment History')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Payment History</h1>
    <p class="text-slate-300 mt-1">Review your previous payments.</p>
</div>

<div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-primary-dark border-b border-slate-700">
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Reference No.</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Date</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Amount</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Method</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-50 hover:bg-primary-dark transition">
                    <td class="p-4 text-sm font-medium text-white">PAY-987654321</td>
                    <td class="p-4 text-sm text-slate-400">Apr 15, 2026</td>
                    <td class="p-4 text-sm font-medium text-white">₱ 5,000.00</td>
                    <td class="p-4 text-sm text-slate-300">Bank Transfer</td>
                    <td class="p-4 text-sm"><span class="bg-gold/20 text-gold px-2 py-1 rounded-full text-xs font-semibold">Verified</span></td>
                </tr>
                <tr class="border-b border-gray-50 hover:bg-primary-dark transition">
                    <td class="p-4 text-sm font-medium text-white">PAY-123456789</td>
                    <td class="p-4 text-sm text-slate-400">Mar 15, 2026</td>
                    <td class="p-4 text-sm font-medium text-white">₱ 5,000.00</td>
                    <td class="p-4 text-sm text-slate-300">GCash</td>
                    <td class="p-4 text-sm"><span class="bg-gold/20 text-gold px-2 py-1 rounded-full text-xs font-semibold">Verified</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
