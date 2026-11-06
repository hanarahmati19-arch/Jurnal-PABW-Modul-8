<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string|array $roles): Response
    {
        if (! Auth::check()) {
            abort(403, 'Akses Ditolak. Silakan login terlebih dahulu.');
        }

        $allowedRoles = is_array($roles) ? $roles : [$roles];
        $userRole = Auth::user()->role;

        if (in_array($userRole, $allowedRoles, true)) {
            return $next($request);
        }

        abort(403, 'Akses Ditolak. Anda bukan ' . implode(' atau ', $allowedRoles));
    }
}