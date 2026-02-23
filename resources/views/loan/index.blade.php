@extends('layouts.app')

@section('title', 'Client List')

@section('content')

<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Client Records</h1>
        <p class="text-gray-500 text-sm mt-1">Manage all registered borrowers</p>
    </div>
    <div class="flex flex-wrap gap-2">
        <a href="{{ route('loan.create') }}"
           class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl shadow-sm transition">
            <i class="fas fa-plus"></i> Add New Client
        </a>
        <a href="{{ route('dashboard') }}"
           class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-gray-700 text-sm font-medium px-4 py-2.5 rounded-xl border border-gray-200 shadow-sm transition">
            <i class="fas fa-arrow-left text-gray-400"></i> Back
        </a>
    </div>
</div>

@if(session('msg'))
    <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl mb-5 text-sm">
        <i class="fas fa-check-circle text-green-500 flex-shrink-0"></i>
        {{ session('msg') }}
    </div>
@endif

<!-- Main Card -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

    <!-- Table Toolbar -->
    <div class="px-5 py-4 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center gap-3">
        <div class="relative flex-1 max-w-xs">
            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
            <input type="text" id="tableSearch" placeholder="Search clients..."
                class="w-full pl-9 pr-4 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-green-400 focus:ring-2 focus:ring-green-100 transition"
                onkeyup="filterTable()">
        </div>
        <div class="flex items-center gap-2 text-sm text-gray-500">
            <i class="fas fa-filter text-gray-400"></i>
            <span id="rowCount">Loading...</span>
        </div>
    </div>

    {{-- Desktop Table --}}
    <div class="hidden md:block overflow-x-auto">
        <table class="min-w-full text-sm" id="clientTable">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Client</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Contact</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Gender</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Age</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Police</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Job</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Payroll</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Added</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($clients as $client)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3 text-gray-400 text-xs">{{ $client->id }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 font-bold text-xs text-white"
                                     style="background: linear-gradient(135deg, #059669, #047857);">
                                    {{ strtoupper(substr($client->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $client->name }}</p>
                                    <p class="text-xs text-gray-400 truncate max-w-xs">{{ $client->address ?? 'No address' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <p class="text-gray-700">{{ $client->phone ?? '—' }}</p>
                        </td>
                        <td class="px-4 py-3">
                            @if($client->gender == 'male')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                    <i class="fas fa-mars text-xs"></i> Male
                                </span>
                            @elseif($client->gender == 'female')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-pink-100 text-pink-700">
                                    <i class="fas fa-venus text-xs"></i> Female
                                </span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">Other</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-700">{{ $client->age ?? '—' }}</td>
                        <td class="px-4 py-3">
                            @if(strtolower($client->police_records ?? '') == 'clean' || empty($client->police_records))
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                    <i class="fas fa-check-circle text-xs"></i> Clean
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                    <i class="fas fa-exclamation-circle text-xs"></i> Has Records
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-700 text-xs">{{ $client->current_job ?? '—' }}</td>
                        <td class="px-4 py-3">
                            <p class="font-semibold text-gray-800">₱{{ number_format($client->payroll ?? 0, 2) }}</p>
                            @if(!empty($client->payroll_picture))
                                <a href="{{ asset($client->payroll_picture) }}" target="_blank"
                                   class="text-xs text-blue-500 hover:underline">View slip</a>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-xs text-gray-400">
                            {{ \Carbon\Carbon::parse($client->created_at)->format('M d, Y') }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('loan.edit', $client->id) }}"
                                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-50 hover:bg-yellow-100 text-yellow-600 transition"
                                   title="Edit">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <form action="{{ route('loan.destroy', $client->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete {{ $client->name }}?')"
                                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 hover:bg-red-100 text-red-600 transition"
                                        title="Delete">
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="px-4 py-16 text-center">
                            <div class="flex flex-col items-center text-gray-400">
                                <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-3">
                                    <i class="fas fa-users text-2xl text-gray-300"></i>
                                </div>
                                <p class="font-medium text-gray-500">No clients found</p>
                                <p class="text-xs mt-1">Start by adding your first client</p>
                                <a href="{{ route('loan.create') }}"
                                   class="mt-4 inline-flex items-center gap-2 bg-green-600 text-white text-sm px-4 py-2 rounded-xl hover:bg-green-700 transition">
                                    <i class="fas fa-plus"></i> Add Client
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Mobile Card View --}}
    <div class="md:hidden divide-y divide-gray-100" id="mobileCards">
        @forelse($clients as $client)
            <div class="p-4 hover:bg-gray-50 transition client-card">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 font-bold text-sm text-white"
                             style="background: linear-gradient(135deg, #059669, #047857);">
                            {{ strtoupper(substr($client->name, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $client->name }}</h3>
                            <p class="text-xs text-gray-400">ID #{{ $client->id }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-1">
                        <a href="{{ route('loan.edit', $client->id) }}"
                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-50 text-yellow-600">
                            <i class="fas fa-edit text-xs"></i>
                        </a>
                        <form action="{{ route('loan.destroy', $client->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Delete {{ $client->name }}?')"
                                class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-600">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div class="bg-gray-50 rounded-xl p-2.5">
                        <p class="text-xs text-gray-400 mb-0.5">Phone</p>
                        <p class="font-medium text-gray-700">{{ $client->phone ?? '—' }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-2.5">
                        <p class="text-xs text-gray-400 mb-0.5">Gender</p>
                        @if($client->gender == 'male')
                            <span class="text-xs font-medium text-blue-700">♂ Male</span>
                        @elseif($client->gender == 'female')
                            <span class="text-xs font-medium text-pink-700">♀ Female</span>
                        @else
                            <span class="text-xs font-medium text-gray-600">Other</span>
                        @endif
                    </div>
                    <div class="bg-gray-50 rounded-xl p-2.5">
                        <p class="text-xs text-gray-400 mb-0.5">Age</p>
                        <p class="font-medium text-gray-700">{{ $client->age ?? '—' }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-2.5">
                        <p class="text-xs text-gray-400 mb-0.5">Payroll</p>
                        <p class="font-semibold text-gray-800">₱{{ number_format($client->payroll ?? 0, 2) }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-2.5">
                        <p class="text-xs text-gray-400 mb-0.5">Police Records</p>
                        @if(strtolower($client->police_records ?? '') == 'clean' || empty($client->police_records))
                            <span class="text-xs font-medium text-green-700">✓ Clean</span>
                        @else
                            <span class="text-xs font-medium text-red-700">⚠ Has Records</span>
                        @endif
                    </div>
                    <div class="bg-gray-50 rounded-xl p-2.5">
                        <p class="text-xs text-gray-400 mb-0.5">Added</p>
                        <p class="text-xs font-medium text-gray-700">{{ \Carbon\Carbon::parse($client->created_at)->format('M d, Y') }}</p>
                    </div>
                    <div class="col-span-2 bg-gray-50 rounded-xl p-2.5">
                        <p class="text-xs text-gray-400 mb-0.5">Address</p>
                        <p class="text-sm font-medium text-gray-700">{{ $client->address ?? '—' }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-12 text-center">
                <div class="flex flex-col items-center text-gray-400">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-3">
                        <i class="fas fa-users text-2xl text-gray-300"></i>
                    </div>
                    <p class="font-medium text-gray-500">No clients found</p>
                    <a href="{{ route('loan.create') }}"
                       class="mt-4 inline-flex items-center gap-2 bg-green-600 text-white text-sm px-4 py-2 rounded-xl hover:bg-green-700 transition">
                        <i class="fas fa-plus"></i> Add Client
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Table Footer -->
    @if($clients->count() > 0)
    <div class="px-5 py-3 border-t border-gray-100 bg-gray-50 text-xs text-gray-500 flex items-center justify-between">
        <span>Showing {{ $clients->count() }} client(s)</span>
        <span>Last updated: {{ now()->format('M d, Y H:i') }}</span>
    </div>
    @endif

</div>

<script>
function filterTable() {
    const input = document.getElementById('tableSearch').value.toLowerCase();
    const rows = document.querySelectorAll('#clientTable tbody tr');
    const cards = document.querySelectorAll('.client-card');
    let count = 0;

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        const show = text.includes(input);
        row.style.display = show ? '' : 'none';
        if (show) count++;
    });

    cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        card.style.display = text.includes(input) ? '' : 'none';
    });

    document.getElementById('rowCount').textContent = count + ' result(s)';
}

document.addEventListener('DOMContentLoaded', function () {
    const rows = document.querySelectorAll('#clientTable tbody tr');
    document.getElementById('rowCount').textContent = rows.length + ' client(s)';
});
</script>

@endsection
