<x-admin-layout judul="{{ $brosur ? 'Edit ' . $brosur->title : 'Tambah Brosur / PDF' }}">
    <div class="card p-5 sm:p-8 max-w-2xl">
        <form method="POST" action="{{ $brosur ? route('admin.brosur.perbarui', $brosur) : route('admin.brosur.simpan') }}"
              enctype="multipart/form-data" class="space-y-5">
            @csrf
            @if ($brosur)
                @method('PUT')
            @endif

            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Judul *</label>
                <input type="text" name="title" required maxlength="150" value="{{ old('title', $brosur?->title) }}"
                       class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Kategori *</label>
                    <select name="kategori" class="w-full rounded-xl border border-line px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-brand-600">
                        @foreach (['brosur', 'pricelist'] as $k)
                            <option value="{{ $k }}" @selected(old('kategori', $brosur?->kategori ?? 'brosur') === $k)>{{ ucfirst($k) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Urutan</label>
                    <input type="number" min="0" name="sort_order" value="{{ old('sort_order', $brosur?->sort_order ?? 0) }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Berkas PDF <span class="normal-case font-normal">(.pdf{{ $brosur ? '' : ' *' }})</span></label>
                    <input type="file" name="file" accept="application/pdf" @required(!$brosur)
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm bg-white file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-brand-600">
                    @if ($brosur?->file)
                        <p class="text-xs text-muted mt-1">Saat ini: {{ $brosur->file }}</p>
                    @endif
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Gambar Sampul <span class="normal-case font-normal">(opsional, jadi webp)</span></label>
                    <input type="file" name="cover" accept="image/*"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm bg-white file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-brand-600">
                    @if ($brosur?->cover)
                        <p class="text-xs text-muted mt-1">Saat ini: {{ $brosur->cover }}</p>
                    @endif
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Deskripsi</label>
                <textarea name="description" rows="2" class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">{{ old('description', $brosur?->description) }}</textarea>
            </div>

            <label class="flex items-center gap-2 text-sm text-ink font-semibold">
                <input type="checkbox" name="active" value="1" @checked(old('active', $brosur?->active ?? true))
                       class="rounded border-line text-brand-600 focus:ring-brand-600">
                Tampilkan di situs
            </label>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-brand-600 hover:bg-brand-700 transition-colors text-white font-semibold px-6 py-2.5 text-sm">
                    {{ $brosur ? 'Simpan Perubahan' : 'Simpan Berkas' }}
                </button>
                <a href="{{ route('admin.brosur.index') }}" class="text-sm text-muted hover:text-ink font-semibold">Batal</a>
            </div>
        </form>
    </div>
</x-admin-layout>