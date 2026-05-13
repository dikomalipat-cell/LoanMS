<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Loan Management System')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Outfit', sans-serif; }
        .bg-primary-dark { background-color: #064e3b; } /* Dark Emerald */
        .bg-primary { background-color: #065f46; } /* Medium Emerald */
        .bg-primary-light { background-color: #047857; } /* Emerald */
        .text-gold { color: #f5c518; }
        .bg-gold { background-color: #f5c518; }
        .border-gold { border-color: #f5c518; }
        .hover-bg-gold:hover { background-color: #eab308; }
    </style>
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { background-color: #064e3b; }
        [x-cloak] { display: none !important; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
    </style>
    <!-- Alpine.js Collapse Plugin + Core -->
    <script defer src="https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-primary-dark text-slate-300 antialiased">

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

            <main class="flex-1 p-4 md:p-6 overflow-x-auto">
                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="text-center text-xs text-slate-500 py-4 border-t border-slate-700 bg-primary">
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
