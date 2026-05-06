@extends('layouts.app')
@section('title', 'All Borrowers')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">All Borrowers</h1>
    <p class="text-gray-600 mt-1">Complete list of registered borrowers in the system.</p>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <div class="flex justify-between items-center mb-6">
        <input type="text" placeholder="Search borrower..." class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-green-500 w-64">
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Phone</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Active Loans</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Verified</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrowers as $borrower)
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                    <td class="p-4 text-sm font-medium text-gray-800">{{ $borrower->name }}</td>
                    <td class="p-4 text-sm text-gray-600">{{ $borrower->email }}</td>
                    <td class="p-4 text-sm text-gray-600">{{ $borrower->phone ?? 'N/A' }}</td>
                    <td class="p-4 text-sm font-medium text-gray-800">{{ $borrower->balance > 0 ? 1 : 0 }}</td>
                    <td class="p-4">
                        @if($borrower->status === 'approved')
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-semibold">Yes</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-semibold">{{ ucfirst($borrower->status) }}</span>
                        @endif
                    </td>
                    <td class="p-4 text-right"><button class="text-blue-500 hover:text-blue-700"><i class="fas fa-eye"></i></button></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-gray-500 text-sm">No borrowers found.</td>
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
