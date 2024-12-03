<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialMedia;
use App\Models\Unit;
use Illuminate\Support\Facades\Storage;

class SocialMediaController extends Controller
{
    public function index(Request $request)
    {

        $socialMedias = SocialMedia::paginate(4);
        $units = Unit::all();

        $userRole = auth()->user()->role;

        $view = $userRole === 'admin'
            ? 'admin.content.social-media-admin'
            : 'operator.content.social-media-operator';

        if ($socialMedias->currentPage() > $socialMedias->lastPage()) {
            $routeName = $userRole === 'admin' ? 'admin.social-media' : 'operator.social-media';

            return redirect()->route($routeName, ['page' => $socialMedias->lastPage()]);
        }

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

    public function edit($id)
    {
        $socialMedia = socialMedia::findOrFail($id);
        $units = Unit::all();

        $view = auth()->user()->role === 'admin'
            ? 'admin.content.social-media-admin'
            : 'operator.content.social-media-operator';

        return view($view, compact('socialMedia', 'units'));
    }

    public function update(Request $request, $id)
    {

        $socialMedia = socialMedia::findOrFail($id);

        $validatedData = $request->validate([
            'path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'unit_id' => 'required|exists:units,id',
            'type' => 'required|in:feed,story,reels',
        ]);

        $socialMedia->unit_id = $validatedData['unit_id'];
        $socialMedia->type = $validatedData['type'];

        if ($request->hasFile('path')) {
            if ($socialMedia->path && Storage::disk('public')->exists($socialMedia->path)) {
                Storage::disk('public')->delete($socialMedia->path);
            }

            $socialMedia->path = $request->file('path')->store('social_media', 'public');
        }
        $socialMedia->save();

        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.social-media' : 'operator.social-media')
            ->with('success', 'social media updated successfully!');
    }

    public function destroy($id)
    {

        $socialMedia = socialMedia::findOrFail($id);

        if ($socialMedia->path && Storage::exists($socialMedia->path)) {
            Storage::delete($socialMedia->path);
        }

        $socialMedia->delete();

        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.social-media' : 'operator.social-media')
            ->with('success', 'social media deleted successfully!');
    }
}
