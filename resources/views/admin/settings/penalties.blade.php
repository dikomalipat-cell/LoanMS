@extends('layouts.app')
@section('title', 'Penalties')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Penalties</h1>
    <p class="text-gray-500 text-sm mt-1">Configure late payment penalties and fees.</p>
</div>
<div class="space-y-6 max-w-3xl">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-bold text-gray-800 mb-4"><i class="fas fa-exclamation-circle text-red-500 mr-2"></i>Late Payment Penalty</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Penalty Type</label>
                <select class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-green-200"><option>Percentage of Due</option><option>Fixed Amount</option></select>
            </div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Penalty Rate</label><input type="text" value="5%" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-green-400"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Grace Period (days)</label><input type="number" value="3" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-green-400"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Max Penalty Cap</label><input type="text" value="₱5,000" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-green-400"></div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-bold text-gray-800 mb-4"><i class="fas fa-ban text-orange-500 mr-2"></i>Escalation Rules</h3>
        <div class="space-y-3">
            <label class="flex items-center gap-3 text-sm text-gray-700"><input type="checkbox" checked class="rounded text-green-600 focus:ring-green-500"> Send reminder after 1 day overdue</label>
            <label class="flex items-center gap-3 text-sm text-gray-700"><input type="checkbox" checked class="rounded text-green-600 focus:ring-green-500"> Apply penalty after grace period</label>
            <label class="flex items-center gap-3 text-sm text-gray-700"><input type="checkbox" checked class="rounded text-green-600 focus:ring-green-500"> Flag account after 30 days overdue</label>
            <label class="flex items-center gap-3 text-sm text-gray-700"><input type="checkbox" class="rounded text-green-600 focus:ring-green-500"> Suspend borrower after 60 days overdue</label>
        </div>
    </div>
    <button class="bg-green-600 text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-green-700 transition"><i class="fas fa-save mr-1"></i> Save Penalties</button>
</div>
@endsection