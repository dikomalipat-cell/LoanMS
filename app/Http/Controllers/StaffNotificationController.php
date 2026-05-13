<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class StaffNotificationController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('staff.notifications.index', compact('notifications'));
    }
}
