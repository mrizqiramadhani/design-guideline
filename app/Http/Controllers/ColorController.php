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
        // Dapatkan semua unit untuk dropdown
        $units = Unit::all();

        // Tentukan role pengguna
        $userRole = auth()->user()->role;

        // Ambil data color palette dengan relasi 'unit' dan urutkan berdasarkan terbaru, dengan pagination
        $colors = ColorPalette::with('unit')->latest()->paginate(5);

        // Jika halaman lebih besar dari jumlah halaman yang tersedia, redirect ke halaman terakhir yang valid
        if ($colors->currentPage() > $colors->lastPage()) {
            // Tentukan rute berdasarkan role
            $routeName = $userRole === 'admin' ? 'admin.color' : 'operator.color';

            // Redirect ke halaman terakhir yang valid
            return redirect()->route($routeName, ['page' => $colors->lastPage()]);
        }

        // Tentukan view berdasarkan role
        $view = $userRole === 'admin'
            ? 'admin.content.color-admin'
            : 'operator.content.color-operator';

        // Kirimkan data ke view
        return view($view, compact('colors', 'units'));
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

        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.color' : 'operator.color')
            ->with('success', 'Color added successfully.');
    }

    /**
     * Show the form for editing the specified color.
     */
    public function edit(ColorPalette $color)
    {
        $units = Unit::all();

        // Dapatkan role pengguna
        $userRole = auth()->user()->role;

        // Tentukan view berdasarkan role
        $view = $userRole === 'admin'
            ? 'admin.colors.edit'
            : 'operator.colors.edit';

        return view($view, compact('color', 'units'));
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

        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.color' : 'operator.color')
            ->with('success', 'Color updated successfully.');
    }

    /**
     * Remove the specified color from storage.
     */
    public function destroy(ColorPalette $color)
    {
        $color->delete();
        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.color' : 'operator.color')
            ->with('success', 'Color deleted successfully.');
    }
}
