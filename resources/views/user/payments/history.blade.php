@extends('layouts.app')

@section('title', 'Payment History')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Payment History</h1>
    <p class="text-slate-300 mt-1">Review your previous payments for all loans.</p>
</div>

@if(session('success'))
<div class="mb-4 bg-green-500/20 border border-green-500/30 text-green-400 px-4 py-3 rounded-xl text-sm">
    <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
</div>
@endif

<div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-primary-dark border-b border-slate-700">
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Reference No.</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Date</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Amount</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Method</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                <tr class="border-b border-slate-700 hover:bg-primary-dark transition">
                    <td class="p-4 text-sm font-medium text-white">{{ $payment->reference_number ?? 'PAY-'.str_pad($payment->id, 8, '0', STR_PAD_LEFT) }}</td>
                    <td class="p-4 text-sm text-slate-400">{{ $payment->payment_date->format('M d, Y') }}</td>
                    <td class="p-4 text-sm font-medium text-white">₱ {{ number_format($payment->amount_paid, 2) }}</td>
                    <td class="p-4 text-sm text-slate-300">{{ ucfirst($payment->payment_method) }}</td>
                    <td class="p-4 text-sm"><span class="bg-gold/20 text-gold px-2 py-1 rounded-full text-xs font-semibold">Verified</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-slate-400 text-sm py-12 italic">
                        You haven't made any payments yet.
                    </td>
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
