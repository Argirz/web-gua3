<section id="lokasi" class="py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-14 anim-hidden text-center">
            <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-semibold text-ink">Lokasi Kami</h2>
            <p class="mt-5 text-muted max-w-2xl mx-auto leading-relaxed">Temukan lokasi strategis Griya Utama Asri 3 di Banjar Baru, Kalimantan Selatan. Akses mudah ke pusat kota, sekolah, dan fasilitas publik lainnya.</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8 items-start">
            {{-- Peta --}}
            <div class="lg:col-span-2 anim-scale relative isolate overflow-hidden rounded-2xl ring-1 ring-line shadow-lg bg-brand-50">
                <div id="map" class="relative z-10 w-full h-[450px] bg-transparent"></div>
            </div>

            {{-- Info Card --}}
            <div class="lg:sticky lg:top-24 anim-slide-right card card-hover p-6 sm:p-7">
                <div class="flex items-start gap-4 mb-5">
                    <div class="shrink-0 w-14 h-14 rounded-xl bg-brand-50 text-brand-600 ring-1 ring-brand-100 flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-display font-semibold text-ink text-xl leading-tight">Griya Utama Asri 3</h3>
                        <p class="mt-1 text-xs text-muted uppercase font-semibold tracking-wide">Perumahan</p>
                        <p class="mt-2 text-sm text-ink-soft leading-relaxed">HQJ8+3X, Syamsudin Noor, Kec. Landasan Ulin, Kota Banjar Baru, Kalimantan Selatan 70721</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 mb-6">
                    <span class="text-xl font-extrabold text-ink">5.0</span>
                    <div class="flex items-center gap-0.5">
                        <svg class="w-5 h-5 text-gold-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-gold-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-gold-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-gold-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-gold-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    <a href="https://maps.google.com/?q=Griya+Utama+Asri+3&ll=-3.4196923,114.7671107&z=17" target="_blank" rel="noopener"
                       class="text-sm text-brand-600 hover:underline font-medium">(5)</a>
                </div>

                <div class="flex flex-col gap-3">
                    <a href="https://maps.google.com/?q=Griya+Utama+Asri+3&ll=-3.4196923,114.7671107&z=17" target="_blank" rel="noopener"
                       class="btn btn-outline text-center text-sm flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z"/></svg>
                        Buka Maps
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<link rel="stylesheet" href="{{ asset('vendor/leaflet/leaflet.css') }}">
<script src="{{ asset('vendor/leaflet/leaflet.js') }}"></script>
<script>
(function () {
    const el = document.getElementById('map');
    if (typeof L === 'undefined' || !el) return;

    const map = L.map('map', {
        scrollWheelZoom: false,
        zoomControl: true
    }).setView([-3.4196923, 114.7671107], 17);

    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        maxZoom: 20,
        subdomains: 'abcd',
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank" rel="noopener">OpenStreetMap</a> &copy; <a href="https://carto.com/attributions" target="_blank" rel="noopener">CARTO</a>'
    }).addTo(map);

    const icon = L.divIcon({
        className: '',
        html: '<svg width="36" height="48" viewBox="0 0 36 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 0C8.06 0 0 8.06 0 18c0 13.5 18 30 18 30s18-16.5 18-30C36 8.06 27.94 0 18 0z" fill="#047857"/><circle cx="18" cy="18" r="8" fill="#ffffff"/></svg>',
        iconSize: [36, 48],
        iconAnchor: [18, 46],
        popupAnchor: [0, -44]
    });

    L.marker([-3.4196923, 114.7671107], { icon: icon })
        .addTo(map)
        .bindPopup(
            '<div style="font-family:inherit;line-height:1.5;min-width:180px;">' +
            '<strong style="font-size:14px;">Griya Utama Asri 3</strong><br>' +
            '<span style="font-size:13px;color:#475569;">Syamsudin Noor, Landasan Ulin, Kota Banjarbaru, Kalimantan Selatan</span>' +
            '</div>'
        )
        .openPopup();

    window.addEventListener('load', () => map.invalidateSize());
    setTimeout(() => map.invalidateSize(), 500);
})();
</script>
