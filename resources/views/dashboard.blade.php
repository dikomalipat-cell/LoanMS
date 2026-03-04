@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<h1>Welcome, {{ Auth::user()->name }}</h1>

<div class="dashboard-stats">
    <div class="stat-card">
        <h3>Total Clients</h3>
        <p class="stat-number">0</p>
    </div>
    <div class="stat-card">
        <h3>Active Loans</h3>
        <p class="stat-number">0</p>
    </div>
    <div class="stat-card">
        <h3>Overdue</h3>
        <p class="stat-number">0</p>
    </div>
    <div class="stat-card">
        <h3>Collected</h3>
        <p class="stat-number">₱0</p>
    </div>
</div>

<div class="dashboard-actions">
    <a href="{{ route('loan.create') }}" class="btn-primary">Add New Client</a>
    <a href="{{ route('loan.index') }}" class="btn-secondary">View All Clients</a>
</div>

<div class="dashboard-section">
    <h2>Quick Tips</h2>
    <ul>
        <li>Create your first client record</li>
        <li>Track loan status and due dates</li>
        <li>Review unpaid dues to avoid delinquencies</li>
    </ul>
</div>

@endsection
