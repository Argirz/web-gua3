<section id="foto-rumah" class="relative z-10 -mt-16 lg:-mt-20 rounded-t-[2.5rem] bg-surface shadow-[0_-45px_80px_-50px_rgba(13,33,23,0.55)] pt-20 lg:pt-32 pb-20 lg:pb-32">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="mb-14 lg:mb-20 anim-hidden flex flex-col items-center text-center">
            <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl font-bold text-ink">Foto Rumah</h2>
            <p class="mt-5 text-muted max-w-2xl mx-auto leading-relaxed text-sm sm:text-base">Intip lebih dekat pesona desain unit dan rasakan tenangnya suasana lingkungan di Griya Utama Asri 3. Bayangkan kenyamanan masa depan Anda di sini</p>
        </div>

        @if ($foto_rumah->count())
            <div class="w-full anim-scale">
                <div class="card card-hover overflow-hidden flex flex-col bg-brand-950">
                    <div class="relative overflow-hidden w-full">
                        <div id="foto-slideshow" class="flex gap-4 sm:gap-6 overflow-x-auto snap-x snap-mandatory scroll-smooth py-10 px-[7.5%] sm:px-[15%] lg:px-[20%] [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
                            @foreach ($foto_rumah as $i => $item)
                                <a href="{{ asset($item->image) }}" data-lightbox="foto-rumah" data-title="{{ $item->title }}"
                                   data-index="{{ $i }}"
                                   class="galeri-slide shrink-0 w-[85%] sm:w-[70%] lg:w-[60%] snap-center block transition-all duration-500 opacity-50 scale-95">
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" loading="lazy"
                                         class="w-full h-[50vh] sm:h-[60vh] lg:h-[70vh] object-cover rounded-xl shadow-2xl pointer-events-none select-none">
                                </a>
                            @endforeach
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
                if (idx === current) {
                    s.classList.replace('opacity-50', 'opacity-100');
                    s.classList.replace('scale-95', 'scale-100');
                } else {
                    s.classList.replace('opacity-100', 'opacity-50');
                    s.classList.replace('scale-100', 'scale-95');
                }
            });
        }

        slideshow.addEventListener('scroll', () => {
            const viewCenter = slideshow.scrollLeft + (slideshow.clientWidth / 2);
            let closestIdx = 0;
            let minDistance = Infinity;
            
            slides.forEach((s, idx) => {
                const sCenter = s.offsetLeft - slideshow.offsetLeft + (s.clientWidth / 2);
                const dist = Math.abs(sCenter - viewCenter);
                if (dist < minDistance) {
                    minDistance = dist;
                    closestIdx = idx;
                }
            });

            if (current !== closestIdx) {
                current = closestIdx;
                updateVisuals();
            }
        }, { passive: true });

        window.galeriTo = function(index, isWrap = false) {
            if (!slides[index]) return;
            const targetLeft = slides[index].offsetLeft - slideshow.offsetLeft - (slideshow.clientWidth / 2) + (slides[index].clientWidth / 2);
            slideshow.scrollTo({ left: targetLeft, behavior: isWrap ? 'instant' : 'smooth' });
        };

        function next() {
            const nextIdx = (current + 1) % total;
            window.galeriTo(nextIdx, nextIdx === 0 && current === total - 1);
        }
        function startAuto() { stopAuto(); autoTimer = setInterval(next, 2500); }
        function stopAuto() { if (autoTimer) clearInterval(autoTimer); }

        slideshow.addEventListener('mouseenter', stopAuto);
        slideshow.addEventListener('mouseleave', startAuto);
        slideshow.addEventListener('touchstart', stopAuto, {passive: true});
        slideshow.addEventListener('touchend', startAuto, {passive: true});
        
        window.galeriTo(0);
        startAuto();
    })();
    </script>
</section>