@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')


@php
    $user = Auth::user();
    $isAdmin = (bool) ($user?->is_admin ?? false);
@endphp

<!-- Hero / Greeting -->
<section class="relative overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm">
    <div class="absolute inset-0 opacity-60"
         style="background: radial-gradient(900px circle at 0% 0%, rgba(16,185,129,0.18) 0%, rgba(16,185,129,0) 60%), radial-gradient(900px circle at 100% 0%, rgba(59,130,246,0.14) 0%, rgba(59,130,246,0) 55%), radial-gradient(900px circle at 70% 120%, rgba(245,158,11,0.14) 0%, rgba(245,158,11,0) 60%);"></div>

    <div class="relative p-6 md:p-8">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-500">{{ $isAdmin ? 'Admin Overview' : 'Your Workspace' }}</p>
                <h1 class="mt-1 text-2xl md:text-3xl font-bold text-gray-900">
                    Welcome back, <span class="text-green-700">{{ $user->name ?? 'User' }}</span>
                </h1>
                <p class="mt-2 text-sm text-gray-600">
                    {{ $isAdmin ? 'Monitor collections, manage clients, and stay on top of overdue accounts.' : 'Create clients, track loans, and keep payments organized.' }}
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('loan.create') }}"
                   class="inline-flex items-center gap-2 rounded-xl bg-green-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-200">
                    <i class="fas fa-user-plus text-xs"></i>
                    {{ $isAdmin ? 'Add Client' : 'New Client' }}
                </a>
                <a href="{{ route('loan.index') }}"
                   class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-gray-200 transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <i class="fas fa-list text-xs text-gray-500"></i>
                    View Clients
                </a>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-2xl border border-gray-100 bg-white/70 p-5 backdrop-blur">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-50">
                            <i class="fas fa-users text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-500">Total Clients</p>
                            <p class="text-2xl font-bold text-gray-900">0</p>
                        </div>
                    </div>
                    <span class="rounded-full bg-green-50 px-2.5 py-1 text-xs font-semibold text-green-700">Live</span>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-100 bg-white/70 p-5 backdrop-blur">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50">
                            <i class="fas fa-hand-holding-usd text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-500">Active Loans</p>
                            <p class="text-2xl font-bold text-gray-900">0</p>
                        </div>
                    </div>
                    <span class="rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700">Active</span>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-100 bg-white/70 p-5 backdrop-blur">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-50">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-500">Overdue</p>
                            <p class="text-2xl font-bold text-red-600">0</p>
                        </div>
                    </div>
                    <span class="rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700">Attention</span>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-100 bg-white/70 p-5 backdrop-blur">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50">
                            <i class="fas fa-peso-sign text-amber-600"></i>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-500">Collected</p>
                            <p class="text-2xl font-bold text-gray-900">₱0</p>
                        </div>
                    </div>
                    <span class="rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">This month</span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="mt-6 grid grid-cols-1 gap-5 lg:grid-cols-3">
    <!-- Left column -->
    <section class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <h2 class="text-base font-semibold text-gray-900 flex items-center gap-2">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-2xl bg-gray-100">
                    <i class="fas fa-bolt text-sm text-gray-700"></i>
                </span>
                Quick Actions
            </h2>
            <span class="text-xs font-medium text-gray-400">Shortcuts</span>
        </div>

        <div class="mt-4 space-y-3">
            <a href="{{ route('loan.create') }}"
               class="group flex items-center gap-3 rounded-2xl border border-gray-100 bg-gradient-to-br from-green-50 to-white p-4 transition hover:shadow-sm">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-600 text-white shadow-sm transition group-hover:bg-green-700">
                    <i class="fas fa-user-plus text-sm"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-gray-900">Create a Client</p>
                    <p class="mt-0.5 text-xs text-gray-500">Add borrower details and initial loan data</p>
                </div>
                <i class="fas fa-chevron-right ml-auto text-xs text-gray-300 group-hover:text-gray-400"></i>
            </a>

            <a href="{{ route('loan.index') }}"
               class="group flex items-center gap-3 rounded-2xl border border-gray-100 bg-gradient-to-br from-blue-50 to-white p-4 transition hover:shadow-sm">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-white shadow-sm transition group-hover:bg-blue-700">
                    <i class="fas fa-list text-sm"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-gray-900">Browse Clients</p>
                    <p class="mt-0.5 text-xs text-gray-500">Search, filter, and update records</p>
                </div>
                <i class="fas fa-chevron-right ml-auto text-xs text-gray-300 group-hover:text-gray-400"></i>
            </a>

            <a href="{{ url('/waykabayad') }}"
               class="group flex items-center gap-3 rounded-2xl border border-gray-100 bg-gradient-to-br from-red-50 to-white p-4 transition hover:shadow-sm">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-600 text-white shadow-sm transition group-hover:bg-red-700">
                    <i class="fas fa-calendar-times text-sm"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-gray-900">Unpaid Dues</p>
                    <p class="mt-0.5 text-xs text-gray-500">Review accounts that need attention</p>
                </div>
                <i class="fas fa-chevron-right ml-auto text-xs text-gray-300 group-hover:text-gray-400"></i>
            </a>
        </div>
    </section>

    <!-- Right column -->
    <section class="lg:col-span-2 rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-base font-semibold text-gray-900 flex items-center gap-2">
                    <span class="inline-flex h-9 w-9 items-center justify-center rounded-2xl bg-gray-100">
                        <i class="fas fa-chart-line text-sm text-gray-700"></i>
                    </span>
                    {{ $isAdmin ? 'Admin Insights' : 'Your Activity' }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    {{ $isAdmin ? 'Key operational signals at a glance.' : 'Recent actions will appear here.' }}
                </p>
            </div>

            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-2 rounded-full bg-gray-100 px-3 py-1.5 text-xs font-semibold text-gray-700">
                    <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                    System OK
                </span>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="rounded-2xl border border-gray-100 p-5">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-gray-900">Next Steps</p>
                    <i class="fas fa-clipboard-check text-gray-300"></i>
                </div>
                <ul class="mt-3 space-y-2 text-sm text-gray-600">
                    <li class="flex items-start gap-2">
                        <span class="mt-1 h-1.5 w-1.5 rounded-full bg-green-500"></span>
                        Create your first client record.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="mt-1 h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                        Track loan status and due dates consistently.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="mt-1 h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                        Review unpaid dues daily to avoid delinquencies.
                    </li>
                </ul>
            </div>

            <div class="rounded-2xl border border-gray-100 p-5">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-gray-900">Recent Activity</p>
                    <i class="fas fa-clock text-gray-300"></i>
                </div>
                <div class="mt-6 flex flex-col items-center justify-center rounded-2xl bg-gray-50 p-6 text-center">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">
                        <i class="fas fa-inbox text-xl text-gray-300"></i>
                    </div>
                    <p class="mt-3 text-sm font-semibold text-gray-700">No activity yet</p>
                    <p class="mt-1 text-xs text-gray-500">Once you add clients, updates will show here.</p>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
