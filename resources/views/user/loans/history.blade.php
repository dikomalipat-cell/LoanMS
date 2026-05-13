@extends('layouts.app')

@section('title', 'Loan History')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Loan History</h1>
    <p class="text-slate-300 mt-1">View your past and fully paid loans.</p>
</div>

<div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-primary-dark border-b border-slate-700">
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Loan ID</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Amount</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Date Applied</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Date Cleared</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                <tr class="border-b border-gray-50 hover:bg-primary-dark transition">
                    <td class="p-4 text-sm font-medium text-white">LN-{{ date('Y', strtotime($loan->created_at)) }}-{{ str_pad($loan->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td class="p-4 text-sm font-medium text-white">₱ {{ number_format($loan->loan_amount, 2) }}</td>
                    <td class="p-4 text-sm text-slate-400">{{ $loan->created_at->format('M d, Y') }}</td>
                    <td class="p-4 text-sm text-slate-400">{{ $loan->updated_at->format('M d, Y') }}</td>
                    <td class="p-4 text-sm">
                        <span class="bg-{{ $loan->status === 'approved' ? 'green' : 'yellow' }}-100 text-{{ $loan->status === 'approved' ? 'green' : 'yellow' }}-700 px-2 py-1 rounded-full text-xs font-semibold">
                            {{ ucfirst($loan->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-slate-400 text-sm">No loan history found.</td>
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
