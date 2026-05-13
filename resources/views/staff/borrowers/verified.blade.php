@extends('layouts.app')
@section('title', 'Verified Accounts')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Verified Accounts</h1>
    <p class="text-slate-300 mt-1">Borrowers who have completed identity verification.</p>
</div>
<div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-primary-dark border-b border-slate-700">
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Name</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Email</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Phone</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrowers as $borrower)
                <tr class="border-b border-gray-50 hover:bg-primary-dark transition">
                    <td class="p-4 text-sm font-medium text-white">{{ $borrower->name }}</td>
                    <td class="p-4 text-sm text-slate-300">{{ $borrower->email }}</td>
                    <td class="p-4 text-sm text-slate-300">{{ $borrower->phone ?? 'N/A' }}</td>
                    <td class="p-4"><span class="bg-gold/20 text-gold px-2 py-1 rounded-full text-xs font-semibold">Verified</span></td>
                    <td class="p-4 text-right">
                        <button class="text-blue-500 hover:text-blue-700 mr-2"><i class="fas fa-eye"></i></button>
                        <button class="text-green-500 hover:text-gold"><i class="fas fa-user-check"></i></button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-slate-400 text-sm">No verified borrowers found.</td>
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
