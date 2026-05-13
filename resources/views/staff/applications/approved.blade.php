@extends('layouts.app')
@section('title', 'Approved Applications')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Approved Applications</h1>
    <p class="text-slate-300 mt-1">Loan applications that have been approved and disbursed.</p>
</div>
<div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-primary-dark border-b border-slate-700">
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Application ID</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Borrower</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Amount</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Approved Date</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $application)
                <tr class="border-b border-gray-50 hover:bg-primary-dark transition">
                    <td class="p-4 text-sm font-medium text-white">APP-{{ date('Y') }}-{{ str_pad($application->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td class="p-4 text-sm text-slate-300">{{ $application->borrower->name ?? 'Unknown' }}</td>
                    <td class="p-4 text-sm font-medium text-white">₱ {{ number_format($application->loan_amount, 2) }}</td>
                    <td class="p-4 text-sm text-slate-400">{{ $application->disbursement_date ? $application->disbursement_date->format('M d, Y') : $application->updated_at->format('M d, Y') }}</td>
                    <td class="p-4"><span class="bg-gold/20 text-gold px-2 py-1 rounded-full text-xs font-semibold">Approved</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-slate-400 text-sm">No approved applications found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $applications->links() }}
    </div>
</div>
@endsection
