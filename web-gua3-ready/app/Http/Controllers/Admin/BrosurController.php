<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brosur;
use App\Support\BerkasPdf;
use App\Support\GambarWebp;
use Illuminate\Http\Request;

class BrosurController extends Controller
{
    public function index()
    {
        return view('admin.brosur', [
            'brosur' => Brosur::orderBy('kategori')->orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.brosur-form', ['brosur' => null]);
    }

    public function simpan(Request $request)
    {
        $data = $request->validate([
            'kategori' => ['required', 'in:brosur,pricelist'],
            'title' => ['required', 'string', 'max:150'],
            'file' => ['required', 'file', 'mimes:pdf'],
            'cover' => ['nullable', 'image'],
            'description' => ['nullable', 'string'],
            'active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['file'] = BerkasPdf::simpan($request->file('file'), 'brosur');
        $data['cover'] = $request->hasFile('cover')
            ? GambarWebp::simpan($request->file('cover'), 'brosur')
            : null;
        $data['active'] = $request->boolean('active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        Brosur::create($data);

        return redirect()->route('admin.brosur.index')->with('sukses', 'Brosur berhasil ditambahkan.');
    }

    public function edit(Brosur $brosur)
    {
        return view('admin.brosur-form', ['brosur' => $brosur]);
    }

    public function perbarui(Request $request, Brosur $brosur)
    {
        $data = $request->validate([
            'kategori' => ['required', 'in:brosur,pricelist'],
            'title' => ['required', 'string', 'max:150'],
            'file' => ['nullable', 'file', 'mimes:pdf'],
            'cover' => ['nullable', 'image'],
            'description' => ['nullable', 'string'],
            'active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('file')) {
            BerkasPdf::hapus($brosur->file);
            $data['file'] = BerkasPdf::simpan($request->file('file'), 'brosur');
        }
        if ($request->hasFile('cover')) {
            GambarWebp::hapus($brosur->cover);
            $data['cover'] = GambarWebp::simpan($request->file('cover'), 'brosur');
        }

        $data['active'] = $request->boolean('active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $brosur->update($data);

        return redirect()->route('admin.brosur.index')->with('sukses', 'Brosur berhasil diperbarui.');
    }

    public function hapus(Brosur $brosur)
    {
        BerkasPdf::hapus($brosur->file);
        GambarWebp::hapus($brosur->cover);
        $brosur->delete();

        return back()->with('sukses', 'Brosur berhasil dihapus.');
    }
}