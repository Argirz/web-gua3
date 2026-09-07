@php
    $persen = $total_unit > 0 ? round($unit_terjual / $total_unit * 100) : 0;
    $perTipe = $unit_rumah->groupBy('tipe')->map(function ($items, $type) {
        return [
            'type' => $type,
            'total' => $items->count(),
            'terjual' => $items->where('status', 'terjual')->count(),
            'dipesan' => $items->where('status', 'dipesan')->count(),
            'tersedia' => $items->where('status', 'tersedia')->count(),
        ];
    })->values();
@endphp

<section id="availability" class="py-16 lg:py-24 bg-white border-t border-line">
    <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="anim-hidden text-center max-w-3xl mx-auto">
            <h2 class="font-display text-[28px] sm:text-[36px] lg:text-[42px] font-bold tracking-tight text-ink leading-[0.95]">
                Ketersediaan Unit <span class="text-brand-600">&</span> Siteplan
            </h2>
            <p class="mt-4 text-[14px] sm:text-[15px] leading-relaxed text-muted max-w-2xl mx-auto">
                Pantau status unit secara real-time. Pilih kavling ideal Anda dan lihat denah lengkap Tipe 36 2 Kamar Tidur, 1 Kamar Mandi, LT 72 m² / LB 36 m².
            </p>
        </div>

        {{-- Metrics --}}
        <div class="mt-10 grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 stagger">
            <div class="card p-5 sm:p-6 text-center">
                <p class="text-[11px] font-bold tracking-widest uppercase text-muted">Total Unit</p>
                <p class="mt-2 text-[28px] sm:text-[32px] font-extrabold tracking-tight text-ink" data-count="{{ $total_unit }}">{{ $total_unit }}</p>
            </div>
            <div class="card p-5 sm:p-6 text-center border-emerald-200 bg-emerald-50/60">
                <p class="text-[11px] font-bold tracking-widest uppercase text-emerald-700">Terjual</p>
                <p class="mt-2 text-[28px] sm:text-[32px] font-extrabold tracking-tight text-emerald-700" data-count="{{ $unit_terjual }}">{{ $unit_terjual }}</p>
            </div>
            <div class="card p-5 sm:p-6 text-center bg-amber-50/50 border-amber-200">
                <p class="text-[11px] font-bold tracking-widest uppercase text-amber-700">Dipesan</p>
                <p class="mt-2 text-[28px] sm:text-[32px] font-extrabold tracking-tight text-amber-600" data-count="{{ $unit_dipesan }}">{{ $unit_dipesan }}</p>
            </div>
            <div class="card p-5 sm:p-6 text-center border-blue-200 bg-blue-50/60">
                <p class="text-[11px] font-bold tracking-widest uppercase text-blue-700">Tersedia</p>
                <p class="mt-2 text-[28px] sm:text-[32px] font-extrabold tracking-tight text-blue-700" data-count="{{ $unit_tersedia }}">{{ $unit_tersedia }}</p>
            </div>
        </div>

        {{-- Progress --}}
        <div class="mt-6 card p-5 sm:p-6 flex flex-col sm:flex-row items-center gap-5 sm:gap-6 anim-hidden">
            <div class="relative w-20 h-20 shrink-0">
                <svg class="w-full h-full -rotate-90" viewBox="0 0 120 120">
                    <circle cx="60" cy="60" r="52" fill="none" stroke="#f1f5f9" stroke-width="10"/>
                    <circle cx="60" cy="60" r="52" fill="none" stroke="url(#grad-avail)" stroke-width="10" stroke-linecap="round" stroke-dasharray="326.7" stroke-dashoffset="326.7" class="progress-ring"/>
                    <defs>
                        <linearGradient id="grad-avail" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#6EE7B7"/>
                            <stop offset="100%" stop-color="#065F46"/>
                        </linearGradient>
                    </defs>
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="text-[16px] font-extrabold text-ink leading-none" data-count="{{ $persen }}" data-suffix="%">{{ $persen }}%</span>
                    <span class="text-[10px] font-bold tracking-wide uppercase text-muted">Terjual</span>
                </div>
            </div>
            <div class="flex-1 w-full text-center sm:text-left">
                <div class="flex flex-wrap items-center justify-center sm:justify-between gap-2">
                    <p class="font-bold text-ink">Progres Penjualan</p>
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-sage border border-line text-ink">{{ $unit_terjual }} dari {{ $total_unit }} unit</span>
                </div>
                <div class="mt-3 h-2.5 bg-slate-100 rounded-full overflow-hidden flex">
                    <div class="progress-bar bg-emerald-500" style="width: 0%" data-width="{{ $total_unit ? round($unit_terjual/$total_unit*100) : 0 }}%"></div>
                    <div class="bg-amber-500" style="width: {{ $total_unit ? round($unit_dipesan/$total_unit*100) : 0 }}%"></div>
                    <div class="bg-blue-500" style="width: {{ $total_unit ? round($unit_tersedia/$total_unit*100) : 0 }}%"></div>
                </div>
                <div class="mt-2 flex flex-wrap justify-center sm:justify-start gap-3 text-[11px] font-medium">
                    <span class="inline-flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> Terjual</span>
                    <span class="inline-flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span> Dipesan</span>
                    <span class="inline-flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span> Tersedia</span>
                </div>
            </div>
            <a href="#minat" class="shrink-0 btn btn-primary btn-sm hidden sm:inline-flex">Amankan Unit</a>
        </div>

        {{-- Main Grid: Kavling Selector + Siteplan & Denah --}}
        <div class="mt-8 grid lg:grid-cols-5 gap-6 lg:gap-6 items-start">
            {{-- Kavling Selector --}}
            <div class="lg:col-span-3 card overflow-hidden anim-slide-left">
                <div class="px-5 sm:px-6 py-4 border-b border-line bg-gradient-to-r from-white to-sage/40 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <h3 class="font-bold text-ink text-[15px]">Pilih Kavling</h3>
                        <p class="text-xs text-muted mt-0.5">Klik kavling untuk cek status — Biru Tersedia, Kuning Dipesan, Hijau Terjual</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <input id="lot-search" type="text" placeholder="Cari A1, B12..." class="w-full sm:w-36 rounded-full border border-line bg-white px-3.5 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-brand-300 focus:border-brand-300">
                        <select id="lot-filter" class="rounded-full border border-line bg-white px-3 py-2 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-brand-300">
                            <option value="all">Semua</option>
                            <option value="tersedia">Tersedia</option>
                            <option value="terjual">Terjual</option>
                            <option value="dipesan">Dipesan</option>
                        </select>
                    </div>
                </div>

                {{-- Legend --}}
                <div class="px-5 sm:px-6 py-3 flex flex-wrap gap-2 text-[11px] font-semibold">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full lot-available">● Tersedia</span>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full lot-sold">● Terjual</span>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full lot-booked">● Dipesan</span>
                </div>

                <div class="px-5 sm:px-6 pb-6">
                    {{-- Scrollable grid --}}
                    <div class="max-h-[420px] overflow-y-auto pr-1 -mr-1">
                        <div id="lot-grid" class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-2.5">
                            @foreach ($unit_rumah as $unit)
                                @php
                                    $st = $unit->status;
                                    if ($st === 'terjual') $cls = 'lot-sold';
                                    elseif ($st === 'dipesan') $cls = 'lot-booked';
                                    else $cls = 'lot-available';
                                @endphp
                                <div data-lot="{{ strtolower($unit->block) }}" data-status="{{ $st }}" class="lot-item group relative rounded-2xl border p-3 text-center transition-all hover:shadow-md hover:-translate-y-0.5 cursor-default {{ $cls }}">
                                    <p class="text-sm font-extrabold tracking-tight">{{ $unit->block }}</p>
                                    <p class="text-[10px] font-semibold uppercase tracking-wide opacity-70">{{ $unit->tipe }}</p>
                                    <span class="mt-1 inline-flex text-[10px] font-bold uppercase tracking-wider px-1.5 py-0.5 rounded-full bg-white/70 border border-black/5">{{ $st }}</span>
                                </div>
                            @endforeach
                        </div>
                        <p id="lot-empty" class="hidden text-center text-sm text-muted py-10">Tidak ada kavling yang cocok.</p>
                    </div>

                    {{-- Per tipe mini bars --}}
                    <div class="mt-6 pt-5 border-t border-line">
                        <p class="text-xs font-bold uppercase tracking-wide text-muted mb-3">Status per Tipe</p>
                        <div class="grid sm:grid-cols-2 gap-4">
                            @foreach ($perTipe as $tipe)
                                @php $p = $tipe['total'] ? round($tipe['terjual']/$tipe['total']*100) : 0; @endphp
                                <div class="rounded-xl bg-sage/60 border border-line p-3">
                                    <div class="flex justify-between text-xs">
                                        <span class="font-bold text-ink">{{ $tipe['type'] }}</span>
                                        <span class="font-bold text-brand-600">{{ $p }}% Terjual</span>
                                    </div>
                                    <div class="mt-2 h-2 bg-white rounded-full overflow-hidden flex border border-line">
                                        <div class="bg-emerald-500" style="width: {{ $tipe['total'] ? round($tipe['terjual']/$tipe['total']*100) : 0 }}%"></div>
                                        <div class="bg-amber-500" style="width: {{ $tipe['total'] ? round($tipe['dipesan']/$tipe['total']*100) : 0 }}%"></div>
                                        <div class="bg-blue-500" style="width: {{ $tipe['total'] ? round($tipe['tersedia']/$tipe['total']*100) : 0 }}%"></div>
                                    </div>
                                    <p class="mt-1 text-[11px] text-muted">{{ $tipe['tersedia'] }} tersedia • {{ $tipe['total'] }} total</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Siteplan & Denah --}}
            <div class="lg:col-span-2 space-y-6 anim-slide-right">
                {{-- Siteplan --}}
                <a href="{{ asset('images/Siteplan GUA3.jpg') }}" data-lightbox="siteplan" data-title="Siteplan Griya Utama Asri 3" class="group card overflow-hidden block p-2">
                    <div class="relative rounded-[14px] overflow-hidden bg-slate-50 aspect-[4/3]">
                        <img src="{{ asset('images/Siteplan GUA3.jpg') }}" alt="Siteplan" loading="lazy" class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-950/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <span class="absolute bottom-3 left-3 inline-flex items-center gap-1.5 rounded-full bg-white/95 backdrop-blur px-3 py-1.5 text-xs font-bold shadow-sm">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                            Klik untuk zoom
                        </span>
                        <span class="absolute top-3 right-3 rounded-full bg-brand-600 text-white text-[11px] font-bold px-2.5 py-1 shadow-md">Siteplan</span>
                    </div>
                    <div class="px-2 pt-3 pb-1">
                        <h4 class="font-bold text-ink text-sm">Siteplan Griya Utama Asri 3</h4>
                        <p class="text-xs text-muted mt-1 leading-relaxed">85 unit tertata, akses jalan lingkungan lebar, drainase terkelola.</p>
                    </div>
                </a>

                {{-- Denah Tipe 36 --}}
                @foreach ($denah->take(1) as $siteplan)
                    <a href="{{ asset($siteplan->image) }}" data-lightbox="siteplan" data-title="{{ $siteplan->title }}" class="group card overflow-hidden block p-2">
                        <div class="relative rounded-[14px] overflow-hidden bg-white aspect-[4/3] border border-line">
                            <img src="{{ asset($siteplan->image) }}" alt="{{ $siteplan->title }}" loading="lazy" class="w-full h-full object-contain p-2 group-hover:scale-[1.02] transition-transform duration-700">
                            <span class="absolute top-3 right-3 rounded-full bg-sage border border-line text-[11px] font-bold px-2.5 py-1">Denah Tipe 36</span>
                        </div>
                        <div class="px-2 pt-3 pb-1">
                            <h4 class="font-bold text-ink text-sm">{{ $siteplan->title }}</h4>
                            <p class="text-xs text-muted mt-1">{{ $siteplan->description }}</p>
                            <div class="mt-3 flex flex-wrap gap-1.5">
                                <span class="text-[11px] font-semibold px-2.5 py-1 rounded-full bg-brand-50 border border-brand-100 text-brand-700">LT 72 m²</span>
                                <span class="text-[11px] font-semibold px-2.5 py-1 rounded-full bg-brand-50 border border-brand-100 text-brand-700">LB 36 m²</span>
                                <span class="text-[11px] font-semibold px-2.5 py-1 rounded-full bg-white border border-line text-ink">2 KT • 1 KM</span>
                            </div>
                        </div>
                    </a>
                @endforeach

                @if($denah->count() > 1)
                    <div class="grid grid-cols-2 gap-3">
                        @foreach($denah->slice(1,2) as $siteplan)
                            <a href="{{ asset($siteplan->image) }}" data-lightbox="siteplan" data-title="{{ $siteplan->title }}" class="group card overflow-hidden block p-2">
                                <div class="rounded-[12px] overflow-hidden bg-white border border-line aspect-[4/3]">
                                    <img src="{{ asset($siteplan->image) }}" alt="{{ $siteplan->title }}" class="w-full h-full object-contain p-1 group-hover:scale-[1.02] transition-transform">
                                </div>
                                <p class="text-xs font-bold text-ink mt-2 px-1 truncate">{{ $siteplan->title }}</p>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const ring = document.querySelector('#availability .progress-ring');
        if (ring) {
            const c = 2*Math.PI*52;
            requestAnimationFrame(()=> setTimeout(()=>{
                const p = parseInt('{{ $persen }}',10) || 0;
                ring.style.transition = 'stroke-dashoffset 1.6s cubic-bezier(0.16,1,0.3,1)';
                ring.style.strokeDashoffset = c - (p/100)*c;
            }, 300));
        }
        document.querySelectorAll('#availability .progress-bar').forEach(el=>{
            const w = el.dataset.width;
            setTimeout(()=> el.style.width = w, 500);
            el.style.transition = 'width 1.6s cubic-bezier(0.16,1,0.3,1)';
        });

        const search = document.getElementById('lot-search');
        const filter = document.getElementById('lot-filter');
        const items = Array.from(document.querySelectorAll('.lot-item'));
        const empty = document.getElementById('lot-empty');
        function apply(){
            const q = (search.value||'').toLowerCase().trim();
            const f = filter.value;
            let vis=0;
            items.forEach(it=>{
                const lot = it.dataset.lot;
                const st = it.dataset.status;
                const matchQ = !q || lot.includes(q);
                const matchF = f==='all' || st===f;
                const show = matchQ && matchF;
                it.style.display = show ? '' : 'none';
                if(show) vis++;
            });
            if(empty) empty.classList.toggle('hidden', vis!==0);
        }
        if(search) search.addEventListener('input', apply);
        if(filter) filter.addEventListener('change', apply);
    });
    </script>
</section>
