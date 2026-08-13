<x-admin-layout judul="{{ $serahTerima ? 'Edit Serah Terima' : 'Tambah Serah Terima' }}">
    <div class="card p-5 sm:p-8 max-w-2xl">
        <form method="POST" action="{{ $serahTerima ? route('admin.serah_terima.perbarui', $serahTerima) : route('admin.serah_terima.simpan') }}"
              enctype="multipart/form-data" class="space-y-5">
            @csrf
            @if ($serahTerima)
                @method('PUT')
            @endif

            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Foto Serah Terima {{ $serahTerima ? '' : '*' }} <span class="normal-case font-normal">(jpg/png, otomatis jadi webp)</span></label>
                <input type="file" name="image" accept="image/*" @required(!$serahTerima)
                       class="w-full rounded-xl border border-line px-3 py-2 text-sm bg-white file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-brand-600">
                @if ($serahTerima?->image)
                    <p class="text-xs text-muted mt-1">Saat ini: {{ $serahTerima->image }}</p>
                @endif
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Nama Konsumen</label>
                    <input type="text" name="customer" maxlength="150" value="{{ old('customer', $serahTerima?->customer) }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Unit Rumah <span class="normal-case font-normal">(opsional)</span></label>
                    <select name="unit_rumah_id" class="w-full rounded-xl border border-line px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-brand-600">
                        <option value="">— Tanpa unit —</option>
                        @foreach ($unit as $u)
                            <option value="{{ $u->id }}" @selected(old('unit_rumah_id', $serahTerima?->unit_rumah_id) == $u->id)>Unit {{ $u->block }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Tanggal Serah Terima</label>
                    <input type="date" name="handover_date" value="{{ old('handover_date', $serahTerima?->handover_date?->format('Y-m-d')) }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Urutan</label>
                    <input type="number" min="0" name="sort_order" value="{{ old('sort_order', $serahTerima?->sort_order ?? 0) }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Caption / Keterangan</label>
                <textarea name="caption" rows="2" maxlength="255" class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">{{ old('caption', $serahTerima?->caption) }}</textarea>
            </div>

            <label class="flex items-center gap-2 text-sm text-ink font-semibold">
                <input type="checkbox" name="active" value="1" @checked(old('active', $serahTerima?->active ?? true))
                       class="rounded border-line text-brand-600 focus:ring-brand-600">
                Tampilkan di situs
            </label>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-brand-600 hover:bg-brand-700 transition-colors text-white font-semibold px-6 py-2.5 text-sm">
                    {{ $serahTerima ? 'Simpan Perubahan' : 'Simpan Dokumentasi' }}
                </button>
                <a href="{{ route('admin.serah_terima.index') }}" class="text-sm text-muted hover:text-ink font-semibold">Batal</a>
            </div>
        </form>
    </div>
</x-admin-layout>