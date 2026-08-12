@php
    $pdfUrl = $brochures->count() ? asset('storage/' . $brochures->first()->file) : '';
@endphp

<section id="brosur" class="py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-14 anim-hidden text-center">
            <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-semibold text-ink">Brosur</h2>
            <p class="mt-5 text-muted max-w-2xl mx-auto leading-relaxed">Unduh brosur lengkap Griya Utama Asri 3 dalam format PDF. Berisi informasi detail tipe rumah, harga, hingga siteplan.</p>
        </div>

        @if ($brochures->count())
            <div class="anim-scale">
                {{-- Slideshow --}}
                <div class="relative rounded-3xl overflow-hidden ring-1 ring-line shadow-xl bg-brand-950 aspect-[4/3] sm:aspect-[16/9] lg:aspect-[21/9]" id="brosur-slideshow">
                    @foreach ($brochures as $index => $brochure)
                        <div class="brosur-slide absolute inset-0 transition-opacity duration-700 {{ $index === 0 ? 'opacity-100' : 'opacity-0 pointer-events-none' }}" data-index="{{ $index }}">
                            <img src="{{ asset($brochure->cover) }}" alt="{{ $brochure->title }}"
                                 class="w-full h-full object-contain cursor-pointer brosur-zoom-trigger"
                                 data-title="{{ $brochure->title }}"
                                 data-desc="{{ $brochure->description ?? '' }}">
                        </div>
                    @endforeach

                    {{-- Gradient overlay --}}
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-brand-950/85 to-transparent p-6 pointer-events-none">
                        <p id="brosur-caption" class="text-white font-bold text-lg">{{ $brochures->first()->title }}</p>
                        <p id="brosur-desc" class="text-white/60 text-sm">{{ $brochures->first()->description }}</p>
                    </div>

                    {{-- Navigation dots --}}
                    <div class="absolute bottom-6 right-6 flex gap-2 z-10">
                        @foreach ($brochures as $index => $brochure)
                            <button class="brosur-dot w-2.5 h-2.5 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-gold-400 w-8' : 'bg-white/40 hover:bg-white/70' }}" data-index="{{ $index }}" aria-label="Brosur {{ $index + 1 }}"></button>
                        @endforeach
                    </div>

                    {{-- Click hint --}}
                    <div class="absolute top-4 right-4 z-10 px-3 py-1.5 rounded-full bg-black/30 backdrop-blur-sm text-white/80 text-xs font-medium items-center gap-1.5 pointer-events-none hidden sm:flex">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6"/></svg>
                        Klik untuk zoom
                    </div>
                </div>

                {{-- Download bar --}}
                <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4 rounded-2xl bg-brand-50 ring-1 ring-brand-100 p-5">
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
