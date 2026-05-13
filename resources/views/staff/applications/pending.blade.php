@extends('layouts.app')
@section('title', 'Pending Applications')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Pending Applications</h1>
    <p class="text-slate-300 mt-1">Loan applications awaiting your review and verification.</p>
</div>

@if(session('success'))
<div class="mb-4 bg-green-500/20 border border-green-500/30 text-green-400 px-4 py-3 rounded-xl text-sm">
    <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
</div>
@endif

<div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-primary-dark border-b border-slate-700">
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Application ID</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Borrower</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Amount</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Term</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Date Filed</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $application)
                <tr class="border-b border-slate-700 hover:bg-primary-dark transition">
                    <td class="p-4 text-sm font-medium text-white">LOAN-{{ str_pad($application->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td class="p-4 text-sm text-slate-300">{{ $application->borrower->name ?? 'Unknown' }}</td>
                    <td class="p-4 text-sm font-medium text-gold">₱{{ number_format($application->loan_amount, 2) }}</td>
                    <td class="p-4 text-sm text-slate-300">{{ $application->loan_term }} months</td>
                    <td class="p-4 text-sm text-slate-400">{{ $application->created_at->format('M d, Y') }}</td>
                    <td class="p-4"><span class="bg-yellow-500/20 text-yellow-400 px-2 py-1 rounded-full text-xs font-semibold">Pending</span></td>
                    <td class="p-4 text-right">
                        <form action="{{ route('staff.applications.verify', $application) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-gold text-primary-dark px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-gold-hover transition" title="Verify & Forward to Admin">
                                <i class="fas fa-check mr-1"></i> Verify & Forward
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-4 text-center text-slate-400 text-sm">No pending applications found.</td>
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
