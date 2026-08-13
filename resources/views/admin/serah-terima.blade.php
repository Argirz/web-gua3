<x-admin-layout judul="Manajemen Serah Terima Kunci">
    <div class="flex items-center justify-between">
        <p class="text-sm text-muted">{{ $serahTerima->count() }} dokumentasi serah terima</p>
        <a href="{{ route('admin.serah_terima.create') }}" class="rounded-xl bg-brand-600 hover:bg-brand-700 transition-colors text-white font-semibold text-sm px-5 py-2.5">+ Tambah Serah Terima</a>
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-muted text-xs uppercase tracking-wide border-b border-line bg-brand-950/5">
                        <th class="py-3 px-5 sm:px-6">Foto</th>
                        <th class="py-3 px-4">Konsumen</th>
                        <th class="py-3 px-4">Unit</th>
                        <th class="py-3 px-4">Tanggal Serah Terima</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-5 sm:px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($serahTerima as $s)
                        <tr class="border-b border-line last:border-0 hover:bg-brand-50/40">
                            <td class="py-3 px-5 sm:px-6">
                                <a href="{{ asset($s->image) }}" target="_blank" class="block">
                                    <img src="{{ asset($s->image) }}" alt="{{ $s->customer ?? 'Serah terima' }}" loading="lazy"
                                         class="w-16 h-12 object-cover rounded-lg ring-1 ring-line">
                                </a>
                            </td>
                            <td class="py-3 px-4 font-semibold text-ink">{{ $s->customer ?? '-' }}</td>
                            <td class="py-3 px-4 text-muted">{{ $s->unit ? 'Unit ' . $s->unit : '-' }}</td>
                            <td class="py-3 px-4 whitespace-nowrap">{{ $s->handover_date?->format('d M Y') ?? '-' }}</td>
                            <td class="py-3 px-4">
                                <span class="rounded-full px-2.5 py-1 text-xs font-bold ring-1 {{ $s->active ? 'bg-emerald-50 text-emerald-700 ring-emerald-200' : 'bg-rose-50 text-rose-700 ring-rose-200' }}">
                                    {{ $s->active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="py-3 px-5 sm:px-6">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.serah_terima.edit', $s) }}" class="text-brand-600 hover:text-brand-700 font-semibold text-xs">Edit</a>
                                    <form method="POST" action="{{ route('admin.serah_terima.hapus', $s) }}" onsubmit="return confirm('Hapus dokumentasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:text-rose-700 font-semibold text-xs">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-muted">Belum ada dokumentasi serah terima kunci.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>