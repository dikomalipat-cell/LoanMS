<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Services\AuditService;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class StaffApplicationController extends Controller
{
    protected AuditService $auditService;
    protected NotificationService $notificationService;

    public function __construct(AuditService $auditService, NotificationService $notificationService)
    {
        $this->auditService = $auditService;
        $this->notificationService = $notificationService;
    }

    /**
     * Show all pending loan applications for staff to review.
     */
    public function pending(): \Illuminate\View\View
    {
        $applications = Loan::where('status', 'pending')
            ->with('borrower')
            ->latest()
            ->paginate(10);

        return view('staff.applications.pending', compact('applications'));
    }

    /**
     * Review a specific loan application (view details).
     */
    public function reviewLoan(Loan $loan): \Illuminate\View\View
    {
        $loan->load('borrower', 'payments');

        return view('staff.applications.review', compact('loan'));
    }

    /**
     * Staff verifies documents and forwards to Admin for approval.
     * This is the middle step: User applies → STAFF VERIFIES → Admin approves.
     */
    public function verifyAndForward(Request $request, Loan $loan): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'staff_notes' => ['nullable', 'string', 'max:500'],
        ]);

        // Log the staff verification action
        $this->auditService->log(
            'verify_and_forward',
            'Loan',
            $loan->id,
            'Staff verified loan application and forwarded to Admin. Notes: '.($request->staff_notes ?? 'None'),
            null,
            ['verified_by' => auth()->user()->name, 'staff_notes' => $request->staff_notes],
            $request
        );

        // Notify admins that a loan is ready for their review
        $this->notificationService->notifyAdmins(
            'Loan Ready for Approval',
            "Staff {$staffName = auth()->user()->name} has verified loan #{$loan->id} from {$loan->borrower->name} (₱".number_format($loan->loan_amount, 2)."). Ready for admin approval.",
            'info',
            'loan_verified'
        );

        // Notify the borrower that their application is being processed
        $this->notificationService->createNotification(
            $loan->user_id,
            'Application Under Review',
            'Your loan application has been verified by our staff and forwarded to management for final approval.',
            'info',
            'loan_under_review'
        );

        return redirect()->route('staff.applications.pending')
            ->with('success', "Loan #{$loan->id} has been verified and forwarded to Admin for approval.");
    }

    /**
     * Show approved loan applications.
     */
    public function approved(): \Illuminate\View\View
    {
        $applications = Loan::where('status', 'approved')
            ->with('borrower', 'approvedBy')
            ->latest()
            ->paginate(10);

        return view('staff.applications.approved', compact('applications'));
    }

    /**
     * Show rejected loan applications.
     */
    public function rejected(): \Illuminate\View\View
    {
        $applications = Loan::where('status', 'rejected')
            ->with('borrower')
            ->latest()
            ->paginate(10);

        return view('staff.applications.rejected', compact('applications'));
    }
}
