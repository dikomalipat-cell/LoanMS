<?php

namespace App\Http\Controllers;

class AdminNotificationController extends Controller
{
    public function index()
    {
        return view('admin.notifications.index');
    }
}
