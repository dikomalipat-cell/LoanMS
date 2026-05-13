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
                LoanShark Overview
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
        <!-- Capital Card -->
        <div class="bg-gradient-to-br from-primary to-primary-light rounded-xl p-6 border border-slate-700 shadow-sm flex items-center gap-4 hover:shadow-md transition-all group overflow-hidden relative">
            <div class="absolute -right-4 -top-4 opacity-10 group-hover:scale-110 transition-transform">
                <i class="fas fa-vault text-6xl"></i>
            </div>
            <div class="w-12 h-12 rounded-full bg-gold/20 flex items-center justify-center text-gold flex-shrink-0">
                <i class="fas fa-gem text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-400">Total Capital</p>
                <h3 class="text-2xl font-bold text-white">₱ 10,000,000,000</h3>
                <p class="text-[10px] text-green-400 font-bold mt-1 uppercase">Corporate Reserve</p>
            </div>
        </div>

        <!-- Revenue Card -->
        <div class="bg-gradient-to-br from-primary to-primary-light rounded-xl p-6 border border-slate-700 shadow-sm flex items-center gap-4 hover:shadow-md transition-all group overflow-hidden relative">
            <div class="absolute -right-4 -top-4 opacity-10 group-hover:scale-110 transition-transform">
                <i class="fas fa-chart-line text-6xl"></i>
            </div>
            <div class="w-12 h-12 rounded-full bg-green-100/10 flex items-center justify-center text-green-500 flex-shrink-0">
                <i class="fas fa-coins text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-400">Total Revenue</p>
                <h3 class="text-2xl font-bold text-white">₱ 10,000,000,000</h3>
                <p class="text-[10px] text-green-400 font-bold mt-1 uppercase">+12.5% vs Last Month</p>
            </div>
        </div>

        <!-- Profit Card -->
        <div class="bg-gradient-to-br from-primary to-primary-light rounded-xl p-6 border border-slate-700 shadow-sm flex items-center gap-4 hover:shadow-md transition-all group overflow-hidden relative">
            <div class="absolute -right-4 -top-4 opacity-10 group-hover:scale-110 transition-transform">
                <i class="fas fa-sack-dollar text-6xl"></i>
            </div>
            <div class="w-12 h-12 rounded-full bg-blue-100/10 flex items-center justify-center text-blue-400 flex-shrink-0">
                <i class="fas fa-hand-holding-heart text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-400">Net Profit</p>
                <h3 class="text-2xl font-bold text-white">₱ 10,000,000,000</h3>
                <p class="text-[10px] text-blue-400 font-bold mt-1 uppercase">Ready for Payout</p>
            </div>
        </div>

        <!-- Countdown Card -->
        <div class="bg-gradient-to-br from-gold/10 to-gold/5 rounded-xl p-6 border border-gold/20 shadow-sm flex items-center gap-4 hover:shadow-md transition-all overflow-hidden relative">
            <div class="w-12 h-12 rounded-full bg-gold flex items-center justify-center text-primary-dark flex-shrink-0">
                <i class="fas fa-clock text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gold">Next Collection Cycle</p>
                <h3 class="text-2xl font-bold text-white font-mono" id="collection-countdown">00:00:00</h3>
                <p class="text-[10px] text-slate-400 mt-1 uppercase">Automated Batch Process</p>
            </div>
        </div>
    </div>

    <!-- Real-time Graph Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="lg:col-span-2 bg-primary p-6 rounded-2xl border border-slate-700 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-lg font-bold text-white">Live Collection Analytics</h3>
                    <p class="text-xs text-slate-400">Real-time throughput of system-wide payments</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="flex h-2 w-2 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                    <span class="text-[10px] font-bold text-green-500 uppercase tracking-widest">Live</span>
                </div>
            </div>
            <div class="h-64">
                <canvas id="liveChart"></canvas>
            </div>
        </div>

        <div class="flex flex-col gap-6">
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
                <div class="w-12 h-12 rounded-full bg-red-100/10 flex items-center justify-center text-red-500 flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-400">Overdue Accounts</p>
                    <h3 class="text-2xl font-bold text-white">{{ number_format($stats['overdue_followups']) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-primary p-6 rounded-xl border border-slate-700 shadow-sm">
            <h3 class="text-lg font-bold text-white mb-4">Quick Actions</h3>
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('admin.users.index') }}" class="p-4 border border-slate-700 rounded-lg hover:border-gold hover:bg-primary-light transition text-center group">
                    <i class="fas fa-users-cog text-2xl text-gray-400 group-hover:text-gold mb-2 block"></i>
                    <span class="text-sm font-medium text-slate-300">User Management</span>
                </a>
                <a href="{{ route('banks.index') }}" class="p-4 border border-slate-700 rounded-lg hover:border-gold hover:bg-primary-light transition text-center group">
                    <i class="fas fa-university text-2xl text-gray-400 group-hover:text-gold mb-2 block"></i>
                    <span class="text-sm font-medium text-slate-300">Bank Partners</span>
                </a>
            </div>
        </div>
        <div class="bg-gradient-to-br from-primary to-primary-light p-6 rounded-xl border border-slate-700 shadow-sm text-white flex flex-col justify-center relative overflow-hidden">
            <div class="absolute right-0 bottom-0 opacity-5 -mb-4 -mr-4">
                <i class="fas fa-shield-alt text-8xl"></i>
            </div>
            <h3 class="text-xl font-bold mb-2">Security & Health</h3>
            <p class="text-slate-400 mb-4 text-sm">System encryption is active. All financial logs are being audited in real-time.</p>
            <a href="{{ route('settings.index') }}" class="bg-gold text-primary-dark px-4 py-2 rounded-lg text-sm font-bold self-start hover:bg-white transition shadow-sm">
                System Settings
            </a>
        </div>
    </div>

    <!-- Recent Activity Tables -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Recent Loans -->
        <div class="bg-primary rounded-2xl border border-slate-700 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-700 flex justify-between items-center bg-white/5">
                <h3 class="font-bold text-white">Recent Loan Applications</h3>
                <span class="text-[10px] bg-gold/20 text-gold px-2 py-1 rounded-full font-bold uppercase">Real-time</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="text-xs text-slate-400 uppercase bg-slate-800/50">
                        <tr>
                            <th class="px-6 py-3 font-semibold">Borrower</th>
                            <th class="px-6 py-3 font-semibold">Amount</th>
                            <th class="px-6 py-3 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        @forelse($recentLoans ?? [] as $loan)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-primary-light flex items-center justify-center text-xs font-bold text-gold">
                                        {{ strtoupper(substr($loan->borrower->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <span class="text-sm font-medium text-white">{{ $loan->borrower->name ?? 'Unknown' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-300">₱ {{ number_format($loan->loan_amount, 2) }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-[10px] font-bold rounded-full uppercase 
                                    @if($loan->status === 'approved') bg-green-500/20 text-green-400
                                    @elseif($loan->status === 'pending') bg-yellow-500/20 text-yellow-400
                                    @else bg-red-500/20 text-red-400 @endif">
                                    {{ $loan->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-slate-500 italic text-sm">No recent applications found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Payments -->
        <div class="bg-primary rounded-2xl border border-slate-700 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-700 flex justify-between items-center bg-white/5">
                <h3 class="font-bold text-white">Recent Collections</h3>
                <span class="text-[10px] bg-green-500/20 text-green-400 px-2 py-1 rounded-full font-bold uppercase">Verified</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="text-xs text-slate-400 uppercase bg-slate-800/50">
                        <tr>
                            <th class="px-6 py-3 font-semibold">Client</th>
                            <th class="px-6 py-3 font-semibold">Amount</th>
                            <th class="px-6 py-3 font-semibold">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        @forelse($recentPayments ?? [] as $payment)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-green-500/10 flex items-center justify-center text-xs font-bold text-green-400">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <span class="text-sm font-medium text-white">{{ $payment->loan->borrower->name ?? 'Unknown' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-green-400 font-bold">₱ {{ number_format($payment->amount_paid, 2) }}</td>
                            <td class="px-6 py-4 text-xs text-slate-400">{{ $payment->payment_date->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-slate-500 italic text-sm">No recent payments recorded.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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

@if($role === 'admin')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Countdown Timer
    function updateCountdown() {
        const now = new Date();
        const tomorrow = new Date(now);
        tomorrow.setHours(24, 0, 0, 0);
        
        const diff = tomorrow - now;
        const hours = Math.floor(diff / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((diff % (1000 * 60)) / 1000);
        
        document.getElementById('collection-countdown').innerText = 
            `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    }
    setInterval(updateCountdown, 1000);
    updateCountdown();

    // Live Chart
    const ctx = document.getElementById('liveChart').getContext('2d');
    const liveChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: Array(20).fill(''),
            datasets: [{
                label: 'Payment Throughput (₱)',
                data: Array(20).fill(0).map(() => Math.floor(Math.random() * 5000) + 1000),
                borderColor: '#f5c518',
                backgroundColor: 'rgba(245, 197, 24, 0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#94a3b8' } },
                x: { grid: { display: false } }
            },
            plugins: { legend: { display: false } },
            animation: { duration: 1000 }
        }
    });

    // Simulate real-time updates
    setInterval(() => {
        liveChart.data.datasets[0].data.shift();
        liveChart.data.datasets[0].data.push(Math.floor(Math.random() * 5000) + 1000);
        liveChart.update();
    }, 3000);
</script>
@endif
@endsection
