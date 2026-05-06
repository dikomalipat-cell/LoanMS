<?php

namespace App\Http\Controllers;

class StaffBorrowerController extends Controller
{
    public function all()
    {
        $borrowers = \App\Models\Client::latest()->paginate(10);

        return view('staff.borrowers.all', compact('borrowers'));
    }

    public function verified()
    {
        $borrowers = \App\Models\Client::where('status', 'approved')->latest()->paginate(10);

        return view('staff.borrowers.verified', compact('borrowers'));
    }
}
