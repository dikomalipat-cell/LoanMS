@extends('layouts.app')
@section('title', 'Under Review')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Under Review</h1>
    <p class="text-slate-300 mt-1">Applications currently being evaluated by staff.</p>
</div>
<div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-primary-dark border-b border-slate-700">
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Application ID</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Borrower</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Amount</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Assigned To</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $application)
                <tr class="border-b border-gray-50 hover:bg-primary-dark transition">
                    <td class="p-4 text-sm font-medium text-white">APP-{{ date('Y') }}-{{ str_pad($application->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td class="p-4 text-sm text-slate-300">{{ $application->name }}</td>
                    <td class="p-4 text-sm font-medium text-white">₱ {{ number_format($application->loan_amount, 2) }}</td>
                    <td class="p-4 text-sm text-slate-300">Admin</td>
                    <td class="p-4"><span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-semibold">Under Review</span></td>
                    <td class="p-4 text-right">
                        <button class="text-blue-500 hover:text-blue-700 mr-2"><i class="fas fa-eye"></i></button>
                        <button class="text-green-500 hover:text-gold mr-2"><i class="fas fa-check"></i></button>
                        <button class="text-red-500 hover:text-red-700"><i class="fas fa-times"></i></button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-slate-400 text-sm">No applications under review.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $applications->links() }}
    </div>
</div>
@endsection
