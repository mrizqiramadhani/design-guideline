<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan daftar campaign dengan pagination
        $campaigns = Campaign::paginate(4);
        $units = Unit::all();

        $userRole = auth()->user()->role;

        // Menentukan view yang akan digunakan berdasarkan role
        $view = $userRole === 'admin'
            ? 'admin.content.campaign-admin'
            : 'operator.content.campaign-operator';

        // Pengecekan untuk memastikan pagination tidak melewati batas
        if ($campaigns->currentPage() > $campaigns->lastPage()) {
            $routeName = $userRole === 'admin' ? 'admin.campaign' : 'operator.campaign';

            return redirect()->route($routeName, ['page' => $campaigns->lastPage()]);
        }

        // Mengirimkan data campaign dan unit ke view
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
        // Validasi data input dari form
        $validatedData = $request->validate([
            'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'unit_id' => 'required|exists:units,id',
            'status' => 'required|in:publish,private', // Menambahkan validasi status
        ]);

        // Menyimpan gambar campaign ke folder 'campaigns' di storage publik
        $campaignPath = $request->file('path')->store('campaigns', 'public');

        // Membuat record baru di tabel campaign
        Campaign::create([
            'path' => $campaignPath,
            'unit_id' => $validatedData['unit_id'],
            'user_id' => auth()->id(),
            'status' => $validatedData['status'], // Menyimpan status campaign
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

        // Validasi data input
        $validatedData = $request->validate([
            'unit_id' => 'required|exists:units,id',
            'path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'status' => 'required|in:publish,private', // Menambahkan validasi status
        ]);

        // Memperbarui unit_id dan status campaign
        $campaign->unit_id = $validatedData['unit_id'];
        $campaign->status = $validatedData['status']; // Memperbarui status campaign

        // Jika ada file gambar baru, simpan dan hapus yang lama jika ada
        if ($request->hasFile('path')) {
            if ($campaign->path && Storage::disk('public')->exists($campaign->path)) {
                Storage::disk('public')->delete($campaign->path);
            }

            // Menyimpan gambar campaign baru
            $campaign->path = $request->file('path')->store('campaigns', 'public');
        }

        // Menyimpan perubahan campaign ke database
        $campaign->save();

        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.campaign' : 'operator.campaign')
            ->with('success', 'Campaign updated successfully!');
    }

    public function destroy($id)
    {
        $campaign = Campaign::findOrFail($id);

        // Menghapus file gambar campaign dari storage jika ada
        if ($campaign->path && Storage::disk('public')->exists($campaign->path)) {
            Storage::disk('public')->delete($campaign->path);
        }

        // Menghapus data campaign dari database
        $campaign->delete();

        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.campaign' : 'operator.campaign')
            ->with('success', 'Campaign deleted successfully!');
    }
}
