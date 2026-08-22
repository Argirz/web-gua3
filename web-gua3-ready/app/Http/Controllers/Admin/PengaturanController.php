<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    private const KUNCI = [
        'nama_perumahan' => 'Nama Perumahan',
        'nama_perusahaan' => 'Nama Perusahaan',
        'tagline' => 'Tagline',
        'alamat' => 'Alamat',
        'kabupaten' => 'Kabupaten / Kota',
        'telepon' => 'Telepon',
        'whatsapp' => 'Nomor WhatsApp',
        'email' => 'Email',
        'jam_operasional' => 'Jam Operasional',
        'deskripsi' => 'Deskripsi',
        'instagram' => 'Instagram',
    ];

    public function edit()
    {
        return view('admin.pengaturan', [
            'kunci' => self::KUNCI,
            'nilai' => Pengaturan::pluck('value', 'key'),
        ]);
    }

    public function perbarui(Request $request)
    {
        foreach (self::KUNCI as $kunci => $label) {
            Pengaturan::updateOrCreate(
                ['key' => $kunci],
                ['value' => $request->input($kunci, '')]
            );
        }

        return back()->with('sukses', 'Pengaturan berhasil disimpan.');
    }
}