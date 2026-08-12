<section id="pricelist" class="py-20 lg:py-28 dark-gradient text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-14 anim-hidden text-center">
            <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-semibold text-white">Pricelist Rumah</h2>
            <p class="mt-5 text-white/60 max-w-2xl mx-auto leading-relaxed">Lihat daftar harga terbaru untuk setiap tipe rumah di Griya Utama Asri 3. Harga bisa berubah sewaktu-waktu, hubungi kami untuk informasi terkini.</p>
        </div>

        @if ($pricelists->count())
            <div class="overflow-x-auto rounded-2xl bg-white text-ink shadow-2xl shadow-black/30 ring-1 ring-white/10 anim-scale">
                <table class="w-full text-sm text-left min-w-[640px]">
                    <thead>
                        <tr class="bg-brand-950 text-white">
                            <th class="py-5 px-4 sm:px-6 font-semibold whitespace-nowrap text-left">Tipe</th>
                            <th class="py-5 px-4 sm:px-6 font-semibold text-right whitespace-nowrap">Luas Tanah</th>
                            <th class="py-5 px-4 sm:px-6 font-semibold text-right whitespace-nowrap">Luas Bangunan</th>
                            <th class="py-5 px-4 sm:px-6 font-semibold text-right whitespace-nowrap">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pricelists as $pl)
                            @php
                                $hargaFinal = $pl->price - $pl->discount;
                            @endphp
                            <tr class="border-b border-line last:border-0 hover:bg-brand-50/60 transition-colors">
                                <td class="py-5 px-4 sm:px-6 font-bold text-ink whitespace-nowrap">{{ $pl->title }}</td>
                                <td class="py-5 px-4 sm:px-6 text-muted text-right whitespace-nowrap">{{ $pl->land_area ? $pl->land_area . ' mÂ²' : '-' }}</td>
                                <td class="py-5 px-4 sm:px-6 text-muted text-right whitespace-nowrap">{{ $pl->building_area ? $pl->building_area . ' mÂ²' : '-' }}</td>
                                <td class="py-5 px-4 sm:px-6 text-right align-middle whitespace-nowrap">
                                    @if ($pl->discount > 0)
                                        <span class="text-sm text-muted line-through mr-2 align-middle">Rp {{ number_format($pl->price, 0, ',', '.') }}</span>
                                        <span class="font-extrabold text-brand-600 text-base align-middle">Rp {{ number_format($hargaFinal, 0, ',', '.') }}</span>
                                    @else
                                        <span class="font-extrabold text-ink text-base align-middle">Rp {{ number_format($pl->price, 0, ',', '.') }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            @include('partials.empty-state', ['message' => 'Belum ada data pricelist.'])
        @endif
    </div>
</section>