@extends('layouts.app')
@section('title', 'Notification Settings')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Notification Settings</h1>
    <p class="text-slate-400 text-sm mt-1">Configure how and when notifications are sent.</p>
</div>
<div class="space-y-6 max-w-3xl">
    <div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6">
        <h3 class="font-bold text-white mb-4"><i class="fas fa-envelope text-blue-500 mr-2"></i>Email Notifications</h3>
        <div class="space-y-3">
            <label class="flex items-center justify-between text-sm text-gray-700"><span>Loan application submitted</span><input type="checkbox" checked class="rounded text-gold focus:ring-green-500"></label>
            <label class="flex items-center justify-between text-sm text-gray-700"><span>Loan approved/rejected</span><input type="checkbox" checked class="rounded text-gold focus:ring-green-500"></label>
            <label class="flex items-center justify-between text-sm text-gray-700"><span>Payment received</span><input type="checkbox" checked class="rounded text-gold focus:ring-green-500"></label>
            <label class="flex items-center justify-between text-sm text-gray-700"><span>Payment overdue reminder</span><input type="checkbox" checked class="rounded text-gold focus:ring-green-500"></label>
            <label class="flex items-center justify-between text-sm text-gray-700"><span>System maintenance</span><input type="checkbox" class="rounded text-gold focus:ring-green-500"></label>
        </div>
    </div>
    <div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6">
        <h3 class="font-bold text-white mb-4"><i class="fas fa-sms text-purple-500 mr-2"></i>SMS Notifications</h3>
        <div class="space-y-3">
            <label class="flex items-center justify-between text-sm text-gray-700"><span>Payment due reminder (3 days before)</span><input type="checkbox" checked class="rounded text-gold focus:ring-green-500"></label>
            <label class="flex items-center justify-between text-sm text-gray-700"><span>Payment overdue alert</span><input type="checkbox" checked class="rounded text-gold focus:ring-green-500"></label>
            <label class="flex items-center justify-between text-sm text-gray-700"><span>Loan disbursement confirmation</span><input type="checkbox" class="rounded text-gold focus:ring-green-500"></label>
        </div>
    </div>
    <button class="bg-gold text-primary-dark text-white px-6 py-2.5 rounded-lg text-sm font-medium hover-bg-gold transition"><i class="fas fa-save mr-1"></i> Save Settings</button>
</div>
@endsection