@extends('layouts.app')
@section('title', 'Interest Rates')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Interest Rates</h1>
    <p class="text-slate-400 text-sm mt-1">Configure interest rate tiers for different loan types.</p>
</div>
<div class="space-y-6 max-w-3xl">
    <div class="bg-primary rounded-xl shadow-sm border border-slate-700">
        <div class="p-4 border-b border-slate-700 flex items-center justify-between">
            <h3 class="font-bold text-white">Rate Configuration</h3>
            <button class="bg-gold text-primary-dark text-white px-4 py-2 rounded-lg text-sm font-medium hover-bg-gold transition"><i class="fas fa-plus mr-1"></i> Add Tier</button>
        </div>
        <div class="divide-y divide-gray-100">
            @php $rates=[['type'=>'Personal Loan','range'=>'₱5,000 - ₱50,000','rate'=>'5.0%','term'=>'3-12 months'],['type'=>'Business Loan','range'=>'₱50,000 - ₱200,000','rate'=>'4.5%','term'=>'6-24 months'],['type'=>'Emergency Loan','range'=>'₱5,000 - ₱25,000','rate'=>'3.0%','term'=>'1-6 months'],['type'=>'Premium Loan','range'=>'₱200,000 - ₱500,000','rate'=>'6.0%','term'=>'12-36 months']]; @endphp
            @foreach($rates as $r)
            <div class="p-5 flex flex-wrap items-center justify-between gap-4 hover:bg-primary-dark transition">
                <div>
                    <h4 class="font-semibold text-white">{{ $r['type'] }}</h4>
                    <p class="text-xs text-slate-400">{{ $r['range'] }} · {{ $r['term'] }}</p>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-2xl font-bold text-gold">{{ $r['rate'] }}</span>
                    <div class="flex gap-1">
                        <button class="text-gray-400 hover:text-blue-600 p-1"><i class="fas fa-edit"></i></button>
                        <button class="text-gray-400 hover:text-red-600 p-1"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection