<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class PasswordController extends Controller
{
    // Menampilkan halaman forgot password
    public function showForgotPassword()
    {
        return view('auth.forgot-password.email-validation');
    }

    // Proses validasi email
    public function validateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->where('role', 'admin')->first();

        if ($user) {
            Session::put('validated_email', $user->email);

            return response()->json(['message' => 'Email is valid.']);
        }

        return response()->json(['message' => 'Invalid email address or not an admin role'], 422);
    }

    // Menampilkan halaman reset password
    public function showResetPassword()
    {
        if (!Session::has('validated_email')) {
            return redirect()->route('forgot-password')->with('error', 'Access denied.');
        }

        return view('auth.forgot-password.reset-password');
    }

    // Proses reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $email = Session::get('validated_email');
        $user = User::where('email', $email)->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            Session::forget('validated_email');
            Session::put('password_reset_success', true);
            return redirect()->route('reset-password-success');
        }

        return response()->json(['message' => 'User not found.'], 404);
    }


    // Menampilkan halaman reset password success
    public function showResetPasswordSuccess()
    {
        if (!Session::has('password_reset_success')) {
            return redirect()->route('forgot-password');
        }

        Session::forget('validated_email');
        Session::forget('password_reset_success');
        return view('auth.forgot-password.reset-password-success');
    }
}
