<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    $settings = \App\Models\Setting::pluck('value', 'key');
    $units = \App\Models\Unit::orderBy('block')->get();
    $totalUnits = $units->count();
    $soldUnits = $units->where('status', 'terjual')->count();
    $bookedUnits = $units->where('status', 'dipesan')->count();
    $availableUnits = $units->where('status', 'tersedia')->count();

    $perTipe = $units->groupBy('type')->map(function ($items, $type) {
        return [
            'type' => $type,
            'total' => $items->count(),
            'terjual' => $items->where('status', 'terjual')->count(),
            'dipesan' => $items->where('status', 'dipesan')->count(),
            'tersedia' => $items->where('status', 'tersedia')->count(),
        ];
    })->values();

    return response()->json([
        'settings' => $settings,
        'galleries' => \App\Models\GalleryItem::where('active', true)->orderBy('sort_order')->get(),
        'handovers' => \App\Models\Handover::where('active', true)->orderByDesc('handover_date')->get(),
        'siteplans' => \App\Models\Siteplan::where('active', true)->orderBy('sort_order')->get(),
        'units' => $units,
        'specifications' => \App\Models\Specification::orderBy('sort_order')->get()->groupBy('category'),
        'brochures' => \App\Models\Brochure::where('active', true)->orderBy('sort_order')->get(),
        'pricelists' => \App\Models\Pricelist::where('active', true)->orderBy('sort_order')->get(),
        'totalUnits' => $totalUnits,
        'soldUnits' => $soldUnits,
        'bookedUnits' => $bookedUnits,
        'availableUnits' => $availableUnits,
        'perTipe' => $perTipe,
    ]);
});