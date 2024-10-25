<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role === $role) {
            // Set session berdasarkan role
            Session::put('role', $role);
            return $next($request);
        }

        return redirect('/login')->withErrors(['access' => 'Unauthorized access.']);
    }
}
