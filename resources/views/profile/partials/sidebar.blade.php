<aside class="sidebar fixed top-0 left-0 w-64 h-full bg-gray-700 text-white shadow-lg overflow-y-auto">
    <div class="brand p-4 text-center border-b border-gray-600">
        <a href="{{ route('loan.index') }}" class="text-white font-bold text-xl">LoanMS</a>
    </div>

    <nav class="mt-4">
        <a href="{{ route('loan.index') }}" class="flex items-center p-3 hover:bg-gray-600 rounded @if(request()->routeIs('loan.index')) bg-gray-600 @endif">
            <i class="fas fa-address-book mr-2"></i> Clients Record
        </a>

        <a href="{{ url('/banks') }}" class="flex items-center p-3 hover:bg-gray-600 rounded">
            <i class="fas fa-university mr-2"></i> Loan Banks
        </a>

        <a href="{{ url('/waykabayad') }}" class="flex items-center p-3 hover:bg-gray-600 rounded">
            <i class="fas fa-calendar-day mr-2"></i> Unpaid Dues
        </a>

        <a href="{{ url('/recent_payments') }}" class="flex items-center p-3 hover:bg-gray-600 rounded">
            <i class="fas fa-money-bill-wave mr-2"></i> Recent Payment
        </a>

        <a href="{{ url('/settings') }}" class="flex items-center p-3 hover:bg-gray-600 rounded">
            <i class="fas fa-cogs mr-2"></i> Settings
        </a>
    </nav>
</aside>