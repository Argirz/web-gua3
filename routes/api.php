<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    $pengaturan = \App\Models\Pengaturan::pluck('value', 'key');
    $tipeRumah = \App\Models\TipeRumah::where('active', true)->orderBy('sort_order')->get();
    $unitRumah = \App\Models\UnitRumah::with('tipeRumah')->orderBy('block')->get();
    $totalUnit = $unitRumah->count();
    $unitTerjual = $unitRumah->where('status', 'terjual')->count();
    $unitDipesan = $unitRumah->where('status', 'dipesan')->count();
    $unitTersedia = $unitRumah->where('status', 'tersedia')->count();

    $perTipe = $unitRumah->groupBy('tipe')->map(function ($items, $tipe) {
        return [
            'tipe' => $tipe,
            'total' => $items->count(),
            'terjual' => $items->where('status', 'terjual')->count(),
            'dipesan' => $items->where('status', 'dipesan')->count(),
            'tersedia' => $items->where('status', 'tersedia')->count(),
        ];
    })->values();

    return response()->json([
        'pengaturan' => $pengaturan,
        'foto_rumah' => \App\Models\FotoRumah::where('active', true)->orderBy('sort_order')->get(),
        'serah_terima' => \App\Models\SerahTerima::where('active', true)->orderByDesc('handover_date')->get(),
        'denah' => $tipeRumah->map(fn ($tipe) => [
            'title' => 'Denah ' . $tipe->name,
            'image' => $tipe->image,
            'description' => $tipe->description,
        ]),
        'unit_rumah' => $unitRumah,
        'spesifikasi' => \App\Models\Spesifikasi::orderBy('sort_order')->get()->groupBy('category'),
        'brosur' => \App\Models\Brosur::where('active', true)->orderBy('sort_order')->get(),
        'pricelists' => $tipeRumah->map(fn ($tipe) => [
            'title' => $tipe->name,
            'land_area' => $tipe->land_area,
            'building_area' => $tipe->building_area,
            'price' => $tipe->price,
            'discount' => $tipe->discount,
        ]),
        'total_unit' => $totalUnit,
        'unit_terjual' => $unitTerjual,
        'unit_dipesan' => $unitDipesan,
        'unit_tersedia' => $unitTersedia,
        'per_tipe' => $perTipe,
    ]);
});