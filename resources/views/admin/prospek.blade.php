<x-admin-layout judul="Manajemen Prospek">
    <div class="card p-5 sm:p-6">
        <form method="GET" action="{{ route('admin.prospek.index') }}" class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5 items-end">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Status</label>
                <select name="status" class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                    <option value="">Semua</option>
                    @foreach (['baru', 'dihubungi', 'deal', 'gugur'] as $s)
                        <option value="{{ $s }}" @selected($status === $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Dari Tanggal</label>
                <input type="date" name="dari" value="{{ $dari }}" class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Sampai Tanggal</label>
                <input type="date" name="sampai" value="{{ $sampai }}" class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Cari Nama / WA</label>
                <input type="text" name="cari" value="{{ $cari }}" placeholder="contoh: Budi, 0812..." class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm w-full sm:w-auto">Filter</button>
                @if ($status || $dari || $sampai || $cari)
                    <a href="{{ route('admin.prospek.index') }}" class="rounded-xl ring-1 ring-line px-4 py-2.5 text-sm font-semibold text-muted hover:text-ink transition-colors">Reset</a>
                @endif
            </div>
        </form>

        <div class="mt-5 flex items-center justify-between">
            <p class="text-sm text-muted">{{ $prospek->total() }} prospek ditemukan</p>
            <a href="{{ route('admin.prospek.export', request()->only(['status', 'dari', 'sampai', 'cari'])) }}"
               class="btn btn-sm bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200 hover:bg-emerald-100 transition-colors inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                Export Excel (CSV)
            </a>
        </div>
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-muted text-xs uppercase tracking-wide border-b border-line bg-brand-950/5">
                        <th class="py-3 px-5 sm:px-6">Nama</th>
                        <th class="py-3 px-4">Nomor WA</th>
                        <th class="py-3 px-4">Tipe</th>
                        <th class="py-3 px-4">Sumber</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Dibuat</th>
                        <th class="py-3 px-5 sm:px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($prospek as $p)
                        <tr class="border-b border-line last:border-0 hover:bg-brand-50/40">
                            <td class="py-3 px-5 sm:px-6 font-semibold text-ink">{{ $p->nama_lengkap }}</td>
                            <td class="py-3 px-4">{{ $p->nomor_wa }}</td>
                            <td class="py-3 px-4 text-muted">{{ $p->tipeRumah?->name ?? '-' }}</td>
                            <td class="py-3 px-4">
                                <span class="rounded-full px-2.5 py-1 text-xs font-bold bg-brand-50 text-brand-600 ring-1 ring-brand-100">{{ ['brosur' => 'Brosur / Iklan', 'sosmed' => 'Media Sosial', 'kontak' => 'Kontak / Referensi'][$p->sumber] ?? $p->sumber }}</span>
                            </td>
                            <td class="py-3 px-4">
                                <form method="POST" action="{{ route('admin.prospek.status', $p) }}" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="rounded-lg border border-line px-2 py-1.5 text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-brand-600 bg-white">
                                        @foreach (['baru', 'dihubungi', 'deal', 'gugur'] as $s)
                                            <option value="{{ $s }}" @selected($p->status === $s)>{{ ucfirst($s) }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td class="py-3 px-4 text-muted whitespace-nowrap">{{ $p->created_at?->format('d M Y, H:i') }}</td>
                            <td class="py-3 px-5 sm:px-6 text-right">
                                <form method="POST" action="{{ route('admin.prospek.hapus', $p) }}" onsubmit="return confirm('Hapus prospek ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-600 hover:text-rose-700 font-semibold text-xs">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-muted">Tidak ada prospek dengan filter ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($prospek->hasPages())
            <div class="px-5 sm:px-6 py-4 border-t border-line">{{ $prospek->links() }}</div>
        @endif
    </div>
</x-admin-layout>