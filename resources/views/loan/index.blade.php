
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   @extends('layouts.app')



@section('content')
<div class="bg-white shadow rounded p-6">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-green-700 text-lg font-bold"><i class="fas fa-users mr-2"></i>Client List</h2>
        <div class="flex space-x-2">
            <a href="{{ route('loan.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700"><i class="fas fa-plus-circle"></i> Add New Client</a>
            <a href="{{ route('dashboard') }}" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
    </div>

    @if(session('msg'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('msg') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead>
                <tr class="bg-green-600 text-white">
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">name</th>
                    <th class="p-2 border">Address</th>
                    <th class="p-2 border">Phone</th>
                    <th class="p-2 border">Gender</th>
                    <th class="p-2 border">Birthdate</th>
                    <th class="p-2 border">Age</th>
                    <th class="p-2 border">Police Records</th>
                    <th class="p-2 border">Current Job</th>
                    <th class="p-2 border">Payroll</th>
                    <th class="p-2 border">Payroll Picture</th>
                    <th class="p-2 border">Created At</th>
                    <th class="p-2 border">Admin</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                    <tr class="hover:bg-gray-100">
                        <td class="p-2 border">{{ $client->id }}</td>
                        <td class="p-2 border font-bold">{{ $client->full_name }}</td>
                        <td class="p-2 border">{{ $client->address }}</td>
                        <td class="p-2 border">{{ $client->phone ?? 'N/A' }}</td>
                        <td class="p-2 border">
                            <span class="px-2 py-1 rounded @if($client->gender == 'male') bg-blue-400 text-white @elseif($client->gender == 'female') bg-yellow-400 text-black @else bg-gray-400 text-white @endif">
                                {{ ucfirst($client->gender ?? 'other') }}
                            </span>
                        </td>
                        <td class="p-2 border">{{ $client->birthdate ?? 'N/A' }}</td>
                        <td class="p-2 border">{{ $client->age ?? 'N/A' }}</td>
                        <td class="p-2 border">
                            @if(strtolower($client->police_records ?? '') == 'clean' || empty($client->police_records))
                                <span class="bg-green-500 text-white px-2 py-1 rounded">Clean</span>
                            @else
                                <span class="bg-red-500 text-white px-2 py-1 rounded">Has Records</span>
                            @endif
                        </td>
                        <td class="p-2 border">{{ $client->current_job ?? 'N/A' }}</td>
                        <td class="p-2 border">₱{{ number_format($client->payroll ?? 0, 2) }}</td>
                        <td class="p-2 border">
                            @if(!empty($client->payroll_picture))
                                <a href="{{ asset($client->payroll_picture) }}" target="_blank" class="text-blue-600 hover:underline">View</a>
                            @else
                                <span class="text-gray-400">No Image</span>
                            @endif
                        </td>
                        <td class="p-2 border">{{ $client->created_at }}</td>
                        <td class="p-2 border">{{ $client->admin->name ?? 'N/A' }}</td>
                        <td class="p-2 border">
                            <a href="{{ route('loan.edit', $client->id) }}" class="text-yellow-500 hover:underline"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('loan.destroy', $client->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this client?')" class="text-red-500 hover:underline"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<footer class="main-footer text-center">
    <strong>© 2025 Loan Management System</strong>
</footer>

</body>
</html>
<style>
 




@endsection