@extends('layouts.app')
@section('title', 'Roles & Permissions')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Roles & Permissions</h1>
    <p class="text-slate-400 text-sm mt-1">Manage system roles and their access levels.</p>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    @php
        $roles = [
            ['name'=>'Admin','color'=>'purple','icon'=>'fas fa-shield-alt','users'=>2,'perms'=>['Full System Access','Manage Users','Manage Loans','View Reports','System Settings','Manage Roles']],
            ['name'=>'Staff','color'=>'blue','icon'=>'fas fa-user-tie','users'=>8,'perms'=>['Review Applications','Process Payments','View Borrowers','Manage Schedule','View Reports']],
            ['name'=>'User','color'=>'green','icon'=>'fas fa-user','users'=>146,'perms'=>['Apply for Loans','Make Payments','Upload Documents','View Own History','Receive Notifications']],
        ];
    @endphp
    @foreach($roles as $role)
    <div class="bg-primary rounded-xl shadow-sm border border-slate-700 overflow-hidden">
        <div class="bg-{{ $role['color'] }}-50 px-5 py-4 border-b border-{{ $role['color'] }}-100">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-{{ $role['color'] }}-100 flex items-center justify-center text-{{ $role['color'] }}-600"><i class="{{ $role['icon'] }}"></i></div>
                    <div>
                        <h3 class="font-bold text-white">{{ $role['name'] }}</h3>
                        <p class="text-xs text-slate-400">{{ $role['users'] }} users</p>
                    </div>
                </div>
                <button class="text-gray-400 hover:text-{{ $role['color'] }}-600 transition"><i class="fas fa-edit"></i></button>
            </div>
        </div>
        <div class="p-5">
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Permissions</p>
            <ul class="space-y-2">
                @foreach($role['perms'] as $perm)
                <li class="flex items-center gap-2 text-sm text-gray-700">
                    <i class="fas fa-check-circle text-green-500 text-xs"></i> {{ $perm }}
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endforeach
</div>
@endsection