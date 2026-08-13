<x-admin-layout judul="Dashboard">
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="card p-5">
            <p class="text-sm text-muted font-medium">Total Prospek</p>
            <p class="text-3xl font-extrabold text-ink mt-1">{{ $totalProspek }}</p>
            <p class="text-xs text-emerald-600 font-semibold mt-1">{{ $prospekBaru }} prospek baru</p>
        </div>
        <div class="card p-5">
            <p class="text-sm text-muted font-medium">Unit Terjual</p>
            <p class="text-3xl font-extrabold text-emerald-600 mt-1">{{ $unitTerjual }}</p>
            <p class="text-xs text-muted mt-1">dari {{ $totalUnit }} total unit</p>
        </div>
        <div class="card p-5">
            <p class="text-sm text-muted font-medium">Unit Dipesan</p>
            <p class="text-3xl font-extrabold text-gold-600 mt-1">{{ $unitDipesan }}</p>
            <p class="text-xs text-muted mt-1">{{ $unitTersedia }} unit tersedia</p>
        </div>
        <div class="card p-5">
            <p class="text-sm text-muted font-medium">Konten</p>
            <p class="text-3xl font-extrabold text-ink mt-1">{{ $totalTipe }}</p>
            <p class="text-xs text-muted mt-1">{{ $totalFoto }} foto · {{ $totalBrosur }} brosur</p>
        </div>
    </div>

    <div class="card p-5 sm:p-6">
        <h2 class="font-display font-semibold text-lg text-ink mb-4">Prospek per Status</h2>
        <div class="flex flex-wrap gap-3">
            @foreach (['baru' => 'Baru', 'dihubungi' => 'Dihubungi', 'deal' => 'Deal', 'gugur' => 'Gugur'] as $kode => $label)
                <span class="rounded-full px-4 py-2 text-sm font-semibold ring-1 {{ $kode === 'baru' ? 'bg-sky-50 text-sky-700 ring-sky-200' : ($kode === 'dihubungi' ? 'bg-gold-50 text-gold-600 ring-gold-200' : ($kode === 'deal' ? 'bg-emerald-50 text-emerald-700 ring-emerald-200' : 'bg-rose-50 text-rose-700 ring-rose-200')) }}">
                    {{ $label }}: <strong>{{ $prospekPerStatus[$kode] ?? 0 }}</strong>
                </span>
            @endforeach
        </div>
    </div>

    <div class="card overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-line flex items-center justify-between">
            <h2 class="font-display font-semibold text-lg text-ink">Prospek Terbaru</h2>
            <a href="{{ route('admin.prospek.index') }}" class="text-sm font-semibold text-brand-600 hover:underline">Kelola semua →</a>
        </div>
        @if ($prospekTerbaru->count())
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-muted text-xs uppercase tracking-wide border-b border-line">
                            <th class="py-3 px-5 sm:px-6">Nama</th>
                            <th class="py-3 px-4">Nomor WA</th>
                            <th class="py-3 px-4">Sumber</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-5 sm:px-6">Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prospekTerbaru as $p)
                            <tr class="border-b border-line last:border-0">
                                <td class="py-3 px-5 sm:px-6 font-semibold text-ink">{{ $p->nama_lengkap }}</td>
                                <td class="py-3 px-4">{{ $p->nomor_wa }}</td>
                                <td class="py-3 px-4">{{ $p->sumber }}</td>
                                <td class="py-3 px-4">
                                    <span class="rounded-full px-2.5 py-1 text-xs font-bold ring-1 ring-current/20 {{ $p->status === 'baru' ? 'bg-sky-50 text-sky-700' : ($p->status === 'deal' ? 'bg-emerald-50 text-emerald-700' : ($p->status === 'gugur' ? 'bg-rose-50 text-rose-700' : 'bg-gold-50 text-gold-600')) }}">
                                        {{ $p->status }}
                                    </span>
                                </td>
                                <td class="py-3 px-5 sm:px-6 text-muted">{{ $p->created_at?->format('d M Y, H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-10 text-center text-muted text-sm">Belum ada prospek. Isi form unduh di situs untuk mulai mengumpulkan lead.</div>
        @endif
    </div>
</x-admin-layout>