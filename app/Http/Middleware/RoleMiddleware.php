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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
     /*if (auth()->check() && auth()->user()->is_admin) {
            return $next($request);
        }
     
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        abort(403);*/
        $user = $request->user();
        if (!$user) {
            abort(403, 'You must be logged in.');
        }

        
        if (!in_array($user->role, $roles)) {
            abort(403, 'You do not have permission to access this page.');
        }

        return $next($request);
    }

}
