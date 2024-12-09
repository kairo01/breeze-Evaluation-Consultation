<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Check if the user's role matches the expected role
        if ($request->user()->role !== $role) {
            // You can change this to redirect or show a more specific error page
            abort(403, 'Unauthorized action.');  // 403 Forbidden is more appropriate for unauthorized access
        }

        // If the role matches, continue the request
        return $next($request);
    }
}
