<section id="foto-rumah" class="py-16 lg:py-24 bg-white border-t border-line">
    <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="anim-hidden text-center max-w-3xl mx-auto">
            <h2 class="font-display text-[28px] sm:text-[36px] lg:text-[42px] font-bold tracking-tight text-ink leading-[0.95]">
                Foto Rumah & Lingkungan
            </h2>
            <p class="mt-4 text-[14px] sm:text-[15px] leading-relaxed text-muted">Intip lebih dekat pesona desain unit dan tenangnya suasana lingkungan di Griya Utama Asri 3.</p>
        </div>

        @if ($foto_rumah->count())
            <div class="mt-10 anim-scale">
                <div class="card overflow-hidden p-2 sm:p-3 bg-sage/40">
                    <div class="relative overflow-hidden rounded-[18px] bg-white">
                        <div id="foto-slideshow" class="flex gap-4 sm:gap-5 overflow-x-auto snap-x snap-mandatory scroll-smooth py-6 px-[7.5%] sm:px-[15%] lg:px-[18%] [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
                            @foreach ($foto_rumah as $i => $item)
                                @php $imgUrl = str_starts_with($item->image, 'http') ? $item->image : asset($item->image); @endphp
                                <a href="{{ $imgUrl }}" data-lightbox="foto-rumah" data-title="{{ $item->title }}"
                                   data-index="{{ $i }}"
                                   class="galeri-slide shrink-0 w-[85%] sm:w-[68%] lg:w-[60%] snap-center block transition-all duration-500 opacity-60 scale-[0.97] rounded-2xl overflow-hidden border border-line shadow-sm bg-white">
                                    <img src="{{ $imgUrl }}" alt="{{ $item->title }}" loading="lazy" onerror="this.onerror=null;this.src='{{ asset('images/foto-rumah-depan.jpg') }}'"
                                         class="w-full h-[46vh] sm:h-[52vh] lg:h-[58vh] object-cover pointer-events-none select-none group-hover:scale-[1.02]">
                                </a>
                            @endforeach
                        </div>
                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 hidden sm:flex items-center gap-2 rounded-full bg-white/90 backdrop-blur border border-line shadow-sm px-3 py-1.5">
                            <span class="text-xs font-semibold text-ink">Geser untuk jelajahi</span>
                        </div>
                    </div>
                </div>
            </div>
        @else
            @include('partials.empty-state', ['message' => 'Belum ada foto rumah. Silakan tambahkan galeri nanti.'])
        @endif
    </div>

    <script>
    (function () {
        const slideshow = document.getElementById('foto-slideshow');
        if (!slideshow) return;
        const slides = Array.from(slideshow.querySelectorAll('.galeri-slide'));
        let current = 0;
        let autoTimer = null;
        const total = slides.length;
        function updateVisuals() {
            slides.forEach((s, idx) => {
                if (idx === current) { s.classList.remove('opacity-60','scale-[0.97]'); s.classList.add('opacity-100','scale-100'); s.classList.add('ring-2','ring-brand-200'); }
                else { s.classList.add('opacity-60','scale-[0.97]'); s.classList.remove('opacity-100','scale-100','ring-2','ring-brand-200'); }
            });
        }
        slideshow.addEventListener('scroll', () => {
            const viewCenter = slideshow.scrollLeft + (slideshow.clientWidth / 2);
            let closestIdx = 0; let minDistance = Infinity;
            slides.forEach((s, idx) => {
                const sCenter = s.offsetLeft - slideshow.offsetLeft + (s.clientWidth / 2);
                const dist = Math.abs(sCenter - viewCenter);
                if (dist < minDistance) { minDistance = dist; closestIdx = idx; }
            });
            if (current !== closestIdx) { current = closestIdx; updateVisuals(); }
        }, { passive: true });
        window.galeriTo = function(index, isWrap = false) {
            if (!slides[index]) return; current=index;
            const targetLeft = slides[index].offsetLeft - slideshow.offsetLeft - (slideshow.clientWidth / 2) + (slides[index].clientWidth / 2);
            slideshow.scrollTo({ left: targetLeft, behavior: isWrap ? 'auto' : 'smooth' });
            updateVisuals();
        };
        function next() { const nextIdx = (current + 1) % total; window.galeriTo(nextIdx, nextIdx === 0 && current === total - 1); }
        function startAuto() { stopAuto(); autoTimer = setInterval(next, 3200); }
        function stopAuto() { if (autoTimer) clearInterval(autoTimer); }
        slideshow.addEventListener('mouseenter', stopAuto); slideshow.addEventListener('mouseleave', startAuto);
        slideshow.addEventListener('touchstart', stopAuto, {passive: true}); slideshow.addEventListener('touchend', startAuto, {passive: true});
        window.galeriTo(0); startAuto(); updateVisuals();
    })();
    </script>
</section>
