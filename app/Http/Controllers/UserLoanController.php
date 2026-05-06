<?php

namespace App\Http\Controllers;

class UserLoanController extends Controller
{
    public function active()
    {
        $client = auth()->user()->client;

        return view('user.loans.active', compact('client'));
    }

    public function history()
    {
        $loans = \App\Models\Client::where('user_id', auth()->id())->paginate(10);

        return view('user.loans.history', compact('loans'));
    }
}
