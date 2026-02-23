<aside id="sidebar" class="fixed top-0 left-0 w-64 h-full z-30 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col"
    style="background: linear-gradient(180deg, #064e3b 0%, #065f46 60%, #047857 100%);">

    <!-- Brand -->
    <div class="flex items-center justify-between px-5 py-5 border-b border-green-700">
        <a href="{{ route('loan.index') }}" class="flex items-center gap-3">
            <div class="w-9 h-9 bg-green-400 bg-opacity-20 rounded-xl flex items-center justify-center">
                <i class="fas fa-coins text-green-300 text-lg"></i>
            </div>
            <span class="text-white font-bold text-lg tracking-wide">LoanMS</span>
        </a>
        <button onclick="closeSidebar()" class="lg:hidden text-green-300 hover:text-white focus:outline-none transition">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">

        <p class="text-green-400 text-xs font-semibold uppercase tracking-widest px-3 mb-2">Main Menu</p>

        <a href="{{ route('loan.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group
                  @if(request()->routeIs('loan.index')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
            <span class="w-8 h-8 flex items-center justify-center rounded-lg
                         @if(request()->routeIs('loan.index')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                <i class="fas fa-address-book text-sm"></i>
            </span>
            <span class="text-sm font-medium">Clients Record</span>
            @if(request()->routeIs('loan.index'))
                <span class="ml-auto w-1.5 h-1.5 bg-green-300 rounded-full"></span>
            @endif
        </a>

        <a href="{{ url('/banks') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white transition-all duration-200 group">
            <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 transition">
                <i class="fas fa-university text-sm"></i>
            </span>
            <span class="text-sm font-medium">Loan Banks</span>
        </a>

        <a href="{{ url('/waykabayad') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white transition-all duration-200 group">
            <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 transition">
                <i class="fas fa-calendar-day text-sm"></i>
            </span>
            <span class="text-sm font-medium">Unpaid Dues</span>
        </a>

        <a href="{{ url('/recent_payments') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white transition-all duration-200 group">
            <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 transition">
                <i class="fas fa-money-bill-wave text-sm"></i>
            </span>
            <span class="text-sm font-medium">Recent Payment</span>
        </a>

        <div class="pt-3 mt-3 border-t border-green-700">
            <p class="text-green-400 text-xs font-semibold uppercase tracking-widest px-3 mb-2">System</p>
            <a href="{{ url('/settings') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white transition-all duration-200 group">
                <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 transition">
                    <i class="fas fa-cogs text-sm"></i>
                </span>
                <span class="text-sm font-medium">Settings</span>
            </a>
        </div>
    </nav>

    <!-- User info at bottom -->
    <div class="px-4 py-4 border-t border-green-700">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-green-400 bg-opacity-30 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-user text-green-200 text-sm"></i>
            </div>
            <div class="min-w-0">
                <p class="text-white text-sm font-medium truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                <p class="text-green-400 text-xs truncate">{{ Auth::user()->email ?? '' }}</p>
            </div>
        </div>
    </div>
</aside>
