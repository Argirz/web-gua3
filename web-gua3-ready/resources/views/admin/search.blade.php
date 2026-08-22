<x-admin-layout judul="Hasil Pencarian">
    <div class="card p-5 mb-6 flex items-center gap-3">
        <svg class="w-5 h-5 text-brand-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        <p class="text-muted">Menampilkan hasil pencarian untuk: <strong class="text-ink">"{{ $query }}"</strong></p>
    </div>

    <div class="space-y-8">
        @if ($prospek->isNotEmpty())
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-display font-semibold text-lg text-ink">Prospek ({{ $prospek->count() }})</h2>
                    <a href="{{ route('admin.prospek.index', ['cari' => $query]) }}" class="text-sm text-brand-600 font-semibold hover:underline">Lihat Semua</a>
                </div>
                <div class="card overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-muted text-xs uppercase tracking-wide border-b border-line bg-brand-950/5">
                                    <th class="py-3 px-5">Nama</th>
                                    <th class="py-3 px-4">Nomor WA</th>
                                    <th class="py-3 px-4">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prospek as $p)
                                    <tr class="border-b border-line last:border-0">
                                        <td class="py-3 px-5 font-semibold text-ink">{{ $p->nama_lengkap }}</td>
                                        <td class="py-3 px-4">{{ $p->nomor_wa }}</td>
                                        <td class="py-3 px-4">
                                            <span class="rounded-full px-2.5 py-1 text-xs font-bold bg-brand-50 text-brand-600 ring-1 ring-brand-100">{{ ucfirst($p->status) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        @if ($tipe->isNotEmpty())
            <div>
                <h2 class="font-display font-semibold text-lg text-ink mb-4">Tipe Rumah ({{ $tipe->count() }})</h2>
                <div class="card overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-muted text-xs uppercase tracking-wide border-b border-line bg-brand-950/5">
                                    <th class="py-3 px-5">Nama Tipe</th>
                                    <th class="py-3 px-4">Harga</th>
                                    <th class="py-3 px-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tipe as $t)
                                    <tr class="border-b border-line last:border-0">
                                        <td class="py-3 px-5 font-semibold text-ink">{{ $t->name }}</td>
                                        <td class="py-3 px-4">Rp {{ number_format($t->price, 0, ',', '.') }}</td>
                                        <td class="py-3 px-4">
                                            <a href="{{ route('admin.tipe.edit', $t) }}" class="text-brand-600 font-semibold text-xs hover:underline">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        @if ($unit->isNotEmpty())
            <div>
                <h2 class="font-display font-semibold text-lg text-ink mb-4">Unit Rumah ({{ $unit->count() }})</h2>
                <div class="card overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-muted text-xs uppercase tracking-wide border-b border-line bg-brand-950/5">
                                    <th class="py-3 px-5">Blok</th>
                                    <th class="py-3 px-4">Tipe</th>
                                    <th class="py-3 px-4">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unit as $u)
                                    <tr class="border-b border-line last:border-0">
                                        <td class="py-3 px-5 font-semibold text-ink">{{ $u->block }}</td>
                                        <td class="py-3 px-4">{{ $u->tipeRumah?->name ?? '-' }}</td>
                                        <td class="py-3 px-4">{{ ucfirst($u->status) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        @if ($brosur->isNotEmpty())
            <div>
                <h2 class="font-display font-semibold text-lg text-ink mb-4">Brosur / Pricelist ({{ $brosur->count() }})</h2>
                <div class="card overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-muted text-xs uppercase tracking-wide border-b border-line bg-brand-950/5">
                                    <th class="py-3 px-5">Judul</th>
                                    <th class="py-3 px-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brosur as $b)
                                    <tr class="border-b border-line last:border-0">
                                        <td class="py-3 px-5 font-semibold text-ink">{{ $b->title }}</td>
                                        <td class="py-3 px-4">
                                            <a href="{{ route('admin.brosur.edit', $b) }}" class="text-brand-600 font-semibold text-xs hover:underline">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        @if ($prospek->isEmpty() && $tipe->isEmpty() && $unit->isEmpty() && $brosur->isEmpty())
            <div class="card p-12 text-center">
                <svg class="w-12 h-12 text-muted mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <h3 class="text-lg font-semibold text-ink">Tidak ada hasil ditemukan</h3>
                <p class="text-sm text-muted mt-1">Coba gunakan kata kunci yang berbeda.</p>
            </div>
        @endif
    </div>
</x-admin-layout>
