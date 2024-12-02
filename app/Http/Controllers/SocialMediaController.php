<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialMedia;
use App\Models\Unit;

class SocialMediaController extends Controller
{
    public function index(Request $request)
    {

        $socialMedias = SocialMedia::all();
        $units = Unit::all();

        $userRole = auth()->user()->role;

        $view = $userRole === 'admin'
            ? 'admin.content.social-media-admin'
            : 'operator.content.social-media-operator';

        // if ($illustrations->currentPage() > $illustrations->lastPage()) {
        //     $routeName = $userRole === 'admin' ? 'admin.illustration' : 'operator.illustration';

        //     return redirect()->route($routeName, ['page' => $illustrations->lastPage()]);
        // }

        return view($view, compact('socialMedias', 'units'));
    }

    public function create()
    {

        $units = Unit::all();

        $view = auth()->user()->role === 'admin'
            ? 'admin.content.social-media-admin'
            : 'operator.content.social-media-operator';

        return view($view, compact('units'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'unit_id' => 'required|exists:units,id',
            'type' => 'required|in:feed,story,reels',
        ]);

        $socialMediaPath = $request->file('path')->store('social_media', 'public');

        SocialMedia::create([
            'path' => $socialMediaPath,
            'unit_id' => $validatedData['unit_id'],
            'type' => $validatedData['type'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.social-media' : 'operator.social-media')
            ->with('success', 'Social Media added successfully!');
    }
}
