<section id="serah-terima" class="py-20 lg:py-28 bg-brand-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-14 anim-hidden text-center">
            <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-semibold text-white">Serah Terima Kunci</h2>
            <p class="mt-5 text-white/60 max-w-2xl mx-auto leading-relaxed">Momen bahagia saat kunci rumah resmi diserahkan kepada pemilik baru. Ini adalah bukti nyata komitmen kami dalam mewujudkan hunian impian Anda.</p>
        </div>

        @if ($serah_terima->count())
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 stagger">
                @foreach ($serah_terima as $item)
                    <a href="{{ asset($item->image) }}" data-lightbox="serah-terima" data-title="{{ $item->customer ?? 'Serah Terima Kunci' }}"
                       class="group card-hover block rounded-2xl overflow-hidden bg-white/5 ring-1 ring-white/10 hover:ring-gold-400/40">
                        <div class="img-zoom rounded-none">
                            <img src="{{ asset($item->image) }}" alt="{{ $item->caption ?? 'Serah terima kunci' }}" loading="lazy"
                                 class="w-full h-64 object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-white group-hover:text-gold-300 transition-colors">{{ $item->customer ?? 'Konsumen' }}</h3>
                            <p class="mt-2 text-sm text-gold-400 font-semibold">
                                @if ($item->unit) Unit {{ $item->unit }} &middot; @endif
                                {{ $item->handover_date?->translatedFormat('d F Y') }}
                            </p>
                            @if ($item->caption)
                                <p class="mt-2 text-sm text-white/50">{{ $item->caption }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            @include('partials.empty-state', ['message' => 'Belum ada dokumentasi serah terima kunci.'])
        @endif
    </div>
</section>
