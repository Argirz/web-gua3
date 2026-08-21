<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prospek;
use App\Models\TipeRumah;
use App\Models\UnitRumah;
use App\Models\Brosur;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        
        if (empty(trim($query))) {
            return view('admin.search', [
                'query' => $query,
                'prospek' => collect(),
                'tipe' => collect(),
                'unit' => collect(),
                'brosur' => collect()
            ]);
        }

        $prospek = Prospek::where('nama_lengkap', 'like', "%{$query}%")
            ->orWhere('nomor_wa', 'like', "%{$query}%")
            ->latest()
            ->take(10)
            ->get();

        $tipe = TipeRumah::where('name', 'like', "%{$query}%")
            ->latest()
            ->take(10)
            ->get();

        $unit = UnitRumah::where('block', 'like', "%{$query}%")
            ->with('tipeRumah')
            ->latest()
            ->take(10)
            ->get();

        $brosur = Brosur::where('title', 'like', "%{$query}%")
            ->latest()
            ->take(10)
            ->get();

        return view('admin.search', compact('query', 'prospek', 'tipe', 'unit', 'brosur'));
    }
}
