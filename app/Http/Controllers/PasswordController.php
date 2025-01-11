<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\QuestionValidation;

class PasswordController extends Controller
{
    // Menampilkan halaman forgot password
    public function showForgotPassword()
    {
        return view('auth.forgot-password.email-validation');
    }


    public function adminEmail(Request $request)
    {
        $user = User::where('role', 'admin')->first();

        if ($user) {
            return response()->json(['email' => $user->email], 200);
        } else {
            return response()->json(['message' => 'Admin not found.'], 404);
        }
    }

    public function validateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('role', 'admin')->first();

        if ($user) {
            if ($user->email == $request->email) {
                // Create session
                Session::flush(); // Hapus semua session terkait sebelum memulai ulang proses
                Session::put('validated_email', $user->email);

                $questions = QuestionValidation::where('user_id', $user->id)->inRandomOrder()->first();

                if ($questions) {
                    Session::put('selected_question', $questions->id);
                    // Log::info("Security question selected for user: {$user->email}");
                    // return response()->json(['redirect' => route('security-question')], 200);
                    return response()->json(['valid' => true, 'redirect' => route('security-question')], 200);
                }
            } else {
                return response()->json(['valid' => false], 404);
            }
        } else {
            return response()->json(['valid' => false], 404);
        }
    }

    // Menampilkan halaman security question
    public function showSecurityQuestion()
    {
        if (!Session::has('validated_email')) {
            return redirect()->route('forgot-password')->with('error', 'Session expired. Please restart the reset process.');
        }

        $questionId = Session::get('selected_question');
        $question = QuestionValidation::find($questionId);

        if (!$question) {
            return redirect()->route('reset-password')->with('info', 'No security questions found. Proceeding to reset password.');
        }

        return view('auth.forgot-password.security-question', ['question' => $question]);
    }

    // Proses validasi jawaban security question
    public function validateSecurityQuestion(Request $request)
    {
        $request->validate([
            'security_answer' => 'required|string',
        ]);

        $questionId = Session::get('selected_question');
        $question = QuestionValidation::find($questionId);

        $attempts = Session::get('security_question_attempts', 0);
        Session::put('security_question_attempts', $attempts + 1);

        if ($attempts >= 2) {
            // Log::warning("User exceeded maximum attempts for security question: {$questionId}");
            Session::flush();
            return redirect()->route('forgot-password')->with('error', 'Too many attempts. Please restart the process.');
        }

        if ($question && Hash::check($request->security_answer, $question->security_answer)) {
            Session::put('security_question_answered', true);
            Session::forget('security_question_attempts'); // Reset attempts
            // Log::info("Security question answered successfully for question ID: {$questionId}");
            return redirect()->route('reset-password');
        }

        // Log::warning("Incorrect security answer for question ID: {$questionId}");
        return back()->withErrors(['security_answer' => 'Incorrect answer. Please try again.']);
    }

    // Menampilkan halaman reset password
    public function showResetPassword()
    {
        if (!Session::has('validated_email')) {
            return redirect()->route('forgot-password')->with('error', 'Access denied.');
        }

        if (!Session::has('security_question_answered')) {
            return redirect()->route('security-question')->with('error', 'You must answer the security question before resetting your password.');
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

        return back()->withErrors(['password' => 'User not found.']);
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
