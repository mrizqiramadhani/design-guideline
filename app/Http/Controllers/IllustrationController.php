<?php

namespace App\Http\Controllers;

use App\Models\Illustration;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class IllustrationController extends Controller
{
    public function index(Request $request)
    {

        $illustrations = Illustration::all();
        $units = Unit::all();

        $userRole = auth()->user()->role;

        $view = $userRole === 'admin'
            ? 'admin.content.illustration-admin'
            : 'operator.content.illustration-operator';

        // if ($illustrations->currentPage() > $illustrations->lastPage()) {
        //     $routeName = $userRole === 'admin' ? 'admin.logo' : 'operator.logo';

        //     return redirect()->route($routeName, ['page' => $illustrations->lastPage()]);
        // }

        return view($view, compact('illustrations', 'units'));
    }

    public function create()
    {

        $units = Unit::all();

        $view = auth()->user()->role === 'admin'
            ? 'admin.content.illustration-admin'
            : 'operator.content.illustration-operator';

        return view($view, compact('units'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'unit_id' => 'required|exists:units,id',

        ]);

        $illustrationPath = $request->file('path')->store('illustrations', 'public');

        Illustration::create([
            'path' => $illustrationPath,
            'unit_id' => $validatedData['unit_id'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.illustration' : 'operator.illustration')
            ->with('success', 'Logo and photos added successfully!');
    }

    public function destroy($id)
    {


        $illustration = Illustration::findOrFail($id);

        if ($illustration->path && Storage::exists($illustration->path)) {
            Storage::delete($illustration->path);
        }

        $illustration->delete();

        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.illustration' : 'operator.illustration')
            ->with('success', 'Logo and photos deleted successfully!');
    }
}
