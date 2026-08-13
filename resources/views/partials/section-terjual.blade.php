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

<section id="terjual" class="py-20 lg:py-28 bg-surface">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-14 anim-hidden text-center">
            <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-semibold text-ink">Rumah Terjual</h2>
            <p class="mt-5 text-muted max-w-2xl mx-auto leading-relaxed">Pantau progres penjualan unit Griya Utama Asri 3 secara real-time.</p>
        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-12 stagger">
            <div class="card p-5 !border-0 bg-brand-950 text-white">
                <p class="text-sm text-white/60 font-medium mb-1">Total Unit</p>
                <p class="text-3xl font-extrabold">{{ $total_unit }}</p>
            </div>
            <div class="card p-5 !border-0 bg-brand-50">
                <p class="text-sm text-brand-600/80 font-medium mb-1">Terjual</p>
                <p class="text-3xl font-extrabold text-brand-600">{{ $unit_terjual }}</p>
            </div>
            <div class="card p-5 !border-0 bg-gold-50">
                <p class="text-sm text-gold-600/80 font-medium mb-1">Dipesan</p>
                <p class="text-3xl font-extrabold text-gold-600">{{ $unit_dipesan }}</p>
            </div>
            <div class="card p-5 !border-0 bg-[#f0f7ff]">
                <p class="text-sm text-sky-600/80 font-medium mb-1">Tersedia</p>
                <p class="text-3xl font-extrabold text-sky-600">{{ $unit_tersedia }}</p>
            </div>
        </div>

        {{-- Progress Ring + Bar --}}
        <div class="anim-hidden card flex flex-col lg:flex-row items-center gap-10 p-6 sm:p-8 mb-10">
            <div class="shrink-0">
                <div class="relative w-40 h-40 sm:w-48 sm:h-48">
                    <svg class="w-full h-full -rotate-90" viewBox="0 0 120 120">
                        <circle cx="60" cy="60" r="52" fill="none" stroke="#eef1ee" stroke-width="8"/>
                        <circle cx="60" cy="60" r="52" fill="none" stroke="url(#grad-ring)" stroke-width="8"
                                stroke-linecap="round" stroke-dasharray="326.73" stroke-dashoffset="326.73"
                                class="progress-ring"/>
                        <defs>
                            <linearGradient id="grad-ring" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#61a47b"/>
                                <stop offset="100%" stop-color="#2e6f4b"/>
                            </linearGradient>
                        </defs>
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-4xl sm:text-5xl font-extrabold text-ink" data-count="{{ $persen }}">0</span>
                        <span class="text-xs text-muted font-medium mt-1">% terjual</span>
                    </div>
                </div>
            </div>
            <div class="flex-1 w-full">
                <p class="text-sm font-bold text-ink mb-3">Komposisi</p>
                <div class="h-3 bg-brand-50 rounded-full overflow-hidden flex">
                    @if ($total_unit > 0)
                        <div class="bg-[#61a47b] transition-all duration-1000" style="width: {{ $persen }}%"></div>
                        <div class="bg-gold-400 transition-all duration-1000" style="width: {{ round($unit_dipesan / $total_unit * 100) }}%"></div>
                        <div class="bg-sky-400 transition-all duration-1000" style="width: {{ round($unit_tersedia / $total_unit * 100) }}%"></div>
                    @endif
                </div>
                <div class="flex flex-wrap gap-5 mt-4 text-sm">
                    <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-[#61a47b]"></span> Terjual <strong class="text-ink">{{ $unit_terjual }}</strong></span>
                    <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-gold-400"></span> Dipesan <strong class="text-ink">{{ $unit_dipesan }}</strong></span>
                    <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-sky-400"></span> Tersedia <strong class="text-ink">{{ $unit_tersedia }}</strong></span>
                </div>
            </div>
        </div>

        {{-- Per Type --}}
        <div class="grid sm:grid-cols-2 gap-4 mb-10 stagger">
            @foreach ($perTipe as $tipe)
                @php
                    $tipePersen = $tipe['total'] > 0 ? round($tipe['terjual'] / $tipe['total'] * 100) : 0;
                @endphp
                <div class="card p-5 sm:p-6 card-hover">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="font-bold text-ink text-lg">{{ $tipe['type'] }}</h4>
                        <span class="text-sm font-bold text-brand-600">{{ $tipePersen }}%</span>
                    </div>
                    <div class="h-2 bg-brand-50 rounded-full overflow-hidden mb-4 flex">
                        @if ($tipe['total'] > 0)
                            <div class="bg-[#61a47b] transition-all duration-700" style="width: {{ round($tipe['terjual'] / $tipe['total'] * 100) }}%"></div>
                            <div class="bg-gold-400 transition-all duration-700" style="width: {{ round($tipe['dipesan'] / $tipe['total'] * 100) }}%"></div>
                            <div class="bg-sky-400 transition-all duration-700" style="width: {{ round($tipe['tersedia'] / $tipe['total'] * 100) }}%"></div>
                        @endif
                    </div>
                    <div class="flex gap-4 text-sm text-muted">
                        <span><strong class="text-brand-600">{{ $tipe['terjual'] }}</strong> terjual</span>
                        <span><strong class="text-gold-600">{{ $tipe['dipesan'] }}</strong> dipesan</span>
                        <span><strong class="text-sky-600">{{ $tipe['tersedia'] }}</strong> tersedia</span>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Unit Grid --}}
        <div class="anim-scale card overflow-hidden">
            <div class="px-5 sm:px-6 py-4 border-b border-line flex items-center justify-between">
                <h3 class="font-bold text-ink">Daftar Unit</h3>
                <div class="flex items-center gap-3 text-xs text-muted">
                    <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-[#61a47b]"></span> Terjual</span>
                    <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-gold-400"></span> Dipesan</span>
                    <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-sky-400"></span> Tersedia</span>
                </div>
            </div>
            <div class="p-5 sm:p-6">
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2.5">
                    @foreach ($unit_rumah as $unit)
                        @php
                            $sc = $unit->status === 'terjual' ? '#3f8a60' : ($unit->status === 'dipesan' ? '#cda453' : '#38bdf8');
                            $sl = $unit->status === 'terjual' ? 'Terjual' : ($unit->status === 'dipesan' ? 'Dipesan' : 'Tersedia');
                        @endphp
                        <div class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl bg-brand-50/60 hover:bg-brand-50 transition-colors">
                            <span class="w-2 h-2 rounded-full shrink-0" style="background: {{ $sc }};"></span>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-bold text-ink truncate">{{ $unit->block ?? '-' }}</p>
                                <p class="text-[11px] text-muted truncate">{{ $unit->tipe }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            const ring = document.querySelector('.progress-ring');
            if (ring) {
                const circumference = 2 * Math.PI * 52;
                const offset = circumference - ({{ $persen }} / 100) * circumference;
                ring.style.transition = 'stroke-dashoffset 1.5s cubic-bezier(0.16, 1, 0.3, 1)';
                ring.style.strokeDashoffset = offset;
            }
        }, 400);
    });
    </script>
</section>
