@extends('layouts.app')
@section('title', 'Approved Loans')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Approved Loans</h1>
    <p class="text-slate-400 text-sm mt-1">All currently approved and active loans.</p>
</div>
<div class="bg-primary rounded-xl shadow-sm border border-slate-700">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-primary-dark text-slate-300 text-xs uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3 text-left">Loan ID</th>
                    <th class="px-4 py-3 text-left">Borrower</th>
                    <th class="px-4 py-3 text-left">Amount</th>
                    <th class="px-4 py-3 text-left">Balance</th>
                    <th class="px-4 py-3 text-left">Monthly</th>
                    <th class="px-4 py-3 text-left">Due Date</th>
                    <th class="px-4 py-3 text-center">Progress</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($loans as $loan)
                <tr class="hover:bg-primary-dark transition">
                    <td class="px-4 py-3 font-mono text-xs font-semibold text-gray-700">LN-{{ $loan->id }}</td>
                    <td class="px-4 py-3 font-medium text-white">{{ $loan->full_name }}</td>
                    <td class="px-4 py-3 text-gray-700">₱{{ number_format($loan->loan_amount, 2) }}</td>
                    <td class="px-4 py-3 font-semibold text-white">₱{{ number_format($loan->balance, 2) }}</td>
                    <td class="px-4 py-3 text-slate-300">₱{{ number_format($loan->loan_amount / 6, 2) }}</td>
                    <td class="px-4 py-3 text-slate-300">{{ $loan->due_date ? \Carbon\Carbon::parse($loan->due_date)->format('M d') : 'N/A' }}</td>
                    <td class="px-4 py-3">
                        @php 
                            $paid = $loan->loan_amount - $loan->balance;
                            $pct = $loan->loan_amount > 0 ? min(100, round(($paid / $loan->loan_amount) * 100)) : 0;
                        @endphp
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-primary-light0 h-2 rounded-full" style="width:{{ $pct }}%"></div>
                        </div>
                        <span class="text-[10px] text-slate-400">{{ $pct }}% paid</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-8 text-center text-slate-400">No approved loans found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4 border-t border-slate-700">
        {{ $loans->links() }}
    </div>
</div>
@endsection