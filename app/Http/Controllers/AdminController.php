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

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8', // Adjust according to your needs
        ]);

        // If validation passes, create the operator
        $operator = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'operator',
        ]);


        return redirect()->back()->with('success', 'Operator added successfully.');
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
            'email' => 'required|email|max:255',
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

            // Set flash message untuk sukses
            return redirect()->back()->with('success', 'Operator updated successfully!');
        } catch (QueryException $e) {
            // Jika terjadi kesalahan, set flash message untuk error
            return redirect()->back()->withErrors(['email' => 'Email sudah digunakan.']);
        }
    }

    public function deleteOperator($id)
    {
        $operator = User::findOrFail($id);
        $operator->delete();
    
        return redirect()->route('admin.show-operators')->with('success', 'Operator berhasil dihapus.');
    }
    

}
