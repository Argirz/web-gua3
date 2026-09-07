<x-admin-layout judul="{{ $fotoRumah ? 'Edit Foto' : 'Tambah Foto' }}">
    @php
        $labelKategori = ['unit' => 'Unit', 'serah_terima' => 'Serah Terima', 'siteplan' => 'Siteplan'];
    @endphp
    <div class="card p-5 sm:p-8 max-w-2xl">
        <form method="POST" action="{{ $fotoRumah ? route('admin.foto.perbarui', $fotoRumah) : route('admin.foto.simpan') }}"
              enctype="multipart/form-data" class="space-y-5">
            @csrf
            @if ($fotoRumah)
                @method('PUT')
            @endif

            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Judul *</label>
                <input type="text" name="title" required maxlength="150" value="{{ old('title', $fotoRumah?->title) }}"
                       class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Deskripsi</label>
                <textarea name="description" rows="2" class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">{{ old('description', $fotoRumah?->description) }}</textarea>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Gambar {{ $fotoRumah ? '' : '*' }} <span class="normal-case font-normal">(jpg/png, otomatis jadi webp)</span></label>
                    <input type="file" name="image" accept="image/*" @required(!$fotoRumah)
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm bg-white file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-brand-600">
                    @if ($fotoRumah?->image)
                        <p class="text-xs text-muted mt-1">Saat ini: {{ $fotoRumah->image }}</p>
                    @endif
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Kategori *</label>
                    <select name="kategori" class="w-full rounded-xl border border-line px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-brand-600">
                        @foreach (['unit', 'serah_terima', 'siteplan'] as $k)
                            <option value="{{ $k }}" @selected(old('kategori', $fotoRumah?->kategori ?? 'unit') === $k)>{{ $labelKategori[$k] }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Tipe Rumah <span class="normal-case font-normal">(opsional)</span></label>
                    <select name="tipe_rumah_id" class="w-full rounded-xl border border-line px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-brand-600">
                        <option value="">Tanpa tipe</option>
                        @foreach ($tipe as $t)
                            <option value="{{ $t->id }}" @selected(old('tipe_rumah_id', $fotoRumah?->tipe_rumah_id) == $t->id)>{{ $t->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Urutan</label>
                    <input type="number" min="0" name="sort_order" value="{{ old('sort_order', $fotoRumah?->sort_order ?? 0) }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
            </div>

            <label class="flex items-center gap-2 text-sm text-ink font-semibold">
                <input type="checkbox" name="active" value="1" @checked(old('active', $fotoRumah?->active ?? true))
                       class="rounded border-line text-brand-600 focus:ring-brand-600">
                Tampilkan di situs
            </label>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="btn btn-primary btn-sm px-6">
                    {{ $fotoRumah ? 'Simpan Perubahan' : 'Simpan Foto' }}
                </button>
                <a href="{{ route('admin.foto.index') }}" class="text-sm text-muted hover:text-ink font-semibold">Batal</a>
            </div>
        </form>
    </div>
</x-admin-layout>