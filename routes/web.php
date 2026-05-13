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

// ─── PUBLIC ROUTES ───────────────────────────────────────────
Route::get('/', function () {
    $stats = [
        'total_disbursed' => \App\Models\Loan::sum('loan_amount'),
        'repayment_rate' => \App\Models\Loan::sum('loan_amount') > 0 
            ? round((\App\Models\Payment::sum('amount_paid') / \App\Models\Loan::sum('loan_amount')) * 100, 1) 
            : 0,
        'active_borrowers' => \App\Models\User::where('role', 'user')->count(),
        'avg_approval_time' => '24h', // This can be a static "promise" or calculated if we had timestamps
    ];
    return view('welcome', compact('stats'));
});

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/user/login', [ProfileController::class, 'login'])->name('profile.login');

// ─── AUTHENTICATED ROUTES ────────────────────────────────────
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Profile (all roles)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ═══════════════════════════════════════════════════════════
    // ADMIN ROUTES — Full System Access
    // ═══════════════════════════════════════════════════════════
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {

        // ── User Management ──
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
        Route::get('/users/roles', function () {
            return view('admin.users.roles');
        })->name('users.roles');

        // ── Loan Monitoring ──
        Route::get('/loans', [AdminController::class, 'loansIndex'])->name('loans.index');
        Route::get('/loans/pending', [AdminController::class, 'loansPending'])->name('loans.pending');
        Route::get('/loans/approved', [AdminController::class, 'loansApproved'])->name('loans.approved');
        Route::get('/loans/rejected', [AdminController::class, 'loansRejected'])->name('loans.rejected');
        Route::get('/loans/overdue', [AdminController::class, 'loansOverdue'])->name('loans.overdue');

        // ── Loan Actions (Approve / Reject) ──
        Route::post('/loans/{loan}/approve', [AdminController::class, 'approveLoan'])->name('loans.approve');
        Route::post('/loans/{loan}/reject', [AdminController::class, 'rejectLoan'])->name('loans.reject');

        // ── Reports & Analytics ──
        Route::get('/reports/loans', [AdminController::class, 'reportsLoans'])->name('reports.loans');
        Route::get('/reports/payments', [AdminController::class, 'reportsPayments'])->name('reports.payments');
        Route::get('/reports/activity', [AdminController::class, 'reportsActivity'])->name('reports.activity');

        // ── System Settings ──
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

        // ── Admin Notifications ──
        Route::get('/notifications', function () {
            return view('admin.notifications.index');
        })->name('notifications.index');
    });

    // ═══════════════════════════════════════════════════════════
    // STAFF ROUTES — Loan Processor, Verifier, Payment Recorder
    // ═══════════════════════════════════════════════════════════
    Route::prefix('staff')->name('staff.')->middleware('role:staff')->group(function () {

        // ── Loan Applications (Verify → Forward to Admin) ──
        Route::get('/applications/pending', [StaffApplicationController::class, 'pending'])->name('applications.pending');
        Route::get('/applications/review', [StaffApplicationController::class, 'underReview'])->name('applications.review');
        Route::get('/applications/review/{loan}', [StaffApplicationController::class, 'reviewLoan'])->name('applications.review.show');
        Route::post('/applications/{loan}/verify', [StaffApplicationController::class, 'verifyAndForward'])->name('applications.verify');
        Route::get('/applications/approved', [StaffApplicationController::class, 'approved'])->name('applications.approved');
        Route::get('/applications/rejected', [StaffApplicationController::class, 'rejected'])->name('applications.rejected');

        // ── Borrower Management ──
        Route::get('/borrowers/all', [StaffBorrowerController::class, 'all'])->name('borrowers.all');
        Route::get('/borrowers/verified', [StaffBorrowerController::class, 'verified'])->name('borrowers.verified');

        // ── Payment Management (Record Payments) ──
        Route::get('/payments/tracking', [StaffPaymentController::class, 'tracking'])->name('payments.tracking');
        Route::post('/payments/record', [StaffPaymentController::class, 'recordPayment'])->name('payments.record');
        Route::get('/payments/history', [StaffPaymentController::class, 'history'])->name('payments.history');

        // ── Schedule Monitoring ──
        Route::get('/schedule/due', [StaffScheduleController::class, 'due'])->name('schedule.due');
        Route::get('/schedule/overdue', [StaffScheduleController::class, 'overdue'])->name('schedule.overdue');

        // ── Staff Notifications ──
        Route::get('/notifications', [StaffNotificationController::class, 'index'])->name('notifications');
    });

    // ═══════════════════════════════════════════════════════════
    // USER / BORROWER ROUTES — Apply, Pay, Monitor
    // ═══════════════════════════════════════════════════════════
    Route::prefix('user')->name('user.')->middleware('role:user')->group(function () {

        // ── Loan Application ──
        Route::get('/loans/apply', [ApplyLoanController::class, 'index'])->name('loans.apply');
        Route::post('/loans/apply', [ApplyLoanController::class, 'store'])->name('loans.store');
        Route::get('/loans/active', [UserLoanController::class, 'active'])->name('loans.active');
        Route::get('/loans/history', [UserLoanController::class, 'history'])->name('loans.history');

        // ── Payments ──
        Route::get('/payments/make', [UserPaymentController::class, 'make'])->name('payments.make');
        Route::post('/payments/make', [UserPaymentController::class, 'store'])->name('payments.store');
        Route::get('/payments/history', [UserPaymentController::class, 'history'])->name('payments.history');

        // ── Documents ──
        Route::get('/documents/upload', [UserDocumentController::class, 'upload'])->name('documents.upload');
        Route::post('/documents/upload', [UserDocumentController::class, 'store'])->name('documents.store');
        Route::get('/documents/submitted', [UserDocumentController::class, 'submitted'])->name('documents.submitted');

        // ── User Notifications ──
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    });

    // Legacy routes (shared)
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
});

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

require __DIR__.'/auth.php';
