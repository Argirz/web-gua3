<section id="serah-terima" class="relative z-10 -mt-12 lg:-mt-16 rounded-t-[2.5rem] bg-brand-950 pt-20 lg:pt-32 pb-20 lg:pb-32">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="mb-14 lg:mb-20 anim-hidden flex flex-col items-center text-center">
            <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl font-bold text-white">Serah Terima Kunci</h2>
            <p class="mt-5 text-white/70 max-w-2xl mx-auto leading-relaxed text-sm sm:text-base">Mengabadikan momen berharga saat impian resmi menjadi kenyataan. Terima kasih telah mempercayakan hunian masa depan Anda di Griya Utama Asri 3.</p>
        </div>

        @if ($serah_terima->count())
            <div class="w-full anim-scale">
                <div class="relative overflow-hidden w-full">
                    <div id="serah-slideshow" class="flex gap-4 sm:gap-6 overflow-x-auto snap-x snap-mandatory scroll-smooth py-10 px-[7.5%] sm:px-[15%] lg:px-[20%] [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">
                        @foreach ($serah_terima as $i => $item)
                            <a href="{{ asset($item->image) }}" data-lightbox="serah-terima" data-title="{{ $item->customer ?? 'Serah Terima Kunci' }}"
                               data-index="{{ $i }}"
                               class="serah-slide shrink-0 w-[85%] sm:w-[70%] lg:w-[60%] snap-center block transition-all duration-500 opacity-50 scale-95 group rounded-2xl overflow-hidden bg-white/5 ring-1 ring-white/10 hover:ring-gold-400/40 shadow-2xl">
                                <div class="img-zoom rounded-none h-full">
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->caption ?? 'Serah terima kunci' }}" loading="lazy"
                                         class="w-full h-[50vh] sm:h-[60vh] lg:h-[70vh] object-cover pointer-events-none select-none">
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            @include('partials.empty-state', ['message' => 'Belum ada dokumentasi serah terima kunci.'])
        @endif
    </div>

    <script>
    (function () {
        const slideshow = document.getElementById('serah-slideshow');
        if (!slideshow) return;
        
        const slides = Array.from(slideshow.querySelectorAll('.serah-slide'));
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

        window.serahTo = function(index, isWrap = false) {
            if (!slides[index]) return;
            const targetLeft = slides[index].offsetLeft - slideshow.offsetLeft - (slideshow.clientWidth / 2) + (slides[index].clientWidth / 2);
            slideshow.scrollTo({ left: targetLeft, behavior: isWrap ? 'instant' : 'smooth' });
        };

        function next() {
            const nextIdx = (current + 1) % total;
            window.serahTo(nextIdx, nextIdx === 0 && current === total - 1);
        }
        function startAuto() { stopAuto(); autoTimer = setInterval(next, 2500); }
        function stopAuto() { if (autoTimer) clearInterval(autoTimer); }

        slideshow.addEventListener('mouseenter', stopAuto);
        slideshow.addEventListener('mouseleave', startAuto);
        slideshow.addEventListener('touchstart', stopAuto, {passive: true});
        slideshow.addEventListener('touchend', startAuto, {passive: true});
        
        window.serahTo(0);
        startAuto();
    })();
    </script>


</section>
