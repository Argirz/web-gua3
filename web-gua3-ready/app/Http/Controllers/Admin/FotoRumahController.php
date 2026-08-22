<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FotoRumah;
use App\Models\TipeRumah;
use App\Support\GambarWebp;
use Illuminate\Http\Request;

class FotoRumahController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.foto', [
            'foto' => FotoRumah::with('tipeRumah')
                ->when($request->filled('kategori'), fn ($q) => $q->where('kategori', $request->input('kategori')))
                ->orderBy('sort_order')
                ->get(),
            'kategori' => $request->input('kategori', ''),
            'tipe' => TipeRumah::orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.foto-form', ['fotoRumah' => null, 'tipe' => TipeRumah::orderBy('sort_order')->get()]);
    }

    public function simpan(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'image' => ['required', 'image'],
            'kategori' => ['required', 'in:unit,serah_terima,siteplan'],
            'tipe_rumah_id' => ['nullable', 'exists:tipe_rumah,id'],
            'active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['image'] = GambarWebp::simpan($request->file('image'), 'galeri');
        $data['active'] = $request->boolean('active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        FotoRumah::create($data);

        return redirect()->route('admin.foto.index')->with('sukses', 'Foto rumah berhasil ditambahkan.');
    }

    public function edit(FotoRumah $fotoRumah)
    {
        return view('admin.foto-form', ['fotoRumah' => $fotoRumah, 'tipe' => TipeRumah::orderBy('sort_order')->get()]);
    }

    public function perbarui(Request $request, FotoRumah $fotoRumah)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image'],
            'kategori' => ['required', 'in:unit,serah_terima,siteplan'],
            'tipe_rumah_id' => ['nullable', 'exists:tipe_rumah,id'],
            'active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('image')) {
            GambarWebp::hapus($fotoRumah->image);
            $data['image'] = GambarWebp::simpan($request->file('image'), 'galeri');
        }

        $data['active'] = $request->boolean('active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $fotoRumah->update($data);

        return redirect()->route('admin.foto.index')->with('sukses', 'Foto rumah berhasil diperbarui.');
    }

    public function hapus(FotoRumah $fotoRumah)
    {
        GambarWebp::hapus($fotoRumah->image);
        $fotoRumah->delete();

        return back()->with('sukses', 'Foto rumah berhasil dihapus.');
    }
}