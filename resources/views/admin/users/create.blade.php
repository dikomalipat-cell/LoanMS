@extends('layouts.app')
@section('title', 'Add User')
@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="text-gold hover:text-gold text-sm font-medium"><i
                class="fas fa-arrow-left mr-1"></i> Back to All Users</a>
        <h1 class="text-2xl font-bold text-white mt-2">Add New User</h1>
        <p class="text-slate-400 text-sm mt-1">Create a new user account in the system.</p>
    </div>
    <div class="bg-primary rounded-xl shadow-sm border border-slate-700 max-w-2xl">
        <form class="p-6 space-y-5">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                    <input type="text"
                        class="w-full border border-slate-700 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-gold"
                        placeholder="Enter first name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text"
                        class="w-full border border-slate-700 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-gold"
                        placeholder="Enter last name">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email"
                    class="w-full border border-slate-700 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-gold"
                    placeholder="user@example.com">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                <input type="text"
                    class="w-full border border-slate-700 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-gold"
                    placeholder="09XX-XXX-XXXX">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select
                        class="w-full border border-slate-700 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-gold bg-primary">
                        <option>User</option>
                        <option>Staff</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select
                        class="w-full border border-slate-700 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-gold bg-primary">
                        <option>Active</option>
                        <option>Pending</option>
                        <option>Suspended</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password"
                    class="w-full border border-slate-700 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-gold"
                    placeholder="Minimum 8 characters">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input type="password"
                    class="w-full border border-slate-700 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-gold"
                    placeholder="Re-enter password">
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="bg-gold text-primary-dark text-white px-6 py-2.5 rounded-lg text-sm font-medium hover-bg-gold transition"><i
                        class="fas fa-save mr-1"></i> Create User</button>
                <a href="{{ route('admin.users.index') }}"
                    class="bg-primary-dark text-gray-700 px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-200 transition">Cancel</a>
            </div>
        </form>
    </div>
@endsection