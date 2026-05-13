@extends('layouts.app')
@section('title', 'Overdue Accounts')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Overdue Accounts</h1>
    <p class="text-slate-300 mt-1">Borrowers who have missed their payment deadlines.</p>
</div>
<div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-primary-dark border-b border-slate-700">
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Borrower</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Contact</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Amount Due</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Days Overdue</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($schedules as $schedule)
                <tr class="border-b border-gray-50 hover:bg-primary-dark transition">
                    <td class="p-4 text-sm font-medium text-white">{{ $schedule->name }}</td>
                    <td class="p-4 text-sm text-slate-300">{{ $schedule->phone ?? 'N/A' }}</td>
                    <td class="p-4 text-sm font-medium text-red-600">₱ {{ number_format($schedule->balance, 2) }}</td>
                    <td class="p-4 text-sm text-slate-300">{{ now()->diffInDays(\Carbon\Carbon::parse($schedule->due_date)) }} days</td>
                    <td class="p-4 text-right">
                        <button class="bg-red-100 text-red-700 px-3 py-1 rounded text-xs font-medium hover:bg-red-200 transition">Contact Borrower</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-slate-400 text-sm">No overdue accounts found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $schedules->links() }}
    </div>
</div>
@endsection
