@extends('layouts.app')
@section('title', 'User Activity Logs')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">User Activity Logs</h1>
    <p class="text-gray-500 text-sm mt-1">Monitor all user actions and system events.</p>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-100">
    <div class="p-4 border-b border-gray-100 flex flex-wrap items-center justify-between gap-3">
        <div class="relative">
            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
            <input type="text" placeholder="Search logs..." class="pl-9 pr-4 py-2 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-200 w-64">
        </div>
        <select class="text-sm border border-gray-200 rounded-lg px-3 py-2 bg-gray-50"><option>All Actions</option><option>Login</option><option>Loan</option><option>Payment</option><option>Settings</option></select>
    </div>
    <div class="divide-y divide-gray-100">
        @forelse($logs as $log)
        <div class="px-5 py-4 flex items-center gap-4 hover:bg-gray-50 transition">
            <div class="w-9 h-9 rounded-full bg-{{ $log['color'] }}-100 flex items-center justify-center text-{{ $log['color'] }}-600 flex-shrink-0">
                <i class="fas {{ $log['icon'] }} text-sm"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm text-gray-800"><span class="font-semibold">{{ $log['user'] }}</span> {{ $log['action'] }}</p>
                <p class="text-xs text-gray-400">{{ $log['time'] }}</p>
            </div>
        </div>
        @empty
        <div class="p-8 text-center text-gray-500">
            No recent activity found.
        </div>
        @endforelse
    </div>
</div>
@endsection