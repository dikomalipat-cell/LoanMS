<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Client CRUD routes
Route::middleware('auth')->group(function () {
    Route::get('/banks', function () {
        return view('banks.index');
    })->name('banks.index');

    Route::post('/Client', [ClientController::class, 'store'])->name('loan.store');
    Route::get('/Client', [ClientController::class, 'index'])->name('loan.index');
    Route::get('/Client/create', [ClientController::class, 'create'])->name('loan.create');
    Route::post('/Client', [ClientController::class, 'store'])->name('loan.store');
    Route::get('/Client/{client}/edit', [ClientController::class, 'edit'])->name('loan.edit');
    Route::put('/Client/{client}', [ClientController::class, 'update'])->name('loan.update');
    Route::delete('/Client/{client}', [ClientController::class, 'destroy'])->name('loan.destroy');
});
// Logout route
Route::post('/logout', function () {
    Auth::logout();

    return redirect('/');
})->name('logout');

require __DIR__.'/auth.php';
