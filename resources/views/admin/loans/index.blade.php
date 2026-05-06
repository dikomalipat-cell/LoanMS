@extends('layouts.app')
@section('title', 'All Loans')
@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">All Loans</h1>
        <p class="text-gray-500 text-sm mt-1">Complete overview of all loans in the system.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600"><i
                    class="fas fa-file-invoice-dollar"></i></div>
            <div>
                <p class="text-xs text-gray-500">Total Loans</p>
                <p class="text-xl font-bold text-gray-800">{{ $stats['total'] }}</p>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600"><i
                    class="fas fa-check-circle"></i></div>
            <div>
                <p class="text-xs text-gray-500">Approved</p>
                <p class="text-xl font-bold text-gray-800">{{ $stats['approved'] }}</p>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600"><i
                    class="fas fa-clock"></i></div>
            <div>
                <p class="text-xs text-gray-500">Pending</p>
                <p class="text-xl font-bold text-gray-800">{{ $stats['pending'] }}</p>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-600"><i
                    class="fas fa-exclamation-triangle"></i></div>
            <div>
                <p class="text-xs text-gray-500">Overdue</p>
                <p class="text-xl font-bold text-gray-800">{{ $stats['overdue'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-4 border-b border-gray-100 flex flex-wrap items-center justify-between gap-3">
            <div class="relative">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input type="text" placeholder="Search loans..."
                    class="pl-9 pr-4 py-2 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-200 w-64">
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                        <th class="px-4 py-3 text-left">Loan ID</th>
                        <th class="px-4 py-3 text-left">Borrower</th>
                        <th class="px-4 py-3 text-left">Amount</th>
                        <th class="px-4 py-3 text-left">Balance</th>
                        <th class="px-4 py-3 text-left">Due Date</th>
                        <th class="px-4 py-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($loans as $loan)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 font-medium text-gray-800">
                                LN-{{ $loan->created_at->format('Y') }}-{{ str_pad($loan->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-4 py-3 text-gray-800">{{ $loan->full_name }}</td>
                            <td class="px-4 py-3 text-gray-600">₱{{ number_format($loan->loan_amount, 2) }}</td>
                            <td class="px-4 py-3 font-bold text-gray-800">₱{{ number_format($loan->balance, 2) }}</td>
                            <td class="px-4 py-3 text-gray-500">
                                {{ $loan->due_date ? \Carbon\Carbon::parse($loan->due_date)->format('M d, Y') : 'N/A' }}</td>
                            <td class="px-4 py-3">
                                <span
                                    class="px-2 py-1 rounded-full text-[10px] font-bold uppercase 
                                    {{ $loan->status == 'approved' ? 'bg-green-100 text-green-700' : ($loan->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                    {{ $loan->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-gray-500">No loan records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection