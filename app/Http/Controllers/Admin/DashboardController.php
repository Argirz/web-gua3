<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brosur;
use App\Models\FotoRumah;
use App\Models\Prospek;
use App\Models\TipeRumah;
use App\Models\UnitRumah;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalProspek' => Prospek::count(),
            'prospekBaru' => Prospek::where('status', 'baru')->count(),
            'prospekPerStatus' => Prospek::selectRaw('status, COUNT(*) as total')->groupBy('status')->pluck('total', 'status'),
            'totalUnit' => UnitRumah::count(),
            'unitTerjual' => UnitRumah::where('status', 'terjual')->count(),
            'unitDipesan' => UnitRumah::where('status', 'dipesan')->count(),
            'unitTersedia' => UnitRumah::where('status', 'tersedia')->count(),
            'totalTipe' => TipeRumah::count(),
            'totalFoto' => FotoRumah::count(),
            'totalBrosur' => Brosur::count(),
            'prospekTerbaru' => Prospek::with('tipeRumah')->orderByDesc('created_at')->limit(6)->get(),
        ]);
    }
}