@extends('layouts.app')

@section('title', 'Payment History')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Payment History</h1>
    <p class="text-gray-600 mt-1">Review your previous payments.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Reference No.</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Amount</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Method</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                    <td class="p-4 text-sm font-medium text-gray-800">PAY-987654321</td>
                    <td class="p-4 text-sm text-gray-500">Apr 15, 2026</td>
                    <td class="p-4 text-sm font-medium text-gray-800">₱ 5,000.00</td>
                    <td class="p-4 text-sm text-gray-600">Bank Transfer</td>
                    <td class="p-4 text-sm"><span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-semibold">Verified</span></td>
                </tr>
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                    <td class="p-4 text-sm font-medium text-gray-800">PAY-123456789</td>
                    <td class="p-4 text-sm text-gray-500">Mar 15, 2026</td>
                    <td class="p-4 text-sm font-medium text-gray-800">₱ 5,000.00</td>
                    <td class="p-4 text-sm text-gray-600">GCash</td>
                    <td class="p-4 text-sm"><span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-semibold">Verified</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
