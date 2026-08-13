<x-admin-layout judul="Manajemen Foto Rumah">
    <div class="flex items-center justify-between">
        <form method="GET" action="{{ route('admin.foto.index') }}" class="flex items-center gap-2">
            <select name="kategori" onchange="this.form.submit()" class="rounded-xl border border-line px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-brand-600">
                <option value="">Semua kategori</option>
                @foreach (['unit', 'serah_terima', 'siteplan'] as $k)
                    <option value="{{ $k }}" @selected($kategori === $k)>{{ ucfirst($k) }}</option>
                @endforeach
            </select>
            @if ($kategori)
                <a href="{{ route('admin.foto.index') }}" class="text-sm text-muted hover:text-ink font-semibold">Reset</a>
            @endif
        </form>
        <a href="{{ route('admin.foto.create') }}" class="rounded-xl bg-brand-600 hover:bg-brand-700 transition-colors text-white font-semibold text-sm px-5 py-2.5">+ Tambah Foto</a>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($foto as $f)
            <div class="card overflow-hidden">
                <a href="{{ asset($f->image) }}" target="_blank" class="block">
                    <img src="{{ asset($f->image) }}" alt="{{ $f->title }}" loading="lazy" class="w-full h-48 object-cover">
                </a>
                <div class="p-4 sm:p-5">
                    <h3 class="font-semibold text-ink text-sm">{{ $f->title }}</h3>
                    <p class="text-xs text-muted mt-1">
                        {{ ucfirst($f->kategori) }} @if ($f->tipeRumah) · {{ $f->tipeRumah->name }} @endif
                        @if (!$f->active) · <span class="text-rose-600 font-semibold">nonaktif</span> @endif
                    </p>
                    <div class="flex items-center justify-between mt-3 pt-3 border-t border-line">
                        <span class="text-xs text-muted">Urutan {{ $f->sort_order }}</span>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.foto.edit', $f) }}" class="text-brand-600 hover:text-brand-700 font-semibold text-xs">Edit</a>
                            <form method="POST" action="{{ route('admin.foto.hapus', $f) }}" onsubmit="return confirm('Hapus foto ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-700 font-semibold text-xs">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="sm:col-span-2 lg:col-span-3 card p-12 text-center text-muted text-sm">Belum ada foto.</div>
        @endforelse
    </div>
</x-admin-layout>