@extends('layouts.app')

@section('title', 'Edit Client')

@section('content')

<h1>Edit Client</h1>

<form action="{{ route('loan.update', $client->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-section">
        <h2>Personal Information</h2>

        <div class="form-group">
            <label for="name">Full Name *</label>
            <input type="text" name="name" id="name" value="{{ old('name', $client->name) }}" required>
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $client->email) }}">
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $client->phone) }}">
                @error('phone')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" id="address" rows="2">{{ old('address', $client->address) }}</textarea>
            @error('address')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" id="gender">
                    <option value="">Select</option>
                    <option value="male" {{ old('gender', $client->gender) == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $client->gender) == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender', $client->gender) == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('gender')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" name="age" id="age" value="{{ old('age', $client->age) }}" min="18" max="100">
                @error('age')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="current_job">Job</label>
            <input type="text" name="current_job" id="current_job" value="{{ old('current_job', $client->current_job) }}">
            @error('current_job')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="form-section">
        <h2>Loan Details</h2>

        <div class="form-row">
            <div class="form-group">
                <label for="loan_amount">Loan Amount</label>
                <input type="number" name="loan_amount" id="loan_amount" value="{{ old('loan_amount', $client->loan_amount) }}" step="0.01">
                @error('loan_amount')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="pending" {{ old('status', $client->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ old('status', $client->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="paid" {{ old('status', $client->status) == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="defaulted" {{ old('status', $client->status) == 'defaulted' ? 'selected' : '' }}>Defaulted</option>
                </select>
                @error('status')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="loan_date">Loan Date</label>
                <input type="date" name="loan_date" id="loan_date" value="{{ old('loan_date', $client->loan_date) }}">
                @error('loan_date')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="due_date">Due Date</label>
                <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $client->due_date) }}">
                @error('due_date')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit">Update Client</button>
        <a href="{{ route('loan.index') }}" class="btn-secondary">Cancel</a>
    </div>
</form>

<form id="delete-form" action="{{ route('loan.destroy', $client->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<p class="delete-link">
    <button type="button" onclick="if(confirm('Delete this client?')) { document.getElementById('delete-form').submit(); }">
        Delete Client
    </button>
</p>

@endsection
