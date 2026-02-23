<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Loan Management System')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { background-color: #f3f4f6; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
    </style>
    <!-- Alpine.js for dropdowns -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100 text-gray-800 antialiased">

    <!-- Mobile sidebar overlay -->
    <div id="sidebar-overlay"
         class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden lg:hidden"
         onclick="closeSidebar()"></div>

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        @include('profile.partials.sidebar')

        {{-- Main content area --}}
        <div class="flex-1 flex flex-col lg:ml-64 min-w-0">

            {{-- Header --}}
            @include('profile.header')

            {{-- Page content --}}
            <main class="flex-1 p-4 md:p-6 overflow-x-auto">
                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="text-center text-xs text-gray-400 py-4 border-t border-gray-200 bg-white">
                © {{ date('Y') }} Loan Management System. All rights reserved.
            </footer>
        </div>
    </div>

    <script>
        function openSidebar() {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.remove('hidden');
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.add('hidden');
        }
    </script>

</body>
</html>
