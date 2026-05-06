@extends('layouts.app')
@section('title', 'Loan Policies')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Loan Policies</h1>
    <p class="text-gray-500 text-sm mt-1">Configure loan rules and requirements.</p>
</div>
<div class="space-y-6 max-w-3xl">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-bold text-gray-800 mb-4"><i class="fas fa-sliders-h text-green-600 mr-2"></i>Loan Limits</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Minimum Loan Amount</label><input type="text" value="₱5,000" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-green-400"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Maximum Loan Amount</label><input type="text" value="₱500,000" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-green-400"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Min Loan Term (months)</label><input type="number" value="3" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-green-400"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Max Loan Term (months)</label><input type="number" value="36" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-green-400"></div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-bold text-gray-800 mb-4"><i class="fas fa-file-contract text-green-600 mr-2"></i>Requirements</h3>
        <div class="space-y-3">
            <label class="flex items-center gap-3 text-sm text-gray-700"><input type="checkbox" checked class="rounded text-green-600 focus:ring-green-500"> Valid Government ID</label>
            <label class="flex items-center gap-3 text-sm text-gray-700"><input type="checkbox" checked class="rounded text-green-600 focus:ring-green-500"> Proof of Income</label>
            <label class="flex items-center gap-3 text-sm text-gray-700"><input type="checkbox" checked class="rounded text-green-600 focus:ring-green-500"> Proof of Billing Address</label>
            <label class="flex items-center gap-3 text-sm text-gray-700"><input type="checkbox" class="rounded text-green-600 focus:ring-green-500"> Co-maker Required</label>
            <label class="flex items-center gap-3 text-sm text-gray-700"><input type="checkbox" class="rounded text-green-600 focus:ring-green-500"> Collateral Required</label>
        </div>
    </div>
    <button class="bg-green-600 text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-green-700 transition"><i class="fas fa-save mr-1"></i> Save Policies</button>
</div>
@endsection