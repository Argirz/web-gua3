@php
    $pdfUrl = $brosur->count() ? asset('storage/' . $brosur->first()->file) : '';
    $doneImages = [
        'images/1 done.png',
        'images/2 done.png',
        'images/4 done.png',
        'images/16 done.png',
        'images/17 done.png',
        'images/25 done.png',
        'images/26 done.png',
    ];
    $slides = $brosur->map(fn ($b) => (object) ['cover' => asset($b->cover), 'title' => $b->title])->values();
    foreach ($doneImages as $img) {
        $slides->push((object) ['cover' => asset($img), 'title' => 'Foto Progress Griya Utama Asri 3']);
    }
@endphp

<section id="brosur" class="py-20 lg:py-32">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="mb-14 lg:mb-20 anim-hidden flex flex-col items-center text-center">
            <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl font-bold text-ink">Brosur</h2>
            <p class="mt-5 text-muted max-w-2xl mx-auto leading-relaxed text-sm sm:text-base">Temukan panduan lengkap hunian idaman keluarga Anda, mulai dari spesifikasi tipe hingga rencana tapak, langsung melalui brosur PDF resmi kami.</p>
        </div>

        @if ($brosur->count())
            <div class="anim-scale w-full">
                <div class="w-full">
                    {{-- Slideshow --}}
                    <div class="relative rounded-3xl overflow-hidden ring-1 ring-line shadow-xl bg-brand-950">
                        
                        <div id="brosur-slideshow" class="flex gap-4 sm:gap-6 overflow-x-auto snap-x snap-mandatory scroll-smooth py-10 px-[7.5%] sm:px-[15%] lg:px-[20%] [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
                            @foreach ($slides as $index => $slide)
                                <div class="brosur-slide shrink-0 w-[85%] sm:w-[70%] lg:w-[60%] snap-center flex justify-center items-center transition-all duration-500 opacity-50 scale-95" data-index="{{ $index }}">
                                    <img src="{{ $slide->cover }}" alt="{{ $slide->title }}"
                                         class="block max-h-[75vh] w-full h-auto object-contain rounded-xl cursor-pointer brosur-zoom-trigger shadow-2xl">
                                </div>
                            @endforeach
                    </div>
                </div>

                {{-- Download bar --}}
                <div class="mt-8 w-full flex flex-col sm:flex-row items-center justify-between gap-4 rounded-2xl bg-brand-50 ring-1 ring-brand-100 p-5">
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
