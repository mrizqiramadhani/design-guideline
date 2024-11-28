<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logo;
use App\Models\LogoPhoto;
use App\Models\Unit;
use App\Models\ColorPalette;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ShowUnitController extends Controller
{
    public function showShafwahGroupPage()
    {
        // Get the logos for Shafwah Group unit
        $unit = Unit::where('name', 'Shafwah group')->first();
        $logos = Logo::where('unit_id', $unit->id)->get();
        $colors = ColorPalette::where('unit_id', $unit->id)->get();

        // Pass logos and unit to the view
        return view('shafwah-group.index-sg', compact('logos', 'unit','colors'));
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
        $logos = Logo::where('unit_id', $unit->id)->get();
        $colors = ColorPalette::where('unit_id', $unit->id)->get();

        // Pass logos and unit to the view
        return view('shafwah-holidays.index-sh', compact('logos', 'unit', 'colors'));
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
        $logos = Logo::where('unit_id', $unit->id)->get();
        $colors = ColorPalette::where('unit_id', $unit->id)->get();

        // Pass logos and unit to the view
        return view('shafwah-property.index-srp', compact('logos', 'unit', 'colors'));
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

}
