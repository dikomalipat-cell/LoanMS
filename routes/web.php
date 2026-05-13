<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ApplyLoanController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StaffApplicationController;
use App\Http\Controllers\StaffBorrowerController;
use App\Http\Controllers\StaffNotificationController;
use App\Http\Controllers\StaffPaymentController;
use App\Http\Controllers\StaffScheduleController;
use App\Http\Controllers\UnpaidDuesController;
use App\Http\Controllers\UserDocumentController;
use App\Http\Controllers\UserLoanController;
use App\Http\Controllers\UserPaymentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/user/login', [ProfileController::class, 'login'])->name('profile.login');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/Client', [ClientController::class, 'store'])->name('loan.store');
    Route::get('/Client', [ClientController::class, 'index'])->name('loan.index');
    Route::get('/Client/create', [ClientController::class, 'create'])->name('loan.create');
    Route::get('/Client/{client}/edit', [ClientController::class, 'edit'])->name('loan.edit');
    Route::put('/Client/{client}', [ClientController::class, 'update'])->name('loan.update');
    Route::delete('/Client/{client}', [ClientController::class, 'destroy'])->name('loan.destroy');

    Route::get('/banks', [BankController::class, 'index'])->name('banks.index');
    Route::get('/waykabayad', [UnpaidDuesController::class, 'index'])->name('waykabayad.index');
    Route::get('/recent_payments', [PaymentController::class, 'index'])->name('recent_payments.index');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');

    // Admin Sidebar Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
        Route::get('/users/roles', function () {
            return view('admin.users.roles');
        })->name('users.roles');

        Route::get('/loans', [AdminController::class, 'loansIndex'])->name('loans.index');
        Route::get('/loans/pending', [AdminController::class, 'loansPending'])->name('loans.pending');
        Route::get('/loans/approved', [AdminController::class, 'loansApproved'])->name('loans.approved');
        Route::get('/loans/rejected', [AdminController::class, 'loansRejected'])->name('loans.rejected');
        Route::get('/loans/overdue', [AdminController::class, 'loansOverdue'])->name('loans.overdue');

        Route::get('/reports/loans', [AdminController::class, 'reportsLoans'])->name('reports.loans');
        Route::get('/reports/payments', [AdminController::class, 'reportsPayments'])->name('reports.payments');
        Route::get('/reports/activity', [AdminController::class, 'reportsActivity'])->name('reports.activity');

        Route::get('/settings/policies', function () {
            return view('admin.settings.policies');
        })->name('settings.policies');
        Route::get('/settings/rates', function () {
            return view('admin.settings.rates');
        })->name('settings.rates');
        Route::get('/settings/penalties', function () {
            return view('admin.settings.penalties');
        })->name('settings.penalties');
        Route::get('/settings/notifications', function () {
            return view('admin.settings.notifications');
        })->name('settings.notifications');

        Route::get('/notifications', function () {
            return view('admin.notifications.index');
        })->name('notifications.index');
    });

    // User Sidebar Routes
    Route::get('/user/loans/active', [UserLoanController::class, 'active'])->name('user.loans.active');
    Route::get('/user/loans/history', [UserLoanController::class, 'history'])->name('user.loans.history');
    Route::get('/user/loans/apply', [ApplyLoanController::class, 'index'])->name('user.loans.apply');
    Route::post('/user/loans/apply', [ApplyLoanController::class, 'store'])->name('user.loans.store');

    Route::get('/user/payments/make', [UserPaymentController::class, 'make'])->name('user.payments.make');
    Route::post('/user/payments/make', [UserPaymentController::class, 'store'])->name('user.payments.store');
    Route::get('/user/payments/history', [UserPaymentController::class, 'history'])->name('user.payments.history');

    Route::get('/user/documents/upload', [UserDocumentController::class, 'upload'])->name('user.documents.upload');
    Route::post('/user/documents/upload', [UserDocumentController::class, 'store'])->name('user.documents.store');
    Route::get('/user/documents/submitted', [UserDocumentController::class, 'submitted'])->name('user.documents.submitted');

    Route::get('/user/notifications', [NotificationController::class, 'index'])->name('user.notifications');

    // Staff Sidebar Routes
    Route::get('/staff/applications/pending', [StaffApplicationController::class, 'pending'])->name('staff.applications.pending');
    Route::get('/staff/applications/review', [StaffApplicationController::class, 'review'])->name('staff.applications.review');
    Route::get('/staff/applications/approved', [StaffApplicationController::class, 'approved'])->name('staff.applications.approved');
    Route::get('/staff/applications/rejected', [StaffApplicationController::class, 'rejected'])->name('staff.applications.rejected');

    Route::get('/staff/borrowers/all', [StaffBorrowerController::class, 'all'])->name('staff.borrowers.all');
    Route::get('/staff/borrowers/verified', [StaffBorrowerController::class, 'verified'])->name('staff.borrowers.verified');

    Route::get('/staff/payments/tracking', [StaffPaymentController::class, 'tracking'])->name('staff.payments.tracking');
    Route::get('/staff/payments/history', [StaffPaymentController::class, 'history'])->name('staff.payments.history');

    Route::get('/staff/schedule/due', [StaffScheduleController::class, 'due'])->name('staff.schedule.due');
    Route::get('/staff/schedule/overdue', [StaffScheduleController::class, 'overdue'])->name('staff.schedule.overdue');

    Route::get('/staff/notifications', [StaffNotificationController::class, 'index'])->name('staff.notifications');
});
// Logout route
Route::post('/logout', function () {
    Auth::logout();

    return redirect('/');
})->name('logout');

require __DIR__.'/auth.php';
