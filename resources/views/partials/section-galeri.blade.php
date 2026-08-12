<section id="foto-rumah" class="py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-14 anim-hidden text-center">
            <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-semibold text-ink">Foto Rumah</h2>
            <p class="mt-5 text-muted max-w-2xl mx-auto leading-relaxed">Lihat tampilan unit dan suasana lingkungan Griya Utama Asri 3.</p>
        </div>

        @if ($galleries->count())
            <div class="anim-hidden relative overflow-hidden rounded-3xl bg-brand-950 ring-1 ring-line shadow-xl aspect-[16/9]">
                @foreach ($galleries as $i => $item)
                    <div class="galeri-slide absolute inset-0 transition-opacity duration-700 ease-in-out {{ $i === 0 ? 'opacity-100' : 'opacity-0 pointer-events-none' }}">
                        <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" loading="lazy"
                             class="w-full h-full object-cover pointer-events-none select-none">
                    </div>
                @endforeach

                <div class="absolute bottom-3 sm:bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-2 z-10">
                    @foreach ($galleries as $i => $item)
                        <button type="button" onclick="galeriTo({{ $i }})" aria-label="Foto {{ $i + 1 }}"
                                class="galeri-dot w-2 h-2 rounded-full bg-white/40 transition-all duration-300 {{ $i === 0 ? 'bg-gold-400 w-7' : '' }}"></button>
                    @endforeach
                </div>
            </div>
        @else
            @include('partials.empty-state', ['message' => 'Belum ada foto rumah. Silakan tambahkan galeri nanti.'])
        @endif
    </div>

    <script>
    (function () {
        const slides = document.querySelectorAll('.galeri-slide');
        const dots = document.querySelectorAll('.galeri-dot');
        if (!slides.length) return;
        let current = 0;
        function show(i) {
            const n = slides.length;
            current = (i + n) % n;
            slides.forEach((s, idx) => {
                s.classList.toggle('opacity-100', idx === current);
                s.classList.toggle('opacity-0', idx !== current);
                s.classList.toggle('pointer-events-none', idx !== current);
            });
            dots.forEach((d, idx) => {
                d.classList.toggle('bg-gold-400', idx === current);
                d.classList.toggle('w-7', idx === current);
                d.classList.toggle('bg-white/40', idx !== current);
            });
        }
        window.galeriTo = (i) => show(i);
        setInterval(() => show(current + 1), 5000);
    })();
    </script>
</section>
