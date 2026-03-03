<!-- DASHBOARD HEADER -->
<header class="bg-white border-b border-gray-200 px-4 md:px-6 py-3 flex items-center justify-between sticky top-0 z-10 shadow-sm">

    <!-- Left: Hamburger + Page Title -->
    <div class="flex items-center gap-3">
        <!-- Hamburger - mobile only -->
        <button onclick="openSidebar()"
            class="lg:hidden w-9 h-9 flex items-center justify-center rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-600 transition focus:outline-none">
            <i class="fas fa-bars text-sm"></i>
        </button>

        <!-- Breadcrumb / Title -->
        <div class="hidden sm:flex items-center gap-2 text-sm text-gray-500">
            <i class="fas fa-home text-gray-400"></i>
            <span class="text-gray-300">/</span>
            <span class="text-gray-700 font-medium">Dashboard</span>
            <span class="text-gray-300">·</span>
            <span class="text-xs font-semibold text-gray-500">{{ (bool) (Auth::user()?->is_admin ?? false) ? 'Admin' : 'User' }}</span>
        </div>
    </div>

    <!-- Right: Search + Actions -->
    <div class="flex items-center gap-2 md:gap-3">

        <!-- Search bar - hidden on small screens -->
        <div class="relative hidden md:flex items-center">
            <i class="fas fa-search absolute left-3 text-gray-400 text-sm"></i>
            <input
                type="text"
                placeholder="Search clients..."
                class="pl-9 pr-4 py-2 text-sm bg-gray-100 border border-transparent rounded-xl focus:outline-none focus:bg-white focus:border-green-400 focus:ring-2 focus:ring-green-100 transition w-48 lg:w-64"
            >
        </div>

        <!-- Notification bell -->
        <button class="relative w-9 h-9 flex items-center justify-center rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-600 transition focus:outline-none">
            <i class="fas fa-bell text-sm"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
        </button>

        <!-- User dropdown -->
        <div class="relative" x-data="{ open: false }" @click.away="open = false">
            <button @click="open = !open"
                class="flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-xl hover:bg-gray-100 transition focus:outline-none">
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center flex-shrink-0">
                    <span class="text-white text-xs font-bold">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </span>
                </div>
                <div class="hidden sm:block text-left">
                    <p class="text-sm font-semibold text-gray-800 leading-tight">{{ Auth::user()->name ?? 'User' }}</p>
                    <p class="text-xs text-gray-500 leading-tight">{{ (bool) (Auth::user()?->is_admin ?? false) ? 'Administrator' : 'Staff User' }}</p>
                </div>
                <i class="fas fa-chevron-down text-xs text-gray-400 hidden sm:block ml-1"></i>
            </button>

            <!-- Dropdown menu -->
            <div x-show="open" x-transition
                class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-50">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                    <i class="fas fa-home w-4 text-gray-400"></i> Dashboard
                </a>
                <div class="border-t border-gray-100 my-1"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition">
                        <i class="fas fa-sign-out-alt w-4"></i> Sign Out
                    </button>
                </form>
            </div>
        </div>

    </div>
</header>

<script>
    // Simple dropdown without Alpine if not available
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof Alpine === 'undefined') {
            const btn = document.querySelector('[\\@click="open = !open"]');
            const menu = document.querySelector('[x-show="open"]');
            if (btn && menu) {
                menu.style.display = 'none';
                btn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
                });
                document.addEventListener('click', function () {
                    menu.style.display = 'none';
                });
            }
        }
    });
</script>
