<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logo;
use App\Models\LogoPhoto;
use App\Models\Unit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{

    public function __construct()
    {
        // Memastikan hanya admin dan operator yang dapat mengakses controller ini
        $this->middleware(['auth']);
    }

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
        // Mendapatkan logo dengan relasi logoPhotos dan unit
        $logo = Logo::with(['logoPhotos', 'unit'])->findOrFail($id);

        // Mengambil data theme_primary dan theme_white dari logoPhotos
        $themePrimaryImages = $logo->logoPhotos->where('theme', 'Primary')->values();
        $themeWhiteImages = $logo->logoPhotos->where('theme', 'White')->values();

        // Cek jika request menggunakan AJAX
        if (request()->ajax()) {
            Log::info($logo);
            return response()->json([
                'title' => $logo->title, // Pastikan title dikirim
                'unit_id' => $logo->unit_id,
                'thumbnail' => $logo->thumbnail,
                'theme_primary' => $themePrimaryImages,
                'theme_white' => $themeWhiteImages
            ]);
        }

        // Jika bukan AJAX, arahkan ke halaman lain
        return redirect()->route('admin.logo')->with('error', 'Invalid request');
    }



    public function update(Request $request, $id)
    {
        $logo = Logo::findOrFail($id);

        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'unit_id' => 'required|exists:units,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'theme_primary.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'theme_white.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update title dan unit_id
        $logo->title = $validatedData['title'];
        $logo->unit_id = $validatedData['unit_id'];

        // Update thumbnail jika ada file baru
        if ($request->hasFile('thumbnail')) {
            // Hapus file thumbnail lama jika ada
            if ($logo->thumbnail) {
                Storage::delete($logo->thumbnail);
            }
            // Simpan file thumbnail baru
            $logo->thumbnail = $request->file('thumbnail')->store('public/thumbnails');
        }

        // Update tema primary jika ada file baru
        if ($request->hasFile('theme_primary')) {
            // Hapus semua tema primary lama
            LogoPhoto::where('logo_id', $logo->id)->where('theme', 'Primary')->delete();

            // Simpan tema primary baru
            foreach ($request->file('theme_primary') as $primaryFile) {
                $primaryPath = $primaryFile->store('public/logo_photos');
                LogoPhoto::create([
                    'logo_id' => $logo->id,
                    'path' => $primaryPath,
                    'theme' => 'Primary',
                ]);
            }
        }

        // Update tema white jika ada file baru
        if ($request->hasFile('theme_white')) {
            // Hapus semua tema white lama
            LogoPhoto::where('logo_id', $logo->id)->where('theme', 'White')->delete();

            // Simpan tema white baru
            foreach ($request->file('theme_white') as $whiteFile) {
                $whitePath = $whiteFile->store('public/logo_photos');
                LogoPhoto::create([
                    'logo_id' => $logo->id,
                    'path' => $whitePath,
                    'theme' => 'White',
                ]);
            }
        }

        // Simpan perubahan pada logo
        $logo->save();

        return response()->json([
            'success' => true,
            'message' => 'Logo updated successfully!',
            'logo' => $logo,  // Mengembalikan data logo terbaru
        ]);
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
