<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Check if user has one of the required roles
        foreach ($roles as $role) {
            if ($request->user()->role === $role || ($role === 'admin' && $request->user()->is_admin)) {
                return $next($request);
            }
        }

        // User doesn't have required role
        abort(403, 'You do not have permission to access this resource.');
    }
}
