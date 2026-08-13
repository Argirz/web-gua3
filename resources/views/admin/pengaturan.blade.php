<x-admin-layout judul="Pengaturan Situs">
    <div class="card p-5 sm:p-8 max-w-3xl">
        <form method="POST" action="{{ route('admin.pengaturan.perbarui') }}" class="space-y-5">
            @csrf

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Nama Perumahan</label>
                    <input type="text" name="nama_perumahan" maxlength="255" value="{{ old('nama_perumahan', $nilai['nama_perumahan'] ?? '') }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan" maxlength="255" value="{{ old('nama_perusahaan', $nilai['nama_perusahaan'] ?? '') }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Tagline</label>
                    <input type="text" name="tagline" maxlength="255" value="{{ old('tagline', $nilai['tagline'] ?? '') }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Telepon</label>
                    <input type="text" name="telepon" maxlength="50" value="{{ old('telepon', $nilai['telepon'] ?? '') }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Nomor WhatsApp</label>
                    <input type="text" name="whatsapp" maxlength="50" value="{{ old('whatsapp', $nilai['whatsapp'] ?? '') }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Email</label>
                    <input type="email" name="email" maxlength="255" value="{{ old('email', $nilai['email'] ?? '') }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Kabupaten / Kota</label>
                    <input type="text" name="kabupaten" maxlength="100" value="{{ old('kabupaten', $nilai['kabupaten'] ?? '') }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Jam Operasional</label>
                    <input type="text" name="jam_operasional" maxlength="100" value="{{ old('jam_operasional', $nilai['jam_operasional'] ?? '') }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Instagram</label>
                    <input type="text" name="instagram" maxlength="255" value="{{ old('instagram', $nilai['instagram'] ?? '') }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Alamat</label>
                    <input type="text" name="alamat" maxlength="255" value="{{ old('alamat', $nilai['alamat'] ?? '') }}"
                           class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">{{ old('deskripsi', $nilai['deskripsi'] ?? '') }}</textarea>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-brand-600 hover:bg-brand-700 transition-colors text-white font-semibold px-6 py-2.5 text-sm">Simpan Pengaturan</button>
            </div>
        </form>
    </div>
</x-admin-layout>