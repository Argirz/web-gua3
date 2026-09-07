@php
    $wa = preg_replace('/[^0-9]/', '', $pengaturan['whatsapp'] ?? '');
    $waLink = $wa ? 'https://wa.me/' . $wa : '#';
    $menu = [
        'beranda' => 'Beranda',
        'availability' => 'Unit & Siteplan',
        'spek' => 'Spesifikasi',
        'legalitas' => 'Legalitas & Promo',
        'kontak' => 'Kontak',
    ];
@endphp

<header id="navbar" class="fixed inset-x-0 top-0 z-50">
    <nav class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-[68px] lg:h-[72px]">
            {{-- Brand --}}
            <a href="#beranda" class="flex items-center gap-3 group shrink-0">
                <img src="{{ asset('images/logo-gua3.jpg') }}" alt="Logo GUA 3"
                     class="w-9 h-9 lg:w-10 lg:h-10 rounded-full object-cover ring-2 ring-white/20 group-hover:ring-white/40 transition-all">
                <div class="leading-tight">
                    <span class="nav-brand-text block font-display text-[15px] lg:text-[16px] font-bold tracking-tight transition-colors">Griya Utama Asri 3</span>
                </div>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden lg:flex items-center gap-1.5">
                @foreach ($menu as $id => $label)
                    <a href="#{{ $id }}" class="nav-link">{{ $label }}</a>
                @endforeach
            </div>

            {{-- CTA Desktop --}}
            <div class="hidden lg:flex items-center gap-3">
                <a href="#minat" class="nav-cta">Formulir Minat</a>
            </div>

            {{-- Mobile Toggle --}}
            <button id="menu-toggle" type="button" class="lg:hidden p-2.5 rounded-full transition hover:bg-black/5" aria-label="Menu" aria-expanded="false">
                <svg id="menu-open" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5"/></svg>
                <svg id="menu-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden lg:hidden pb-4">
            <div class="rounded-[20px] bg-white shadow-xl border border-line p-3 flex flex-col gap-1 backdrop-blur-md">
                @foreach ($menu as $id => $label)
                    <a href="#{{ $id }}" class="px-4 py-3 text-[14px] font-medium text-ink-soft hover:bg-brand-50 hover:text-brand-700 rounded-xl transition-all">{{ $label }}</a>
                @endforeach
                <div class="pt-2 mt-1 border-t border-line">
                    <a href="#minat" class="btn btn-primary w-full justify-center">Formulir Minat</a>
                </div>
            </div>
        </div>
    </nav>
</header>
