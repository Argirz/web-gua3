<section id="minat" class="relative z-10 -mt-12 lg:-mt-16 rounded-t-[2.5rem] bg-brand-50 shadow-[0_-40px_70px_-45px_rgba(13,33,23,0.4)] pt-20 lg:pt-32 pb-20 lg:pb-32">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="mb-14 lg:mb-20 anim-hidden flex flex-col items-center text-center">
            <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl font-bold text-ink">Formulir Minat</h2>
            <p class="mt-5 text-muted max-w-2xl mx-auto leading-relaxed text-sm sm:text-base">Mulai langkah kepemilikan hunian Anda sekarang. Cukup lengkapi data di bawah ini, dan kami akan segera menghubungi Anda.</p>
        </div>

        <div class="grid gap-8 lg:grid-cols-5 items-start">
            {{-- Info --}}
            <div class="lg:col-span-2 anim-slide-right">
                <div class="card card-hover p-6 sm:p-7">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 ring-1 ring-brand-100 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                        </div>
                        <h3 class="font-display font-semibold text-ink text-xl">Kenapa Mendaftar?</h3>
                    </div>
                    <ul class="space-y-4 text-sm text-ink-soft">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 shrink-0 text-brand-600 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                            <span>Info promo &amp; harga terbaru langsung ke WhatsApp Anda.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 shrink-0 text-brand-600 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                            <span>Jadwalkan survei lokasi &amp; konsultasi tipe rumah.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 shrink-0 text-brand-600 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                            <span>Dapatkan informasi unit yang tersedia secara real-time.</span>
                        </li>
                    </ul>
                    <div class="mt-6 pt-5 border-t border-line">
                        <p class="text-xs font-bold uppercase tracking-wide text-muted mb-2">Butuh respon cepat?</p>
                        <a href="https://wa.me/62895340878054" target="_blank" rel="noopener"
                           class="btn btn-outline w-full justify-center text-sm flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.895 7.175 9.87 9.87 0 01-1.508 5.26l.983 3.647-3.74-.982-.362.213a9.87 9.87 0 01-5.03 1.38z"/></svg>
                            Chat WhatsApp Langsung
                        </a>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <div class="lg:col-span-3 anim-scale">
                <form id="form-minat" class="card p-6 sm:p-8 space-y-5" novalidate>
                    @csrf
                    <div id="minat-sukses" class="hidden rounded-xl bg-emerald-50 ring-1 ring-emerald-200 text-emerald-800 px-4 py-3 text-sm font-medium">
                        Terima kasih! Data Anda sudah kami terima. Tim marketing akan menghubungi Anda segera.
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="minat-nama" class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Nama Lengkap <span class="text-rose-500">*</span></label>
                            <input type="text" id="minat-nama" name="nama_lengkap" required
                                   class="w-full rounded-xl border border-line px-4 py-2.5 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-brand-600">
                            <p class="minat-error hidden text-xs text-rose-500 mt-1" data-for="nama_lengkap"></p>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="minat-wa" class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Nomor WhatsApp <span class="text-rose-500">*</span></label>
                            <input type="tel" id="minat-wa" name="nomor_wa" required
                                   class="w-full rounded-xl border border-line px-4 py-2.5 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-brand-600">
                            <p class="minat-error hidden text-xs text-rose-500 mt-1" data-for="nomor_wa"></p>
                        </div>
                        <div>
                            <label for="minat-tipe" class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Tipe Rumah Idaman</label>
                            <select id="minat-tipe" name="tipe_rumah_id"
                                    class="w-full rounded-xl border border-line px-4 py-2.5 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-brand-600">
                                <option value="">Belum ditentukan</option>
                                @foreach ($prospek_tipe as $tipe)
                                    <option value="{{ $tipe->id }}">{{ $tipe->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="minat-sumber" class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Mengetahui dari <span class="text-rose-500">*</span></label>
                            <select id="minat-sumber" name="sumber" required
                                    class="w-full rounded-xl border border-line px-4 py-2.5 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-brand-600">
                                <option value="brosur">Brosur / Iklan</option>
                                <option value="sosmed">Media Sosial (Instagram, TikTok)</option>
                                <option value="kontak">Kontak / Referensi</option>
                            </select>
                            <p class="minat-error hidden text-xs text-rose-500 mt-1" data-for="sumber"></p>
                        </div>
                    </div>

                    <button type="submit" id="minat-kirim"
                            class="btn btn-primary w-full justify-center text-sm flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                        Kirim Minat
                    </button>
                </form>
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
