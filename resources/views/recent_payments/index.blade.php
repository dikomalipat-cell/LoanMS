@extends('layouts.app')

@section('title', 'Recent Payments')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Recent Payments</h1>
    <p class="text-slate-300 mt-1">View the latest payment transactions.</p>
</div>

<div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold text-white">Transaction History</h2>
        <button class="bg-primary-dark hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition flex items-center gap-2">
            <i class="fas fa-download"></i> Export
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-primary-dark border-b border-slate-700">
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Transaction ID</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Client Name</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Amount Paid</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Date</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-50 hover:bg-primary-dark transition">
                    <td class="p-4 text-sm font-medium text-white">#TRX-00123</td>
                    <td class="p-4 text-sm text-slate-300">Mark Johnson</td>
                    <td class="p-4 text-sm font-medium text-gold">₱ 1,500.00</td>
                    <td class="p-4 text-sm text-slate-400">May 06, 2026</td>
                    <td class="p-4 text-sm"><span class="bg-gold/20 text-gold px-2 py-1 rounded-full text-xs font-semibold">Completed</span></td>
                </tr>
                <tr class="border-b border-gray-50 hover:bg-primary-dark transition">
                    <td class="p-4 text-sm font-medium text-white">#TRX-00122</td>
                    <td class="p-4 text-sm text-slate-300">Sarah Williams</td>
                    <td class="p-4 text-sm font-medium text-gold">₱ 3,000.00</td>
                    <td class="p-4 text-sm text-slate-400">May 05, 2026</td>
                    <td class="p-4 text-sm"><span class="bg-gold/20 text-gold px-2 py-1 rounded-full text-xs font-semibold">Completed</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
