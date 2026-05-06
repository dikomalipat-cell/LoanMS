<?php

namespace App\Http\Controllers;

class StaffPaymentController extends Controller
{
    public function tracking()
    {
        // Placeholder for real payments using an empty paginator
        $payments = \App\Models\Client::whereRaw('1 = 0')->paginate(10);

        return view('staff.payments.tracking', compact('payments'));
    }

    public function history()
    {
        $payments = \App\Models\Client::whereRaw('1 = 0')->paginate(10);

        return view('staff.payments.history', compact('payments'));
    }
}
