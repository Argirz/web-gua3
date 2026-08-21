<?php

namespace App\Http\Controllers;

use App\Models\Brosur;
use App\Models\FotoRumah;
use App\Models\Pengaturan;
use App\Models\SerahTerima;
use App\Models\Spesifikasi;
use App\Models\TipeRumah;
use App\Models\UnitRumah;

class HomeController extends Controller
{
    public function index()
    {
        $tipeRumah = TipeRumah::where('active', true)->orderBy('sort_order')->get();
        $unitRumah = UnitRumah::with('tipeRumah')
            ->orderByRaw('SUBSTRING(block, 1, 1) ASC, CAST(SUBSTRING(block, 2) AS UNSIGNED) ASC')
            ->get();
        $fmtLuas = fn ($v) => $v == (int) $v ? (string) (int) $v : rtrim(number_format($v, 1, '.', ''), '.');

        return view('home', [
            'pengaturan' => Pengaturan::pluck('value', 'key'),
            'foto_rumah' => FotoRumah::where('active', true)->orderBy('sort_order')->get(),
            'serah_terima' => SerahTerima::where('active', true)->orderByDesc('handover_date')->get(),
            'denah' => $tipeRumah->map(fn ($tipe) => (object) [
                'title' => 'Denah ' . $tipe->name,
                'image' => $tipe->image,
                'description' => "{$tipe->bedrooms} Kamar Tidur · {$tipe->bathrooms} Kamar Mandi · Tanah {$fmtLuas($tipe->land_area)} m² · Bangunan {$fmtLuas($tipe->building_area)} m²",
            ]),
            'unit_rumah' => $unitRumah,
            'spesifikasi' => Spesifikasi::orderBy('sort_order')->get()->groupBy('category'),
            'brosur' => Brosur::where('active', true)->orderBy('sort_order')->get(),
            'pricelists' => $tipeRumah->map(fn ($tipe) => (object) [
                'title' => $tipe->name,
                'land_area' => $fmtLuas($tipe->land_area),
                'building_area' => $fmtLuas($tipe->building_area),
                'price' => $tipe->price,
                'discount' => $tipe->discount,
            ]),
            'total_unit' => $unitRumah->count(),
            'prospek_tipe' => $tipeRumah,
            'unit_terjual' => $unitRumah->where('status', 'terjual')->count(),
            'unit_dipesan' => $unitRumah->where('status', 'dipesan')->count(),
            'unit_tersedia' => $unitRumah->where('status', 'tersedia')->count(),
        ]);
    }
}