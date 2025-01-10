<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuestionValidation; // Model untuk tabel question_validations
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    /**
     * Menampilkan halaman Personal Information.
     */
    public function index()
    {
        $questions = QuestionValidation::where('user_id', Auth::id())->get();
        return view('admin.personal-information', compact('questions'));
    }

    /**
     * Tambah Security Question.
     */
    public function store(Request $request)
    {
        $request->validate([
            'security_question' => 'required|string|max:255',
            'security_answer' => 'required|string|max:255',
        ]);

        // Tambahkan data ke tabel question_validations
        QuestionValidation::create([
            'user_id' => Auth::id(),
            'security_question' => $request->security_question,
            'security_answer' => Hash::make($request->security_answer), // Hash jawaban untuk keamanan
        ]);

        return redirect()->route('personal.information')->with('success', 'Illustration added successfully!');
    }

    /**
     * Validasi Jawaban untuk Edit.
     */
    public function validateAnswer(Request $request, $id)
    {
        $request->validate(['security_answer' => 'required|string']);

        $question = QuestionValidation::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if (!Hash::check($request->security_answer, $question->security_answer)) {
            return redirect()->back()->withErrors(['security_answer' => 'Answer is incorrect.']);
        }

        // Update kolom validated_at jika valid
        $question->update(['validated_at' => now()]);

        return response()->json([
            'message' => 'Answer validated successfully.',
            'id' => $id,
            'security_question' => $question->security_question,
        ], 200);
    }

    /**
     * Update Security Question.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'security_question' => 'required|string|max:255',
            'security_answer' => 'required|string|max:255',
        ]);

        $question = QuestionValidation::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $question->update([
            'security_question' => $request->security_question,
            'security_answer' => Hash::make($request->security_answer),
        ]);

        return redirect()->route('personal.information')->with('success', 'Security question updated successfully.');
    }

    /**
     * Hapus Security Question.
     */
    public function destroy($id)
    {
        $question = QuestionValidation::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $question->delete();

        return redirect()->route('personal.information')->with('success', 'Security question deleted successfully.');
    }
}
