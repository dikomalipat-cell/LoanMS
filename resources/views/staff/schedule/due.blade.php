@extends('layouts.app')
@section('title', 'Due Payments')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Due Payments</h1>
    <p class="text-gray-600 mt-1">Borrowers with payments due soon.</p>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Borrower</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Contact</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Amount Due</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Due Date</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($schedules as $schedule)
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                    <td class="p-4 text-sm font-medium text-gray-800">{{ $schedule->name }}</td>
                    <td class="p-4 text-sm text-gray-600">{{ $schedule->phone ?? 'N/A' }}</td>
                    <td class="p-4 text-sm font-medium text-gray-800">₱ {{ number_format($schedule->balance / 6, 2) }}</td>
                    <td class="p-4 text-sm text-yellow-600 font-medium">{{ \Carbon\Carbon::parse($schedule->due_date)->format('M d, Y') }}</td>
                    <td class="p-4 text-right">
                        <button class="bg-blue-100 text-blue-700 px-3 py-1 rounded text-xs font-medium hover:bg-blue-200 transition">Send Reminder</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500 text-sm">No payments due.</td>
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
