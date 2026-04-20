@extends('layouts.app')

@section('title', 'Client List')

@section('content')

<!-- Page Header -->
<div class="mb-6">
    <h1 class="text-xl font-semibold text-gray-800">Client Records</h1>
    <div class="flex gap-2 mt-3">
        <a href="{{ route('loan.create') }}" class="text-sm text-blue-600 hover:underline">Add New Client</a>
        <span class="text-gray-300">|</span>
        <a href="{{ route('dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700">Back</a>
    </div>
</div>

@if(session('msg'))
    <div class="bg-green-50 text-green-700 px-4 py-2 rounded mb-5 text-sm">
        {{ session('msg') }}
    </div>
@endif

<!-- Main Card -->
<div class="border border-gray-200 rounded-lg overflow-hidden">

    <!-- Table Toolbar -->
    <div class="p-3 border-b border-gray-200 flex items-center gap-3">
        <input type="text" id="tableSearch" placeholder="Search..."
            class="flex-1 max-w-xs px-3 py-1.5 text-sm border border-gray-300 rounded focus:outline-none focus:border-gray-400"
            onkeyup="filterTable()">
        <span id="rowCount" class="text-sm text-gray-500"></span>
    </div>

    {{-- Desktop Table --}}
    <div class="hidden md:block overflow-x-auto">
        <table class="min-w-full text-sm" id="clientTable">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">#</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Client</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Contact</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Gender</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Age</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Police</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Job</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Payroll</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Added</th>
                    <th class="px-3 py-2 text-center text-xs font-medium text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($clients as $client)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-2 text-gray-400 text-xs">{{ $client->id }}</td>
                        <td class="px-3 py-2">
                            <p class="font-medium text-gray-800">{{ $client->name }}</p>
                            <p class="text-xs text-gray-400">{{ $client->address ?? 'No address' }}</p>
                        </td>
                        <td class="px-3 py-2 text-gray-600">{{ $client->phone ?? '—' }}</td>
                        <td class="px-3 py-2 text-gray-600">
                            @if($client->gender == 'male') Male
                            @elseif($client->gender == 'female') Female
                            @else Other
                            @endif
                        </td>
                        <td class="px-3 py-2 text-gray-600">{{ $client->age ?? '—' }}</td>
                        <td class="px-3 py-2">
                            @if(strtolower($client->police_records ?? '') == 'clean' || empty($client->police_records))
                                <span class="text-green-600 text-xs">Clean</span>
                            @else
                                <span class="text-red-600 text-xs">Has Records</span>
                            @endif
                        </td>
                        <td class="px-3 py-2 text-gray-600 text-xs">{{ $client->current_job ?? '—' }}</td>
                        <td class="px-3 py-2 text-gray-800">₱{{ number_format($client->payroll ?? 0, 2) }}</td>
                        <td class="px-3 py-2 text-xs text-gray-400">
                            {{ \Carbon\Carbon::parse($client->created_at)->format('M d, Y') }}
                        </td>
                        <td class="px-3 py-2">
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('loan.edit', $client->id) }}"
                                   class="text-gray-500 hover:text-gray-700 text-xs" title="Edit">Edit</a>
                                <form action="{{ route('loan.destroy', $client->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Delete {{ $client->name }}?')"
                                        class="text-gray-500 hover:text-red-600 text-xs">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="px-3 py-12 text-center text-gray-500">
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
            <div class="p-3 hover:bg-gray-50 client-card">
                <div class="flex items-start justify-between mb-2">
                    <div>
                        <h3 class="font-medium text-gray-800">{{ $client->name }}</h3>
                        <p class="text-xs text-gray-400">ID #{{ $client->id }}</p>
                    </div>
                    <div class="flex items-center gap-2 text-xs">
                        <a href="{{ route('loan.edit', $client->id) }}" class="text-gray-500 hover:text-gray-700">Edit</a>
                        <form action="{{ route('loan.destroy', $client->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete?')" class="text-gray-500 hover:text-red-600">Delete</button>
                        </form>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2 text-xs text-gray-600">
                    <div>Phone: {{ $client->phone ?? '—' }}</div>
                    <div>Gender: @if($client->gender == 'male') Male @elseif($client->gender == 'female') Female @else Other @endif</div>
                    <div>Age: {{ $client->age ?? '—' }}</div>
                    <div>Payroll: ₱{{ number_format($client->payroll ?? 0, 2) }}</div>
                    <div>Police: @if(strtolower($client->police_records ?? '') == 'clean' || empty($client->police_records)) <span class="text-green-600">Clean</span> @else <span class="text-red-600">Has Records</span> @endif</div>
                    <div>Added: {{ \Carbon\Carbon::parse($client->created_at)->format('M d, Y') }}</div>
                    <div class="col-span-2">Address: {{ $client->address ?? '—' }}</div>
                </div>
            </div>
        @empty
            <div class="p-8 text-center text-gray-500">
                <p>No clients found</p>
                <a href="{{ route('loan.create') }}" class="text-blue-600 hover:underline text-sm mt-2 inline-block">Add Client</a>
            </div>
        @endforelse
    </div>

    @if($clients->count() > 0)
    <div class="p-2 border-t border-gray-200 bg-gray-50 text-xs text-gray-500">
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
