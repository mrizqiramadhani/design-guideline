<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            // Jika sudah login, redirect ke dashboard berdasarkan role
            return redirect()->intended(Auth::user()->role === 'admin' ? '/admin/dashboard' : '/operator/dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Menambahkan logika untuk remember me
        $remember = $request->has('remember'); // Mengecek apakah checkbox remember me dipilih

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            // Redirect berdasarkan role
            return redirect()->intended(Auth::user()->role === 'admin' ? '/admin/dashboard' : '/operator/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
