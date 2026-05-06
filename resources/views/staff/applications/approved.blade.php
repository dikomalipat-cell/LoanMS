@extends('layouts.app')
@section('title', 'Approved Applications')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Approved Applications</h1>
    <p class="text-gray-600 mt-1">Loan applications that have been approved and disbursed.</p>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Application ID</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Borrower</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Amount</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Approved Date</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $application)
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                    <td class="p-4 text-sm font-medium text-gray-800">APP-{{ date('Y') }}-{{ str_pad($application->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td class="p-4 text-sm text-gray-600">{{ $application->name }}</td>
                    <td class="p-4 text-sm font-medium text-gray-800">₱ {{ number_format($application->loan_amount, 2) }}</td>
                    <td class="p-4 text-sm text-gray-500">{{ $application->loan_date ? \Carbon\Carbon::parse($application->loan_date)->format('M d, Y') : $application->updated_at->format('M d, Y') }}</td>
                    <td class="p-4"><span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-semibold">Approved</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500 text-sm">No approved applications found.</td>
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
