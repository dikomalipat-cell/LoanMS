@extends('layouts.app')

@section('title', 'Loan Banks')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Loan Banks</h1>
            <p class="text-gray-500 text-sm mt-1">Manage supported banks for loan payments</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('loan.index') }}"
               class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-gray-700 text-sm font-medium px-4 py-2.5 rounded-xl border border-gray-200 shadow-sm transition">
                <i class="fas fa-arrow-left text-gray-400"></i> Back to Clients
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <i class="fas fa-university text-gray-400"></i>
                <span>Bank list</span>
            </div>
            <span class="text-xs text-gray-400">Static page (no DB yet)</span>
        </div>

        @php
            $banks = [
                ['name' => 'BDO Unibank', 'code' => 'BDO', 'status' => 'active'],
                ['name' => 'Bank of the Philippine Islands', 'code' => 'BPI', 'status' => 'active'],
                ['name' => 'Metrobank', 'code' => 'MBTC', 'status' => 'active'],
                ['name' => 'Land Bank of the Philippines', 'code' => 'LANDBANK', 'status' => 'active'],
                ['name' => 'Philippine National Bank', 'code' => 'PNB', 'status' => 'active'],
            ];
        @endphp

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Bank</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Code</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($banks as $bank)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
                                         style="background: linear-gradient(135deg, #059669, #047857);">
                                        <i class="fas fa-university text-white text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $bank['name'] }}</p>
                                        <p class="text-xs text-gray-400">Supported payout bank</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                    {{ $bank['code'] }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                @if($bank['status'] === 'active')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                        <i class="fas fa-check-circle text-xs"></i> Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                        <i class="fas fa-minus-circle text-xs"></i> Inactive
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-5 py-4 border-t border-gray-100">
          
        </div>
    </div>
@endsection

