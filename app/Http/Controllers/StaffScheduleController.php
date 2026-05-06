<?php

namespace App\Http\Controllers;

class StaffScheduleController extends Controller
{
    public function due()
    {
        $schedules = \App\Models\Client::whereNotNull('due_date')->where('status', 'approved')->latest()->paginate(10);

        return view('staff.schedule.due', compact('schedules'));
    }

    public function overdue()
    {
        $schedules = \App\Models\Client::where('due_date', '<', now())->where('status', 'approved')->latest()->paginate(10);

        return view('staff.schedule.overdue', compact('schedules'));
    }
}
