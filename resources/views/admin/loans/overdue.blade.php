@extends('layouts.app')
@section('title', 'Overdue Loans')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Overdue Loans</h1>
    <p class="text-gray-500 text-sm mt-1">Loans with missed payment deadlines requiring attention.</p>
</div>
<div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6 flex items-center gap-3">
    <i class="fas fa-exclamation-triangle text-red-500 text-lg"></i>
    <div>
        <p class="text-sm font-semibold text-red-800">{{ $loans->total() }} loans are currently overdue</p>
        <p class="text-xs text-red-600">Total overdue amount: ₱{{ number_format($loans->sum('balance'), 2) }}</p>
    </div>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-100">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3 text-left">Loan ID</th>
                    <th class="px-4 py-3 text-left">Borrower</th>
                    <th class="px-4 py-3 text-left">Outstanding</th>
                    <th class="px-4 py-3 text-left">Days Overdue</th>
                    <th class="px-4 py-3 text-left">Penalty Estimate</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($loans as $loan)
                <tr class="hover:bg-red-50 transition">
                    <td class="px-4 py-3 font-mono text-xs font-semibold text-gray-700">LN-{{ $loan->id }}</td>
                    <td class="px-4 py-3 font-medium text-gray-800">{{ $loan->full_name }}</td>
                    <td class="px-4 py-3 font-bold text-red-600">₱{{ number_format($loan->balance, 2) }}</td>
                    <td class="px-4 py-3">
                        @php 
                            $days = $loan->due_date ? max(0, now()->diffInDays(\Carbon\Carbon::parse($loan->due_date), false)) : 0;
                            // Reverse the diff logic if it's past due
                            if ($loan->due_date && \Carbon\Carbon::parse($loan->due_date)->isPast()) {
                                $days = now()->diffInDays(\Carbon\Carbon::parse($loan->due_date));
                            } else {
                                $days = 0;
                            }
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-bold {{ $days > 30 ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $days }} days
                        </span>
                    </td>
                    <td class="px-4 py-3 text-gray-700">₱{{ number_format($loan->balance * 0.05, 2) }}</td>
                    <td class="px-4 py-3 text-center">
                        <button class="bg-blue-50 text-blue-600 px-3 py-1 rounded-lg text-xs font-semibold hover:bg-blue-100 transition">Send Reminder</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-gray-500">No overdue loans found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4 border-t border-gray-100">
        {{ $loans->links() }}
    </div>
</div>
@endsection