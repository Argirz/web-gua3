<section id="spek" class="py-16 lg:py-24 bg-sage border-t border-line">
    <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="anim-hidden text-center max-w-3xl mx-auto">
            <h2 class="font-display text-[28px] sm:text-[36px] lg:text-[42px] font-bold tracking-tight text-ink leading-[0.95]">
                Spesifikasi Bangunan <span class="text-brand-600">Berkualitas</span>
            </h2>
            <p class="mt-4 text-[14px] sm:text-[15px] leading-relaxed text-muted">
                Dibangun dengan material terpilih dan standar konstruksi terbaik untuk ketahanan jangka panjang dan kenyamanan harian.
            </p>
        </div>

        @if ($spesifikasi->count())
            @php
                $specsMeta = [
                    'Struktur & Pondasi' => ['image' => 'images/Ikon/Struktur.png', 'accent' => '#1B4332', 'title' => 'Pondasi & Struktur'],
                    'Atap' => ['image' => 'images/Ikon/Atap.png', 'accent' => '#1B4332', 'title' => 'Atap'],
                    'Lantai' => ['image' => 'images/Ikon/Lantai.png', 'accent' => '#81B29A', 'title' => 'Lantai'],
                    'Plafon' => ['image' => 'images/Ikon/Plafon.png', 'accent' => '#a67a2e', 'title' => 'Plafon'],
                    'Pintu & Jendela' => ['image' => 'images/Ikon/Pintu.png', 'accent' => '#334155', 'title' => 'Pintu & Jendela'],
                    'Elektrikal' => ['image' => 'images/Ikon/Elektrikal.png', 'accent' => '#1B4332', 'title' => 'Elektrikal & Sanitasi'],
                    'Sanitasi' => ['image' => 'images/Ikon/Sanitasi.png', 'accent' => '#0F2D1F', 'title' => 'Elektrikal & Sanitasi'],
                    'Fasilitas' => ['image' => 'images/Ikon/Fasilitas.png', 'accent' => '#c08f3e', 'title' => 'Fasilitas'],
                ];
                $cards = [];
                foreach ($spesifikasi as $cat => $items) {
                    $meta = $specsMeta[$cat] ?? ['image'=>null,'accent'=>'#1B4332','title'=>$cat];
                    $key = $meta['title'];
                    if (!isset($cards[$key])) {
                        $cards[$key] = ['meta'=>$meta, 'items'=>collect()];
                    }
                    $cards[$key]['items'] = $cards[$key]['items']->merge($items);
                }
                $order = ['Pondasi & Struktur','Atap','Lantai','Plafon','Pintu & Jendela','Elektrikal & Sanitasi','Fasilitas'];
                uksort($cards, function($a,$b) use ($order){ $pa=array_search($a,$order); $pb=array_search($b,$order); $pa=$pa===false?99:$pa; $pb=$pb===false?99:$pb; return $pa<=>$pb; });
            @endphp

            <div class="mt-10 grid gap-4 sm:gap-5 md:grid-cols-2 lg:grid-cols-3 stagger">
                @foreach ($cards as $displayTitle => $card)
                    @php
                        $items = $card['items'];
                        $s = $card['meta'];
                    @endphp
                    <div class="card card-lift p-6 sm:p-6 group">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0 border shadow-sm"
                                 style="background: color-mix(in srgb, {{ $s['accent'] }} 8%, white); border-color: color-mix(in srgb, {{ $s['accent'] }} 14%, #E2E8F0); color: {{ $s['accent'] }};">
                                @if (!empty($s['image']))
                                    <img src="{{ asset($s['image']) }}" alt="{{ $displayTitle }}" class="w-7 h-7 object-contain" loading="lazy">
                                @else
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.364A5.25 5.25 0 0110.5 12a5.25 5.25 0 015.25-5.25h.008M11.42 15.364A9.75 9.75 0 0012 21a9.75 9.75 0 009.75-9.75c0-1.33-.266-2.597-.748-3.752M11.42 15.364c-.43.64-.97 1.2-1.59 1.65A9.728 9.728 0 0112 21a9.73 9.73 0 01-2.578-.347M4.5 12a9.75 9.75 0 019.75-9.75c1.33 0 2.597.266 3.752.748M4.5 12a9.752 9.752 0 00.347 2.578M4.5 12c.64.43 1.2.97 1.65 1.59"/></svg>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <h3 class="font-bold text-ink text-[15px] leading-tight">{{ $displayTitle }}</h3>
                                <p class="text-xs text-muted mt-1">{{ $s['title'] === $displayTitle ? $displayTitle : $displayTitle }}</p>
                            </div>
                        </div>

                        <dl class="mt-5 space-y-0 rounded-xl bg-sage/40 border border-line overflow-hidden">
                            @foreach ($items as $item)
                                <div class="flex justify-between gap-4 text-[13px] py-2.5 px-3.5 border-b border-line last:border-0 bg-white/60">
                                    <dt class="text-muted font-medium">{{ $item->name }}</dt>
                                    <dd class="font-semibold text-ink text-right max-w-[55%] leading-tight">{{ $item->value }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>
                @endforeach
            </div>

        @else
            @include('partials.empty-state', ['message' => 'Belum ada data spesifikasi.'])
        @endif
    </div>
</section>
