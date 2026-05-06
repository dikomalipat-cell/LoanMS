@extends('layouts.app')

@section('title', 'Unpaid Dues')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Unpaid Dues</h1>
    <p class="text-gray-600 mt-1">Track clients with pending payments or delinquencies.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Delinquent Accounts</h2>
        <div class="flex gap-2">
            <input type="text" placeholder="Search..." class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-green-500">
            <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition flex items-center gap-2">
                <i class="fas fa-filter"></i> Filter
            </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Client Name</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Due Date</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Amount Due</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                    <td class="p-4 text-sm text-gray-800">John Doe</td>
                    <td class="p-4 text-sm text-red-500 font-medium">May 01, 2026</td>
                    <td class="p-4 text-sm font-medium text-gray-800">₱ 5,000.00</td>
                    <td class="p-4 text-sm"><span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-semibold">Overdue</span></td>
                    <td class="p-4 text-right">
                        <button class="text-blue-500 hover:text-blue-700 mr-2" title="Send Reminder"><i class="fas fa-bell"></i></button>
                        <button class="text-green-500 hover:text-green-700" title="Record Payment"><i class="fas fa-money-bill"></i></button>
                    </td>
                </tr>
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                    <td class="p-4 text-sm text-gray-800">Jane Smith</td>
                    <td class="p-4 text-sm text-yellow-600 font-medium">May 05, 2026</td>
                    <td class="p-4 text-sm font-medium text-gray-800">₱ 2,500.00</td>
                    <td class="p-4 text-sm"><span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-semibold">Due Soon</span></td>
                    <td class="p-4 text-right">
                        <button class="text-blue-500 hover:text-blue-700 mr-2" title="Send Reminder"><i class="fas fa-bell"></i></button>
                        <button class="text-green-500 hover:text-green-700" title="Record Payment"><i class="fas fa-money-bill"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
