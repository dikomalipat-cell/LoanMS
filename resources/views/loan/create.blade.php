@extends('layouts.app')

@section('title', 'Add New Client')

@section('content')

<!-- Page Header -->
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('loan.index') }}"
       class="w-9 h-9 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-500 hover:bg-gray-50 transition shadow-sm">
        <i class="fas fa-arrow-left text-sm"></i>
    </a>
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Add New Client</h1>
        <p class="text-gray-500 text-sm mt-0.5">Fill in the details to register a new borrower</p>
    </div>
</div>

<form action="{{ route('loan.store') }}" method="POST">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        <!-- Left Column: Personal Info -->
        <div class="lg:col-span-2 space-y-5">

            <!-- Personal Information Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 md:p-6">
                <h2 class="text-base font-semibold text-gray-800 mb-5 flex items-center gap-2">
                    <span class="w-7 h-7 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user text-green-600 text-xs"></i>
                    </span>
                    Personal Information
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <!-- Full Name -->
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            placeholder="e.g. Juan Dela Cruz"
                            class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:border-green-400 focus:ring-2 focus:ring-green-100 focus:bg-white transition"
                            required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            placeholder="juan@example.com"
                            class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:border-green-400 focus:ring-2 focus:ring-green-100 focus:bg-white transition">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1.5">Phone Number</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                            placeholder="09XX XXX XXXX"
                            class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:border-green-400 focus:ring-2 focus:ring-green-100 focus:bg-white transition">
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="sm:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1.5">Address</label>
                        <textarea name="address" id="address" rows="3"
                            placeholder="Street, Barangay, City, Province"
                            class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:border-green-400 focus:ring-2 focus:ring-green-100 focus:bg-white transition resize-none">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Loan Details Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 md:p-6">
                <h2 class="text-base font-semibold text-gray-800 mb-5 flex items-center gap-2">
                    <span class="w-7 h-7 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-hand-holding-usd text-blue-600 text-xs"></i>
                    </span>
                    Loan Details
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <!-- Loan Amount -->
                    <div>
                        <label for="loan_amount" class="block text-sm font-medium text-gray-700 mb-1.5">Loan Amount (₱)</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-medium">₱</span>
                            <input type="number" name="loan_amount" id="loan_amount" value="{{ old('loan_amount') }}"
                                step="0.01" placeholder="0.00"
                                class="w-full pl-7 pr-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:border-green-400 focus:ring-2 focus:ring-green-100 focus:bg-white transition">
                        </div>
                        @error('loan_amount')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1.5">Loan Status</label>
                        <select name="status" id="status"
                            class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:border-green-400 focus:ring-2 focus:ring-green-100 focus:bg-white transition">
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                            <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>✅ Approved</option>
                            <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>💰 Paid</option>
                            <option value="defaulted" {{ old('status') == 'defaulted' ? 'selected' : '' }}>⚠️ Defaulted</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Loan Date -->
                    <div>
                        <label for="loan_date" class="block text-sm font-medium text-gray-700 mb-1.5">Loan Date</label>
                        <input type="date" name="loan_date" id="loan_date" value="{{ old('loan_date') }}"
                            class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:border-green-400 focus:ring-2 focus:ring-green-100 focus:bg-white transition">
                        @error('loan_date')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Due Date -->
                    <div>
                        <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1.5">Due Date</label>
                        <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}"
                            class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:border-green-400 focus:ring-2 focus:ring-green-100 focus:bg-white transition">
                        @error('due_date')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>
            </div>

        </div>

        <!-- Right Column: Summary / Actions -->
        <div class="space-y-5">

            <!-- Action Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <h2 class="text-base font-semibold text-gray-800 mb-4">Save Client</h2>
                <p class="text-sm text-gray-500 mb-5">Review the information before saving. Fields marked with <span class="text-red-500">*</span> are required.</p>

                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-xl transition shadow-sm text-sm">
                    <i class="fas fa-save"></i> Save Client
                </button>

                <a href="{{ route('loan.index') }}"
                   class="mt-3 w-full flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 rounded-xl transition text-sm">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>

            <!-- Tips Card -->
            <div class="bg-green-50 border border-green-100 rounded-2xl p-5">
                <h3 class="text-sm font-semibold text-green-800 mb-3 flex items-center gap-2">
                    <i class="fas fa-lightbulb text-green-500"></i> Tips
                </h3>
                <ul class="space-y-2 text-xs text-green-700">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check-circle mt-0.5 flex-shrink-0"></i>
                        Ensure the client's full name matches their valid ID.
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check-circle mt-0.5 flex-shrink-0"></i>
                        Double-check the loan amount and due date before saving.
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check-circle mt-0.5 flex-shrink-0"></i>
                        Police records status affects loan approval eligibility.
                    </li>
                </ul>
            </div>

        </div>

    </div>
</form>

@endsection
