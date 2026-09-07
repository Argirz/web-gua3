@php
    $pdfUrl = $brosur->count() ? asset('storage/' . $brosur->first()->file) : '';
    $doneImages = [];
    foreach (range(1, 7) as $i) {
        $doneImages[] = "images/brosur/Brosur {$i}.png";
    }
    $slides = $brosur->map(fn ($b) => (object) ['cover' => asset($b->cover ?? $b->file), 'title' => $b->title])->values();
    foreach ($doneImages as $img) {
        $slides->push((object) ['cover' => asset($img), 'title' => 'Brosur Griya Utama Asri 3']);
    }
    $hasPricelist = isset($pricelists) && $pricelists->count();
@endphp

<section id="legalitas" class="py-14 sm:py-16 lg:py-24 bg-white border-t border-line overflow-hidden">
    <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="anim-hidden text-center max-w-3xl mx-auto px-1">
            <h2 class="font-display text-2xl sm:text-[36px] lg:text-[42px] font-bold tracking-tight text-ink leading-[1.05] sm:leading-[0.95] text-balance">
                Legalitas, Brosur <span class="text-brand-600">&</span> Pricelist
            </h2>
            <p class="mt-3 sm:mt-4 text-[13px] sm:text-[15px] leading-relaxed text-muted">
                Kepastian hukum lengkap, dokumentasi resmi, dan harga transparan semua dalam satu tempat untuk keputusan yang tenang.
            </p>
        </div>

        <div class="mt-8 sm:mt-10 grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-5 stagger">
            <div class="card card-hover p-5 sm:p-7 relative overflow-hidden w-full min-w-0">
                <div class="absolute top-0 right-0 w-28 h-28 bg-gradient-to-br from-emerald-50 to-transparent rounded-bl-[48px]"></div>
                <div class="relative">
                    <div class="flex items-start justify-between gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-brand-600 text-white flex items-center justify-center shadow-md shadow-brand-600/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 13.5l2.25 2.25L15 12"/></svg>
                        </div>
                        <span class="text-4xl font-black text-slate-100 tracking-tight">01</span>
                    </div>
                    <h3 class="mt-5 font-bold text-ink text-[17px]">SHM Sertifikat Hak Milik</h3>
                    <p class="mt-2 text-sm leading-relaxed text-muted">Kepemilikan penuh dan turun-temurun dengan kekuatan hukum tertinggi. SHM memberikan ketenangan hak milik tanpa batas waktu.</p>
                    <ul class="mt-4 space-y-2 text-xs font-medium text-ink-soft">
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shrink-0"></span> Hak milik seumur hidup & dapat diwariskan</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shrink-0"></span> Agunan terbaik untuk pembiayaan bank</li>
                    </ul>
                </div>
            </div>
            <div class="card card-hover p-5 sm:p-7 relative overflow-hidden w-full min-w-0">
                <div class="absolute top-0 right-0 w-28 h-28 bg-gradient-to-br from-gold-50 to-transparent rounded-bl-[48px]"></div>
                <div class="relative">
                    <div class="flex items-start justify-between gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-white border border-line text-gold-600 flex items-center justify-center shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5a3 3 0 013 3v1.5a3 3 0 01-3 3 3 3 0 01-3-3v-1.5a3 3 0 013-3z"/></svg>
                        </div>
                        <span class="text-4xl font-black text-slate-100 tracking-tight">02</span>
                    </div>
                    <h3 class="mt-5 font-bold text-ink text-[17px]">SHGB Hak Guna Bangunan</h3>
                    <p class="mt-2 text-sm leading-relaxed text-muted">Hak mengelola bangunan di atas tanah negara dengan jangka waktu jelas, serta opsi peningkatan ke SHM sesuai ketentuan.</p>
                    <ul class="mt-4 space-y-2 text-xs font-medium text-ink-soft">
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-gold-400 shrink-0"></span> Jangka waktu transparan & dapat diperpanjang</li>
                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-gold-400 shrink-0"></span> Dapat ditingkatkan ke SHM</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-6 sm:mt-8 grid grid-cols-1 lg:grid-cols-5 gap-4 sm:gap-6 items-start">
            <div class="lg:col-span-3 card overflow-hidden p-2 sm:p-3 anim-slide-left w-full min-w-0">
                <div class="flex items-center justify-between px-2 sm:px-3 py-3">
                    <div>
                        <h3 class="font-bold text-ink text-[15px]">Brosur Resmi</h3>
                        <p class="text-xs text-muted mt-0.5">Geser untuk preview • Klik untuk zoom</p>
                    </div>
                    <span class="hidden sm:inline-flex text-[11px] font-bold tracking-wide uppercase px-2.5 py-1 rounded-full bg-sage border border-line text-ink">Lightbox preview</span>
                </div>
                @if($brosur->count() || true)
                    <div class="relative rounded-[14px] sm:rounded-[16px] overflow-hidden bg-slate-900 ring-1 ring-black/5">
                        <div id="brosur-slideshow" class="flex gap-2.5 sm:gap-3 overflow-x-auto snap-x snap-mandatory scroll-smooth py-4 sm:py-6 px-6 sm:px-[14%] lg:px-[18%] [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
                            @foreach ($slides->take(12) as $index => $slide)
                                <div class="brosur-slide shrink-0 w-[82%] sm:w-[68%] lg:w-[62%] snap-center flex justify-center items-center transition-all duration-500 opacity-60 scale-[0.96] {{ $index===0 ? '!opacity-100 !scale-100' : '' }}" data-index="{{ $index }}">
                                    <img src="{{ $slide->cover }}" alt="{{ $slide->title }}" loading="lazy" class="block max-h-[48vh] sm:max-h-[56vh] w-full h-auto object-contain rounded-xl cursor-pointer brosur-zoom-trigger shadow-2xl bg-white">
                                </div>
                            @endforeach
                        </div>
                        <button id="brosur-prev" type="button" class="hidden sm:flex absolute left-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white/90 backdrop-blur border border-line shadow-md items-center justify-center hover:bg-white transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
                        </button>
                        <button id="brosur-next" type="button" class="hidden sm:flex absolute right-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white/90 backdrop-blur border border-line shadow-md items-center justify-center hover:bg-white transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                        </button>
                    </div>
                    <div class="mt-3 rounded-2xl bg-sage border border-line p-3.5 sm:p-4 flex flex-col sm:flex-row sm:items-center items-stretch justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-brand-600 flex items-center justify-center text-white shadow-md shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-ink leading-tight">Download Brosur PDF</p>
                                <p class="text-[11px] text-muted mt-0.5 sm:hidden">File resmi & gratis</p>
                            </div>
                        </div>
                        @if($pdfUrl)
                            <a href="{{ $pdfUrl }}" download class="btn btn-primary btn-sm w-full sm:w-auto justify-center">Download PDF</a>
                        @else
                            <a href="{{ asset('images/brosur/Brosur 1.png') }}" download class="btn btn-primary btn-sm w-full sm:w-auto justify-center">Download PDF</a>
                        @endif
                    </div>
                @endif
                <div id="brosur-lightbox" class="fixed inset-0 z-[100] hidden bg-brand-950/95 backdrop-blur-sm">
                    <button id="brosur-lb-close" class="absolute top-4 right-4 sm:top-6 sm:right-6 w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white text-xl transition z-20" aria-label="Tutup">×</button>
                    <div class="relative w-full h-full flex items-center justify-center p-4 sm:p-8">
                        <img id="brosur-lb-img" src="" alt="" class="max-w-full max-h-[85vh] w-auto h-auto object-contain rounded-2xl shadow-2xl">
                    </div>
                </div>
            </div>
            <div id="pricelist" class="lg:col-span-2 space-y-3 sm:space-y-4 anim-slide-right w-full min-w-0">
                <div class="card overflow-hidden">
                    <div class="px-4 sm:px-6 py-4 border-b border-line bg-gradient-to-r from-brand-600 to-brand-500 text-white">
                        <p class="text-[11px] font-bold tracking-widest uppercase text-white/80">Harga Spesial</p>
                        <h3 class="mt-1 font-display text-[19px] sm:text-[20px] font-bold leading-tight">Tipe 36 Mulai</h3>
                        @php
                            $mainPrice = $pricelists->first()->price ?? 182000000;
                            $mainDiscount = $pricelists->first()->discount ?? 0;
                            $mainFinal = $mainPrice - $mainDiscount;
                        @endphp
                        <div class="mt-2.5 sm:mt-3 flex flex-wrap items-baseline gap-x-2 gap-y-1">
                            <span class="text-2xl sm:text-[28px] font-extrabold tracking-tight break-words">Rp {{ number_format($mainFinal,0,',','.') }}</span>
                            @if($mainDiscount>0)
                                <span class="text-xs line-through text-white/70">Rp {{ number_format($mainPrice,0,',','.') }}</span>
                            @endif
                        </div>
                        <p class="text-[11px] sm:text-xs text-white/80 mt-1 leading-relaxed">LT 72 m² • LB 36 m² • 2 KT • 1 KM • Listrik 1300 VA</p>
                    </div>
                    @if($hasPricelist)
                        <div class="p-3.5 sm:p-5 space-y-3 max-h-[320px] sm:max-h-[360px] overflow-y-auto">
                            @foreach($pricelists as $pl)
                                @php $hargaFinal = $pl->price - $pl->discount; @endphp
                                <div class="rounded-2xl border border-line p-3.5 sm:p-4 bg-sage/30 flex flex-col gap-3 hover:border-brand-200 transition-colors">
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="min-w-0">
                                            <h4 class="font-bold text-ink text-[15px] leading-tight">{{ $pl->title }}</h4>
                                            <p class="text-xs text-muted mt-1 leading-relaxed">{{ $pl->title }} • {{ $pl->land_area }} m² / {{ $pl->building_area }} m²</p>
                                        </div>
                                        <span class="text-[11px] font-bold px-2.5 py-1 rounded-full bg-white border border-line text-ink shrink-0">Ready</span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2">
                                        <div class="rounded-xl bg-white border border-line p-2.5 sm:p-3 text-center min-w-0">
                                            <p class="text-[10px] font-bold uppercase tracking-wide text-muted">Luas Tanah</p>
                                            <p class="text-sm font-extrabold text-ink mt-1">{{ $pl->land_area ? $pl->land_area.' m²' : '-' }}</p>
                                        </div>
                                        <div class="rounded-xl bg-white border border-line p-2.5 sm:p-3 text-center min-w-0">
                                            <p class="text-[10px] font-bold uppercase tracking-wide text-muted">Luas Bangunan</p>
                                            <p class="text-sm font-extrabold text-ink mt-1">{{ $pl->building_area ? $pl->building_area.' m²' : '-' }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-end justify-between gap-3 pt-2 border-t border-line">
                                        <div class="min-w-0">
                                            <p class="text-[11px] font-bold uppercase tracking-wide text-muted">Harga</p>
                                            @if($pl->discount>0)
                                                <p class="text-xs line-through text-rose-500 break-words">Rp {{ number_format($pl->price,0,',','.') }}</p>
                                                <p class="text-base sm:text-lg font-extrabold text-brand-600 break-words">Rp {{ number_format($hargaFinal,0,',','.') }}</p>
                                            @else
                                                <p class="text-base sm:text-lg font-extrabold text-ink break-words">Rp {{ number_format($pl->price,0,',','.') }}</p>
                                            @endif
                                        </div>
                                        <a href="#minat" class="btn btn-primary btn-sm shrink-0">Pesan</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-4 sm:p-6">
                            <div class="rounded-2xl bg-sage border border-line p-4 sm:p-5">
                                <p class="text-sm font-bold text-ink leading-snug">Tipe 36 Hunian Keluarga Modern</p>
                                <div class="mt-3 grid grid-cols-2 gap-2">
                                    <div class="rounded-xl bg-white border border-line p-2.5 sm:p-3 text-center min-w-0">
                                        <p class="text-[10px] font-bold uppercase tracking-wide text-muted">Luas Tanah</p>
                                        <p class="text-sm font-extrabold text-ink mt-1">72 m²</p>
                                    </div>
                                    <div class="rounded-xl bg-white border border-line p-2.5 sm:p-3 text-center min-w-0">
                                        <p class="text-[10px] font-bold uppercase tracking-wide text-muted">Luas Bangunan</p>
                                        <p class="text-sm font-extrabold text-ink mt-1">36 m²</p>
                                    </div>
                                </div>
                                <a href="#minat" class="mt-4 btn btn-gold w-full justify-center">Pesan Sekarang</a>
                                <p class="text-[11px] text-muted text-center mt-2">Konsultasi simulasi KPR & promo terbaru</p>
                            </div>
                        </div>
                    @endif
                    <div class="px-4 sm:px-6 py-3.5 sm:py-4 bg-sage/50 border-t border-line flex flex-col sm:flex-row gap-2">
                        <a href="#minat" class="btn btn-primary flex-1 justify-center w-full sm:w-auto">Jadwalkan Survey</a>
                        <a href="{{ $pdfUrl ?: asset('images/brosur/Brosur 1.png') }}" download class="btn btn-outline flex-1 justify-center w-full sm:w-auto">Download Brosur</a>
                    </div>
                </div>
                <div class="rounded-2xl bg-amber-50 border border-amber-200 p-4 flex gap-3">
                    <span class="w-8 h-8 rounded-full bg-amber-400 text-white flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.008v.008H12v-.008z"/></svg>
                    </span>
                    <div>
                        <p class="text-xs font-bold text-amber-800">Harga dapat berubah sewaktu-waktu</p>
                        <p class="text-xs text-amber-700/80 mt-1 leading-relaxed">Hubungi marketing untuk update pricelist real-time, promo & skema pembayaran terbaik.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
