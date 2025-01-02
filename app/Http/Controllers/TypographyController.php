<?php

namespace App\Http\Controllers;

use App\Models\Typography;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TypographyController extends Controller
{
    public function index(Request $request)
    {
        $typographys = Typography::paginate(4);
        $units = Unit::all();

        $userRole = auth()->user()->role;
        $view = $userRole === 'admin'
            ? 'admin.content.typography-admin'
            : 'operator.content.typography-operator';

        if ($typographys->currentPage() > $typographys->lastPage()) {
            $routeName = $userRole === 'admin' ? 'admin.typography' : 'operator.typography';
            return redirect()->route($routeName, ['page' => $typographys->lastPage()]);
        }

        return view($view, compact('typographys', 'units'));
    }

    public function create()
    {
        $units = Unit::all();

        $view = auth()->user()->role === 'admin'
            ? 'admin.content.typography-admin'
            : 'operator.content.typography-operator';

        return view($view, compact('units'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'unit_id' => 'required|exists:units,id',
            'font_name' => 'nullable|url', // Validasi untuk link
        ]);

        $typographyPath = $request->file('path')->store('typographys', 'public');

        Typography::create([
            'path' => $typographyPath,
            'unit_id' => $validatedData['unit_id'],
            'user_id' => auth()->id(),
            'font_name' => $validatedData['font_name'], // Simpan link
        ]);

        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.typography' : 'operator.typography')
            ->with('success', 'Typography added successfully!');
    }

    public function edit($id)
    {
        $typography = Typography::findOrFail($id);
        $units = Unit::all();

        $view = auth()->user()->role === 'admin'
            ? 'admin.content.typography-admin'
            : 'operator.content.typography-operator';

        return view($view, compact('typography', 'units'));
    }

    public function update(Request $request, $id)
    {
        $typography = Typography::findOrFail($id);

        $validatedData = $request->validate([
            'unit_id' => 'required|exists:units,id',
            'path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'font_name' => 'nullable|url', // Validasi untuk link
        ]);

        $typography->unit_id = $validatedData['unit_id'];
        $typography->font_name = $validatedData['font_name']; // Update link

        if ($request->hasFile('path')) {
            if ($typography->path && Storage::disk('public')->exists($typography->path)) {
                Storage::disk('public')->delete($typography->path);
            }

            $typography->path = $request->file('path')->store('typographys', 'public');
        }

        $typography->save();

        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.typography' : 'operator.typography')
            ->with('success', 'Typography updated successfully!');
    }

    public function destroy($id)
    {
        $typography = Typography::findOrFail($id);

        if ($typography->path && Storage::disk('public')->exists($typography->path)) {
            Storage::disk('public')->delete($typography->path);
        }

        $typography->delete();

        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.typography' : 'operator.typography')
            ->with('success', 'Typography deleted successfully!');
    }
}
