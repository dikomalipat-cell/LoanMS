@extends('layouts.app')

@section('title', 'Loan Banks')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Loan Banks</h1>
    <p class="text-slate-300 mt-1">Manage and view partner banks.</p>
</div>

<div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-semibold text-white">Bank List</h2>
        <button class="bg-gold text-primary-dark hover-bg-gold text-white px-4 py-2 rounded-lg text-sm font-medium transition flex items-center gap-2">
            <i class="fas fa-plus"></i> Add Bank
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-primary-dark border-b border-slate-700">
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Bank Name</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Account Number</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Balance</th>
                    <th class="p-4 text-xs font-semibold text-slate-400 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-50 hover:bg-primary-dark transition">
                    <td class="p-4 text-sm text-white">BDO Unibank</td>
                    <td class="p-4 text-sm text-slate-300">001234567890</td>
                    <td class="p-4 text-sm font-medium text-gold">₱ 500,000.00</td>
                    <td class="p-4 text-right">
                        <button class="text-blue-500 hover:text-blue-700 mr-2"><i class="fas fa-edit"></i></button>
                        <button class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr class="border-b border-gray-50 hover:bg-primary-dark transition">
                    <td class="p-4 text-sm text-white">BPI</td>
                    <td class="p-4 text-sm text-slate-300">098765432100</td>
                    <td class="p-4 text-sm font-medium text-gold">₱ 250,000.00</td>
                    <td class="p-4 text-right">
                        <button class="text-blue-500 hover:text-blue-700 mr-2"><i class="fas fa-edit"></i></button>
                        <button class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
