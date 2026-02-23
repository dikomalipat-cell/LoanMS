<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Loan Management System</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100">

    {{-- HEADER --}}
    @include('layouts.header')

    {{-- MAIN CONTENT --}}
    <main class="p-6">

        <h1 class="text-2xl font-semibold mb-6">
            Welcome, {{ Auth::user()->name }} 👋
        </h1>

        {{-- STATS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <div class="bg-white rounded shadow p-5 flex justify-between items-center">
                <div>
                    <p class="text-gray-500">Total Clients</p>
                    <h2 class="text-2xl font-bold">150</h2>
                </div>
                <i class="fas fa-users text-3xl text-green-600"></i>
            </div>

            <div class="bg-white rounded shadow p-5 flex justify-between items-center">
                <div>
                    <p class="text-gray-500">Active Loans</p>
                    <h2 class="text-2xl font-bold">75</h2>
                </div>
                <i class="fas fa-hand-holding-usd text-3xl text-green-600"></i>
            </div>

            <div class="bg-white rounded shadow p-5 flex justify-between items-center">
                <div>
                    <p class="text-gray-500">Overdue</p>
                    <h2 class="text-2xl font-bold text-red-600">12</h2>
                </div>
                <i class="fas fa-exclamation-triangle text-3xl text-red-500"></i>
            </div>

        </div>

        {{-- QUICK ACTIONS --}}
        <div class="bg-white rounded shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Quick Actions</h2>

            <div class="flex flex-wrap gap-4">
                <a href="{{ route('loan.create') }}"
                   class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700 transition">
                    + Add Client
                </a>

                <a href="{{ route('loan.index') }}"
                   class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                    View Clients
                </a>
            </div>
        </div>

    </main>

</body>
</html>