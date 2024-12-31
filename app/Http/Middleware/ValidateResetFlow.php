<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ValidateResetFlow
{

    public function handle(Request $request, Closure $next, $step)
    {
        // Log untuk memeriksa session
        Log::info('Middleware check: validated_email = ' . Session::get('validated_email'));

        if ($step === 'reset-password' && !Session::has('validated_email')) {
            return redirect()->route('forgot-password')->with('error', 'Access denied.');
        }

        if ($step === 'reset-password-success' && !Session::has('password_reset_success')) {
            return redirect()->route('forgot-password');
        }

        return $next($request);
    }
}
