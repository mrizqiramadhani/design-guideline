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
        $this->middleware(['auth'])->except(
            'showShafwahGroupPage',
            'showShafwahHolidaysPage',
            'showShafwahPropertyPage',
            'showPrimaryLogosShafwahGroup',
            'showWhiteLogosShafwahGroup',
            'showPrimaryLogosShafwahHolidays',
            'showWhiteLogosShafwahHolidays',
            'showPrimaryLogosShafwahProperty',
            'showWhiteLogosShafwahProperty',
        );;
    }

    // Menampilkan semua logo
    public function index(Request $request)
    {
        // Ambil data logos dengan pagination
        $logos = Logo::with(['logoPhotos', 'unit'])->paginate(3);
        $units = Unit::all();

        // Dapatkan role pengguna
        $userRole = auth()->user()->role;

        // Tentukan view berdasarkan role
        $view = $userRole === 'admin'
            ? 'admin.content.logo-admin'
            : 'operator.content.logo-operator'; // View untuk operator

        // Jika request menggunakan AJAX, hanya kirimkan konten tabel
        if ($request->ajax()) {
            return response()->json([
                'html' => view($view, compact('logos', 'units'))->render()
            ]);
        }

        // Jika bukan AJAX, kembalikan halaman dengan data lengkap
        return view($view, compact('logos', 'units'));
    }



    // Menampilkan form tambah logo
    public function create()
    {
        // Ambil data unit untuk dropdown atau kebutuhan lainnya
        $units = Unit::all();

        // Tentukan view berdasarkan role pengguna
        $view = auth()->user()->role === 'admin'
            ? 'admin.content.logo-admin'
            : 'operator.content.logo-operator';

        // Kembalikan view dengan data unit
        return view($view, compact('units'));
    }

    // Menyimpan logo dan foto
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'unit_id' => 'required|exists:units,id',
            'theme_primary.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'theme_white.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);

        // Menyimpan thumbnail
        $thumbnailPath = $request->file('thumbnail')->store('public/thumbnails');

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

        // Redirect berdasarkan role
        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.logo' : 'operator.logo')
            ->with('success', 'Logo and photos added successfully!');
    }


    // Menampilkan form edit logo
    public function edit($id)
    {
        // Mendapatkan logo dengan relasi logoPhotos dan unit
        $logo = Logo::with(['logoPhotos', 'unit'])->findOrFail($id);

        // Mengambil data theme_primary dan theme_white dari logoPhotos
        $themePrimaryImages = $logo->logoPhotos->where('theme', 'Primary')->values();
        $themeWhiteImages = $logo->logoPhotos->where('theme', 'White')->values();

        // Ambil data unit untuk dropdown
        $units = Unit::all();

        // Tentukan view berdasarkan role pengguna
        $view = auth()->user()->role === 'admin'
            ? 'admin.content.logo-admin'
            : 'operator.content.logo-operator';

        // Cek jika request menggunakan AJAX untuk mengambil data logo
        if (request()->ajax()) {
            return response()->json([
                'title' => $logo->title,
                'unit_id' => $logo->unit_id,
                'thumbnail' => $logo->thumbnail,
                'theme_primary' => $themePrimaryImages,
                'theme_white' => $themeWhiteImages
            ]);
        }

        // Kembalikan view dengan data logo, unit, dan gambar tema
        return view($view, compact('logo', 'units', 'themePrimaryImages', 'themeWhiteImages'));
    }

    // Update logo dan foto
    public function update(Request $request, $id)
    {
        // Mendapatkan logo yang akan diperbarui
        $logo = Logo::findOrFail($id);

        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'unit_id' => 'required|exists:units,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'theme_primary.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'theme_white.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
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

        // Hapus gambar primary yang ditandai untuk dihapus jika ada
        if ($request->filled('delete_primary_ids')) {
            $primaryIds = explode(',', $request->input('delete_primary_ids'));
            LogoPhoto::whereIn('id', $primaryIds)->delete();
        }

        // Update tema primary jika ada file baru
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

        // Hapus gambar white yang ditandai untuk dihapus jika ada
        if ($request->filled('delete_white_ids')) {
            $whiteIds = explode(',', $request->input('delete_white_ids'));
            LogoPhoto::whereIn('id', $whiteIds)->delete();
        }

        // Update tema white jika ada file baru
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

        // Simpan perubahan logo
        $logo->save();

        // Redirect berdasarkan role pengguna
        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.logo' : 'operator.logo')
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

        // Hapus logo dari database
        $logo->delete();

        // Redirect berdasarkan role pengguna
        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.logo' : 'operator.logo')
            ->with('success', 'Logo and photos deleted successfully!');
    }

    public function deleteLogoPhoto($id)
    {
        // Mendapatkan gambar berdasarkan ID
        $logoPhoto = LogoPhoto::findOrFail($id);

        // Cek apakah gambar terkait dengan logo
        if ($logoPhoto) {
            // Hapus file gambar dari storage
            Storage::delete($logoPhoto->path);

            // Hapus entri gambar dari database
            $logoPhoto->delete();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Image not found']);
    }

    public function showShafwahGroupPage()
    {
        // Get the logos for Shafwah Group unit
        $unit = Unit::where('name', 'Shafwah group')->first();
        $logos = Logo::where('unit_id', $unit->id)->get();

        // Pass logos and unit to the view
        return view('shafwah-group.index-sg', compact('logos', 'unit'));
    }

    public function showPrimaryLogosShafwahGroup($id)
    {
        $unit = Unit::where('name', 'Shafwah group')->firstOrFail();

        // Cari logo berdasarkan ID
        $logo = Logo::where('unit_id', $unit->id)
            ->where('id', $id)
            ->with(['logoPhotos' => function ($query) {
                $query->where('theme', 'Primary'); // Filter berdasarkan tema "primary"
            }])
            ->firstOrFail(); // Tidak gunakan firstOrFail() agar tidak 404 jika data tidak ditemukan

        // Jika logo tidak ditemukan, buat response kosong
        if (!$logo) {
            $logo = new Logo(); // Berikan instance kosong agar tetap dapat digunakan di view
            $logo->logoPhotos = collect(); // Pastikan koleksi kosong
        }

        return view('shafwah-group.logo.logo-primary', compact('logo', 'unit'));
    }


    public function showWhiteLogosShafwahGroup($id)
    {
        $unit = Unit::where('name', 'Shafwah group')->firstOrFail();

        // Cari logo berdasarkan ID
        $logo = Logo::where('unit_id', $unit->id)
            ->where('id', $id)
            ->with(['logoPhotos' => function ($query) {
                $query->where('theme', 'White'); // Filter berdasarkan tema "White"
            }])
            ->firstOrFail(); // Tidak gunakan firstOrFail() agar tidak 404 jika data tidak ditemukan

        // Jika logo tidak ditemukan, buat response kosong
        if (!$logo) {
            $logo = new Logo(); // Berikan instance kosong agar tetap dapat digunakan di view
            $logo->logoPhotos = collect(); // Pastikan koleksi kosong
        }

        return view('shafwah-group.logo.logo-white', compact('logo', 'unit'));
    }

    public function showShafwahHolidaysPage()
    {
        // Get the logos for Shafwah Holidays unit
        $unit = Unit::where('name', 'Shafwah holidays')->first();
        $logos = Logo::where('unit_id', $unit->id)->get();

        // Pass logos and unit to the view
        return view('shafwah-holidays.index-sh', compact('logos', 'unit'));
    }

    public function showPrimaryLogosShafwahHolidays($id)
    {
        $unit = Unit::where('name', 'Shafwah holidays')->firstOrFail();

        // Cari logo berdasarkan ID
        $logo = Logo::where('unit_id', $unit->id)
            ->where('id', $id)
            ->with(['logoPhotos' => function ($query) {
                $query->where('theme', 'Primary'); // Filter berdasarkan tema "primary"
            }])
            ->firstOrFail(); // Tidak gunakan firstOrFail() agar tidak 404 jika data tidak ditemukan

        // Jika logo tidak ditemukan, buat response kosong
        if (!$logo) {
            $logo = new Logo(); // Berikan instance kosong agar tetap dapat digunakan di view
            $logo->logoPhotos = collect(); // Pastikan koleksi kosong
        }

        return view('shafwah-holidays.logo.logo-primary', compact('logo', 'unit'));
    }


    public function showWhiteLogosShafwahHolidays($id)
    {
        $unit = Unit::where('name', 'Shafwah holidays')->firstOrFail();

        // Cari logo berdasarkan ID
        $logo = Logo::where('unit_id', $unit->id)
            ->where('id', $id)
            ->with(['logoPhotos' => function ($query) {
                $query->where('theme', 'White'); // Filter berdasarkan tema "White"
            }])
            ->firstOrFail(); // Tidak gunakan firstOrFail() agar tidak 404 jika data tidak ditemukan

        // Jika logo tidak ditemukan, buat response kosong
        if (!$logo) {
            $logo = new Logo(); // Berikan instance kosong agar tetap dapat digunakan di view
            $logo->logoPhotos = collect(); // Pastikan koleksi kosong
        }

        return view('shafwah-holidays.logo.logo-white', compact('logo', 'unit'));
    }

    public function showShafwahPropertyPage()
    {
        // Get the logos for Shafwah Property unit
        $unit = Unit::where('name', 'Shafwah property')->first();
        $logos = Logo::where('unit_id', $unit->id)->get();

        // Pass logos and unit to the view
        return view('shafwah-property.index-srp', compact('logos', 'unit'));
    }

    public function showPrimaryLogosShafwahProperty($id)
    {
        $unit = Unit::where('name', 'Shafwah property')->firstOrFail();

        // Cari logo berdasarkan ID
        $logo = Logo::where('unit_id', $unit->id)
            ->where('id', $id)
            ->with(['logoPhotos' => function ($query) {
                $query->where('theme', 'Primary'); // Filter berdasarkan tema "primary"
            }])
            ->firstOrFail(); // Tidak gunakan firstOrFail() agar tidak 404 jika data tidak ditemukan

        // Jika logo tidak ditemukan, buat response kosong
        if (!$logo) {
            $logo = new Logo(); // Berikan instance kosong agar tetap dapat digunakan di view
            $logo->logoPhotos = collect(); // Pastikan koleksi kosong
        }

        return view('shafwah-property.logo.logo-primary', compact('logo', 'unit'));
    }


    public function showWhiteLogosShafwahProperty($id)
    {
        $unit = Unit::where('name', 'Shafwah property')->firstOrFail();

        // Cari logo berdasarkan ID
        $logo = Logo::where('unit_id', $unit->id)
            ->where('id', $id)
            ->with(['logoPhotos' => function ($query) {
                $query->where('theme', 'White'); // Filter berdasarkan tema "White"
            }])
            ->firstOrFail(); // Tidak gunakan firstOrFail() agar tidak 404 jika data tidak ditemukan

        // Jika logo tidak ditemukan, buat response kosong
        if (!$logo) {
            $logo = new Logo(); // Berikan instance kosong agar tetap dapat digunakan di view
            $logo->logoPhotos = collect(); // Pastikan koleksi kosong
        }

        return view('shafwah-property.logo.logo-white', compact('logo', 'unit'));
    }
}
