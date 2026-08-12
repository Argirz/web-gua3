@php
    $wa = preg_replace('/[^0-9]/', '', $settings['whatsapp'] ?? '');
    $waLink = $wa ? 'https://wa.me/' . $wa : '#';
    $menu = [
        'foto-rumah' => 'Foto Rumah',
        'serah-terima' => 'Serah Terima',
        'siteplan' => 'Siteplan',
        'terjual' => 'Rumah Terjual',
        'spek' => 'Spesifikasi',
        'brosur' => 'Brosur',
        'pricelist' => 'Pricelist',
        'lokasi' => 'Lokasi',
    ];
@endphp

<header id="navbar" class="fixed inset-x-0 top-0 z-50">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-18 xl:h-20">
            <a href="#beranda" class="flex items-center gap-3 group">
                <img src="{{ asset('images/logo-gua3.jpg') }}" alt="Logo GUA 3"
                     class="w-11 h-11 rounded-full object-cover ring-2 ring-white/25 group-hover:ring-white/50 transition-all">
                <div class="leading-tight">
                    <span class="nav-brand block font-display text-sm sm:text-base font-bold tracking-wide">Griya Utama Asri 3</span>
                </div>
            </a>

            <div class="hidden xl:flex items-center gap-1">
                @foreach ($menu as $id => $label)
                    <a href="#{{ $id }}" class="nav-link px-3 py-2.5 rounded-full">{{ $label }}</a>
                @endforeach
                <a href="#kontak" class="nav-link px-3 py-2.5 rounded-full">Kontak</a>
            </div>

            <button id="menu-toggle" type="button" class="xl:hidden p-2 rounded-full text-white transition" aria-label="Menu">
                <svg id="menu-open" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5"/></svg>
                <svg id="menu-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <div id="mobile-menu" class="hidden xl:hidden pb-4">
            <div class="flex flex-col gap-1 pt-3 rounded-2xl bg-white shadow-xl border border-line p-3">
                @foreach ($menu as $id => $label)
                    <a href="#{{ $id }}" class="px-4 py-3 text-sm font-semibold text-ink-soft hover:bg-brand-50 hover:text-brand-600 rounded-xl transition-all">{{ $label }}</a>
                @endforeach
                <a href="#kontak" class="px-4 py-3 text-sm font-semibold text-ink-soft hover:bg-brand-50 hover:text-brand-600 rounded-xl transition-all">Kontak</a>
            </div>
        </div>
    </nav>
</header>
