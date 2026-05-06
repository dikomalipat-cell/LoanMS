<?php

namespace App\Http\Controllers;

class ApplyLoanController extends Controller
{
    public function index()
    {
        return view('user.loans.apply');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'loan_amount' => 'required|numeric|min:1',
            'loan_term' => 'required|integer',
        ]);

        $user = auth()->user();

        // Find or create client for the user
        $client = \App\Models\Client::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $user->name,
                'email' => $user->email,
                'loan_amount' => $request->loan_amount,
                'balance' => $request->loan_amount,
                'loan_date' => now(),
                'due_date' => now()->addMonths((int) $request->loan_term),
                'status' => 'pending',
            ]
        );

        return redirect()->route('dashboard')->with('success', 'Loan application submitted successfully.');
    }
}
