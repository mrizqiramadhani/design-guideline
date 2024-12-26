<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logo;
use App\Models\LogoPhoto;
use App\Models\Unit;
use App\Models\ColorPalette;
use App\Models\Illustration;
use App\Models\SocialMedia;
use App\Models\Campaign;
use App\Models\Iconography;
use App\Models\Description;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ShowUnitController extends Controller
{
    public function showShafwahGroupPage()
    {
        $unit = Unit::where('name', 'Shafwah group')->first();
        $descriptions = Description::where('unit_id', $unit->id)->get();
        $logos = Logo::where('unit_id', $unit->id)->get();
        $colors = ColorPalette::where('unit_id', $unit->id)->get();
        $illustrations = Illustration::where('unit_id', $unit->id)->get();
        $socialMedias = socialMedia::where('unit_id', $unit->id)->get();
        $campaigns = Campaign::where('unit_id', $unit->id)->get();
        $iconographys = Iconography::where('unit_id', $unit->id)->get();

        return view('shafwah-group.index-sg', compact('logos', 'descriptions', 'unit', 'colors', 'illustrations', 'socialMedias', 'campaigns', 'iconographys'));
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
            ->firstOrFail();

        // Jika logo tidak ditemukan, buat response kosong
        if (!$logo) {
            $logo = new Logo();
            $logo->logoPhotos = collect();
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
            ->firstOrFail();

        // Jika logo tidak ditemukan, buat response kosong
        if (!$logo) {
            $logo = new Logo();
            $logo->logoPhotos = collect();
        }

        return view('shafwah-group.logo.logo-white', compact('logo', 'unit'));
    }

    public function showShafwahHolidaysPage()
    {
        // Get the logos for Shafwah Holidays unit
        $unit = Unit::where('name', 'Shafwah holidays')->first();
        $descriptions = Description::where('unit_id', $unit->id)->get();
        $logos = Logo::where('unit_id', $unit->id)->get();
        $colors = ColorPalette::where('unit_id', $unit->id)->get();
        $illustrations = Illustration::where('unit_id', $unit->id)->get();
        $socialMedias = socialMedia::where('unit_id', $unit->id)->get();
        $campaigns = Campaign::where('unit_id', $unit->id)->get();
        $iconographys = Iconography::where('unit_id', $unit->id)->get();

        // Pass logos and unit to the view
        return view('shafwah-holidays.index-sh', compact('logos', 'descriptions', 'unit', 'colors', 'illustrations', 'socialMedias', 'campaigns', 'iconographys'));
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
            ->firstOrFail();

        // Jika logo tidak ditemukan, buat response kosong
        if (!$logo) {
            $logo = new Logo();
            $logo->logoPhotos = collect();
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
            ->firstOrFail();

        // Jika logo tidak ditemukan, buat response kosong
        if (!$logo) {
            $logo = new Logo();
            $logo->logoPhotos = collect();
        }

        return view('shafwah-holidays.logo.logo-white', compact('logo', 'unit'));
    }

    public function showShafwahPropertyPage()
    {
        // Get the logos for Shafwah Property unit
        $unit = Unit::where('name', 'Shafwah property')->first();
        $descriptions = Description::where('unit_id', $unit->id)->get();
        $logos = Logo::where('unit_id', $unit->id)->get();
        $colors = ColorPalette::where('unit_id', $unit->id)->get();
        $illustrations = Illustration::where('unit_id', $unit->id)->get();
        $socialMedias = socialMedia::where('unit_id', $unit->id)->get();
        $campaigns = Campaign::where('unit_id', $unit->id)->get();
        $iconographys = Iconography::where('unit_id', $unit->id)->get();

        // Pass logos and unit to the view
        return view('shafwah-property.index-srp', compact('logos',  'descriptions', 'unit', 'colors', 'illustrations', 'socialMedias', 'campaigns', 'iconographys'));
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
            ->firstOrFail();

        // Jika logo tidak ditemukan, buat response kosong
        if (!$logo) {
            $logo = new Logo();
            $logo->logoPhotos = collect();
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
            ->firstOrFail();

        // Jika logo tidak ditemukan, buat response kosong
        if (!$logo) {
            $logo = new Logo();
            $logo->logoPhotos = collect();
        }

        return view('shafwah-property.logo.logo-white', compact('logo', 'unit'));
    }

    public function downloadLogos($id)
    {
        $logo = Logo::with('logoPhotos')->findOrFail($id); // Gunakan relasi logoPhotos

        $zip = new ZipArchive();
        $zipFileName = storage_path("app/public/logos_{$id}.zip");

        if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
            if ($logo->logoPhotos) {
                foreach ($logo->logoPhotos as $photo) {
                    if (in_array($photo->theme, ['Primary', 'White'])) {
                        $filePath = storage_path("app/{$photo->path}");
                        $zip->addFile($filePath, basename($photo->path));
                    }
                }
            }
            $zip->close();
        }

        return response()->download($zipFileName)->deleteFileAfterSend(true);
    }
}
