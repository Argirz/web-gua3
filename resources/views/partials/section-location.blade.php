@php
    $wa = preg_replace('/[^0-9]/', '', $pengaturan['whatsapp'] ?? '');
    $waLink = $wa ? 'https://wa.me/' . $wa : '#';
    $igRaw = $pengaturan['instagram'] ?? '';
    $ig = str_starts_with($igRaw, 'http') ? $igRaw : 'https://www.instagram.com/' . ($igRaw ?: 'griyautamasri3') . '/';
@endphp

<section id="kontak" class="py-16 lg:py-24 bg-white border-t border-line">
    <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="anim-hidden text-center max-w-3xl mx-auto">
            <h2 class="font-display text-[28px] sm:text-[36px] lg:text-[42px] font-bold tracking-tight text-ink leading-[0.95]">
                Lokasi Strategis <span class="text-brand-600">&</span> Formulir Minat
            </h2>
            <p class="mt-4 text-[14px] sm:text-[15px] leading-relaxed text-muted">
                Kunjungi lokasi kami di kawasan berkembang Banjarbaru akses mudah ke bandara, fasilitas publik, dan pusat kota.
            </p>
        </div>

        <div class="mt-10 grid lg:grid-cols-5 gap-6 lg:gap-6 items-start">
            <div class="lg:col-span-2 space-y-4 anim-slide-left">
                <div class="card overflow-hidden p-2">
                    <div class="relative rounded-[16px] overflow-hidden bg-slate-100 aspect-[4/3] min-h-[360px] sm:min-h-[400px] lg:min-h-[420px]">
                        <iframe
                            src="https://maps.google.com/maps?q=HQJ8%2B3X%2C%20Syamsudin%20Noor%2C%20Kec.%20Landasan%20Ulin%2C%20Banjarbaru&z=16&hl=id&output=embed"
                            class="absolute inset-0 w-full h-full border-0"
                            loading="lazy"
                            allowfullscreen
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Peta Griya Utama Asri 3"></iframe>
                        <a href="https://maps.google.com/?q=HQJ8%2B3X%2C%20Syamsudin%20Noor%2C%20Kec.%20Landasan%20Ulin%2C%20Banjarbaru" target="_blank" rel="noopener"
                           class="absolute bottom-3 left-3 right-3 rounded-xl bg-white/95 backdrop-blur border border-line shadow-md px-3 py-2.5 flex items-center justify-between hover:bg-white transition-colors">
                            <div>
                                <p class="text-xs font-bold text-ink leading-none">Buka di Google Maps</p>
                                <p class="text-[11px] text-muted mt-1 leading-none truncate">HQJ8+3X, Landasan Ulin, Banjarbaru</p>
                            </div>
                            <span class="w-8 h-8 rounded-full bg-brand-600 text-white flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                            </span>
                        </a>
                    </div>
                    <div class="px-2 pt-3 pb-1">
                        <p class="text-xs font-bold uppercase tracking-wide text-muted">Alamat Lengkap</p>
                        <p class="text-sm font-medium text-ink mt-1 leading-relaxed">{{ $pengaturan['alamat'] ?? 'HQJ8+3X, Syamsudin Noor, Kec. Landasan Ulin, Kota Banjarbaru, Kalimantan Selatan 70721' }}</p>
                    </div>
                </div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 gap-3">
                    <a href="{{ $waLink }}" target="_blank" rel="noopener" class="card card-hover p-4 flex items-center gap-3 group">
                        <span class="w-11 h-11 rounded-2xl bg-emerald-500 text-white flex items-center justify-center shrink-0 shadow-md shadow-emerald-500/20">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        </span>
                        <div class="min-w-0">
                            <p class="text-xs font-bold uppercase tracking-wide text-muted">WhatsApp</p>
                            <p class="text-sm font-bold text-ink group-hover:text-brand-600 transition-colors truncate">{{ $pengaturan['whatsapp'] ?? '0895340878054' }}</p>
                            <p class="text-[11px] text-emerald-600 font-medium">Chat sekarang →</p>
                        </div>
                    </a>
                    <a href="{{ $ig }}" target="_blank" rel="noopener" class="card card-hover p-4 flex items-center gap-3 group">
                        <span class="w-11 h-11 rounded-2xl bg-gradient-to-br from-purple-500 via-pink-500 to-amber-400 text-white flex items-center justify-center shrink-0 shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                        </span>
                        <div class="min-w-0">
                            <p class="text-xs font-bold uppercase tracking-wide text-muted">Instagram</p>
                            <p class="text-sm font-bold text-ink group-hover:text-brand-600 transition-colors truncate">@griyautamaasri3</p>
                            <p class="text-[11px] text-muted">Lihat galeri terbaru</p>
                        </div>
                    </a>
                </div>
                <div class="card p-4 flex items-center gap-3 bg-sage/50">
                    <span class="w-11 h-11 rounded-2xl bg-white border border-line flex items-center justify-center text-brand-600 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-muted">Jam Operasional</p>
                        <p class="text-sm font-semibold text-ink mt-0.5">{{ $pengaturan['jam_operasional'] ?? 'Senin – Sabtu, 08.00 – 16.30 WITA' }}</p>
                    </div>
                </div>
            </div>
            <div id="minat" class="lg:col-span-3 anim-scale">
                <div class="card p-5 sm:p-7 lg:p-8 shadow-xl shadow-slate-200/50">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="font-display text-[22px] sm:text-[24px] font-bold tracking-tight text-ink leading-none">Formulir Minat</h3>
                            <p class="text-sm text-muted mt-2 leading-relaxed">Lengkapi data tim marketing akan menghubungi Anda via WhatsApp dalam 1×24 jam.</p>
                        </div>
                        <span class="hidden sm:inline-flex w-10 h-10 rounded-2xl bg-brand-600 text-white items-center justify-center shadow-md shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                        </span>
                    </div>
                    <form id="form-minat" class="mt-6 space-y-5" novalidate>
                        @csrf
                        <div id="minat-sukses" class="hidden rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3.5 text-sm font-medium flex items-start gap-3">
                            <span class="w-7 h-7 rounded-full bg-emerald-500 text-white flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                            </span>
                            <span>Terima kasih! Data Anda sudah kami terima. Tim marketing akan menghubungi Anda segera via WhatsApp.</span>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <label for="minat-nama" class="block text-xs font-bold uppercase tracking-wide text-ink mb-1.5">Nama Lengkap <span class="text-rose-500">*</span></label>
                                <input type="text" id="minat-nama" name="nama_lengkap" required placeholder="Budi Santoso"
                                       class="w-full rounded-xl border border-line bg-white px-4 py-3 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-600 focus:border-brand-600 transition">
                                <p class="minat-error hidden text-xs text-rose-500 mt-1.5" data-for="nama_lengkap"></p>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="minat-wa" class="block text-xs font-bold uppercase tracking-wide text-ink mb-1.5">Nomor WhatsApp <span class="text-rose-500">*</span></label>
                                <input type="tel" id="minat-wa" name="nomor_wa" required placeholder="08xxxxxxxxxx"
                                       class="w-full rounded-xl border border-line bg-white px-4 py-3 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-600 focus:border-brand-600 transition">
                                <p class="minat-error hidden text-xs text-rose-500 mt-1.5" data-for="nomor_wa"></p>
                            </div>
                            <div>
                                <label for="minat-tipe" class="block text-xs font-bold uppercase tracking-wide text-ink mb-1.5">Tipe Rumah Idaman</label>
                                <select id="minat-tipe" name="tipe_rumah_id"
                                        class="w-full rounded-xl border border-line bg-white px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600 focus:border-brand-600 transition">
                                    <option value="">Belum ditentukan</option>
                                    @foreach ($prospek_tipe as $tipe)
                                        <option value="{{ $tipe->id }}">{{ $tipe->name }} Rp {{ number_format($tipe->price - $tipe->discount,0,',','.') }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="minat-sumber" class="block text-xs font-bold uppercase tracking-wide text-ink mb-1.5">Mengetahui dari <span class="text-rose-500">*</span></label>
                                <select id="minat-sumber" name="sumber" required
                                        class="w-full rounded-xl border border-line bg-white px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600 focus:border-brand-600 transition">
                                    <option value="brosur">Brosur / Iklan</option>
                                    <option value="sosmed">Media Sosial (Instagram, TikTok)</option>
                                    <option value="kontak">Kontak / Referensi</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                                <p class="minat-error hidden text-xs text-rose-500 mt-1.5" data-for="sumber"></p>
                            </div>
                        </div>
                        <button type="submit" id="minat-kirim" class="btn btn-primary w-full justify-center text-[15px] py-3.5 shadow-lg shadow-brand-600/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                            Kirim Minat & Jadwalkan Survei
                        </button>
                        <p class="text-[11px] text-muted text-center leading-relaxed">Dengan mengirim, Anda menyetujui untuk dihubungi via WhatsApp. Data aman & tidak dibagikan.</p>
                    </form>
                </div>
                <div class="mt-4 grid grid-cols-3 gap-2 text-center">
                    <div class="rounded-2xl bg-white border border-line p-3">
                        <p class="text-[11px] font-bold uppercase tracking-wide text-muted">Respon</p>
                        <p class="text-sm font-extrabold text-ink mt-1">1×24 Jam</p>
                    </div>
                    <div class="rounded-2xl bg-white border border-line p-3">
                        <p class="text-[11px] font-bold uppercase tracking-wide text-muted">Survey</p>
                        <p class="text-sm font-extrabold text-ink mt-1">Gratis</p>
                    </div>
                    <div class="rounded-2xl bg-white border border-line p-3">
                        <p class="text-[11px] font-bold uppercase tracking-wide text-muted">Konsultasi</p>
                        <p class="text-sm font-extrabold text-ink mt-1">Tanpa Biaya</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('form-minat');
        if (!form) return;
        form.addEventListener('submit', async function (e) {
            e.preventDefault();
            const pesan = document.getElementById('minat-sukses');
            pesan.classList.add('hidden');
            document.querySelectorAll('.minat-error').forEach(el => {
                el.classList.add('hidden');
                el.textContent = '';
            });
            const tombol = document.getElementById('minat-kirim');
            const teksAsli = tombol.innerHTML;
            tombol.disabled = true;
            tombol.innerHTML = 'Mengirim...';
            try {
                const res = await fetch('{{ route('prospek.store') }}', {
                    method: 'POST',
                    headers: { 'Accept': 'application/json' },
                    body: new FormData(form)
                });
                const data = await res.json();
                if (res.ok) {
                    pesan.classList.remove('hidden');
                    pesan.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    form.reset();
                } else {
                    const errors = data.errors || {};
                    Object.entries(errors).forEach(([field, msgs]) => {
                        const el = document.querySelector('.minat-error[data-for="' + field + '"]');
                        if (el) {
                            el.textContent = msgs[0];
                            el.classList.remove('hidden');
                        }
                    });
                    if (!Object.keys(errors).length && data.message) {
                        alert(data.message);
                    }
                }
            } catch (err) {
                alert('Gagal mengirim. Periksa koneksi Anda lalu coba lagi.');
            } finally {
                tombol.disabled = false;
                tombol.innerHTML = teksAsli;
            }
        });
    });
    </script>
</section>
