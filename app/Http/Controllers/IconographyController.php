<?php

namespace App\Http\Controllers;

use App\Models\Iconography;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IconographyController extends Controller
{
    public function index(Request $request)
    {
        $iconographys = Iconography::paginate(4);
        $units = Unit::all();

        $userRole = auth()->user()->role;
        $view = $userRole === 'admin'
            ? 'admin.content.iconography-admin'
            : 'operator.content.iconography-operator';

        if ($iconographys->currentPage() > $iconographys->lastPage()) {
            $routeName = $userRole === 'admin' ? 'admin.iconography' : 'operator.iconography';
            return redirect()->route($routeName, ['page' => $iconographys->lastPage()]);
        }

        return view($view, compact('iconographys', 'units'));
    }

    public function create()
    {
        $units = Unit::all();

        $view = auth()->user()->role === 'admin'
            ? 'admin.content.iconography-admin'
            : 'operator.content.iconography-operator';

        return view($view, compact('units'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'unit_id' => 'required|exists:units,id',
            'link' => 'nullable|url', // Validasi untuk link
        ]);

        $iconographyPath = $request->file('path')->store('iconographys', 'public');

        Iconography::create([
            'path' => $iconographyPath,
            'unit_id' => $validatedData['unit_id'],
            'user_id' => auth()->id(),
            'link' => $validatedData['link'], // Simpan link
        ]);

        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.iconography' : 'operator.iconography')
            ->with('success', 'Iconography added successfully!');
    }

    public function edit($id)
    {
        $iconography = Iconography::findOrFail($id);
        $units = Unit::all();

        $view = auth()->user()->role === 'admin'
            ? 'admin.content.iconography-admin'
            : 'operator.content.iconography-operator';

        return view($view, compact('iconography', 'units'));
    }

    public function update(Request $request, $id)
    {
        $iconography = Iconography::findOrFail($id);

        $validatedData = $request->validate([
            'unit_id' => 'required|exists:units,id',
            'path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'link' => 'nullable|url', // Validasi untuk link
        ]);

        $iconography->unit_id = $validatedData['unit_id'];
        $iconography->link = $validatedData['link']; // Update link

        if ($request->hasFile('path')) {
            if ($iconography->path && Storage::disk('public')->exists($iconography->path)) {
                Storage::disk('public')->delete($iconography->path);
            }

            $iconography->path = $request->file('path')->store('iconographys', 'public');
        }

        $iconography->save();

        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.iconography' : 'operator.iconography')
            ->with('success', 'iconography updated successfully!');
    }

    public function destroy($id)
    {
        $iconography = Iconography::findOrFail($id);

        if ($iconography->path && Storage::disk('public')->exists($iconography->path)) {
            Storage::disk('public')->delete($iconography->path);
        }

        $iconography->delete();

        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.iconography' : 'operator.iconography')
            ->with('success', 'Iconography deleted successfully!');
    }
}
