<?php

namespace App\Http\Controllers;

class UserPaymentController extends Controller
{
    public function make()
    {
        $client = auth()->user()->client;

        return view('user.payments.make', compact('client'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string',
        ]);

        $client = auth()->user()->client;

        if ($client) {
            $client->balance = max(0, $client->balance - $request->amount);
            $client->save();
        }

        return redirect()->route('dashboard')->with('success', 'Payment submitted successfully and balance updated.');
    }

    public function history()
    {
        $payments = \App\Models\Client::whereRaw('1 = 0')->paginate(10);

        return view('user.payments.history', compact('payments'));
    }
}
