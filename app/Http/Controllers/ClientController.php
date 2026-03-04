<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Show all clients
    public function index()
    {
        $clients = Client::all();

        return view('loan.index', compact('clients'));
    }

    // Show form to create a new client
    public function create()
    {
        return view('loan.create'); // Make this Blade file
    }

    // Store new client in database
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:clients,email',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
            'gender' => 'nullable|in:male,female,other',
            'age' => 'nullable|integer|min:18|max:100',
            'current_job' => 'nullable|string|max:255',
            'loan_amount' => 'nullable|numeric',
            'loan_date' => 'nullable|date',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,approved,paid,defaulted',
        ]);

        // Create new client
        Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'age' => $request->age,
            'current_job' => $request->current_job,
            'loan_amount' => $request->loan_amount ?? 0,
            'balance' => $request->loan_amount ?? 0,
            'loan_date' => $request->loan_date,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);

        // Redirect back to clients list with a success message
        return redirect()->route('loan.index')->with('msg', 'Client added successfully!');
    }

    // Show form to edit an existing client
    public function edit(Client $client)
    {
        return view('loan.edit', compact('client'));
    }

    // Update an existing client
    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:clients,email,'.$client->id,
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
            'gender' => 'nullable|in:male,female,other',
            'age' => 'nullable|integer|min:18|max:100',
            'current_job' => 'nullable|string|max:255',
            'loan_amount' => 'nullable|numeric',
            'loan_date' => 'nullable|date',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,approved,paid,defaulted',
        ]);

        $client->update($data);

        return redirect()->route('loan.index')->with('msg', 'Client updated successfully!');
    }

    // Delete a client
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('loan.index')->with('msg', 'Client deleted successfully!');
    }
}
