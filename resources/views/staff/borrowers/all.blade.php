@extends('layouts.app')
@section('title', 'All Borrowers')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">All Borrowers</h1>
    <p class="text-slate-300 mt-1">Complete list of registered borrowers in the system.</p>
</div>
<div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6">
    <div class="flex justify-between items-center mb-6">
        <input type="text" placeholder="Search borrower..." class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-green-500 w-64">
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-primary-dark border-b border-slate-700">
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Name</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Email</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Phone</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Active Loans</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Verified</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrowers as $borrower)
                <tr class="border-b border-gray-50 hover:bg-primary-dark transition">
                    <td class="p-4 text-sm font-medium text-white">{{ $borrower->name }}</td>
                    <td class="p-4 text-sm text-slate-300">{{ $borrower->email }}</td>
                    <td class="p-4 text-sm text-slate-300">{{ $borrower->phone ?? 'N/A' }}</td>
                    <td class="p-4 text-sm font-medium text-white">{{ $borrower->balance > 0 ? 1 : 0 }}</td>
                    <td class="p-4">
                        @if($borrower->status === 'approved')
                            <span class="bg-gold/20 text-gold px-2 py-1 rounded-full text-xs font-semibold">Yes</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-semibold">{{ ucfirst($borrower->status) }}</span>
                        @endif
                    </td>
                    <td class="p-4 text-right"><button class="text-blue-500 hover:text-blue-700"><i class="fas fa-eye"></i></button></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-slate-400 text-sm">No borrowers found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $borrowers->links() }}
    </div>
</div>
@endsection
