<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

        // dd($operator);

        return redirect()->back()->with('success', 'Operator added successfully.');
    }
}
