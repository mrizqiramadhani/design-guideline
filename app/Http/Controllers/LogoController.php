<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logo;
use App\Models\LogoPhoto;
use App\Models\Unit;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{
    // Menampilkan semua logo
    public function index()
    {
        $logos = Logo::with(['logoPhotos', 'unit'])->get();
        $units = Unit::all();
        return view('admin.content.logo-admin', compact('logos', 'units'));
    }

    // Menampilkan form tambah logo
    public function create()
    {
        $units = Unit::all();
        return view('admin.content.logo-admin', compact('units'));
    }

    // Menyimpan logo dan foto
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'unit_id' => 'required|exists:units,id',
            'theme_primary.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'theme_white.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Menyimpan thumbnail
        $thumbnailPath = $request->file('thumbnail')->store('public/thumbnails');
        // $logo->thumbnail = $thumbnailPath;
        // Menyimpan logo
        $logo = Logo::create([
            'title' => $validatedData['title'],
            'thumbnail' => $thumbnailPath,
            'unit_id' => $validatedData['unit_id'],
            'user_id' => auth()->id(),
        ]);

        // Menyimpan foto dengan tema Primary
        if ($request->hasFile('theme_primary')) {
            foreach ($request->file('theme_primary') as $primaryFile) {
                $primaryPath = $primaryFile->store('public/logo_photos');
                LogoPhoto::create([
                    'logo_id' => $logo->id,
                    'path' => $primaryPath,
                    'theme' => 'Primary',
                ]);
            }
        }

        // Menyimpan foto dengan tema White
        if ($request->hasFile('theme_white')) {
            foreach ($request->file('theme_white') as $whiteFile) {
                $whitePath = $whiteFile->store('public/logo_photos');
                LogoPhoto::create([
                    'logo_id' => $logo->id,
                    'path' => $whitePath,
                    'theme' => 'White',
                ]);
            }
        }

        return redirect()->route('admin.logo')->with('success', 'Logo and photos added successfully!');
    }

    public function edit($id)
    {
        $logo = Logo::with('logoPhotos')->findOrFail($id); // Mendapatkan logo beserta foto-fotonya
        $units = Unit::all(); // Mengambil semua unit untuk dropdown
        return view('admin.content.logo-admin', compact('logo', 'units')); // Mengirim data logo ke view
    }

    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'unit_id' => 'required|exists:units,id', // Memastikan unit_id valid
            'theme_primary.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'theme_white.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Cari logo berdasarkan ID
        $logo = Logo::findOrFail($id);

        // Update thumbnail jika ada file baru
        if ($request->hasFile('thumbnail')) {
            if ($logo->thumbnail) {
                Storage::delete($logo->thumbnail); // Hapus thumbnail lama
            }
            $thumbnailPath = $request->file('thumbnail')->store('public/thumbnails'); // Simpan file thumbnail baru
            $logo->thumbnail = $thumbnailPath; // Perbarui path thumbnail
        }

        // Update logo dengan data yang divalidasi
        $logo->update([
            'title' => $validatedData['title'],
            'unit_id' => $validatedData['unit_id'],
        ]);

        // Update foto tema Primary jika ada
        if ($request->hasFile('theme_primary')) {
            $logo->logoPhotos()->where('theme', 'Primary')->delete(); // Hapus foto Primary lama
            foreach ($request->file('theme_primary') as $primaryFile) {
                $primaryPath = $primaryFile->store('public/logo_photos'); // Simpan foto tema Primary baru
                LogoPhoto::create([
                    'logo_id' => $logo->id,
                    'path' => $primaryPath,
                    'theme' => 'Primary',
                ]);
            }
        }

        // Update foto tema White jika ada
        if ($request->hasFile('theme_white')) {
            $logo->logoPhotos()->where('theme', 'White')->delete(); // Hapus foto White lama
            foreach ($request->file('theme_white') as $whiteFile) {
                $whitePath = $whiteFile->store('public/logo_photos'); // Simpan foto tema White baru
                LogoPhoto::create([
                    'logo_id' => $logo->id,
                    'path' => $whitePath,
                    'theme' => 'White',
                ]);
            }
        }

        // Redirect ke halaman logo dengan pesan sukses
        return redirect()->route('admin.logo')
            ->with('success', 'Logo and photos updated successfully!');
    }

    // Menghapus logo beserta foto-fotonya
    public function destroy($id)
    {
        $logo = Logo::with('logoPhotos')->findOrFail($id);

        // Hapus thumbnail
        Storage::delete($logo->thumbnail);

        // Hapus foto-foto terkait
        foreach ($logo->logoPhotos as $photo) {
            Storage::delete($photo->path);
        }

        $logo->delete();

        return redirect()->route('admin.logo')->with('success', 'Logo and photos deleted successfully!');
    }
}
