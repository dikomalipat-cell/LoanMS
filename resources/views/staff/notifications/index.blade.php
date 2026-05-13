@extends('layouts.app')
@section('title', 'Staff Notifications')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Notifications</h1>
    <p class="text-slate-300 mt-1">System alerts and borrower updates.</p>
</div>
<div class="bg-primary rounded-xl shadow-sm border border-slate-700 max-w-3xl overflow-hidden">
    <div class="flex justify-between items-center p-4 border-b border-slate-700 bg-primary-dark">
        <h2 class="text-sm font-semibold text-gray-700">Recent Alerts</h2>
        <button class="text-sm text-gold hover:text-gold font-medium">Mark all as read</button>
    </div>
    <div class="divide-y divide-gray-100">
        <div class="p-4 hover:bg-primary-dark transition cursor-pointer bg-primary-light bg-opacity-50">
            <div class="flex gap-4">
                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 mb-1">New Loan Application</p>
                    <p class="text-sm text-slate-300">Maria Santos has submitted a new loan application for ₱25,000.00.</p>
                    <p class="text-xs text-gray-400 mt-2">10 minutes ago</p>
                </div>
                <div class="w-2 h-2 rounded-full bg-primary-light0 mt-2"></div>
            </div>
        </div>
        <div class="p-4 hover:bg-primary-dark transition cursor-pointer bg-primary-light bg-opacity-50">
            <div class="flex gap-4">
                <div class="w-10 h-10 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 mb-1">Payment Verification Required</p>
                    <p class="text-sm text-slate-300">A new payment of ₱5,000.00 from Ana Reyes is pending verification.</p>
                    <p class="text-xs text-gray-400 mt-2">1 hour ago</p>
                </div>
                <div class="w-2 h-2 rounded-full bg-primary-light0 mt-2"></div>
            </div>
        </div>
    </div>
</div>
@endsection
