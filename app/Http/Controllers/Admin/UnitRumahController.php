<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipeRumah;
use App\Models\UnitRumah;
use Illuminate\Http\Request;

class UnitRumahController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status', '');

        return view('admin.unit', [
            'unit' => UnitRumah::with('tipeRumah')
                ->when($status !== '' && in_array($status, ['tersedia', 'dipesan', 'terjual'], true), fn ($q) => $q->where('status', $status))
                ->orderBy('block')
                ->get(),
            'tipe' => TipeRumah::orderBy('sort_order')->get(),
            'status' => $status,
            'jumlah' => [
                'semua' => UnitRumah::count(),
                'tersedia' => UnitRumah::where('status', 'tersedia')->count(),
                'dipesan' => UnitRumah::where('status', 'dipesan')->count(),
                'terjual' => UnitRumah::where('status', 'terjual')->count(),
            ],
        ]);
    }

    public function simpan(Request $request)
    {
        $validated = $request->validate([
            'block' => ['required', 'string', 'max:20', 'unique:unit_rumah,block'],
            'unit_type_id' => ['required', 'exists:tipe_rumah,id'],
            'status' => ['required', 'in:tersedia,dipesan,terjual'],
        ]);

        UnitRumah::create($validated);

        return back()->with('sukses', 'Unit ' . $validated['block'] . ' berhasil ditambahkan.');
    }

    public function ubahStatus(Request $request, UnitRumah $unitRumah)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:tersedia,dipesan,terjual'],
        ]);

        $unitRumah->update($validated);

        return back()->with('sukses', 'Status unit ' . $unitRumah->block . ' diperbarui menjadi ' . $validated['status'] . '.');
    }

    public function hapus(UnitRumah $unitRumah)
    {
        $unitRumah->delete();

        return back()->with('sukses', 'Unit ' . $unitRumah->block . ' berhasil dihapus.');
    }
}