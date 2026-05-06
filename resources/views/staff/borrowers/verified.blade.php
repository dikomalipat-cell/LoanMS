@extends('layouts.app')
@section('title', 'Verified Accounts')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Verified Accounts</h1>
    <p class="text-gray-600 mt-1">Borrowers who have completed identity verification.</p>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Phone</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="p-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrowers as $borrower)
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                    <td class="p-4 text-sm font-medium text-gray-800">{{ $borrower->name }}</td>
                    <td class="p-4 text-sm text-gray-600">{{ $borrower->email }}</td>
                    <td class="p-4 text-sm text-gray-600">{{ $borrower->phone ?? 'N/A' }}</td>
                    <td class="p-4"><span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-semibold">Verified</span></td>
                    <td class="p-4 text-right">
                        <button class="text-blue-500 hover:text-blue-700 mr-2"><i class="fas fa-eye"></i></button>
                        <button class="text-green-500 hover:text-green-700"><i class="fas fa-user-check"></i></button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500 text-sm">No verified borrowers found.</td>
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
