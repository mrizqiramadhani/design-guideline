<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StartSessionByRole
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            // Set session cookie name berdasarkan role
            $role = auth()->user()->role;
            session()->setId($role . '_' . session()->getId());
            session()->start();
            session(['user_name' => auth()->user()->name]); // Menyimpan nama pengguna dalam session

            // Logging session data
            // Log::info('Session started', [
            //     'user_id' => auth()->user()->id,
            //     'user_name' => auth()->user()->name,
            //     'session_id' => session()->getId(),
            //     'role' => $role,
            //     'session_data' => session()->all(),
            // ]);
        }

        return $next($request);
    }
}
