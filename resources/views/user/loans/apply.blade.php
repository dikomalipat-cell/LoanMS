@extends('layouts.app')

@section('title', 'Apply for a Loan')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Apply for a Loan</h1>
    <p class="text-gray-600 mt-1">Fill out the form below to request a new loan.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 max-w-3xl">
    <form action="{{ route('user.loans.store') }}" method="POST" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Requested Amount (₱)</label>
                <input type="number" name="loan_amount" required placeholder="e.g. 10000" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Loan Term (Months)</label>
                <select name="loan_term" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option value="3">3 Months</option>
                    <option value="6">6 Months</option>
                    <option value="12">12 Months</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Purpose of Loan</label>
            <textarea rows="4" placeholder="Briefly describe why you need this loan..." class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"></textarea>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h3 class="font-medium text-gray-800 mb-2">Terms and Conditions</h3>
            <p class="text-xs text-gray-600 mb-3">By applying for this loan, you agree to the standard interest rates and understand that late payments may incur additional penalty fees.</p>
            <label class="flex items-center">
                <input type="checkbox" class="rounded text-green-500 focus:ring-green-500 w-4 h-4 mr-2">
                <span class="text-sm text-gray-700">I agree to the terms and conditions</span>
            </label>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition">
                Submit Application
            </button>
        </div>
    </form>
</div>
@endsection
