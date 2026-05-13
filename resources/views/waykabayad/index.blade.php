@extends('layouts.app')

@section('title', 'Unpaid Dues')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Unpaid Dues</h1>
    <p class="text-slate-300 mt-1">Track clients with pending payments or delinquencies.</p>
</div>

<div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold text-white">Delinquent & Upcoming Dues</h2>
        <div class="flex gap-2">
            <input type="text" placeholder="Search..." class="bg-primary-dark border border-slate-600 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-gold">
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-primary-dark border-b border-slate-700">
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Client Name</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Due Date</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Remaining Balance</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dues as $loan)
                <tr class="border-b border-slate-700 hover:bg-primary-dark transition">
                    <td class="p-4 text-sm text-white">{{ $loan->borrower->name ?? 'Unknown' }}</td>
                    <td class="p-4 text-sm font-medium {{ $loan->is_overdue ? 'text-red-400' : 'text-yellow-400' }}">
                        {{ $loan->end_date ? $loan->end_date->format('M d, Y') : 'N/A' }}
                    </td>
                    <td class="p-4 text-sm font-medium text-white">₱ {{ number_format($loan->remaining_balance, 2) }}</td>
                    <td class="p-4 text-sm">
                        @if($loan->is_overdue)
                        <span class="bg-red-500/20 text-red-400 px-2 py-1 rounded-full text-xs font-semibold">Overdue</span>
                        @else
                        <span class="bg-yellow-500/20 text-yellow-400 px-2 py-1 rounded-full text-xs font-semibold">Due Soon</span>
                        @endif
                    </td>
                    <td class="p-4 text-right">
                        <button class="text-blue-400 hover:text-blue-300 mr-2" title="Send Reminder"><i class="fas fa-bell"></i></button>
                        <a href="{{ route('staff.payments.tracking') }}" class="text-gold hover:text-gold-hover" title="Record Payment"><i class="fas fa-money-bill"></i></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-slate-400 text-sm py-12 italic">
                        No delinquent or upcoming dues found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
