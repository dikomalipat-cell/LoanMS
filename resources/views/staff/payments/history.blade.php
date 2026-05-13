@extends('layouts.app')
@section('title', 'Payment History')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Payment History</h1>
    <p class="text-slate-300 mt-1">Complete record of all verified payments.</p>
</div>
<div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-primary-dark border-b border-slate-700">
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Reference</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Borrower</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Amount</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Date</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                <tr class="border-b border-gray-50 hover:bg-primary-dark transition">
                    <td class="p-4 text-sm font-medium text-white">PAY-{{ date('Ymd') }}-{{ str_pad($payment->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td class="p-4 text-sm text-slate-300">{{ $payment->name }}</td>
                    <td class="p-4 text-sm font-medium text-gold">₱ {{ number_format($payment->amount ?? 0, 2) }}</td>
                    <td class="p-4 text-sm text-slate-400">{{ $payment->created_at->format('M d, Y') }}</td>
                    <td class="p-4"><span class="bg-gold/20 text-gold px-2 py-1 rounded-full text-xs font-semibold">Verified</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-slate-400 text-sm">No payment history found.</td>
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
