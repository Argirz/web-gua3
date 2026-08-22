<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SerahTerima;
use App\Models\UnitRumah;
use App\Support\GambarWebp;
use Illuminate\Http\Request;

class SerahTerimaController extends Controller
{
    public function index()
    {
        return view('admin.serah-terima', [
            'serahTerima' => SerahTerima::with('unitRumah')
                ->orderByDesc('handover_date')
                ->orderBy('sort_order')
                ->get(),
        ]);
    }

    public function create()
    {
        return view('admin.serah-terima-form', [
            'serahTerima' => null,
            'unit' => UnitRumah::orderBy('block')->get(),
        ]);
    }

    public function simpan(Request $request)
    {
        $data = $request->validate([
            'customer' => ['nullable', 'string', 'max:150'],
            'unit_rumah_id' => ['nullable', 'exists:unit_rumah,id'],
            'image' => ['required', 'image'],
            'caption' => ['nullable', 'string', 'max:255'],
            'handover_date' => ['nullable', 'date'],
            'active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['image'] = GambarWebp::simpan($request->file('image'), 'serah-terima');
        $data['active'] = $request->boolean('active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        SerahTerima::create($data);

        return redirect()->route('admin.serah_terima.index')->with('sukses', 'Serah terima kunci berhasil ditambahkan.');
    }

    public function edit(SerahTerima $serahTerima)
    {
        return view('admin.serah-terima-form', [
            'serahTerima' => $serahTerima,
            'unit' => UnitRumah::orderBy('block')->get(),
        ]);
    }

    public function perbarui(Request $request, SerahTerima $serahTerima)
    {
        $data = $request->validate([
            'customer' => ['nullable', 'string', 'max:150'],
            'unit_rumah_id' => ['nullable', 'exists:unit_rumah,id'],
            'image' => ['nullable', 'image'],
            'caption' => ['nullable', 'string', 'max:255'],
            'handover_date' => ['nullable', 'date'],
            'active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('image')) {
            GambarWebp::hapus($serahTerima->image);
            $data['image'] = GambarWebp::simpan($request->file('image'), 'serah-terima');
        }

        $data['active'] = $request->boolean('active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $serahTerima->update($data);

        return redirect()->route('admin.serah_terima.index')->with('sukses', 'Serah terima kunci berhasil diperbarui.');
    }

    public function hapus(SerahTerima $serahTerima)
    {
        GambarWebp::hapus($serahTerima->image);
        $serahTerima->delete();

        return back()->with('sukses', 'Serah terima kunci berhasil dihapus.');
    }
}