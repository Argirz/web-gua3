<x-admin-layout judul="{{ $tipeRumah ? 'Edit Tipe ' . $tipeRumah->name : 'Tambah Tipe Rumah' }}">
    <div class="card p-5 sm:p-8 max-w-3xl">
        <form method="POST" action="{{ $tipeRumah ? route('admin.tipe.perbarui', $tipeRumah) : route('admin.tipe.simpan') }}"
              enctype="multipart/form-data" class="space-y-5">
            @csrf
            @if ($tipeRumah)
                @method('PUT')
            @endif

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Nama Tipe *</label>
                    <input type="text" name="name" required maxlength="100" value="{{ old('name', $tipeRumah?->name) }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Slug <span class="normal-case font-normal">(kosongkan = otomatis)</span></label>
                    <input type="text" name="slug" maxlength="120" value="{{ old('slug', $tipeRumah?->slug) }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">{{ old('description', $tipeRumah?->description) }}</textarea>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Luas Tanah (m²) *</label>
                    <input type="number" step="0.01" min="0" name="land_area" required value="{{ old('land_area', $tipeRumah?->land_area) }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Luas Bangunan (m²) *</label>
                    <input type="number" step="0.01" min="0" name="building_area" required value="{{ old('building_area', $tipeRumah?->building_area) }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Kamar Tidur</label>
                    <input type="number" min="1" max="20" name="bedrooms" value="{{ old('bedrooms', $tipeRumah?->bedrooms) }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Kamar Mandi</label>
                    <input type="number" min="1" max="20" name="bathrooms" value="{{ old('bathrooms', $tipeRumah?->bathrooms) }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Harga (Rp) *</label>
                    <input type="number" min="0" name="price" required value="{{ old('price', $tipeRumah?->price) }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Diskon (Rp)</label>
                    <input type="number" min="0" name="discount" value="{{ old('discount', $tipeRumah?->discount) }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Gambar Denah <span class="normal-case font-normal">(jpg/png, otomatis jadi webp)</span></label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm bg-white file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-brand-600">
                    @if ($tipeRumah?->image)
                        <p class="text-xs text-muted mt-1">Saat ini: {{ $tipeRumah->image }}</p>
                    @endif
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Urutan</label>
                    <input type="number" min="0" name="sort_order" value="{{ old('sort_order', $tipeRumah?->sort_order ?? 0) }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">PDF Brosur Tipe</label>
                    <input type="file" name="brochure_pdf" accept="application/pdf"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm bg-white file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-brand-600">
                    @if ($tipeRumah?->brochure_pdf)
                        <p class="text-xs text-muted mt-1">Saat ini: {{ $tipeRumah->brochure_pdf }}</p>
                    @endif
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">PDF Pricelist Tipe</label>
                    <input type="file" name="pricelist_pdf" accept="application/pdf"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm bg-white file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-brand-600">
                    @if ($tipeRumah?->pricelist_pdf)
                        <p class="text-xs text-muted mt-1">Saat ini: {{ $tipeRumah->pricelist_pdf }}</p>
                    @endif
                </div>
            </div>

            <label class="flex items-center gap-2 text-sm text-ink font-semibold">
                <input type="checkbox" name="active" value="1" @checked(old('active', $tipeRumah?->active ?? true))
                       class="rounded border-line text-brand-600 focus:ring-brand-600">
                Tampilkan di situs
            </label>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-brand-600 hover:bg-brand-700 transition-colors text-white font-semibold px-6 py-2.5 text-sm">
                    {{ $tipeRumah ? 'Simpan Perubahan' : 'Simpan Tipe' }}
                </button>
                <a href="{{ route('admin.tipe.index') }}" class="text-sm text-muted hover:text-ink font-semibold">Batal</a>
            </div>
        </form>
    </div>
</x-admin-layout>