<?php

namespace App\Http\Controllers;

use App\Models\ColorPalette;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
{
    /**
     * Display a listing of the color palettes.
     */
    public function index()
    {
        $colors = ColorPalette::with('unit')->latest()->get();
        $units = Unit::all(); // Mengambil semua unit untuk digunakan di dropdown
        return view('admin.content.color-admin', compact('colors', 'units'));
    }

    /**
     * Store a newly created color in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'color' => 'required|string|max:7|regex:/^#[a-fA-F0-9]{6}$/',
            'unit_id' => 'required|exists:units,id',
        ]);

        ColorPalette::create([
            'color' => $request->color,
            'unit_id' => $request->unit_id,
            'user_id' => Auth::id(), // Pengguna yang sedang login sebagai pembuat
        ]);

        return redirect()->route('admin.color')->with('success', 'Color added successfully.');
    }

    /**
     * Show the form for editing the specified color.
     */
    public function edit(ColorPalette $color)
    {
        $units = Unit::all();
        return view('admin.colors.edit', compact('color', 'units'));
    }

    /**
     * Update the specified color in storage.
     */
    public function update(Request $request, ColorPalette $color)
    {
        $request->validate([
            'color' => 'required|string|max:7|regex:/^#[a-fA-F0-9]{6}$/',
            'unit_id' => 'required|exists:units,id',
        ]);
    
        $color->update([
            'color' => $request->color,
            'unit_id' => $request->unit_id,
        ]);
    
        return redirect()->route('admin.color')->with('success', 'Color updated successfully.');
    }
    

    /**
     * Remove the specified color from storage.
     */
    public function destroy(ColorPalette $color)
    {
        $color->delete();
        return redirect()->route('admin.color')->with('success', 'Color deleted successfully.');
    }
}
