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
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>',
                        'from' => '#c08f3e', 'to' => '#cda453',
                    ],
                    'Atap' => [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>',
                        'from' => '#2e6f4b', 'to' => '#3f8a60',
                    ],
                    'Lantai' => [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>',
                        'from' => '#3f8a60', 'to' => '#61a47b',
                    ],
                    'Plafon' => [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/>',
                        'from' => '#855a2b', 'to' => '#cda453',
                    ],
                    'Pintu & Jendela' => [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"/>',
                        'from' => '#3f8a60', 'to' => '#94c5a4',
                    ],
                    'Elektrikal' => [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>',
                        'from' => '#c08f3e', 'to' => '#d8ba74',
                    ],
                    'Sanitasi' => [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/>',
                        'from' => '#2e6f4b', 'to' => '#61a47b',
                    ],
                    'Fasilitas' => [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z"/>',
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
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">{!! $s['icon'] ?? '' !!}</svg>
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
