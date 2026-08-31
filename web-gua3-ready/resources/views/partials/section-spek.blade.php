<section id="spek" class="py-20 lg:py-32 bg-brand-50/50">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="mb-14 lg:mb-20 anim-hidden flex flex-col items-center text-center">
            <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl font-bold text-ink">Spesifikasi Bangunan</h2>
            <p class="mt-5 text-muted max-w-2xl mx-auto leading-relaxed text-sm sm:text-base">Dibangun dengan material bermutu tinggi dan standar konstruksi terbaik demi ketahanan jangka panjang.</p>
        </div>

        @if ($spesifikasi->count())
            @php
                $specs = [
                    'Struktur & Pondasi' => [
                        'image' => 'images/Ikon/Struktur.png',
                        'from' => '#c08f3e', 'to' => '#cda453',
                    ],
                    'Atap' => [
                        'image' => 'images/Ikon/Atap.png',
                        'from' => '#2e6f4b', 'to' => '#3f8a60',
                    ],
                    'Lantai' => [
                        'image' => 'images/Ikon/Lantai.png',
                        'from' => '#3f8a60', 'to' => '#61a47b',
                    ],
                    'Plafon' => [
                        'image' => 'images/Ikon/Plafon.png',
                        'from' => '#855a2b', 'to' => '#cda453',
                    ],
                    'Pintu & Jendela' => [
                        'image' => 'images/Ikon/Pintu.png',
                        'from' => '#3f8a60', 'to' => '#94c5a4',
                    ],
                    'Elektrikal' => [
                        'image' => 'images/Ikon/Elektrikal.png',
                        'from' => '#c08f3e', 'to' => '#d8ba74',
                    ],
                    'Sanitasi' => [
                        'image' => 'images/Ikon/Sanitasi.png',
                        'from' => '#2e6f4b', 'to' => '#61a47b',
                    ],
                    'Fasilitas' => [
                        'image' => 'images/Ikon/Fasilitas.png',
                        'from' => '#c08f3e', 'to' => '#d8ba74',
                    ],
                ];
            @endphp

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 stagger">
                @foreach ($spesifikasi as $category => $items)
                    @php $s = $specs[$category] ?? null; @endphp
                    <div class="card card-hover p-6 sm:p-7">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-brand-50 text-brand-600 ring-1 ring-brand-100"
                                 style="background: linear-gradient(135deg, color-mix(in srgb, {{ $s['from'] ?? '#3f8a60' }} 12%, white), color-mix(in srgb, {{ $s['to'] ?? '#61a47b' }} 12%, white)); color: {{ $s['from'] ?? '#3f8a60' }};">
                                @if (!empty($s['image']))
                                    <img src="{{ asset($s['image']) }}" alt="{{ $category }}" class="w-7 h-7 object-contain">
                                @else
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">{!! $s['icon'] ?? '' !!}</svg>
                                @endif
                            </div>
                            <h3 class="font-display text-lg font-semibold text-ink">{{ $category }}</h3>
                        </div>
                        <dl class="space-y-3">
                            @foreach ($items as $item)
                                <div class="flex justify-between gap-4 text-sm py-2 border-b border-line last:border-0">
                                    <dt class="text-muted">{{ $item->name }}</dt>
                                    <dd class="font-semibold text-ink text-right">{{ $item->value }}</dd>
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
