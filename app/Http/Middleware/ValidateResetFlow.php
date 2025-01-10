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
        Log::info("Middleware check for step: {$step}, validated_email: " . Session::get('validated_email') . ", security_question_answered: " . Session::get('security_question_answered'));

        // Validasi untuk langkah 'reset-password'
        if ($step === 'reset-password') {
            if (!Session::has('validated_email')) {
                // Log::warning("Access denied: validated_email missing.");
                return redirect()->route('forgot-password')->with('error', 'Access denied. Please restart the reset process.');
            }

            if (!Session::has('security_question_answered')) {
                // Log::warning("Access denied: security_question_answered missing.");
                return redirect()->route('security-question')->with('error', 'You must answer the security question before resetting your password.');
            }
        }

        // Validasi untuk langkah 'security-question'
        if ($step === 'security-question') {
            if (!Session::has('validated_email')) {
                // Log::warning("Access denied: validated_email missing.");
                return redirect()->route('forgot-password')->with('error', 'Session expired. Please restart the reset process.');
            }

            // Tambahan: Reset session jika user mencoba melewati langkah dengan manipulasi URL
            if (Session::has('security_question_answered')) {
                // Log::warning("Redirecting to reset-password due to security_question_answered already set.");
                return redirect()->route('reset-password');
            }
        }

        // Validasi untuk langkah 'reset-password-success'
        if ($step === 'reset-password-success') {
            if (!Session::has('password_reset_success')) {
                // Log::warning("Access denied: password_reset_success missing.");
                return redirect()->route('forgot-password')->with('error', 'Invalid access. Please restart the reset process.');
            }
        }

        // Lanjutkan request jika semua validasi terpenuhi
        return $next($request);
    }
}
