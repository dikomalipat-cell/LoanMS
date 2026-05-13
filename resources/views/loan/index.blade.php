@extends('layouts.app')

@section('title', 'Client List')

@section('content')

<!-- Page Header -->
<div class="mb-6">
    <h1 class="text-xl font-semibold text-white">Client Records</h1>
    <div class="flex gap-2 mt-3">
        <a href="{{ route('loan.create') }}" class="text-sm text-blue-600 hover:underline">Add New Client</a>
        <span class="text-gray-300">|</span>
        <a href="{{ route('dashboard') }}" class="text-sm text-slate-400 hover:text-gray-700">Back</a>
    </div>
</div>

@if(session('msg'))
    <div class="bg-primary-light text-gold px-4 py-2 rounded mb-5 text-sm">
        {{ session('msg') }}
    </div>
@endif

<!-- Main Card -->
<div class="border border-slate-700 rounded-lg overflow-hidden">

    <!-- Table Toolbar -->
    <div class="p-3 border-b border-slate-700 flex items-center gap-3">
        <input type="text" id="tableSearch" placeholder="Search..."
            class="flex-1 max-w-xs px-3 py-1.5 text-sm border border-gray-300 rounded focus:outline-none focus:border-gray-400"
            onkeyup="filterTable()">
        <span id="rowCount" class="text-sm text-slate-400"></span>
    </div>

    {{-- Desktop Table --}}
    <div class="hidden md:block overflow-x-auto">
        <table class="min-w-full text-sm" id="clientTable">
            <thead>
                <tr class="bg-primary-dark border-b border-slate-700">
                    <th class="px-3 py-2 text-left text-xs font-medium text-slate-400">#</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-slate-400">Client</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-slate-400">Contact</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-slate-400">Gender</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-slate-400">Age</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-slate-400">Police</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-slate-400">Job</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-slate-400">Payroll</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-slate-400">Added</th>
                    <th class="px-3 py-2 text-center text-xs font-medium text-slate-400">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($clients as $client)
                    <tr class="hover:bg-primary-dark">
                        <td class="px-3 py-2 text-gray-400 text-xs">{{ $client->id }}</td>
                        <td class="px-3 py-2">
                            <p class="font-medium text-white">{{ $client->name }}</p>
                            <p class="text-xs text-gray-400">{{ $client->address ?? 'No address' }}</p>
                        </td>
                        <td class="px-3 py-2 text-slate-300">{{ $client->phone ?? '—' }}</td>
                        <td class="px-3 py-2 text-slate-300">
                            @if($client->gender == 'male') Male
                            @elseif($client->gender == 'female') Female
                            @else Other
                            @endif
                        </td>
                        <td class="px-3 py-2 text-slate-300">{{ $client->age ?? '—' }}</td>
                        <td class="px-3 py-2">
                            @if(strtolower($client->police_records ?? '') == 'clean' || empty($client->police_records))
                                <span class="text-gold text-xs">Clean</span>
                            @else
                                <span class="text-red-600 text-xs">Has Records</span>
                            @endif
                        </td>
                        <td class="px-3 py-2 text-slate-300 text-xs">{{ $client->current_job ?? '—' }}</td>
                        <td class="px-3 py-2 text-white">₱{{ number_format($client->payroll ?? 0, 2) }}</td>
                        <td class="px-3 py-2 text-xs text-gray-400">
                            {{ \Carbon\Carbon::parse($client->created_at)->format('M d, Y') }}
                        </td>
                        <td class="px-3 py-2">
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('loan.edit', $client->id) }}"
                                   class="text-slate-400 hover:text-gray-700 text-xs" title="Edit">Edit</a>
                                <form action="{{ route('loan.destroy', $client->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Delete {{ $client->name }}?')"
                                        class="text-slate-400 hover:text-red-600 text-xs">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="px-3 py-12 text-center text-slate-400">
                            <p>No clients found</p>
                            <a href="{{ route('loan.create') }}" class="text-blue-600 hover:underline text-sm mt-2 inline-block">Add Client</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Mobile Card View --}}
    <div class="md:hidden divide-y divide-gray-100" id="mobileCards">
        @forelse($clients as $client)
            <div class="p-3 hover:bg-primary-dark client-card">
                <div class="flex items-start justify-between mb-2">
                    <div>
                        <h3 class="font-medium text-white">{{ $client->name }}</h3>
                        <p class="text-xs text-gray-400">ID #{{ $client->id }}</p>
                    </div>
                    <div class="flex items-center gap-2 text-xs">
                        <a href="{{ route('loan.edit', $client->id) }}" class="text-slate-400 hover:text-gray-700">Edit</a>
                        <form action="{{ route('loan.destroy', $client->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete?')" class="text-slate-400 hover:text-red-600">Delete</button>
                        </form>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2 text-xs text-slate-300">
                    <div>Phone: {{ $client->phone ?? '—' }}</div>
                    <div>Gender: @if($client->gender == 'male') Male @elseif($client->gender == 'female') Female @else Other @endif</div>
                    <div>Age: {{ $client->age ?? '—' }}</div>
                    <div>Payroll: ₱{{ number_format($client->payroll ?? 0, 2) }}</div>
                    <div>Police: @if(strtolower($client->police_records ?? '') == 'clean' || empty($client->police_records)) <span class="text-gold">Clean</span> @else <span class="text-red-600">Has Records</span> @endif</div>
                    <div>Added: {{ \Carbon\Carbon::parse($client->created_at)->format('M d, Y') }}</div>
                    <div class="col-span-2">Address: {{ $client->address ?? '—' }}</div>
                </div>
            </div>
        @empty
            <div class="p-8 text-center text-slate-400">
                <p>No clients found</p>
                <a href="{{ route('loan.create') }}" class="text-blue-600 hover:underline text-sm mt-2 inline-block">Add Client</a>
            </div>
        @endforelse
    </div>

    @if($clients->count() > 0)
    <div class="p-2 border-t border-slate-700 bg-primary-dark text-xs text-slate-400">
        Showing {{ $clients->count() }} client(s)
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
