@extends('layouts.app')
@section('title', 'Payment Tracking')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Payment Tracking</h1>
    <p class="text-gray-600 mt-1">Monitor and verify incoming borrower payments.</p>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Reference</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Borrower</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Amount</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Method</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                    <td class="p-4 text-sm font-medium text-gray-800">PAY-{{ date('Ymd') }}-{{ str_pad($payment->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td class="p-4 text-sm text-gray-600">{{ $payment->name }}</td>
                    <td class="p-4 text-sm font-medium text-gray-800">₱ {{ number_format($payment->amount, 2) }}</td>
                    <td class="p-4 text-sm text-gray-600">Bank Transfer</td>
                    <td class="p-4"><span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-semibold">Pending Verification</span></td>
                    <td class="p-4 text-right">
                        <button class="text-green-500 hover:text-green-700 mr-2" title="Verify"><i class="fas fa-check-circle"></i></button>
                        <button class="text-red-500 hover:text-red-700" title="Reject"><i class="fas fa-times-circle"></i></button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-gray-500 text-sm">No pending payments found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $payments->links() }}
    </div>
</div>
@endsection
