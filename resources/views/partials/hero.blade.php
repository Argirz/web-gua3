@php
    $wa = preg_replace('/[^0-9]/', '', $pengaturan['whatsapp'] ?? '');
    $waLink = $wa ? 'https://wa.me/' . $wa : '#';
@endphp

<section id="beranda" class="hero-gradient relative overflow-hidden text-white min-h-screen flex flex-col">
    <div class="absolute inset-0">
        <video id="hero-vid" autoplay muted loop playsinline preload="metadata" poster="{{ asset('images/foto-rumah-depan.png') }}"
               class="absolute inset-0 w-full h-full object-cover object-bottom sm:object-center">
            <source src="{{ asset('images/Rumah-Beranda.mp4') }}" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-brand-950/20"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-brand-950/90 via-brand-950/10 to-transparent"></div>
    </div>



    <div class="relative w-full px-4 sm:px-6 lg:px-8 pt-32 pb-24 flex-1 flex items-center justify-center">
        <div class="w-full max-w-lg lg:max-w-4xl text-center" data-velocity="0.8" data-velocity-fade="0.55">
            <div class="anim-rise">
                <h1 class="font-display text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-semibold leading-[1.08] tracking-tight">
                    Griya Utama<br>
                    <em class="text-gradient font-medium not-italic">Asri 3</em>
                </h1>

                <p class="mt-6 text-sm sm:text-base text-white/75 mx-auto max-w-2xl leading-relaxed">
                    Nikmati perpaduan sempurna antara lingkungan asri, gaya hidup modern, dan keamanan tanpa kompromi. Hadir di kawasan strategis Banjarbaru dengan penawaran harga yang bersahabat
                </p>

                <div class="mt-8 flex flex-col sm:flex-row flex-wrap items-center justify-center gap-4">
                    <a href="#minat" class="btn btn-gold text-base inline-flex items-center justify-center gap-2 w-full sm:w-auto">
                        Konsultasi Gratis
                    </a>
                    <a href="#pricelist" class="btn btn-outline-light text-base inline-flex items-center justify-center gap-2 w-full sm:w-auto">Lihat Pricelist</a>
                </div>
            </div>
        </div>
    </div>
</section>