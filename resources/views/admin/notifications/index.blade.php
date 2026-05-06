@extends('layouts.app')
@section('title', 'Notifications')
@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Notifications</h1>
        <p class="text-gray-500 text-sm mt-1">Stay updated with system alerts and activities.</p>
    </div>
    <button class="text-sm text-green-600 hover:text-green-800 font-medium">Mark all as read</button>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-100 divide-y divide-gray-100">
    @php $notifs=[
        ['icon'=>'fa-file-alt','color'=>'blue','title'=>'New Loan Application','desc'=>'Ana Garcia submitted a loan application for ₱25,000.','time'=>'5 min ago','read'=>false],
        ['icon'=>'fa-money-bill','color'=>'green','title'=>'Payment Received','desc'=>'Juan Dela Cruz made a payment of ₱5,000 (PAY-0124).','time'=>'1 hour ago','read'=>false],
        ['icon'=>'fa-exclamation-triangle','color'=>'red','title'=>'Overdue Alert','desc'=>'Pedro Reyes loan LN-003 is now 45 days overdue.','time'=>'2 hours ago','read'=>false],
        ['icon'=>'fa-user-plus','color'=>'purple','title'=>'New User Registration','desc'=>'Roberto Cruz registered a new account.','time'=>'3 hours ago','read'=>true],
        ['icon'=>'fa-check-circle','color'=>'green','title'=>'Loan Approved','desc'=>'Carlo Mendoza loan LN-005 has been approved.','time'=>'Yesterday','read'=>true],
        ['icon'=>'fa-cog','color'=>'gray','title'=>'System Update','desc'=>'Interest rates configuration was updated.','time'=>'2 days ago','read'=>true],
    ]; @endphp
    @foreach($notifs as $n)
    <div class="px-5 py-4 flex items-start gap-4 hover:bg-gray-50 transition {{ !$n['read'] ? 'bg-green-50/50' : '' }}">
        <div class="w-10 h-10 rounded-full bg-{{ $n['color'] }}-100 flex items-center justify-center text-{{ $n['color'] }}-600 flex-shrink-0 mt-0.5"><i class="fas {{ $n['icon'] }}"></i></div>
        <div class="flex-1 min-w-0">
            <div class="flex items-center gap-2">
                <h4 class="text-sm font-semibold text-gray-800">{{ $n['title'] }}</h4>
                @if(!$n['read'])<span class="w-2 h-2 bg-green-500 rounded-full"></span>@endif
            </div>
            <p class="text-sm text-gray-600 mt-0.5">{{ $n['desc'] }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ $n['time'] }}</p>
        </div>
    </div>
    @endforeach
</div>
@endsection