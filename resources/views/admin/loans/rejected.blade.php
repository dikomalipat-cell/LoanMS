@extends('layouts.app')
@section('title', 'Rejected Loans')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Rejected Loans</h1>
    <p class="text-gray-500 text-sm mt-1">Applications that were declined.</p>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-100">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3 text-left">Loan ID</th>
                    <th class="px-4 py-3 text-left">Applicant</th>
                    <th class="px-4 py-3 text-left">Amount</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($loans as $loan)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 font-mono text-xs font-semibold text-gray-700">LN-{{ $loan->id }}</td>
                    <td class="px-4 py-3 font-medium text-gray-800">{{ $loan->full_name }}</td>
                    <td class="px-4 py-3 text-gray-700">₱{{ number_format($loan->loan_amount, 2) }}</td>
                    <td class="px-4 py-3 text-red-600 text-xs font-bold uppercase">{{ $loan->status }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $loan->updated_at->format('M d, Y') }}</td>
                    <td class="px-4 py-3 text-center">
                        <button class="text-blue-600 hover:text-blue-800 text-xs font-semibold">Reconsider</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-gray-500">No rejected applications found.</td>
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