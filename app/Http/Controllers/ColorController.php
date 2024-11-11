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
        return view('admin.content.color-admin', compact('colors'));
    }

    /**
     * Show the form for creating a new color.
     */
    public function create()
    {
        $units = Unit::all(); // Assuming Unit model represents Shafwah Group, Holidays, and Property
        return view('admin.content.color-admin', compact('units'));
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
            'user_id' => Auth::id(), // Assuming the logged-in user is the creator
        ]);

        return redirect()->route('admin.colors.index')->with('success', 'Color added successfully.');
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

        return redirect()->route('admin.colors.index')->with('success', 'Color updated successfully.');
    }

    /**
     * Remove the specified color from storage.
     */
    public function destroy(ColorPalette $color)
    {
        $color->delete();
        return redirect()->route('admin.colors.index')->with('success', 'Color deleted successfully.');
    }
}
