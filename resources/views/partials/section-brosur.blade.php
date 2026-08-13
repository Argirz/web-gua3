@php
    $pdfUrl = $brosur->count() ? asset('storage/' . $brosur->first()->file) : '';
@endphp

<section id="brosur" class="py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-14 anim-hidden text-center">
            <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-semibold text-ink">Brosur</h2>
            <p class="mt-5 text-muted max-w-2xl mx-auto leading-relaxed">Unduh brosur lengkap Griya Utama Asri 3 dalam format PDF. Berisi informasi detail tipe rumah, harga, hingga siteplan.</p>
        </div>

        @if ($brosur->count())
            <div class="anim-scale mx-auto">
                <div class="w-fit max-w-full mx-auto">
                    {{-- Slideshow --}}
                    <div class="relative grid rounded-3xl overflow-hidden ring-1 ring-line shadow-xl bg-brand-950" id="brosur-slideshow">
                    @foreach ($brosur as $index => $brochure)
                        <div class="brosur-slide col-start-1 row-start-1 transition-opacity duration-700 {{ $index === 0 ? 'opacity-100' : 'opacity-0 pointer-events-none' }}" data-index="{{ $index }}">
                            <img src="{{ asset($brochure->cover) }}" alt="{{ $brochure->title }}"
                                 class="block max-h-[72vh] w-auto h-auto max-w-full object-contain cursor-pointer brosur-zoom-trigger">
                        </div>
                    @endforeach

                    {{-- Navigation dots --}}
                    <div class="absolute bottom-6 right-6 flex gap-2 z-10">
                        @foreach ($brosur as $index => $brochure)
                            <button class="brosur-dot w-2.5 h-2.5 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-gold-400 w-8' : 'bg-white/40 hover:bg-white/70' }}" data-index="{{ $index }}" aria-label="Brosur {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                </div>
                </div>

                {{-- Download bar --}}
                <div class="mt-8 max-w-xl sm:max-w-2xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4 rounded-2xl bg-brand-50 ring-1 ring-brand-100 p-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-brand-600 flex items-center justify-center text-white shadow-lg shadow-brand-600/25">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                            </div>
                            <div>
                                <p class="font-bold text-ink">Download Brosur PDF</p>
                            </div>
                        </div>
                        <a href="{{ $pdfUrl }}" download
                           class="btn btn-primary btn-sm">
                            Download PDF
                        </a>
                    </div>
            </div>

            {{-- Fullscreen Lightbox --}}
            <div id="brosur-lightbox" class="fixed inset-0 z-[100] hidden bg-brand-950/95 backdrop-blur-sm transition-opacity duration-300">
                <button id="brosur-lb-close" class="absolute top-4 right-4 sm:top-6 sm:right-6 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white text-2xl transition z-20" aria-label="Tutup">&times;</button>
                <div class="relative w-full h-full flex items-center justify-center p-4 sm:p-8">
                    <img id="brosur-lb-img" src="" alt="" class="max-w-full max-h-full object-contain rounded-2xl">
                </div>
            </div>
        @else
            @include('partials.empty-state', ['message' => 'Belum ada brosur. Brosur akan ditambahkan segera.'])
        @endif
    </div>
</section>
