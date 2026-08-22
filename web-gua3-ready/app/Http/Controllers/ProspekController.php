<?php

namespace App\Http\Controllers;

use App\Models\Prospek;
use Illuminate\Http\Request;

class ProspekController extends Controller
{
    public function store(Request $request)
    {
        if ($request->filled('website')) {
            return response()->json(['sukses' => true]);
        }

        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:100'],
            'nomor_wa' => ['required', 'string', 'regex:/^(08|62)[0-9]{8,12}$/'],
            'tipe_rumah_id' => ['nullable', 'integer', 'exists:tipe_rumah,id'],
            'sumber' => ['required', 'in:brosur,sosmed,kontak'],
        ]);

        $prospek = Prospek::create($validated);

        return response()->json(['sukses' => true, 'prospek' => $prospek]);
    }
}