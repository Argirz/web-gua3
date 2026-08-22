<section id="siteplan" class="relative z-10 -mt-12 lg:-mt-16 rounded-t-[2.5rem] bg-cream shadow-[0_-40px_70px_-45px_rgba(13,33,23,0.4)] pt-20 lg:pt-32 pb-20 lg:pb-32">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="mb-14 lg:mb-20 anim-hidden flex flex-col items-center text-center">
            <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl font-bold text-ink">Siteplan</h2>
            <p class="mt-5 text-muted max-w-2xl mx-auto leading-relaxed text-sm sm:text-base">Rencana tapak terstruktur perumahan Griya Utama Asri 3 yang mencakup 85 unit. Pilih lokasi kaveling yang paling sesuai dengan kebutuhan Anda.</p>
        </div>

        @if ($denah->count())
            <div class="grid gap-6 lg:grid-cols-2 items-stretch anim-scale w-full">
                {{-- Siteplan --}}
                <a href="{{ asset('images/Siteplan GUA3.jpg') }}" data-lightbox="siteplan" data-title="Siteplan Griya Utama Asri 3"
                   class="group card card-hover block overflow-hidden flex flex-col">
                    <div class="img-zoom rounded-none w-full aspect-[5/3]">
                        <img src="{{ asset('images/Siteplan GUA3.jpg') }}" alt="Siteplan Griya Utama Asri 3" loading="lazy"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-5 border-t border-line">
                        <h3 class="text-lg font-bold text-ink group-hover:text-brand-600 transition-colors">Siteplan Griya Utama Asri 3</h3>
                    </div>
                </a>

                {{-- Denah --}}
                <div class="grid gap-6 content-start">
                    @foreach ($denah as $siteplan)
                        <a href="{{ asset($siteplan->image) }}" data-lightbox="siteplan" data-title="{{ $siteplan->title }}"
                           class="group card card-hover block overflow-hidden flex flex-col">
                            <div class="img-zoom rounded-none w-full aspect-[5/3] bg-brand-50">
                                <img src="{{ asset($siteplan->image) }}" alt="{{ $siteplan->title }}" loading="lazy"
                                     class="w-full h-full object-contain">
                            </div>
                            <div class="p-5 border-t border-line">
                                <h3 class="text-lg font-bold text-ink group-hover:text-brand-600 transition-colors">{{ $siteplan->title }}</h3>
                                @if ($siteplan->description)
                                    <p class="mt-1 text-sm text-muted leading-relaxed">{{ $siteplan->description }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

        @else
            @include('partials.empty-state', ['message' => 'Belum ada gambar siteplan.'])
        @endif
    </div>
</section>
