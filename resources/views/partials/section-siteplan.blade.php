<section id="siteplan" class="py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-14 anim-hidden text-center">
            <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-semibold text-ink">Siteplan</h2>
            <p class="mt-5 text-muted max-w-2xl mx-auto leading-relaxed">Layout lengkap nomor kavling perumahan Griya Utama Asri 3, total 85 unit.</p>
        </div>

        @if ($denah->count())
            <div class="mb-10 anim-hidden flex justify-center">
                <a href="{{ asset('images/Siteplan GUA3.jpg') }}" data-lightbox="siteplan" data-title="Siteplan Griya Utama Asri 3"
                   class="group card card-hover block max-w-2xl w-full overflow-hidden">
                    <div class="img-zoom rounded-none">
                        <img src="{{ asset('images/Siteplan GUA3.jpg') }}" alt="Siteplan Griya Utama Asri 3" loading="lazy"
                             class="w-full h-auto">
                    </div>
                    <div class="p-6 border-t border-line">
                        <h3 class="text-lg font-bold text-ink group-hover:text-brand-600 transition-colors">Siteplan Griya Utama Asri 3</h3>
                        <p class="mt-2 text-sm text-muted leading-relaxed">Klik untuk memperbesar gambar siteplan.</p>
                    </div>
                </a>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 max-w-4xl mx-auto stagger">
                @foreach ($denah as $siteplan)
                    <a href="{{ asset($siteplan->image) }}" data-lightbox="siteplan" data-title="{{ $siteplan->title }}"
                       class="group card card-hover block overflow-hidden">
                        <div class="img-zoom rounded-none bg-brand-50">
                            <img src="{{ asset($siteplan->image) }}" alt="{{ $siteplan->title }}" loading="lazy"
                                 class="w-full h-auto">
                        </div>
                        <div class="p-6 border-t border-line">
                            <h3 class="text-lg font-bold text-ink group-hover:text-brand-600 transition-colors">{{ $siteplan->title }}</h3>
                            @if ($siteplan->description)
                                <p class="mt-2 text-sm text-muted leading-relaxed">{{ $siteplan->description }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>

        @else
            @include('partials.empty-state', ['message' => 'Belum ada gambar siteplan.'])
        @endif
    </div>
</section>
