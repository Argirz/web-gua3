@php
    $wa = preg_replace('/[^0-9]/', '', $settings['whatsapp'] ?? '');
    $waLink = $wa ? 'https://wa.me/' . $wa : '#';
@endphp

<section id="beranda" class="hero-gradient relative overflow-hidden text-white min-h-screen flex flex-col">
    <div class="absolute inset-0 lg:mask-right-fade" style="mask-image: linear-gradient(to right, transparent 0%, black 45%); -webkit-mask-image: linear-gradient(to right, transparent 0%, black 45%);">
        <img src="{{ asset('images/foto-rumah-depan.png') }}" alt="Rumah Griya Utama Asri 3" class="absolute inset-0 w-full h-full object-cover object-bottom sm:object-center opacity-30 lg:opacity-90">
        <div class="absolute inset-0 bg-gradient-to-t from-brand-950/70 via-transparent to-brand-950/30"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-24 w-full flex-1 flex items-center">
        <div class="w-full lg:max-w-2xl anim-hidden">
            <h1 class="font-display text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-semibold leading-[1.08] tracking-tight">
                Griya Utama<br>
                <em class="text-gradient font-medium not-italic">Asri 3</em>
            </h1>

            <p class="mt-5 text-sm sm:text-base text-white/70 max-w-lg leading-relaxed">
                {{ $settings['tagline'] ?? 'Hunian modern dengan suasana asri dan hijau. Dirancang untuk memberikan kenyamanan bagi keluarga Indonesia dengan lingkungan yang aman, asri, dan penuh kehangatan. Lokasi strategis, harga terjangkau, cicilan ringan, serta fasilitas pendukung yang lengkap — mulai dari masjid, taman bermain, hingga jalan lingkungan yang lebar dan asri.' }}
            </p>

            <div class="mt-10 flex flex-wrap items-center gap-4">
                <a href="{{ $waLink }}" target="_blank" rel="noopener" class="btn btn-gold text-base inline-flex items-center gap-2">
                    Konsultasi Gratis
                </a>
                <a href="#pricelist" class="btn btn-outline-light text-base inline-flex items-center gap-2">Lihat Pricelist</a>
            </div>
        </div>
    </div>
</section>
