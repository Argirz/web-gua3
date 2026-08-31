<section id="pricelist" class="py-20 lg:py-32 dark-gradient text-white">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="mb-14 lg:mb-20 anim-hidden flex flex-col items-center text-center">
            <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl font-bold text-white">Pricelist Rumah</h2>
            <p class="mt-5 text-white/70 max-w-2xl mx-auto leading-relaxed text-sm sm:text-base">Miliki hunian impian dengan nilai investasi terbaik. Hubungi kami untuk konsultasi simulasi pembiayaan dan pembaruan harga terkini.</p>
        </div>

        @if ($pricelists->count())
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 lg:gap-8 stagger">
                @foreach ($pricelists as $pl)
                    @php
                        $hargaFinal = $pl->price - $pl->discount;
                    @endphp
                    <div class="card p-6 sm:p-8 bg-white flex flex-col justify-between shadow-xl shadow-black/20 ring-1 ring-white/10 hover:-translate-y-2 transition-transform duration-500">
                        <div>
                            <h3 class="font-display text-3xl sm:text-4xl font-bold text-ink mb-6">{{ $pl->title }}</h3>
                            
                            <div class="grid grid-cols-2 gap-3 sm:gap-4 mb-8">
                                <div class="p-3 sm:p-4 rounded-xl bg-surface border border-line">
                                    <p class="text-[11px] sm:text-xs text-muted mb-1">Luas Tanah</p>
                                    <p class="text-base sm:text-lg font-bold text-ink">{{ $pl->land_area ? $pl->land_area . ' m²' : '-' }}</p>
                                </div>
                                <div class="p-3 sm:p-4 rounded-xl bg-surface border border-line">
                                    <p class="text-[11px] sm:text-xs text-muted mb-1">Luas Bangunan</p>
                                    <p class="text-base sm:text-lg font-bold text-ink">{{ $pl->building_area ? $pl->building_area . ' m²' : '-' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="pt-6 border-t border-line mt-auto">
                            <p class="text-xs text-muted mb-2 uppercase tracking-wider font-bold">Harga Spesial</p>
                            @if ($pl->discount > 0)
                                <div class="flex flex-col gap-0.5">
                                    <span class="text-sm text-red-500/80 line-through font-medium">Rp {{ number_format($pl->price, 0, ',', '.') }}</span>
                                    <span class="text-3xl sm:text-4xl font-extrabold text-brand-600">Rp {{ number_format($hargaFinal, 0, ',', '.') }}</span>
                                </div>
                            @else
                                <span class="text-3xl sm:text-4xl font-extrabold text-ink block mt-2">Rp {{ number_format($pl->price, 0, ',', '.') }}</span>
                            @endif
                            <a href="#minat" class="mt-8 btn btn-gold w-full text-center flex items-center justify-center py-3.5">Pesan Sekarang</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            @include('partials.empty-state', ['message' => 'Belum ada data pricelist.'])
        @endif
    </div>
</section>