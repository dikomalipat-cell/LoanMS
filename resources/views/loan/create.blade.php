@extends('layouts.app') {{-- assuming your main layout is layouts.app --}}

@section('title', 'Add New Client')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold text-green-700 mb-6"><i class="fas fa-user-plus mr-2"></i>Add New Client</h2>

    <form action="{{ route('loan.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Name --}}
        <div>
            <label for="name" class="block text-gray-700 font-semibold mb-1">Full Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Phone --}}
        <div>
            <label for="phone" class="block text-gray-700 font-semibold mb-1">Phone</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
            @error('phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Address --}}
        <div>
            <label for="address" class="block text-gray-700 font-semibold mb-1">Address</label>
            <textarea name="address" id="address" rows="3"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">{{ old('address') }}</textarea>
            @error('address')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Loan Amount --}}
        <div>
            <label for="loan_amount" class="block text-gray-700 font-semibold mb-1">Loan Amount</label>
            <input type="number" name="loan_amount" id="loan_amount" value="{{ old('loan_amount') }}"
                step="0.01"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
            @error('loan_amount')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Loan Date --}}
        <div>
            <label for="loan_date" class="block text-gray-700 font-semibold mb-1">Loan Date</label>
            <input type="date" name="loan_date" id="loan_date" value="{{ old('loan_date') }}"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
            @error('loan_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Due Date --}}
        <div>
            <label for="due_date" class="block text-gray-700 font-semibold mb-1">Due Date</label>
            <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
            @error('due_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block text-gray-700 font-semibold mb-1">Status</label>
            <select name="status" id="status"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="defaulted" {{ old('status') == 'defaulted' ? 'selected' : '' }}>Defaulted</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Buttons --}}
        <div class="flex justify-between items-center">
            <a href="{{ route('loan.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded-md">
               Cancel
            </a>
            <button type="submit" 
                class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-md flex items-center gap-2">
                <i class="fas fa-save"></i> Save Client
            </button>
        </div>
    </form>
</div>
@endsection