@extends('layouts.app')
@section('title', 'All Loans')
@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-white">All Loans</h1>
        <p class="text-slate-400 text-sm mt-1">Complete overview of all loans in the system.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-primary rounded-xl p-4 border border-slate-700 shadow-sm flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600"><i
                    class="fas fa-file-invoice-dollar"></i></div>
            <div>
                <p class="text-xs text-slate-400">Total Loans</p>
                <p class="text-xl font-bold text-white">{{ $stats['total'] }}</p>
            </div>
        </div>
        <div class="bg-primary rounded-xl p-4 border border-slate-700 shadow-sm flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-gold/20 flex items-center justify-center text-gold"><i
                    class="fas fa-check-circle"></i></div>
            <div>
                <p class="text-xs text-slate-400">Approved</p>
                <p class="text-xl font-bold text-white">{{ $stats['approved'] }}</p>
            </div>
        </div>
        <div class="bg-primary rounded-xl p-4 border border-slate-700 shadow-sm flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600"><i
                    class="fas fa-clock"></i></div>
            <div>
                <p class="text-xs text-slate-400">Pending</p>
                <p class="text-xl font-bold text-white">{{ $stats['pending'] }}</p>
            </div>
        </div>
        <div class="bg-primary rounded-xl p-4 border border-slate-700 shadow-sm flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-600"><i
                    class="fas fa-exclamation-triangle"></i></div>
            <div>
                <p class="text-xs text-slate-400">Overdue</p>
                <p class="text-xl font-bold text-white">{{ $stats['overdue'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-primary rounded-xl shadow-sm border border-slate-700">
        <div class="p-4 border-b border-slate-700 flex flex-wrap items-center justify-between gap-3">
            <div class="relative">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input type="text" placeholder="Search loans..."
                    class="pl-9 pr-4 py-2 text-sm bg-primary-dark border border-slate-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-200 w-64">
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-primary-dark text-slate-400 text-xs uppercase tracking-wider">
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
                        <tr class="hover:bg-primary-dark transition">
                            <td class="px-4 py-3 font-medium text-white">
                                LN-{{ $loan->created_at->format('Y') }}-{{ str_pad($loan->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-4 py-3 text-white">{{ $loan->borrower->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-slate-300">₱{{ number_format($loan->loan_amount, 2) }}</td>
                            <td class="px-4 py-3 font-bold text-white">₱{{ number_format($loan->remaining_balance, 2) }}</td>
                            <td class="px-4 py-3 text-slate-400">
                                {{ $loan->end_date ? $loan->end_date->format('M d, Y') : 'N/A' }}</td>
                            <td class="px-4 py-3">
                                <span
                                    class="px-2 py-1 rounded-full text-[10px] font-bold uppercase 
                                    {{ $loan->status == 'approved' ? 'bg-gold/20 text-gold' : ($loan->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                    {{ $loan->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-slate-400">No loan records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection