@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<!-- Page Header -->
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
    <p class="text-slate-400 text-sm mt-1">Welcome back, <span class="font-semibold text-gold">{{ Auth::user()->name ?? 'Admin' }}</span> 👋</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 md:gap-5 mb-8">

    <div class="bg-primary rounded-2xl p-5 shadow-sm border border-slate-700 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #d1fae5, #a7f3d0);">
                <i class="fas fa-users text-gold text-lg"></i>
            </div>
            <span class="text-xs font-medium text-gold bg-primary-light px-2.5 py-1 rounded-full">+12%</span>
        </div>
        <p class="text-3xl font-bold text-gray-900">150</p>
        <p class="text-sm text-slate-400 mt-1">Total Clients</p>
    </div>

    <div class="bg-primary rounded-2xl p-5 shadow-sm border border-slate-700 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #dbeafe, #bfdbfe);">
                <i class="fas fa-hand-holding-usd text-blue-600 text-lg"></i>
            </div>
            <span class="text-xs font-medium text-blue-600 bg-blue-50 px-2.5 py-1 rounded-full">Active</span>
        </div>
        <p class="text-3xl font-bold text-gray-900">75</p>
        <p class="text-sm text-slate-400 mt-1">Active Loans</p>
    </div>

    <div class="bg-primary rounded-2xl p-5 shadow-sm border border-slate-700 hover:shadow-md transition-shadow sm:col-span-2 xl:col-span-1">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #fee2e2, #fecaca);">
                <i class="fas fa-exclamation-triangle text-red-500 text-lg"></i>
            </div>
            <span class="text-xs font-medium text-red-600 bg-red-50 px-2.5 py-1 rounded-full">Urgent</span>
        </div>
        <p class="text-3xl font-bold text-red-600">12</p>
        <p class="text-sm text-slate-400 mt-1">Overdue Loans</p>
    </div>

</div>

<!-- Quick Actions -->
<div class="bg-primary rounded-2xl p-5 shadow-sm border border-slate-700">
    <h2 class="text-base font-semibold text-white mb-4 flex items-center gap-2">
        <i class="fas fa-bolt text-yellow-500"></i> Quick Actions
    </h2>
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('loan.create') }}"
           class="inline-flex items-center gap-2 bg-gold text-primary-dark hover-bg-gold text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition shadow-sm">
            <i class="fas fa-user-plus"></i> Add Client
        </a>
        <a href="{{ route('loan.index') }}"
           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition shadow-sm">
            <i class="fas fa-list"></i> View Clients
        </a>
    </div>
</div>

@endsection
