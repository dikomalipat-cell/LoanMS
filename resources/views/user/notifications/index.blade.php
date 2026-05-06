@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Notifications</h1>
    <p class="text-gray-600 mt-1">Stay updated on your loan status and important alerts.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 max-w-3xl overflow-hidden">
    <div class="flex justify-between items-center p-4 border-b border-gray-100 bg-gray-50">
        <h2 class="text-sm font-semibold text-gray-700">Recent Alerts</h2>
        <button class="text-sm text-green-600 hover:text-green-700 font-medium">Mark all as read</button>
    </div>

    <div class="divide-y divide-gray-100">
        <!-- Unread Notification -->
        <div class="p-4 hover:bg-gray-50 transition cursor-pointer bg-green-50 bg-opacity-50">
            <div class="flex gap-4">
                <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 mb-1">Payment Successful</p>
                    <p class="text-sm text-gray-600">Your payment of ₱5,000.00 has been verified. Thank you!</p>
                    <p class="text-xs text-gray-400 mt-2">Just now</p>
                </div>
                <div class="w-2 h-2 rounded-full bg-green-500 mt-2"></div>
            </div>
        </div>

        <!-- Read Notification -->
        <div class="p-4 hover:bg-gray-50 transition cursor-pointer">
            <div class="flex gap-4">
                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 mb-1">Upcoming Payment Reminder</p>
                    <p class="text-sm text-gray-600">Your next payment of ₱5,000.00 is due on May 15, 2026.</p>
                    <p class="text-xs text-gray-400 mt-2">2 days ago</p>
                </div>
            </div>
        </div>

        <!-- Read Notification -->
        <div class="p-4 hover:bg-gray-50 transition cursor-pointer">
            <div class="flex gap-4">
                <div class="w-10 h-10 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 mb-1">Loan Approved</p>
                    <p class="text-sm text-gray-600">Congratulations! Your loan application for ₱50,000.00 has been approved.</p>
                    <p class="text-xs text-gray-400 mt-2">Jan 10, 2026</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
