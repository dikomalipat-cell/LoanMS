<!-- DASHBOARD HEADER -->
<header
    class="bg-primary border-b border-slate-800 px-4 md:px-6 py-3 flex items-center justify-between sticky top-0 z-10 shadow-sm">

    <!-- Left: Hamburger + Page Title -->
    <div class="flex items-center gap-3">
        <!-- Hamburger - mobile only -->
        <button onclick="openSidebar()"
            class="lg:hidden w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 hover:bg-white/20 text-slate-300 transition focus:outline-none">
            <i class="fas fa-bars text-sm"></i>
        </button>

        <!-- Breadcrumb / Title -->
        <div class="hidden sm:flex items-center gap-2 text-sm text-slate-400">
            <i class="fas fa-home text-gray-400"></i>
            <span class="text-gray-300">/</span>
            <span class="text-slate-200 font-medium">Dashboard</span>
            <span class="text-gray-300">·</span>
            <span
                class="text-xs font-semibold text-slate-400 capitalize">{{ Auth::user()->role }}</span>
        </div>
    </div>

    <!-- Right: Search + Actions -->
    <div class="flex items-center gap-2 md:gap-3">

        @if(in_array(Auth::user()->role, ['admin', 'staff']))
        <!-- Search bar - hidden on small screens -->
        <div class="relative hidden md:flex items-center">
            <i class="fas fa-search absolute left-3 text-gray-400 text-sm"></i>
            <input type="text" placeholder="Search borrowers..."
                class="pl-9 pr-4 py-2 text-sm bg-white/5 border border-slate-700 text-white rounded-xl focus:outline-none focus:bg-white/10 focus:border-gold focus:ring-2 focus:ring-gold/20 transition w-48 lg:w-64 placeholder-slate-500">
        </div>
        @endif

        <!-- Notification bell -->
        <button
            class="relative w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 hover:bg-white/20 text-slate-300 transition focus:outline-none">
            <i class="fas fa-bell text-sm"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full border-2 border-primary"></span>
        </button>

        <!-- User dropdown -->
        <div class="relative" x-data="{ open: false }" @click.away="open = false">
            <button @click="open = !open"
                class="flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-xl hover:bg-white/10 transition focus:outline-none">
                <div
                    class="w-8 h-8 rounded-full bg-gold flex items-center justify-center flex-shrink-0">
                    <span class="text-primary-dark text-xs font-bold">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </span>
                </div>
                <div class="hidden sm:block text-left">
                    <p class="text-sm font-semibold text-slate-200 leading-tight">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-slate-400 leading-tight">
                        @php
                            $role = Auth::user()->role;
                        @endphp
                        @if($role === 'admin')
                            Administrator
                        @elseif($role === 'staff')
                            Loan Officer
                        @else
                            Borrower
                        @endif
                    </p>
                </div>
                <i class="fas fa-chevron-down text-xs text-gray-400 hidden sm:block ml-1"></i>
            </button>

            <!-- Dropdown menu -->
            <div x-show="open" x-transition
                class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-50">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-200 hover:bg-gray-50 transition">
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