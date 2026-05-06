<aside id="sidebar"
    class="fixed top-0 left-0 w-64 h-full z-30 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col"
    style="background: linear-gradient(180deg, #064e3b 0%, #065f46 60%, #047857 100%);">

    @php
        $userRole = Auth::user()?->role ?? 'user';
        $isAdmin = $userRole === 'admin';
        $isStaff = $userRole === 'staff';
    @endphp

    <!-- Brand -->
    <div class="flex items-center justify-between px-5 py-5 border-b border-green-700">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <div class="w-9 h-9 bg-green-400 bg-opacity-20 rounded-xl flex items-center justify-center">
                <i class="fas fa-coins text-green-300 text-lg"></i>
            </div>
            <span class="text-white font-bold text-lg tracking-wide">LoanMS</span>
        </a>
        <button onclick="closeSidebar()"
            class="lg:hidden text-green-300 hover:text-white focus:outline-none transition">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">

        @if($isAdmin)
            <div class="flex items-center justify-between px-3 mb-2">
                <p class="text-green-300 text-xs font-semibold uppercase tracking-widest">Main Menu</p>
                <span class="text-[10px] font-bold text-green-200/90 bg-white/10 px-2 py-1 rounded-full">
                    ADMIN
                </span>
            </div>

            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group @if(request()->routeIs('dashboard')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                <span class="w-8 h-8 flex items-center justify-center rounded-lg @if(request()->routeIs('dashboard')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                    <i class="fas fa-home text-sm"></i>
                </span>
                <span class="text-sm font-medium">Dashboard</span>
            </a>

            <!-- User Management -->
            <div class="pt-3 mt-3 border-t border-green-700">
                <p class="text-green-400 text-xs font-semibold uppercase tracking-widest px-3 mb-2">User Management</p>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group @if(request()->routeIs('admin.users.index')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg @if(request()->routeIs('admin.users.index')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                        <i class="fas fa-users text-sm"></i>
                    </span>
                    <span class="text-sm font-medium">All Users</span>
                </a>
                <a href="{{ route('admin.users.roles') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group @if(request()->routeIs('admin.users.roles')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg @if(request()->routeIs('admin.users.roles')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                        <i class="fas fa-user-shield text-sm"></i>
                    </span>
                    <span class="text-sm font-medium">Roles & Permissions</span>
                </a>
            </div>

            <!-- Loan Management -->
            <div class="pt-3 mt-3 border-t border-green-700">
                <p class="text-green-400 text-xs font-semibold uppercase tracking-widest px-3 mb-2">Loan Management</p>
                <a href="{{ route('admin.loans.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group @if(request()->routeIs('admin.loans.index')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg @if(request()->routeIs('admin.loans.index')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                        <i class="fas fa-file-invoice-dollar text-sm"></i>
                    </span>
                    <span class="text-sm font-medium">All Loans</span>
                </a>
                <a href="{{ route('admin.loans.pending') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group @if(request()->routeIs('admin.loans.pending')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg @if(request()->routeIs('admin.loans.pending')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                        <i class="fas fa-clock text-sm"></i>
                    </span>
                    <span class="text-sm font-medium">Pending Applications</span>
                </a>
                <a href="{{ route('admin.loans.approved') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group @if(request()->routeIs('admin.loans.approved')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg @if(request()->routeIs('admin.loans.approved')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                        <i class="fas fa-check-circle text-sm"></i>
                    </span>
                    <span class="text-sm font-medium">Approved Loans</span>
                </a>
                <a href="{{ route('admin.loans.rejected') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group @if(request()->routeIs('admin.loans.rejected')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg @if(request()->routeIs('admin.loans.rejected')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                        <i class="fas fa-times-circle text-sm"></i>
                    </span>
                    <span class="text-sm font-medium">Rejected Loans</span>
                </a>
                <a href="{{ route('admin.loans.overdue') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group @if(request()->routeIs('admin.loans.overdue')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg @if(request()->routeIs('admin.loans.overdue')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                        <i class="fas fa-exclamation-circle text-sm"></i>
                    </span>
                    <span class="text-sm font-medium">Overdue Loans</span>
                </a>
            </div>

            <!-- Reports -->
            <div class="pt-3 mt-3 border-t border-green-700">
                <p class="text-green-400 text-xs font-semibold uppercase tracking-widest px-3 mb-2">Reports</p>
                <a href="{{ route('admin.reports.loans') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group @if(request()->routeIs('admin.reports.loans')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg @if(request()->routeIs('admin.reports.loans')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                        <i class="fas fa-chart-line text-sm"></i>
                    </span>
                    <span class="text-sm font-medium">Loan Reports</span>
                </a>
                <a href="{{ route('admin.reports.payments') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group @if(request()->routeIs('admin.reports.payments')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg @if(request()->routeIs('admin.reports.payments')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                        <i class="fas fa-chart-pie text-sm"></i>
                    </span>
                    <span class="text-sm font-medium">Payment Reports</span>
                </a>
                <a href="{{ route('admin.reports.activity') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group @if(request()->routeIs('admin.reports.activity')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg @if(request()->routeIs('admin.reports.activity')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                        <i class="fas fa-history text-sm"></i>
                    </span>
                    <span class="text-sm font-medium">User Activity Logs</span>
                </a>
            </div>

            <!-- System Settings -->
            <div class="pt-3 mt-3 border-t border-green-700">
                <p class="text-green-400 text-xs font-semibold uppercase tracking-widest px-3 mb-2">System Settings</p>
                <a href="{{ route('admin.settings.policies') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group @if(request()->routeIs('admin.settings.policies')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg @if(request()->routeIs('admin.settings.policies')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                        <i class="fas fa-file-contract text-sm"></i>
                    </span>
                    <span class="text-sm font-medium">Loan Policies</span>
                </a>
                <a href="{{ route('admin.settings.rates') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group @if(request()->routeIs('admin.settings.rates')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg @if(request()->routeIs('admin.settings.rates')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                        <i class="fas fa-percent text-sm"></i>
                    </span>
                    <span class="text-sm font-medium">Interest Rates</span>
                </a>
                <a href="{{ route('admin.settings.penalties') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group @if(request()->routeIs('admin.settings.penalties')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg @if(request()->routeIs('admin.settings.penalties')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                        <i class="fas fa-gavel text-sm"></i>
                    </span>
                    <span class="text-sm font-medium">Penalties</span>
                </a>
                <a href="{{ route('admin.settings.notifications') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group @if(request()->routeIs('admin.settings.notifications')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg @if(request()->routeIs('admin.settings.notifications')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                        <i class="fas fa-cogs text-sm"></i>
                    </span>
                    <span class="text-sm font-medium">Notifications</span>
                </a>
            </div>

            <!-- Profile & Logout -->
            <div class="pt-3 mt-3 border-t border-green-700">
                <a href="{{ route('admin.notifications.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group @if(request()->routeIs('admin.notifications.index')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg @if(request()->routeIs('admin.notifications.index')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                        <i class="fas fa-bell text-sm"></i>
                    </span>
                    <span class="text-sm font-medium">Notifications</span>
                </a>
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group @if(request()->routeIs('profile.edit')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg @if(request()->routeIs('profile.edit')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                        <i class="fas fa-user-circle text-sm"></i>
                    </span>
                    <span class="text-sm font-medium">Profile</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-green-200 hover:bg-red-500 hover:bg-opacity-20 hover:text-red-300 transition-all duration-200 group mt-1">
                        <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-transparent group-hover:bg-red-500 group-hover:bg-opacity-20 transition">
                            <i class="fas fa-sign-out-alt text-sm"></i>
                        </span>
                        <span class="text-sm font-medium">Logout</span>
                    </button>
                </form>
            </div>

        @elseif($isStaff)
            <!-- Staff Menu -->
            <div class="flex items-center justify-between px-3 mb-2">
                <p class="text-green-300 text-xs font-semibold uppercase tracking-widest">Main Menu</p>
                <span class="text-[10px] font-bold text-green-200/90 bg-white/10 px-2 py-1 rounded-full">STAFF</span>
            </div>

            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group
                              @if(request()->routeIs('dashboard')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                <span
                    class="w-8 h-8 flex items-center justify-center rounded-lg
                                     @if(request()->routeIs('dashboard')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                    <i class="fas fa-home text-sm"></i>
                </span>
                <span class="text-sm font-medium">Dashboard</span>
            </a>

            <!-- Loan Applications -->
            <div x-data="{ open: false }" class="space-y-1">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-xl text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white transition-all duration-200 group">
                    <div class="flex items-center gap-3">
                        <span
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 transition">
                            <i class="fas fa-file-alt text-sm"></i>
                        </span>
                        <span class="text-sm font-medium">Loan Applications</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                        :class="{ 'rotate-180': open }"></i>
                </button>
                <div x-show="open" x-collapse class="pl-11 pr-3 space-y-1">
                    <a href="{{ route('staff.applications.pending') }}"
                        class="block py-2 text-sm text-green-200 hover:text-white transition">Pending</a>
                    <a href="{{ route('staff.applications.review') }}"
                        class="block py-2 text-sm text-green-200 hover:text-white transition">Under Review</a>
                    <a href="{{ route('staff.applications.approved') }}"
                        class="block py-2 text-sm text-green-200 hover:text-white transition">Approved</a>
                    <a href="{{ route('staff.applications.rejected') }}"
                        class="block py-2 text-sm text-green-200 hover:text-white transition">Rejected</a>
                </div>
            </div>

            <!-- Borrowers -->
            <div x-data="{ open: false }" class="space-y-1">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-xl text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white transition-all duration-200 group">
                    <div class="flex items-center gap-3">
                        <span
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 transition">
                            <i class="fas fa-folder-open text-sm"></i>
                        </span>
                        <span class="text-sm font-medium">Borrowers</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                        :class="{ 'rotate-180': open }"></i>
                </button>
                <div x-show="open" x-collapse class="pl-11 pr-3 space-y-1">
                    <a href="{{ route('staff.borrowers.all') }}"
                        class="block py-2 text-sm text-green-200 hover:text-white transition">All Borrowers</a>
                    <a href="{{ route('staff.borrowers.verified') }}"
                        class="block py-2 text-sm text-green-200 hover:text-white transition">Verified Accounts</a>
                </div>
            </div>

            <!-- Payments -->
            <div x-data="{ open: false }" class="space-y-1">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-xl text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white transition-all duration-200 group">
                    <div class="flex items-center gap-3">
                        <span
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 transition">
                            <i class="fas fa-credit-card text-sm"></i>
                        </span>
                        <span class="text-sm font-medium">Payments</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                        :class="{ 'rotate-180': open }"></i>
                </button>
                <div x-show="open" x-collapse class="pl-11 pr-3 space-y-1">
                    <a href="{{ route('staff.payments.tracking') }}"
                        class="block py-2 text-sm text-green-200 hover:text-white transition">Payment Tracking</a>
                    <a href="{{ route('staff.payments.history') }}"
                        class="block py-2 text-sm text-green-200 hover:text-white transition">Payment History</a>
                </div>
            </div>

            <!-- Schedule -->
            <div x-data="{ open: false }" class="space-y-1">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-xl text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white transition-all duration-200 group">
                    <div class="flex items-center gap-3">
                        <span
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 transition">
                            <i class="fas fa-calendar-alt text-sm"></i>
                        </span>
                        <span class="text-sm font-medium">Schedule</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                        :class="{ 'rotate-180': open }"></i>
                </button>
                <div x-show="open" x-collapse class="pl-11 pr-3 space-y-1">
                    <a href="{{ route('staff.schedule.due') }}"
                        class="block py-2 text-sm text-green-200 hover:text-white transition">Due Payments</a>
                    <a href="{{ route('staff.schedule.overdue') }}"
                        class="block py-2 text-sm text-green-200 hover:text-white transition">Overdue Accounts</a>
                </div>
            </div>

            <a href="{{ route('staff.notifications') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group
                              @if(request()->routeIs('staff.notifications')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                <span
                    class="w-8 h-8 flex items-center justify-center rounded-lg
                                     @if(request()->routeIs('staff.notifications')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                    <i class="fas fa-bell text-sm"></i>
                </span>
                <span class="text-sm font-medium">Notifications</span>
            </a>

            <div class="pt-3 mt-3 border-t border-green-700">
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group
                                  @if(request()->routeIs('profile.edit')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <span
                        class="w-8 h-8 flex items-center justify-center rounded-lg
                                         @if(request()->routeIs('profile.edit')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                        <i class="fas fa-user-circle text-sm"></i>
                    </span>
                    <span class="text-sm font-medium">Profile</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-green-200 hover:bg-red-500 hover:bg-opacity-20 hover:text-red-300 transition-all duration-200 group mt-1">
                        <span
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-transparent group-hover:bg-red-500 group-hover:bg-opacity-20 transition">
                            <i class="fas fa-sign-out-alt text-sm"></i>
                        </span>
                        <span class="text-sm font-medium">Logout</span>
                    </button>
                </form>
            </div>

        @else
            <!-- User Menu -->
            <div class="flex items-center justify-between px-3 mb-2">
                <p class="text-green-300 text-xs font-semibold uppercase tracking-widest">Main Menu</p>
                <span class="text-[10px] font-bold text-green-200/90 bg-white/10 px-2 py-1 rounded-full">
                    USER
                </span>
            </div>

            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group
                              @if(request()->routeIs('dashboard')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                <span
                    class="w-8 h-8 flex items-center justify-center rounded-lg
                                     @if(request()->routeIs('dashboard')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                    <i class="fas fa-home text-sm"></i>
                </span>
                <span class="text-sm font-medium">Dashboard</span>
            </a>

            <!-- My Loans Section -->
            <div x-data="{ open: false }" class="space-y-1">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-xl text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white transition-all duration-200 group">
                    <div class="flex items-center gap-3">
                        <span
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 transition">
                            <i class="fas fa-wallet text-sm"></i>
                        </span>
                        <span class="text-sm font-medium">My Loans</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                        :class="{ 'rotate-180': open }"></i>
                </button>
                <div x-show="open" x-collapse class="pl-11 pr-3 space-y-1">
                    <a href="{{ route('user.loans.active') }}"
                        class="block py-2 text-sm text-green-200 hover:text-white transition">Active Loan</a>
                    <a href="{{ route('user.loans.history') }}"
                        class="block py-2 text-sm text-green-200 hover:text-white transition">Loan History</a>
                </div>
            </div>

            <a href="{{ route('user.loans.apply') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group
                              @if(request()->routeIs('user.loans.apply')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                <span
                    class="w-8 h-8 flex items-center justify-center rounded-lg
                                     @if(request()->routeIs('user.loans.apply')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                    <i class="fas fa-pen text-sm"></i>
                </span>
                <span class="text-sm font-medium">Apply Loan</span>
            </a>

            <!-- Payments Section -->
            <div x-data="{ open: false }" class="space-y-1">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-xl text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white transition-all duration-200 group">
                    <div class="flex items-center gap-3">
                        <span
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 transition">
                            <i class="fas fa-credit-card text-sm"></i>
                        </span>
                        <span class="text-sm font-medium">Payments</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                        :class="{ 'rotate-180': open }"></i>
                </button>
                <div x-show="open" x-collapse class="pl-11 pr-3 space-y-1">
                    <a href="{{ route('user.payments.make') }}"
                        class="block py-2 text-sm text-green-200 hover:text-white transition">Make Payment</a>
                    <a href="{{ route('user.payments.history') }}"
                        class="block py-2 text-sm text-green-200 hover:text-white transition">Payment History</a>
                </div>
            </div>

            <!-- Documents Section -->
            <div x-data="{ open: false }" class="space-y-1">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-xl text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white transition-all duration-200 group">
                    <div class="flex items-center gap-3">
                        <span
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 transition">
                            <i class="fas fa-file-alt text-sm"></i>
                        </span>
                        <span class="text-sm font-medium">Documents</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                        :class="{ 'rotate-180': open }"></i>
                </button>
                <div x-show="open" x-collapse class="pl-11 pr-3 space-y-1">
                    <a href="{{ route('user.documents.upload') }}"
                        class="block py-2 text-sm text-green-200 hover:text-white transition">Upload Documents</a>
                    <a href="{{ route('user.documents.submitted') }}"
                        class="block py-2 text-sm text-green-200 hover:text-white transition">Submitted Files</a>
                </div>
            </div>

            <a href="{{ route('user.notifications') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group
                              @if(request()->routeIs('user.notifications')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                <span
                    class="w-8 h-8 flex items-center justify-center rounded-lg
                                     @if(request()->routeIs('user.notifications')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                    <i class="fas fa-bell text-sm"></i>
                </span>
                <span class="text-sm font-medium">Notifications</span>
            </a>

            <div class="pt-3 mt-3 border-t border-green-700">
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-200 group
                                  @if(request()->routeIs('profile.edit')) bg-white bg-opacity-15 text-white @else text-green-200 hover:bg-white hover:bg-opacity-10 hover:text-white @endif">
                    <span
                        class="w-8 h-8 flex items-center justify-center rounded-lg
                                         @if(request()->routeIs('profile.edit')) bg-green-400 bg-opacity-30 @else bg-transparent group-hover:bg-green-400 group-hover:bg-opacity-20 @endif transition">
                        <i class="fas fa-user-circle text-sm"></i>
                    </span>
                    <span class="text-sm font-medium">Profile</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-green-200 hover:bg-red-500 hover:bg-opacity-20 hover:text-red-300 transition-all duration-200 group mt-1">
                        <span
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-transparent group-hover:bg-red-500 group-hover:bg-opacity-20 transition">
                            <i class="fas fa-sign-out-alt text-sm"></i>
                        </span>
                        <span class="text-sm font-medium">Logout</span>
                    </button>
                </form>
            </div>
        @endif
    </nav>

    <!-- User info at bottom -->
    <div class="px-4 py-4 border-t border-green-700">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-green-400 bg-opacity-30 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-user text-green-200 text-sm"></i>
            </div>
            <div class="min-w-0">
                <p class="text-white text-sm font-medium truncate">{{ Auth::user()->name ?? 'User' }}</p>
                <p class="text-green-400 text-xs truncate">{{ Auth::user()->email ?? '' }}</p>
            </div>
        </div>
    </div>
</aside>