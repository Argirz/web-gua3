<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipeRumah;
use App\Support\BerkasPdf;
use App\Support\GambarWebp;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TipeRumahController extends Controller
{
    public function index()
    {
        return view('admin.tipe', [
            'tipe' => TipeRumah::orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.tipe-form', ['tipeRumah' => null]);
    }

    public function simpan(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:tipe_rumah,name'],
            'slug' => ['nullable', 'string', 'max:120'],
            'image' => ['nullable', 'image'],
            'description' => ['nullable', 'string'],
            'land_area' => ['required', 'numeric', 'min:0'],
            'building_area' => ['required', 'numeric', 'min:0'],
            'bedrooms' => ['nullable', 'integer', 'min:1', 'max:20'],
            'bathrooms' => ['nullable', 'integer', 'min:1', 'max:20'],
            'price' => ['required', 'numeric', 'min:0'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'brochure_pdf' => ['nullable', 'file', 'mimes:pdf'],
            'pricelist_pdf' => ['nullable', 'file', 'mimes:pdf'],
            'active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = GambarWebp::simpan($request->file('image'), 'tipe');
        }
        if ($request->hasFile('brochure_pdf')) {
            $data['brochure_pdf'] = BerkasPdf::simpan($request->file('brochure_pdf'), 'tipe');
        }
        if ($request->hasFile('pricelist_pdf')) {
            $data['pricelist_pdf'] = BerkasPdf::simpan($request->file('pricelist_pdf'), 'tipe');
        }

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['active'] = $request->boolean('active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        TipeRumah::create($data);

        return redirect()->route('admin.tipe.index')->with('sukses', 'Tipe ' . $data['name'] . ' berhasil ditambahkan.');
    }

    public function edit(TipeRumah $tipeRumah)
    {
        return view('admin.tipe-form', ['tipeRumah' => $tipeRumah]);
    }

    public function perbarui(Request $request, TipeRumah $tipeRumah)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:tipe_rumah,name,' . $tipeRumah->id],
            'slug' => ['nullable', 'string', 'max:120'],
            'image' => ['nullable', 'image'],
            'description' => ['nullable', 'string'],
            'land_area' => ['required', 'numeric', 'min:0'],
            'building_area' => ['required', 'numeric', 'min:0'],
            'bedrooms' => ['nullable', 'integer', 'min:1', 'max:20'],
            'bathrooms' => ['nullable', 'integer', 'min:1', 'max:20'],
            'price' => ['required', 'numeric', 'min:0'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'brochure_pdf' => ['nullable', 'file', 'mimes:pdf'],
            'pricelist_pdf' => ['nullable', 'file', 'mimes:pdf'],
            'active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('image')) {
            GambarWebp::hapus($tipeRumah->image);
            $data['image'] = GambarWebp::simpan($request->file('image'), 'tipe');
        }
        if ($request->hasFile('brochure_pdf')) {
            BerkasPdf::hapus($tipeRumah->brochure_pdf);
            $data['brochure_pdf'] = BerkasPdf::simpan($request->file('brochure_pdf'), 'tipe');
        }
        if ($request->hasFile('pricelist_pdf')) {
            BerkasPdf::hapus($tipeRumah->pricelist_pdf);
            $data['pricelist_pdf'] = BerkasPdf::simpan($request->file('pricelist_pdf'), 'tipe');
        }

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['active'] = $request->boolean('active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $tipeRumah->update($data);

        return redirect()->route('admin.tipe.index')->with('sukses', 'Tipe ' . $data['name'] . ' berhasil diperbarui.');
    }

    public function ubahHarga(Request $request, TipeRumah $tipeRumah)
    {
        $validated = $request->validate([
            'price' => ['required', 'numeric', 'min:0'],
            'discount' => ['nullable', 'numeric', 'min:0'],
        ]);

        $tipeRumah->update([
            'price' => $validated['price'],
            'discount' => $validated['discount'] ?? 0,
        ]);

        return back()->with('sukses', 'Harga ' . $tipeRumah->name . ' berhasil diperbarui.');
    }

    public function hapus(TipeRumah $tipeRumah)
    {
        if ($tipeRumah->units()->exists()) {
            return back()->withErrors(['tipe' => 'Tipe ini masih memiliki unit, hapus unit terlebih dahulu.']);
        }

        GambarWebp::hapus($tipeRumah->image);
        BerkasPdf::hapus($tipeRumah->brochure_pdf);
        BerkasPdf::hapus($tipeRumah->pricelist_pdf);

        $tipeRumah->delete();

        return back()->with('sukses', 'Tipe rumah berhasil dihapus.');
    }
}