@php
    $wa = preg_replace('/[^0-9]/', '', $pengaturan['whatsapp'] ?? '');
    $waLink = $wa ? 'https://wa.me/' . $wa : '#';
@endphp

<section id="beranda" class="hero-gradient relative overflow-hidden text-white min-h-screen flex flex-col">
    <div class="absolute inset-0">
        <video autoplay muted loop playsinline preload="metadata" poster="{{ asset('images/foto-rumah-depan.png') }}"
               class="absolute inset-0 w-full h-full object-cover object-bottom sm:object-center opacity-30 lg:opacity-90">
            <source src="{{ asset('images/Rumah-Beranda.mp4') }}" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-gradient-to-t from-brand-950/70 via-transparent to-brand-950/30"></div>
    </div>

    {{-- Partikel / ornamen melayang --}}
    <div class="anim-float-slow absolute top-24 right-[10%] w-40 h-40 rounded-full bg-white/10 blur-3xl pointer-events-none hidden md:block"></div>
    <div class="anim-drift absolute bottom-32 right-[38%] w-24 h-24 rounded-full bg-white/10 blur-2xl pointer-events-none hidden md:block"></div>
    <div class="anim-float absolute top-1/2 left-[6%] w-2 h-2 rounded-full bg-white/60 blur-[1px] pointer-events-none"></div>
    <div class="anim-drift absolute top-[38%] left-[14%] w-1.5 h-1.5 rounded-full bg-white/50 blur-[1px] pointer-events-none"></div>
    <div class="anim-float absolute bottom-[22%] right-[22%] w-1.5 h-1.5 rounded-full bg-white/60 blur-[1px] pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-24 w-full flex-1 flex items-center">
        <div class="anim-float-soft w-full lg:max-w-2xl">
            <div class="anim-rise">
                <h1 class="font-display text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-semibold leading-[1.08] tracking-tight">
                    Griya Utama<br>
                    <em class="text-gradient font-medium not-italic">Asri 3</em>
                </h1>

                <p class="mt-6 text-sm sm:text-base text-white/75 max-w-lg leading-relaxed">
                    {{ $pengaturan['tagline'] ?? 'Hunian modern dengan suasana asri dan hijau. Dirancang untuk memberikan kenyamanan bagi keluarga Indonesia dengan lingkungan yang aman, asri, dan penuh kehangatan. Lokasi strategis, harga terjangkau, cicilan ringan, serta fasilitas pendukung yang lengkap — mulai dari masjid, taman bermain, hingga jalan lingkungan yang lebar dan asri.' }}
                </p>

                <div class="mt-8 flex flex-wrap items-center gap-4">
                    <a href="{{ $waLink }}" target="_blank" rel="noopener" class="btn btn-gold text-base inline-flex items-center gap-2">
                        Konsultasi Gratis
                    </a>
                    <a href="#pricelist" class="btn btn-outline-light text-base inline-flex items-center gap-2">Lihat Pricelist</a>
                </div>
            </div>
        </div>
    </div>
</section>