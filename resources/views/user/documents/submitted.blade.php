@extends('layouts.app')

@section('title', 'Submitted Documents')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Submitted Documents</h1>
    <p class="text-gray-600 mt-1">Manage and view files you have uploaded.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <!-- Document Card -->
        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded bg-red-100 flex items-center justify-center text-red-500">
                        <i class="fas fa-file-pdf text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-800 text-sm">Passport_ID.pdf</h3>
                        <p class="text-xs text-gray-500">1.2 MB • Valid ID</p>
                    </div>
                </div>
                <button class="text-gray-400 hover:text-gray-600"><i class="fas fa-ellipsis-v"></i></button>
            </div>
            <div class="flex items-center justify-between mt-4">
                <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-[10px] font-semibold uppercase tracking-wider">Verified</span>
                <span class="text-xs text-gray-400">Uploaded: Jan 05, 2026</span>
            </div>
        </div>

        <!-- Document Card -->
        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded bg-blue-100 flex items-center justify-center text-blue-500">
                        <i class="fas fa-file-image text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-800 text-sm">Payslip_Dec2025.jpg</h3>
                        <p class="text-xs text-gray-500">840 KB • Proof of Income</p>
                    </div>
                </div>
                <button class="text-gray-400 hover:text-gray-600"><i class="fas fa-ellipsis-v"></i></button>
            </div>
            <div class="flex items-center justify-between mt-4">
                <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-[10px] font-semibold uppercase tracking-wider">Verified</span>
                <span class="text-xs text-gray-400">Uploaded: Jan 05, 2026</span>
            </div>
        </div>

        <!-- Document Card -->
        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded bg-red-100 flex items-center justify-center text-red-500">
                        <i class="fas fa-file-pdf text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-800 text-sm">Meralco_Bill.pdf</h3>
                        <p class="text-xs text-gray-500">2.1 MB • Proof of Billing</p>
                    </div>
                </div>
                <button class="text-gray-400 hover:text-gray-600"><i class="fas fa-ellipsis-v"></i></button>
            </div>
            <div class="flex items-center justify-between mt-4">
                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-[10px] font-semibold uppercase tracking-wider">Pending Review</span>
                <span class="text-xs text-gray-400">Uploaded: May 06, 2026</span>
            </div>
        </div>

    </div>
</div>
@endsection
