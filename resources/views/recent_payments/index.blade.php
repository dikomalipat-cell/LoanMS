@extends('layouts.app')

@section('title', 'Recent Payments')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Recent Payments</h1>
    <p class="text-gray-600 mt-1">View the latest payment transactions.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Transaction History</h2>
        <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition flex items-center gap-2">
            <i class="fas fa-download"></i> Export
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Transaction ID</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Client Name</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Amount Paid</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                    <td class="p-4 text-sm font-medium text-gray-800">#TRX-00123</td>
                    <td class="p-4 text-sm text-gray-600">Mark Johnson</td>
                    <td class="p-4 text-sm font-medium text-green-600">₱ 1,500.00</td>
                    <td class="p-4 text-sm text-gray-500">May 06, 2026</td>
                    <td class="p-4 text-sm"><span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-semibold">Completed</span></td>
                </tr>
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                    <td class="p-4 text-sm font-medium text-gray-800">#TRX-00122</td>
                    <td class="p-4 text-sm text-gray-600">Sarah Williams</td>
                    <td class="p-4 text-sm font-medium text-green-600">₱ 3,000.00</td>
                    <td class="p-4 text-sm text-gray-500">May 05, 2026</td>
                    <td class="p-4 text-sm"><span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-semibold">Completed</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
