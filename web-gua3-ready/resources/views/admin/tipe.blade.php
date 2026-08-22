<x-admin-layout judul="Manajemen Tipe Rumah">
    @php
        $fmtLuas = fn ($v) => $v == (int) $v ? (int) $v : rtrim(rtrim(number_format($v, 1, '.', ''), '0'), '.');
    @endphp
    <x-slot name="headerAction">
        <a href="{{ route('admin.tipe.create') }}" class="btn bg-white text-brand-900 hover:bg-brand-50 shadow-sm text-sm px-4 py-2">+ Tambah Tipe</a>
    </x-slot>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-muted text-xs uppercase tracking-wide border-b border-line bg-brand-950/5">
                        <th class="py-3 px-5 sm:px-6">Nama</th>
                        <th class="py-3 px-4">Luas</th>
                        <th class="py-3 px-4">Kamar</th>
                        <th class="py-3 px-4">Harga &amp; Diskon (Rp)</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-5 sm:px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tipe as $t)
                        <tr class="border-b border-line last:border-0 hover:bg-brand-50/40">
                            <td class="py-3 px-5 sm:px-6 font-semibold text-ink">
                                {{ $t->name }}
                                @if ($t->image)
                                    <a href="{{ asset($t->image) }}" target="_blank" class="text-xs text-brand-600 hover:underline ml-2">denah ↗</a>
                                @endif
                            </td>
                            <td class="py-3 px-4 whitespace-nowrap">{{ $fmtLuas($t->land_area) }} / {{ $fmtLuas($t->building_area) }} m²</td>
                            <td class="py-3 px-4 whitespace-nowrap">{{ $t->bedrooms ?? '-' }} KT / {{ $t->bathrooms ?? '-' }} KM</td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <form method="POST" action="{{ route('admin.tipe.harga', $t) }}" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="price" value="{{ $t->price }}" min="0" step="100000"
                                           title="Harga" class="w-28 rounded-lg border border-line px-2 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-brand-600">
                                    <input type="number" name="discount" value="{{ $t->discount }}" min="0" step="100000"
                                           title="Diskon" class="w-28 rounded-lg border border-line px-2 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-brand-600">
                                    <button type="submit" class="btn btn-primary btn-sm px-3 py-1.5 text-xs">Simpan</button>
                                </form>
                            </td>
                            <td class="py-3 px-4">
                                <span class="rounded-full px-2.5 py-1 text-xs font-bold ring-1 {{ $t->active ? 'bg-emerald-50 text-emerald-700 ring-emerald-200' : 'bg-rose-50 text-rose-700 ring-rose-200' }}">
                                    {{ $t->active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="py-3 px-5 sm:px-6">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.tipe.edit', $t) }}" class="text-brand-600 hover:text-brand-700 font-semibold text-xs">Edit</a>
                                    <form method="POST" action="{{ route('admin.tipe.hapus', $t) }}" onsubmit="return confirm('Hapus tipe {{ $t->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:text-rose-700 font-semibold text-xs">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-muted">Belum ada tipe rumah.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>