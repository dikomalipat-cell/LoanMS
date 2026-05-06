@extends('layouts.app')

@section('title', 'Make Payment')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Make a Payment</h1>
    <p class="text-gray-600 mt-1">Settle your active loan dues easily.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 max-w-2xl">
    <div class="bg-green-50 rounded-lg p-4 mb-6 border border-green-100 flex justify-between items-center">
        <div>
            <p class="text-sm text-green-700 font-medium">Current Amount Due</p>
            <p class="text-xl font-bold text-gray-800">₱ {{ number_format($client?->balance / 6 ?? 0, 2) }}</p>
        </div>
        <div class="text-right">
            <p class="text-sm text-gray-600">Due Date</p>
            <p class="font-medium text-gray-800">{{ $client?->due_date ? \Carbon\Carbon::parse($client->due_date)->format('M d, Y') : 'N/A' }}</p>
        </div>
    </div>

    <form action="{{ route('user.payments.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Payment Amount (₱)</label>
            <input type="number" name="amount" value="{{ $client?->balance / 6 ?? 0 }}" step="0.01" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
            <div class="grid grid-cols-2 gap-4">
                <label class="border border-gray-200 rounded-lg p-4 flex items-center cursor-pointer hover:border-green-500 transition">
                    <input type="radio" name="payment_method" value="bank_transfer" class="text-green-600 focus:ring-green-500 mr-3" checked>
                    <div>
                        <p class="font-medium text-gray-800">Bank Transfer</p>
                        <p class="text-xs text-gray-500">BDO, BPI, UnionBank</p>
                    </div>
                </label>
                <label class="border border-gray-200 rounded-lg p-4 flex items-center cursor-pointer hover:border-green-500 transition">
                    <input type="radio" name="payment_method" value="ewallet" class="text-green-600 focus:ring-green-500 mr-3">
                    <div>
                        <p class="font-medium text-gray-800">E-Wallet</p>
                        <p class="text-xs text-gray-500">GCash, Maya</p>
                    </div>
                </label>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Proof of Payment (Optional)</label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition cursor-pointer">
                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                <p class="text-sm text-gray-600">Click to upload or drag and drop</p>
                <p class="text-xs text-gray-400 mt-1">PNG, JPG or PDF (Max 5MB)</p>
            </div>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition w-full sm:w-auto">
                Submit Payment
            </button>
        </div>
    </form>
</div>
@endsection
