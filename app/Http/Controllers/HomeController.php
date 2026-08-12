<?php

namespace App\Http\Controllers;

use App\Models\Brochure;
use App\Models\GalleryItem;
use App\Models\Handover;
use App\Models\Pricelist;
use App\Models\Setting;
use App\Models\Siteplan;
use App\Models\Specification;
use App\Models\Unit;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'settings' => Setting::pluck('value', 'key'),
            'galleries' => GalleryItem::where('active', true)->orderBy('sort_order')->get(),
            'handovers' => Handover::where('active', true)->orderByDesc('handover_date')->get(),
            'siteplans' => Siteplan::where('active', true)->orderBy('sort_order')->get(),
            'units' => Unit::orderBy('block')->get(),
            'specifications' => Specification::orderBy('sort_order')->get()->groupBy('category'),
            'brochures' => Brochure::where('active', true)->orderBy('sort_order')->get(),
            'pricelists' => Pricelist::where('active', true)->orderBy('sort_order')->get(),
            'totalUnits' => Unit::count(),
            'soldUnits' => Unit::where('status', 'terjual')->count(),
            'bookedUnits' => Unit::where('status', 'dipesan')->count(),
            'availableUnits' => Unit::where('status', 'tersedia')->count(),
        ]);
    }
}