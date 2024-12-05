<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    public function index(Request $request)
    {

        $campaigns = Campaign::paginate(4);
        $units = Unit::all();

        $userRole = auth()->user()->role;

        $view = $userRole === 'admin'
            ? 'admin.content.campaign-admin'
            : 'operator.content.campaign-operator';

        if ($campaigns->currentPage() > $campaigns->lastPage()) {
            $routeName = $userRole === 'admin' ? 'admin.campaign' : 'operator.campaign';

            return redirect()->route($routeName, ['page' => $campaigns->lastPage()]);
        }

        return view($view, compact('campaigns', 'units'));
    }

    public function create()
    {

        $units = Unit::all();

        $view = auth()->user()->role === 'admin'
            ? 'admin.content.campaign-admin'
            : 'operator.content.campaign-operator';

        return view($view, compact('units'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'unit_id' => 'required|exists:units,id',

        ]);

        $campaignPath = $request->file('path')->store('campaigns', 'public');

        Campaign::create([
            'path' => $campaignPath,
            'unit_id' => $validatedData['unit_id'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.campaign' : 'operator.campaign')
            ->with('success', 'Campaign added successfully!');
    }

    public function edit($id)
    {

        $campaign = Campaign::findOrFail($id);
        $units = Unit::all();

        $view = auth()->user()->role === 'admin'
            ? 'admin.content.campaign-admin'
            : 'operator.content.campaign-operator';

        return view($view, compact('campaign', 'units'));
    }

    public function update(Request $request, $id)
    {

        $campaign = Campaign::findOrFail($id);

        $validatedData = $request->validate([
            'unit_id' => 'required|exists:units,id',
            'path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);

        $campaign->unit_id = $validatedData['unit_id'];

        if ($request->hasFile('path')) {
            if ($campaign->path && Storage::disk('public')->exists($campaign->path)) {
                Storage::disk('public')->delete($campaign->path);
            }

            $campaign->path = $request->file('path')->store('campaigns', 'public');
        }
        $campaign->save();

        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.campaign' : 'operator.campaign')
            ->with('success', 'Campaign updated successfully!');
    }

    public function destroy($id)
    {


        $Campaign = Campaign::findOrFail($id);

        if ($Campaign->path && Storage::exists($Campaign->path)) {
            Storage::delete($Campaign->path);
        }

        $Campaign->delete();

        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.campaign' : 'operator.campaign')
            ->with('success', 'Illustration deleted successfully!');
    }
}
