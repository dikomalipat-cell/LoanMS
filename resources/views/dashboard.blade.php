@extends('layouts.app')

@section('title', 'Dashboard Overview')

@section('content')

@php
    // $role and $client are passed from DashboardController
@endphp

<!-- Common Header -->
<div class="mb-6 flex justify-between items-end">
    <div>
        <h1 class="text-3xl font-bold text-white">
            @if($role === 'admin')
                Admin Overview
            @elseif($role === 'staff')
                Staff Dashboard
            @else
                Welcome back, {{ Auth::user()->name }}!
            @endif
        </h1>
        <p class="text-slate-300 mt-1">
            @if($role === 'admin')
                System-wide metrics and management at a glance.
            @elseif($role === 'staff')
                Monitor loan applications, payments, and borrower schedules.
            @else
                Here is a summary of your active loans and upcoming dues.
            @endif
        </p>
    </div>
    <div class="text-sm text-slate-400 font-medium bg-primary px-4 py-2 rounded-lg border border-slate-700 shadow-sm">
        <i class="far fa-calendar-alt mr-2"></i> {{ date('F d, Y') }}
    </div>
</div>

@if($role === 'admin')
    <!-- ================= ADMIN DASHBOARD ================= -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stat Card 1 -->
        <div class="bg-primary rounded-xl p-6 border border-slate-700 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 flex-shrink-0">
                <i class="fas fa-users text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-400">Total Borrowers</p>
                <h3 class="text-2xl font-bold text-white">{{ number_format($stats['total_borrowers']) }}</h3>
            </div>
        </div>
        <!-- Stat Card 2 -->
        <div class="bg-primary rounded-xl p-6 border border-slate-700 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-full bg-gold/20 flex items-center justify-center text-gold flex-shrink-0">
                <i class="fas fa-hand-holding-usd text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-400">Active Loans</p>
                <h3 class="text-2xl font-bold text-white">{{ number_format($stats['active_loans']) }}</h3>
            </div>
        </div>
        <!-- Stat Card 3 -->
        <div class="bg-primary rounded-xl p-6 border border-slate-700 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 flex-shrink-0">
                <i class="fas fa-exclamation-circle text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-400">Overdue Accounts</p>
                <h3 class="text-2xl font-bold text-white">{{ number_format($stats['overdue_followups']) }}</h3>
            </div>
        </div>
        <!-- Stat Card 4 -->
        <div class="bg-primary rounded-xl p-6 border border-slate-700 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 flex-shrink-0">
                <i class="fas fa-wallet text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-400">Total Disbursed</p>
                <h3 class="text-2xl font-bold text-white">₱ {{ number_format($stats['total_disbursed'] >= 1000000 ? $stats['total_disbursed']/1000000 : $stats['total_disbursed'], 1) }}{{ $stats['total_disbursed'] >= 1000000 ? 'M' : '' }}</h3>
            </div>
        </div>
    </div>

    <!-- Admin Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-primary p-6 rounded-xl border border-slate-700 shadow-sm">
            <h3 class="text-lg font-bold text-white mb-4">Quick Actions</h3>
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('loan.index') }}" class="p-4 border border-slate-700 rounded-lg hover:border-green-500 hover:bg-primary-light transition text-center group">
                    <i class="fas fa-address-book text-2xl text-gray-400 group-hover:text-green-500 mb-2 block"></i>
                    <span class="text-sm font-medium text-gray-700">Manage Clients</span>
                </a>
                <a href="{{ route('banks.index') }}" class="p-4 border border-slate-700 rounded-lg hover:border-green-500 hover:bg-primary-light transition text-center group">
                    <i class="fas fa-university text-2xl text-gray-400 group-hover:text-green-500 mb-2 block"></i>
                    <span class="text-sm font-medium text-gray-700">Manage Banks</span>
                </a>
            </div>
        </div>
        <div class="bg-gradient-to-br from-green-700 to-green-900 p-6 rounded-xl shadow-sm text-white flex flex-col justify-center">
            <h3 class="text-xl font-bold mb-2">System Health</h3>
            <p class="text-gold-light mb-4 text-sm">All systems are running smoothly. Database backups are up to date.</p>
            <a href="{{ route('settings.index') }}" class="bg-primary text-gold px-4 py-2 rounded-lg text-sm font-medium self-start hover:bg-primary-dark transition shadow-sm">
                Go to Settings
            </a>
        </div>
    </div>

@elseif($role === 'staff')
    <!-- ================= STAFF DASHBOARD ================= -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stat Card 1 -->
        <div class="bg-primary rounded-xl p-6 border border-slate-700 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 flex-shrink-0">
                <i class="fas fa-file-invoice text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-400">Pending Apps</p>
                <h3 class="text-2xl font-bold text-white">{{ number_format($stats['pending_apps']) }}</h3>
            </div>
        </div>
        <!-- Stat Card 2 -->
        <div class="bg-primary rounded-xl p-6 border border-slate-700 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 flex-shrink-0">
                <i class="fas fa-money-check-alt text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-400">Payments to Verify</p>
                <h3 class="text-2xl font-bold text-white">{{ number_format($stats['payments_to_verify']) }}</h3>
            </div>
        </div>
        <!-- Stat Card 3 -->
        <div class="bg-primary rounded-xl p-6 border border-slate-700 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 flex-shrink-0">
                <i class="fas fa-calendar-day text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-400">Due Today</p>
                <h3 class="text-2xl font-bold text-white">{{ number_format($stats['due_today']) }}</h3>
            </div>
        </div>
        <!-- Stat Card 4 -->
        <div class="bg-primary rounded-xl p-6 border border-slate-700 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center text-red-600 flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-400">Overdue Follow-ups</p>
                <h3 class="text-2xl font-bold text-white">{{ number_format($stats['overdue_followups']) }}</h3>
            </div>
        </div>
    </div>

    <!-- Staff Quick Actions -->
    <div class="bg-primary p-6 rounded-xl border border-slate-700 shadow-sm mb-6">
        <h3 class="text-lg font-bold text-white mb-4">Task Shortcuts</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('staff.applications.pending') }}" class="p-4 border border-slate-700 rounded-lg hover:border-green-500 hover:bg-primary-light transition text-center group">
                <i class="fas fa-search text-xl text-gray-400 group-hover:text-green-500 mb-2 block"></i>
                <span class="text-sm font-medium text-gray-700">Review Applications</span>
            </a>
            <a href="{{ route('staff.payments.tracking') }}" class="p-4 border border-slate-700 rounded-lg hover:border-green-500 hover:bg-primary-light transition text-center group">
                <i class="fas fa-check-circle text-xl text-gray-400 group-hover:text-green-500 mb-2 block"></i>
                <span class="text-sm font-medium text-gray-700">Verify Payments</span>
            </a>
            <a href="{{ route('staff.borrowers.all') }}" class="p-4 border border-slate-700 rounded-lg hover:border-green-500 hover:bg-primary-light transition text-center group">
                <i class="fas fa-user-friends text-xl text-gray-400 group-hover:text-green-500 mb-2 block"></i>
                <span class="text-sm font-medium text-gray-700">Browse Borrowers</span>
            </a>
            <a href="{{ route('staff.schedule.overdue') }}" class="p-4 border border-slate-700 rounded-lg hover:border-green-500 hover:bg-primary-light transition text-center group">
                <i class="fas fa-phone-alt text-xl text-gray-400 group-hover:text-green-500 mb-2 block"></i>
                <span class="text-sm font-medium text-gray-700">Contact Overdue</span>
            </a>
        </div>
    </div>

@else
    <!-- ================= USER DASHBOARD ================= -->
    <div x-data="{ showApplyModal: false }">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            
            <!-- Primary Loan Status Card -->
            <div class="lg:col-span-2 bg-gradient-to-r from-primary to-primary-light border border-slate-700 rounded-xl p-6 shadow-md text-white relative overflow-hidden">
                <div class="absolute right-0 top-0 opacity-10">
                    <i class="fas fa-wallet text-[150px] -mt-10 -mr-10"></i>
                </div>
                <div class="relative z-10">
                    <p class="text-gold-light text-sm font-medium mb-1 uppercase tracking-wider">Active Loan Balance</p>
                    <h2 class="text-4xl font-bold mb-4">₱ {{ number_format($remainingBalance ?? 0, 2) }}</h2>
                    
                    <div class="flex flex-wrap gap-6 mt-6">
                        <div>
                            <p class="text-xs text-gold-light mb-1">Monthly Payment</p>
                            <p class="font-semibold text-lg">₱ {{ number_format($activeLoan?->monthly_payment ?? 0, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gold-light mb-1">Next Due Date</p>
                            <p class="font-semibold text-lg">{{ $nextPaymentDate ? \Carbon\Carbon::parse($nextPaymentDate)->format('M d, Y') : 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        @if($activeLoan && ($remainingBalance ?? 0) > 0)
                            <a href="{{ route('user.payments.make') }}" class="inline-block bg-primary text-gold font-bold py-2 px-6 rounded-full shadow-sm hover:shadow-md hover:bg-primary-dark transition">
                                Pay Now <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        @else
                            <button @click="showApplyModal = true" class="inline-block bg-primary text-gold font-bold py-2 px-6 rounded-full shadow-sm hover:shadow-md hover:bg-primary-dark transition">
                                Apply for a Loan <i class="fas fa-plus ml-2"></i>
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Info column -->
            <div class="flex flex-col gap-6">
                <!-- Application Status -->
                <div class="bg-primary p-5 rounded-xl border border-slate-700 shadow-sm flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center flex-shrink-0 mt-1">
                        <i class="fas fa-file-signature"></i>
                    </div>
                    <div>
                        @if($activeLoan)
                            <h3 class="font-bold text-white text-sm mb-1">Loan Status</h3>
                            <p class="text-xs text-slate-400 mb-2">Your loan #{{ $activeLoan->id }} is currently {{ $activeLoan->status }}. Keep your payments up to date to maintain a good credit score.</p>
                            <a href="{{ route('user.loans.active') }}" class="text-blue-600 hover:text-blue-800 text-xs font-semibold">View Details &rarr;</a>
                        @else
                            <h3 class="font-bold text-white text-sm mb-1">Ready to Apply?</h3>
                            <p class="text-xs text-slate-400 mb-2">You are eligible to apply for a new loan. Click the button below to get started.</p>
                            <button @click="showApplyModal = true" class="text-blue-600 hover:text-blue-800 text-xs font-semibold uppercase tracking-wider">Apply Now &rarr;</button>
                        @endif
                    </div>
                </div>

                <!-- Documents Status -->
                <div class="bg-primary p-5 rounded-xl border border-slate-700 shadow-sm flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-primary-light text-green-500 flex items-center justify-center flex-shrink-0 mt-1">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-sm mb-1">Documents</h3>
                        <p class="text-xs text-slate-400 mb-2">All your submitted requirements are verified and up to date.</p>
                        <a href="{{ route('user.documents.submitted') }}" class="text-gold hover:text-gold text-xs font-semibold">View Files &rarr;</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-white">Recent Transactions</h3>
                <a href="{{ route('user.payments.history') }}" class="text-sm text-gold hover:text-gold font-medium">View All</a>
            </div>
            <div class="divide-y divide-slate-700">
                @forelse($recentPayments ?? [] as $payment)
                <div class="py-3 flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-primary-dark text-slate-400 flex items-center justify-center">
                            <i class="fas fa-receipt text-xs"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-white">Loan Payment</p>
                            <p class="text-xs text-slate-400">{{ $payment->payment_date->format('M d, Y') }} • {{ ucfirst($payment->payment_method) }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-white">- ₱ {{ number_format($payment->amount_paid, 2) }}</p>
                        <p class="text-[10px] font-semibold text-gold uppercase">Verified</p>
                    </div>
                </div>
                @empty
                <div class="py-8 text-center text-slate-400 text-sm italic">
                    No payment history found.
                </div>
                @endforelse
            </div>
        </div>

        <!-- Apply Loan Modal -->
        <div x-show="showApplyModal" 
             class="fixed inset-0 z-50 overflow-y-auto" 
             x-cloak>
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showApplyModal" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0" 
                     x-transition:enter-end="opacity-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100" 
                     x-transition:leave-end="opacity-0" 
                     class="fixed inset-0 transition-opacity" 
                     aria-hidden="true" 
                     @click="showApplyModal = false">
                    <div class="absolute inset-0 bg-primary-dark0 opacity-75"></div>
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="showApplyModal" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="inline-block align-bottom bg-primary rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    
                    <div class="bg-primary px-6 py-6 sm:p-8">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-white">Apply for a Loan</h3>
                            <button @click="showApplyModal = false" class="text-gray-400 hover:text-slate-300 transition">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <form action="{{ route('user.loans.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Requested Amount (₱)</label>
                                <input type="number" name="loan_amount" required placeholder="e.g. 10000" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Loan Term</label>
                                <select name="loan_term" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all">
                                    <option value="3">3 Months</option>
                                    <option value="6" selected>6 Months</option>
                                    <option value="12">12 Months</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Purpose of Loan</label>
                                <textarea name="purpose" rows="3" placeholder="Briefly describe why you need this loan..." class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"></textarea>
                            </div>

                            <div class="bg-blue-50 p-4 rounded-xl border border-blue-100">
                                <div class="flex gap-3">
                                    <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                                    <p class="text-xs text-blue-700 leading-relaxed">By applying, you agree to the standard 5% monthly interest rate. Your application will be reviewed by our staff within 24-48 hours.</p>
                                </div>
                            </div>

                            <div class="pt-4 flex gap-3">
                                <button type="button" @click="showApplyModal = false" class="flex-1 px-4 py-3 border border-slate-700 text-slate-300 font-semibold rounded-xl hover:bg-primary-dark transition">
                                    Cancel
                                </button>
                                <button type="submit" class="flex-1 px-4 py-3 bg-gold text-primary-dark text-white font-bold rounded-xl hover-bg-gold shadow-md hover:shadow-lg transform active:scale-95 transition-all">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection
