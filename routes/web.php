<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\userController;

Route::get('/', function () {
    return view('login');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');

    Route::post('/Client', [ClientController::class, 'store'])->name('loan.store');
    Route::get('/Client', [ClientController::class, 'index'])->name('loan.index');
    Route::get('/Client/create', [ClientController::class, 'create'])->name('loan.create');
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
