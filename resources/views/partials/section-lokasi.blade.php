<section id="lokasi" class="relative z-10 -mt-12 lg:-mt-16 rounded-t-[2.5rem] bg-cream shadow-[0_-40px_70px_-45px_rgba(13,33,23,0.4)] pt-20 lg:pt-32 pb-20 lg:pb-32">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="mb-14 lg:mb-20 anim-hidden flex flex-col items-center text-center">
            <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl font-bold text-ink">Lokasi Kami</h2>
            <p class="mt-5 text-muted max-w-2xl mx-auto leading-relaxed text-sm sm:text-base">Terletak di kawasan berkembang Banjarbaru, Griya Utama Asri 3 hadir di lokasi strategis dengan akses mudah ke beragam fasilitas publik dan pusat aktivitas kota.</p>
        </div>

        {{-- Peta --}}
        <div class="anim-scale relative isolate overflow-hidden rounded-2xl ring-1 ring-line shadow-lg bg-brand-50 max-w-4xl mx-auto aspect-[4/3] min-h-[400px] sm:min-h-[500px] lg:min-h-[600px]">
            <iframe id="map"
                    src="https://maps.google.com/maps?q=Griya+Utama+Asri+3&z=17&hl=id&output=embed"
                    class="absolute inset-0 w-full h-full border-0"
                    loading="lazy"
                    allowfullscreen
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Peta Griya Utama Asri 3"></iframe>
        </div>
    </div>
</section>
