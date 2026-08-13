<x-admin-layout judul="Manajemen Brosur / PDF">
    <div class="flex items-center justify-between">
        <p class="text-sm text-muted">{{ $brosur->count() }} berkas</p>
        <a href="{{ route('admin.brosur.create') }}" class="rounded-xl bg-brand-600 hover:bg-brand-700 transition-colors text-white font-semibold text-sm px-5 py-2.5">+ Tambah Berkas</a>
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-muted text-xs uppercase tracking-wide border-b border-line bg-brand-950/5">
                        <th class="py-3 px-5 sm:px-6">Kategori</th>
                        <th class="py-3 px-4">Judul</th>
                        <th class="py-3 px-4">Berkas</th>
                        <th class="py-3 px-4">Urutan</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-5 sm:px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($brosur as $b)
                        <tr class="border-b border-line last:border-0 hover:bg-brand-50/40">
                            <td class="py-3 px-5 sm:px-6">
                                <span class="rounded-full px-2.5 py-1 text-xs font-bold bg-brand-50 text-brand-600 ring-1 ring-brand-100">{{ ucfirst($b->kategori) }}</span>
                            </td>
                            <td class="py-3 px-4 font-semibold text-ink">{{ $b->title }}</td>
                            <td class="py-3 px-4">
                                <a href="{{ asset('storage/' . $b->file) }}" target="_blank" class="text-brand-600 hover:underline text-xs font-semibold">Lihat PDF ↗</a>
                            </td>
                            <td class="py-3 px-4 text-muted">{{ $b->sort_order }}</td>
                            <td class="py-3 px-4">
                                <span class="rounded-full px-2.5 py-1 text-xs font-bold ring-1 {{ $b->active ? 'bg-emerald-50 text-emerald-700 ring-emerald-200' : 'bg-rose-50 text-rose-700 ring-rose-200' }}">
                                    {{ $b->active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="py-3 px-5 sm:px-6">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.brosur.edit', $b) }}" class="text-brand-600 hover:text-brand-700 font-semibold text-xs">Edit</a>
                                    <form method="POST" action="{{ route('admin.brosur.hapus', $b) }}" onsubmit="return confirm('Hapus berkas ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:text-rose-700 font-semibold text-xs">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-muted">Belum ada brosur / pricelist.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>