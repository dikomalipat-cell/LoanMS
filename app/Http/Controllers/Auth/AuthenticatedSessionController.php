<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Check login type and user role
        $loginType = $request->input('login_type', 'user');
        $user = Auth::user();

        // If admin login is requested, verify user is actually admin
        if ($loginType === 'admin' && ! $user->is_admin) {
            // Not an admin, logout and show error
            Auth::logout();

            return back()->withErrors([
                'email' => 'You do not have admin access.',
            ])->onlyInput('email');
        }

        // If user login but user is actually admin, redirect to admin dashboard
        if ($loginType === 'user' && $user->is_admin) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // Redirect based on role
        if ($user->is_admin) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
