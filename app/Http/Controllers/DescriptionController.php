<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Description;
use App\Models\Unit;

class DescriptionController extends Controller
{
    public function index(Request $request)
    {
        $descriptions = Description::all();
        $units = Unit::all();
        $userRole = auth()->user()->role;

        $view = $userRole === 'admin'
            ? 'admin.dashboard-admin'
            : 'operator.dashboard-operator';

        // if ($descriptions->currentPage() > $descriptions->lastPage()) {
        //     $routeName = $userRole === 'admin' ? 'admin.description' : 'operator.description';

        //     return redirect()->route($routeName, ['page' => $descriptions->lastPage()]);
        // }

        return view($view, compact('descriptions', 'units'));
    }

    public function create()
    {
        $units = Unit::all();
        $view = auth()->user()->role === 'admin'
            ? 'admin.dashboard-admin'
            : 'operator.dashboard-operator';

        return view($view, compact('units'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
            'unit_id' => 'required|exists:units,id',
        ]);

        Description::create([
            'title' => $validatedData['title'] ?? null,
            'content' => $validatedData['content'],
            'unit_id' => $validatedData['unit_id'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.description' : 'operator.description')
            ->with('success', 'Description added successfully!');
    }

    public function edit($id)
    {
        $description = Description::findOrFail($id);
        $units = Unit::all();
        $view = auth()->user()->role === 'admin'
            ? 'admin.dashboard-admin'
            : 'operator.dashboard-operator';

        return view($view, compact('description', 'units'));
    }

    public function update(Request $request, $id)
    {
        $descriptions = Description::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
            'unit_id' => 'required|exists:units,id',
        ]);

        $descriptions->update([
            'title' => $validatedData['title'] ?? null,
            'content' => $validatedData['content'],
            'unit_id' => $validatedData['unit_id'],
        ]);

        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.description' : 'operator.description')
            ->with('success', 'Description updated successfully!');
    }

    public function destroy($id)
    {
        $description = Description::findOrFail($id);

        $description->delete();

        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.description' : 'operator.description')
            ->with('success', 'Description deleted successfully!');
    }
}
