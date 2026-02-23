@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<!-- Page Header -->
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
    <p class="text-gray-500 text-sm mt-1">Welcome back, <span class="font-semibold text-green-600">{{ Auth::user()->name ?? 'Admin' }}</span> 👋</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 md:gap-5 mb-8">

    <!-- Total Clients -->
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #d1fae5, #a7f3d0);">
                <i class="fas fa-users text-green-600 text-lg"></i>
            </div>
            <span class="text-xs font-medium text-green-600 bg-green-50 px-2.5 py-1 rounded-full">+12%</span>
        </div>
        <p class="text-3xl font-bold text-gray-900">0</p>
        <p class="text-sm text-gray-500 mt-1">Total Clients</p>
    </div>

    <!-- Active Loans -->
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #dbeafe, #bfdbfe);">
                <i class="fas fa-hand-holding-usd text-blue-600 text-lg"></i>
            </div>
            <span class="text-xs font-medium text-blue-600 bg-blue-50 px-2.5 py-1 rounded-full">Active</span>
        </div>
        <p class="text-3xl font-bold text-gray-900">0</p>
        <p class="text-sm text-gray-500 mt-1">Active Loans</p>
    </div>

    <!-- Overdue -->
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #fee2e2, #fecaca);">
                <i class="fas fa-exclamation-triangle text-red-500 text-lg"></i>
            </div>
            <span class="text-xs font-medium text-red-600 bg-red-50 px-2.5 py-1 rounded-full">Urgent</span>
        </div>
        <p class="text-3xl font-bold text-red-600">0</p>
        <p class="text-sm text-gray-500 mt-1">Overdue Loans</p>
    </div>

    <!-- Total Collected -->
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #fef3c7, #fde68a);">
                <i class="fas fa-peso-sign text-yellow-600 text-lg"></i>
            </div>
            <span class="text-xs font-medium text-yellow-600 bg-yellow-50 px-2.5 py-1 rounded-full">This month</span>
        </div>
        <p class="text-3xl font-bold text-gray-900">₱0</p>
        <p class="text-sm text-gray-500 mt-1">Total Collected</p>
    </div>

</div>

<!-- Quick Actions + Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
        <h2 class="text-base font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fas fa-bolt text-yellow-500"></i> Quick Actions
        </h2>
        <div class="space-y-3">
            <a href="{{ route('loan.create') }}"
               class="flex items-center gap-3 p-3 rounded-xl bg-green-50 hover:bg-green-100 text-green-700 transition group">
                <div class="w-9 h-9 bg-green-600 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-green-700 transition">
                    <i class="fas fa-user-plus text-white text-sm"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold">Add New Client</p>
                    <p class="text-xs text-green-600">Register a new borrower</p>
                </div>
                <i class="fas fa-chevron-right ml-auto text-xs text-green-400"></i>
            </a>

            <a href="{{ route('loan.index') }}"
               class="flex items-center gap-3 p-3 rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-700 transition group">
                <div class="w-9 h-9 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-blue-700 transition">
                    <i class="fas fa-list text-white text-sm"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold">View All Clients</p>
                    <p class="text-xs text-blue-600">Browse client records</p>
                </div>
                <i class="fas fa-chevron-right ml-auto text-xs text-blue-400"></i>
            </a>

            <a href="{{ url('/waykabayad') }}"
               class="flex items-center gap-3 p-3 rounded-xl bg-red-50 hover:bg-red-100 text-red-700 transition group">
                <div class="w-9 h-9 bg-red-500 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-red-600 transition">
                    <i class="fas fa-calendar-times text-white text-sm"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold">Unpaid Dues</p>
                    <p class="text-xs text-red-600">Check overdue payments</p>
                </div>
                <i class="fas fa-chevron-right ml-auto text-xs text-red-400"></i>
            </a>
        </div>
    </div>

    <!-- Recent Activity placeholder -->
    <div class="lg:col-span-2 bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
        <h2 class="text-base font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fas fa-clock text-blue-500"></i> Recent Activity
        </h2>
        <div class="flex flex-col items-center justify-center py-10 text-gray-400">
            <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-3">
                <i class="fas fa-inbox text-2xl text-gray-300"></i>
            </div>
            <p class="text-sm font-medium text-gray-500">No recent activity</p>
            <p class="text-xs text-gray-400 mt-1">Activity will appear here once you start adding clients</p>
        </div>
    </div>

</div>

@endsection
