@extends('layouts.app')

@section('title', 'System Settings')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">System Settings</h1>
    <p class="text-slate-300 mt-1">Configure your loan management system preferences.</p>
</div>

<div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6 max-w-4xl">
    <div class="border-b border-slate-700 mb-6 pb-4">
        <h2 class="text-lg font-semibold text-white">General Settings</h2>
    </div>

    <form action="#" method="POST" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                <input type="text" value="Loan Management System" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Contact Email</label>
                <input type="email" value="admin@example.com" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Default Currency</label>
                <select class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option value="PHP" selected>PHP (₱)</option>
                    <option value="USD">USD ($)</option>
                    <option value="EUR">EUR (€)</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Timezone</label>
                <select class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option value="Asia/Manila" selected>Asia/Manila</option>
                    <option value="UTC">UTC</option>
                </select>
            </div>
        </div>

        <div class="border-t border-slate-700 pt-6 mt-6">
            <h2 class="text-lg font-semibold text-white mb-4">Loan Parameters</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Default Interest Rate (%)</label>
                    <input type="number" step="0.01" value="5.00" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Penalty Fee (%)</label>
                    <input type="number" step="0.01" value="2.00" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                </div>
            </div>
        </div>

        <div class="flex justify-end mt-8">
            <button type="submit" class="bg-gold text-primary-dark hover-bg-gold text-white px-6 py-2 rounded-lg font-medium transition">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
