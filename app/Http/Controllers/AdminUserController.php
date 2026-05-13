<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AuditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminUserController extends Controller
{
    protected AuditService $auditService;

    public function __construct(AuditService $auditService)
    {
        $this->auditService = $auditService;
    }

    /**
     * Display a listing of all users with role stats.
     */
    public function index(): \Illuminate\View\View
    {
        $users = User::latest()->paginate(10);
        $stats = [
            'total' => User::count(),
            'admins' => User::where('role', 'admin')->count(),
            'staff' => User::where('role', 'staff')->count(),
            'users' => User::where('role', 'user')->count(),
        ];

        return view('admin.users.index', compact('users', 'stats'));
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:user,staff,admin'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_admin' => $request->role === 'admin',
        ]);

        // Audit log
        $this->auditService->logUserCreated($user->id, [
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
        ], $request);

        return redirect()->back()->with('success', 'User added successfully.');
    }

    /**
     * Update an existing user.
     */
    public function update(Request $request, User $user): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'role' => ['required', 'string', 'in:user,staff,admin'],
            'password' => ['nullable', Rules\Password::defaults()],
        ]);

        $oldData = $user->only(['name', 'email', 'role']);
        $oldRole = $user->role;

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'is_admin' => $request->role === 'admin',
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        // Audit log
        if ($oldRole !== $request->role) {
            $this->auditService->logUserRoleChanged($user->id, $oldRole, $request->role, $request);
        } else {
            $this->auditService->logUserUpdated($user->id, $oldData, $user->only(['name', 'email', 'role']), $request);
        }

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    /**
     * Remove a user from the system.
     */
    public function destroy(User $user): \Illuminate\Http\RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'You cannot delete yourself.');
        }

        $this->auditService->logUserDeleted($user->id, $user->email);

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
