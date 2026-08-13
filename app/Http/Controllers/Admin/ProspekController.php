<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prospek;
use Illuminate\Http\Request;

class ProspekController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.prospek', [
            'prospek' => $this->queryProspek($request)->paginate(20)->withQueryString(),
            'status' => $request->input('status', ''),
            'dari' => $request->input('dari', ''),
            'sampai' => $request->input('sampai', ''),
            'cari' => $request->input('cari', ''),
        ]);
    }

    public function ubahStatus(Request $request, Prospek $prospek)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:baru,dihubungi,deal,gugur'],
        ]);

        $prospek->update($validated);

        return back()->with('sukses', 'Status prospek berhasil diperbarui.');
    }

    public function hapus(Prospek $prospek)
    {
        $prospek->delete();

        return back()->with('sukses', 'Prospek berhasil dihapus.');
    }

    public function export(Request $request)
    {
        $baris = [['ID', 'Nama Lengkap', 'Nomor WA', 'Tipe Rumah', 'Sumber', 'Status', 'Dibuat']];

        foreach ($this->queryProspek($request)->get() as $p) {
            $baris[] = [
                $p->id,
                $p->nama_lengkap,
                $p->nomor_wa,
                $p->tipeRumah?->name ?? '-',
                $p->sumber,
                $p->status,
                $p->created_at?->format('d/m/Y H:i') ?? '-',
            ];
        }

        $stream = fopen('php://temp', 'w+');
        fwrite($stream, "\xEF\xBB\xBF");

        foreach ($baris as $b) {
            fputcsv($stream, $b);
        }

        rewind($stream);
        $isi = stream_get_contents($stream);
        fclose($stream);

        return response($isi, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="prospek-' . now()->format('Y-m-d-Hi') . '.csv"',
        ]);
    }

    private function queryProspek(Request $request)
    {
        return Prospek::query()
            ->with('tipeRumah')
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->input('status')))
            ->when($request->filled('dari'), fn ($q) => $q->whereDate('created_at', '>=', $request->input('dari')))
            ->when($request->filled('sampai'), fn ($q) => $q->whereDate('created_at', '<=', $request->input('sampai')))
            ->when($request->filled('cari'), fn ($q) => $q->where(fn ($q2) => $q2
                ->where('nama_lengkap', 'like', '%' . $request->input('cari') . '%')
                ->orWhere('nomor_wa', 'like', '%' . $request->input('cari') . '%')))
            ->orderByDesc('created_at');
    }
}