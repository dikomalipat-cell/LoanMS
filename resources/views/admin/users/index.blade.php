@extends('layouts.app')
@section('title', 'All Users')
@section('content')
    <div x-data="{ 
        showAddUserModal: {{ $errors->any() && !session('edit_id') ? 'true' : 'false' }},
        showEditUserModal: {{ session('edit_id') ? 'true' : 'false' }},
        editUser: {
            id: '{{ session('edit_id') }}',
            name: '{{ old('name') }}',
            email: '{{ old('email') }}',
            role: '{{ old('role') }}'
        },
        openEditModal(user) {
            this.editUser = user;
            this.showEditUserModal = true;
        }
    }">
        @if (session('success'))
            <div class="mb-4 p-4 bg-gold/20 border border-green-200 text-gold rounded-xl flex items-center gap-3">
                <i class="fas fa-check-circle"></i>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-white">All Users</h1>
            <p class="text-slate-400 text-sm mt-1">Manage all registered users in the system.</p>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-primary rounded-xl p-4 border border-slate-700 shadow-sm flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <p class="text-xs text-slate-400">Total Users</p>
                    <p class="text-xl font-bold text-white">{{ $stats['total'] }}</p>
                </div>
            </div>
            <div class="bg-primary rounded-xl p-4 border border-slate-700 shadow-sm flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div>
                    <p class="text-xs text-slate-400">Admins</p>
                    <p class="text-xl font-bold text-white">{{ $stats['admins'] }}</p>
                </div>
            </div>
            <div class="bg-primary rounded-xl p-4 border border-slate-700 shadow-sm flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div>
                    <p class="text-xs text-slate-400">Staff</p>
                    <p class="text-xl font-bold text-white">{{ $stats['staff'] }}</p>
                </div>
            </div>
            <div class="bg-primary rounded-xl p-4 border border-slate-700 shadow-sm flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gold/20 flex items-center justify-center text-gold">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <p class="text-xs text-slate-400">Regular Users</p>
                    <p class="text-xl font-bold text-white">{{ $stats['users'] }}</p>
                </div>
            </div>
        </div>

        <!-- Filters & Table -->
        <div class="bg-primary rounded-xl shadow-sm border border-slate-700">
            <div class="p-4 border-b border-slate-700 flex flex-wrap items-center justify-between gap-3">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" placeholder="Search users..."
                        class="pl-9 pr-4 py-2 text-sm bg-primary-dark border border-slate-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-gold w-64">
                </div>
                <div class="flex items-center gap-2">
                    <select
                        class="text-sm border border-slate-700 rounded-lg px-3 py-2 bg-primary-dark focus:outline-none focus:ring-2 focus:ring-green-200">
                        <option>All Roles</option>
                      
                        <option>Staff</option>
                        <option>User</option>
                    </select>
                    <select
                        class="text-sm border border-slate-700 rounded-lg px-3 py-2 bg-primary-dark focus:outline-none focus:ring-2 focus:ring-green-200">
                        <option>All Status</option>
                        <option>Active</option>
                        <option>Pending</option>
                        <option>Suspended</option>
                    </select>
                    <button @click="showAddUserModal = true" type="button"
                        class="bg-gold text-primary-dark text-white px-4 py-2 rounded-lg text-sm font-medium hover-bg-gold transition"><i
                            class="fas fa-plus mr-1"></i> Add User</button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-primary-dark text-slate-300 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-4 py-3 text-left">User</th>
                            <th class="px-4 py-3 text-left">Email</th>
                            <th class="px-4 py-3 text-left">Role</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Joined</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($users as $user)
                            <tr class="hover:bg-primary-dark transition">
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-gold/20 flex items-center justify-center text-gold font-bold text-xs">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                        <span class="font-medium text-white">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-slate-300">{{ $user->email }}</td>
                                <td class="px-4 py-3"><span
                                        class="px-2 py-1 rounded-full text-xs font-semibold {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : ($user->role === 'staff' ? 'bg-blue-100 text-blue-700' : 'bg-primary-dark text-gray-700') }}">{{ ucfirst($user->role ?? 'User') }}</span>
                                </td>
                                <td class="px-4 py-3"><span
                                        class="px-2 py-1 rounded-full text-xs font-semibold bg-gold/20 text-gold">Active</span>
                                </td>
                                <td class="px-4 py-3 text-slate-400">{{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}</td>
                                <td class="px-4 py-3 text-center">
                                    <button @click="openEditModal({ id: '{{ $user->id }}', name: '{{ $user->name }}', email: '{{ $user->email }}', role: '{{ $user->role }}' })" 
                                            class="text-gray-400 hover:text-blue-600 mx-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-600 mx-1" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-slate-400">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-slate-700">
                {{ $users->links() }}
            </div>
        </div>

        <!-- Add User Modal -->
        <div x-show="showAddUserModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showAddUserModal" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" class="fixed inset-0 bg-primary-dark0 bg-opacity-75 transition-opacity"
                    aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="showAddUserModal" @click.away="showAddUserModal = false"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block align-bottom bg-primary rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        <div class="bg-primary px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                        Add New User
                                    </h3>
                                    <div class="mt-4 space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Name</label>
                                            <input type="text" name="name" value="{{ old('name') }}" required
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Email</label>
                                            <input type="email" name="email" value="{{ old('email') }}" required
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Role</label>
                                            <select name="role"
                                                class="mt-1 block w-full bg-primary border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                                <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                                               
                                            @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Password</label>
                                            <input type="password" name="password" required
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-primary-dark px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-gold text-primary-dark text-base font-medium text-white hover-bg-gold focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Save User
                            </button>
                            <button type="button" @click="showAddUserModal = false"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-primary text-base font-medium text-gray-700 hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Edit User Modal -->
        <div x-show="showEditUserModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showEditUserModal" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" class="fixed inset-0 bg-primary-dark0 bg-opacity-75 transition-opacity"
                    aria-hidden="true" @click="showEditUserModal = false"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="showEditUserModal" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block align-bottom bg-primary rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form :action="'{{ url('admin/users') }}/' + editUser.id" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="bg-primary px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-xl font-bold text-white" id="modal-title">Edit User</h3>
                                <button type="button" @click="showEditUserModal = false"
                                    class="text-gray-400 hover:text-slate-300"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                    <input type="text" name="name" x-model="editUser.name" required
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                    <input type="email" name="email" x-model="editUser.email" required
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                                    <select name="role" x-model="editUser.role" required
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                        <option value="user">User</option>
                                        <option value="staff">Staff</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">New Password (optional)</label>
                                    <input type="password" name="password"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                    <p class="text-[10px] text-gray-400 mt-1 italic">Leave blank to keep current password</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-primary-dark px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-3">
                            <button type="submit"
                                class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-gold text-primary-dark text-base font-medium text-white hover-bg-gold focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm transition">Update
                                User</button>
                            <button type="button" @click="showEditUserModal = false"
                                class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-primary text-base font-medium text-gray-700 hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection