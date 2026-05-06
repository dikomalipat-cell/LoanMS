@extends('layouts.app')

@section('title', 'Loan History')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Loan History</h1>
    <p class="text-gray-600 mt-1">View your past and fully paid loans.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Loan ID</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Amount</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Date Applied</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Date Cleared</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                    <td class="p-4 text-sm font-medium text-gray-800">LN-{{ date('Y', strtotime($loan->created_at)) }}-{{ str_pad($loan->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td class="p-4 text-sm font-medium text-gray-800">₱ {{ number_format($loan->loan_amount, 2) }}</td>
                    <td class="p-4 text-sm text-gray-500">{{ $loan->created_at->format('M d, Y') }}</td>
                    <td class="p-4 text-sm text-gray-500">{{ $loan->updated_at->format('M d, Y') }}</td>
                    <td class="p-4 text-sm">
                        <span class="bg-{{ $loan->status === 'approved' ? 'green' : 'yellow' }}-100 text-{{ $loan->status === 'approved' ? 'green' : 'yellow' }}-700 px-2 py-1 rounded-full text-xs font-semibold">
                            {{ ucfirst($loan->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500 text-sm">No loan history found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $loans->links() }}
    </div>
</div>
@endsection
