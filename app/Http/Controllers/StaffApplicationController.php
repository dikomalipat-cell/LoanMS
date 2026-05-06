<?php

namespace App\Http\Controllers;

class StaffApplicationController extends Controller
{
    public function pending()
    {
        $applications = \App\Models\Client::where('status', 'pending')->latest()->paginate(10);

        return view('staff.applications.pending', compact('applications'));
    }

    public function review()
    {
        $applications = \App\Models\Client::where('status', 'pending')->latest()->paginate(10);

        return view('staff.applications.review', compact('applications'));
    }

    public function approved()
    {
        $applications = \App\Models\Client::where('status', 'approved')->latest()->paginate(10);

        return view('staff.applications.approved', compact('applications'));
    }

    public function rejected()
    {
        // For now, return empty collection as 'rejected' status doesn't exist in migration yet
        $applications = \App\Models\Client::where('status', 'rejected')->latest()->paginate(10);

        return view('staff.applications.rejected', compact('applications'));
    }
}
