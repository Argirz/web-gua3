@php
    $doneImages = [
        'images/1 done.png',
        'images/2 done.png',
        'images/4 done.png',
        'images/16 done.png',
        'images/17 done.png',
        'images/25 done.png',
        'images/26 done.png',
    ];
@endphp

<section class="relative py-12 lg:py-16 bg-brand-950 overflow-hidden">
    <div class="absolute inset-0 opacity-[0.35]">
        <div class="absolute -top-24 right-1/4 w-96 h-96 bg-brand-600/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-1/4 w-80 h-80 bg-gold-500/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative mx-auto max-w-6xl px-4 sm:px-6">
        <div id="done-frame" class="relative overflow-hidden rounded-3xl shadow-2xl shadow-black/40 ring-1 ring-white/10 bg-brand-900">
            <div id="done-track" class="flex transition-transform duration-700 ease-out">
                @foreach ($doneImages as $i => $img)
                    <div class="done-slide w-full shrink-0">
                        <img src="{{ asset($img) }}" alt="Progress Griya Utama Asri 3" loading="lazy"
                             class="w-full h-auto block pointer-events-none select-none">
                    </div>
                @endforeach
            </div>

            <div class="absolute bottom-3 sm:bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-2 z-10">
                @foreach ($doneImages as $i => $img)
                    <button type="button" data-dot="{{ $i }}" aria-label="Foto {{ $i + 1 }}"
                            class="done-dot w-2 h-2 rounded-full bg-white/40 transition-all duration-300 {{ $i === 0 ? 'bg-gold-400 w-7' : '' }}"></button>
                @endforeach
            </div>
        </div>
    </div>
</section>

<script>
(function() {
    const frame = document.getElementById('done-frame');
    const track = document.getElementById('done-track');
    if (!frame || !track) return;
    const slides = track.querySelectorAll('.done-slide');
    const dots = document.querySelectorAll('.done-dot');
    if (!slides.length) return;
    let current = 0;

    const fitHeight = () => {
        const img = slides[0].querySelector('img');
        if (!img || !img.complete || !img.naturalWidth) return;
        frame.style.height = (frame.offsetWidth * img.naturalHeight / img.naturalWidth) + 'px';
    };

    const firstImg = slides[0].querySelector('img');
    if (firstImg && firstImg.complete) {
        fitHeight();
    } else {
        firstImg?.addEventListener('load', fitHeight);
    }
    window.addEventListener('resize', fitHeight);

    const show = (i) => {
        const n = slides.length;
        current = (i + n) % n;
        track.style.transform = 'translateX(-' + current * 100 + '%)';
        dots.forEach((d, idx) => {
            d.classList.toggle('bg-gold-400', idx === current);
            d.classList.toggle('w-7', idx === current);
            d.classList.toggle('bg-white/40', idx !== current);
        });
    };

    let timer = setInterval(() => show(current + 1), 6000);
    const restart = () => { clearInterval(timer); timer = setInterval(() => show(current + 1), 6000); };

    dots.forEach((d) => d.addEventListener('click', () => { show(parseInt(d.dataset.dot)); restart(); }));
})();
</script>
