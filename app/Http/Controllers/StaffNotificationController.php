<?php

namespace App\Http\Controllers;

class StaffNotificationController extends Controller
{
    public function index()
    {
        return view('staff.notifications.index');
    }
}
