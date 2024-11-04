<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard-admin');
    }

    public function addOperator(Request $request)
    {
        try {
            // Validasi data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            // Jika validasi berhasil, buat operator
            $operator = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'operator',
            ]);

            // Mengembalikan respon sukses
            return response()->json(['success' => 'Operator added successfully.']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Mengembalikan respon error jika validasi gagal
            return response()->json(['errors' => $e->validator->errors()], 422);
        }
    }

    public function showOperators()
    {
        $operators = User::where('role', 'operator')->get();
        return view('admin.operator-admin', compact('operators'));
    }

    public function editOperator($id)
    {
        // Ambil data operator berdasarkan ID
        $operator = User::findOrFail($id);

        // Kembalikan response JSON dengan data operator
        return response()->json([
            'name' => $operator->name,
            'email' => $operator->email,
        ]);
    }

    public function updateOperator(Request $request, $id)
    {
        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8', // Password opsional
        ]);

        try {
            // Cari operator berdasarkan ID dan update data
            $operator = User::findOrFail($id);
            $operator->name = $validatedData['name'];
            $operator->email = $validatedData['email'];

            // Jika password diisi, update password
            if (!empty($validatedData['password'])) {
                $operator->password = bcrypt($validatedData['password']);
            }

            $operator->save();

            // Jika permintaan adalah AJAX, kirim respons JSON
            if ($request->ajax()) {
                return response()->json(['success' => 'Operator updated successfully!']);
            }

            // Jika bukan AJAX, gunakan redirect biasa
            return redirect()->back()->with('success', 'Operator updated successfully!');
        } catch (QueryException $e) {
            // Jika terjadi kesalahan, buat pesan error

            $errorMessage = ['email' => 'Email sudah digunakan.'];

            // Jika permintaan adalah AJAX, kirim respons JSON untuk error
            if ($request->ajax()) {
                return response()->json(['errors' => $errorMessage], 422);
            }

            // Jika bukan AJAX, kembalikan dengan error melalui redirect
            return redirect()->back()->withErrors($errorMessage);
        }
    }

    public function deleteOperator($id)
    {
        $operator = User::findOrFail($id);
        $operator->delete();

        return redirect()->route('admin.show-operators')->with('success', 'Operator successfully deleted.');
    }
}
