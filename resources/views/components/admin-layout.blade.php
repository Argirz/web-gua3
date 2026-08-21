@props(['judul' => 'Panel Admin'])
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $judul }} · Griya Utama Asri 3</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white text-ink font-sans antialiased overflow-x-hidden">

    <div class="flex min-h-screen bg-brand-950">
        <div id="admin-backdrop" class="hidden fixed inset-0 z-40 bg-brand-950/60 lg:hidden"></div>
        <aside id="admin-sidebar" class="fixed top-0 inset-y-0 left-0 z-50 w-64 -translate-x-full lg:translate-x-0 transition-transform duration-300 hidden lg:flex flex-col shrink-0 bg-brand-950 text-white/90 h-dvh">
            <div class="flex items-center gap-3 px-6 py-6 border-b border-white/10">
                <img src="{{ asset('images/logo-gua3.jpg') }}" alt="Logo GUA 3" class="w-10 h-10 rounded-full object-cover ring-2 ring-white/15">
                <div class="leading-tight">
                    <p class="text-white font-display font-semibold text-sm">Griya Utama Asri 3</p>
                    <p class="text-xs text-white/60">Panel Admin</p>
                </div>
            </div>

            <nav class="flex-1 min-h-0 overflow-y-auto overscroll-contain py-5 space-y-1 text-sm font-medium px-3">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-gold-400' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.prospek.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.prospek.*') ? 'bg-white/10 text-gold-400' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                    Prospek
                </a>
                <a href="{{ route('admin.unit.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.unit.*') ? 'bg-white/10 text-gold-400' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/></svg>
                    Unit Rumah
                </a>
                <a href="{{ route('admin.tipe.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.tipe.*') ? 'bg-white/10 text-gold-400' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z"/></svg>
                    Tipe Rumah
                </a>
                <a href="{{ route('admin.foto.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.foto.*') ? 'bg-white/10 text-gold-400' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                    Foto
                </a>
                <a href="{{ route('admin.serah_terima.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.serah_terima.*') ? 'bg-white/10 text-gold-400' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.864 4.243A7.5 7.5 0 0119.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 004.5 10.5a7.464 7.464 0 01-1.15 3.993m1.989 3.559A11.209 11.209 0 008.25 10.5a3.75 3.75 0 117.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 01-3.6 9.75m6.633-4.596a18.666 18.666 0 01-2.485 5.33"/></svg>
                    Serah Terima
                </a>
                <a href="{{ route('admin.brosur.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.brosur.*') ? 'bg-white/10 text-gold-400' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                    Brosur
                </a>
                <a href="{{ route('admin.pengaturan.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.pengaturan.*') ? 'bg-white/10 text-gold-400' : 'hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Pengaturan
                </a>
            </nav>

            <div class="p-4 border-t border-white/10 space-y-2">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm hover:bg-white/5 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/></svg>
                    Lihat Situs
                </a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm w-full text-left hover:bg-white/5 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
                        Keluar
                    </button>
                </form>
                <div class="px-3 pt-1 text-xs text-white/60">
                    {{ auth()->user()->name }} · {{ auth()->user()->role }}
                </div>
            </div>
        </aside>

        <div class="flex-1 min-w-0 bg-white lg:pl-64 flex flex-col min-h-screen relative">
            <header class="sticky top-0 z-30 bg-white/90 backdrop-blur border-b border-line px-4 sm:px-8 py-3 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3 w-full">
                    <button id="admin-menu-btn" type="button" aria-label="Buka menu" class="lg:hidden p-2 -ml-1 rounded-xl text-ink hover:bg-brand-50 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                    </button>
                    <!-- Global Search -->
                    <form action="{{ route('admin.search') }}" method="GET" class="relative w-full max-w-md hidden sm:block">
                        <svg class="w-5 h-5 absolute left-3 top-2 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari data (Budi, Tipe 36, Blok A...)" required class="w-full pl-10 pr-4 py-1.5 rounded-xl border border-line bg-brand-50/50 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600 focus:bg-white transition-colors">
                    </form>
                </div>
                
                @php
                    $newProspek = \App\Models\Prospek::where('status', 'baru')->latest()->take(5)->get();
                    $newProspekCount = \App\Models\Prospek::where('status', 'baru')->count();
                @endphp

                <!-- Profile / Notification -->
                <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                    
                    <!-- Notifications Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false" type="button" class="relative p-2 rounded-xl text-muted hover:text-ink hover:bg-brand-50 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/></svg>
                            @if($newProspekCount > 0)
                                <span class="absolute top-1.5 right-1.5 flex h-2.5 w-2.5">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-rose-500 ring-2 ring-white"></span>
                                </span>
                            @endif
                        </button>
                        
                        <div x-show="open" x-transition.opacity.duration.200ms style="display: none;" class="absolute right-0 mt-2 w-80 bg-white rounded-2xl shadow-xl ring-1 ring-black/5 overflow-hidden z-50">
                            <div class="px-4 py-3 border-b border-line flex justify-between items-center bg-brand-50/50">
                                <h3 class="text-sm font-bold text-ink">Notifikasi</h3>
                                @if($newProspekCount > 0)
                                    <span class="bg-rose-100 text-rose-700 text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $newProspekCount }} Baru</span>
                                @endif
                            </div>
                            <div class="max-h-[300px] overflow-y-auto">
                                @forelse($newProspek as $np)
                                    <a href="{{ route('admin.prospek.index', ['cari' => $np->nomor_wa]) }}" class="block px-4 py-3 border-b border-line last:border-0 hover:bg-brand-50/50 transition-colors">
                                        <p class="text-sm font-semibold text-ink">{{ $np->nama_lengkap }}</p>
                                        <p class="text-xs text-muted mt-0.5">Prospek baru masuk via {{ $np->sumber }}</p>
                                        <p class="text-[10px] text-muted mt-1">{{ $np->created_at?->diffForHumans() }}</p>
                                    </a>
                                @empty
                                    <div class="px-4 py-6 text-center text-sm text-muted">Belum ada notifikasi baru.</div>
                                @endforelse
                            </div>
                            <a href="{{ route('admin.prospek.index', ['status' => 'baru']) }}" class="block px-4 py-2.5 text-center text-xs font-semibold text-brand-600 hover:bg-brand-50 transition-colors border-t border-line">
                                Lihat Semua Prospek Baru
                            </a>
                        </div>
                    </div>

                    <!-- Profile Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false" type="button" class="w-8 h-8 rounded-full bg-brand-600 text-white flex items-center justify-center font-bold text-sm shrink-0 hover:ring-2 hover:ring-brand-200 transition-all focus:outline-none">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </button>
                        
                        <div x-show="open" x-transition.opacity.duration.200ms style="display: none;" class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl ring-1 ring-black/5 overflow-hidden z-50 py-1">
                            <div class="px-4 py-3 border-b border-line mb-1">
                                <p class="text-sm font-bold text-ink truncate">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-muted truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <a href="{{ route('admin.pengaturan.edit') }}" class="block px-4 py-2 text-sm text-ink hover:bg-brand-50 transition-colors">Pengaturan</a>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-rose-600 hover:bg-rose-50 transition-colors font-medium">Keluar (Logout)</button>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </header>

            <!-- Hero Section -->
            <div class="bg-brand-800 pt-8 pb-24 px-4 sm:px-8 shrink-0">
                <div class="flex items-center justify-between gap-4 flex-wrap">
                    <h1 class="font-display text-2xl font-bold text-white tracking-tight">{{ $judul }}</h1>
                    @if (isset($headerAction))
                        <div class="shrink-0">
                            {{ $headerAction }}
                        </div>
                    @endif
                </div>
            </div>

            <main class="flex-1 px-4 sm:px-8 pb-12 -mt-16 relative z-10 space-y-6">
                @if (session('sukses'))
                    <div class="rounded-xl bg-emerald-50 ring-1 ring-emerald-200 text-emerald-800 px-4 py-3 text-sm font-medium">
                        {{ session('sukses') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="rounded-xl bg-rose-50 ring-1 ring-rose-200 text-rose-800 px-4 py-3 text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
    (function () {
        const sidebar = document.getElementById('admin-sidebar');
        const backdrop = document.getElementById('admin-backdrop');
        const btn = document.getElementById('admin-menu-btn');
        if (!sidebar || !backdrop || !btn) return;

        function closeMenu() {
            sidebar.classList.add('hidden');
            sidebar.classList.remove('flex', 'translate-x-0', '-translate-x-full');
            backdrop.classList.add('hidden');
        }

        btn.addEventListener('click', () => {
            sidebar.classList.remove('hidden', '-translate-x-full');
            sidebar.classList.add('flex', 'translate-x-0');
            backdrop.classList.remove('hidden');
        });
        backdrop.addEventListener('click', closeMenu);
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeMenu(); });
        window.addEventListener('resize', () => { if (window.innerWidth >= 1024) closeMenu(); });
    })();
    </script>
</body>
</html>