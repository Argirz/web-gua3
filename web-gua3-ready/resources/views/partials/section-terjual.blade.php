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

<section id="terjual" class="py-20 lg:py-32 bg-surface">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="mb-14 lg:mb-20 anim-hidden flex flex-col items-center text-center">
            <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl font-bold text-ink">Rumah Terjual</h2>
            <p class="mt-5 text-muted max-w-2xl mx-auto leading-relaxed text-sm sm:text-base">Temukan unit idaman yang masih tersedia dengan mudah melalui pantauan status terkini kami.</p>
        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8 stagger">
            <div class="card p-5 !border-0 bg-brand-950 text-white">
                <p class="text-xs text-white/60 font-medium mb-1">Total Unit</p>
                <p class="text-3xl font-extrabold">{{ $total_unit }}</p>
            </div>
            <div class="card p-5 !border-0 bg-brand-50">
                <p class="text-xs text-brand-700 font-medium mb-1">Terjual</p>
                <p class="text-3xl font-extrabold text-brand-700">{{ $unit_terjual }}</p>
            </div>
            <div class="card p-5 !border-0 bg-gold-50">
                <p class="text-xs text-gold-700 font-medium mb-1">Dipesan</p>
                <p class="text-3xl font-extrabold text-gold-700">{{ $unit_dipesan }}</p>
            </div>
            <div class="card p-5 !border-0 bg-sky-50">
                <p class="text-xs text-sky-700 font-medium mb-1">Tersedia</p>
                <p class="text-3xl font-extrabold text-sky-700">{{ $unit_tersedia }}</p>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-6 lg:gap-8 items-start">
            {{-- Kiri: Progress & Tipe --}}
            <div class="lg:col-span-1 flex flex-col gap-6">
                {{-- Progress Ring --}}
                <div class="anim-hidden card flex items-center gap-6 p-6">
                    <div class="relative w-24 h-24 shrink-0">
                        <svg class="w-full h-full -rotate-90" viewBox="0 0 120 120">
                            <circle cx="60" cy="60" r="52" fill="none" stroke="#eef1ee" stroke-width="12"/>
                            <circle cx="60" cy="60" r="52" fill="none" stroke="url(#grad-ring)" stroke-width="12"
                                    stroke-linecap="round" stroke-dasharray="326.73" stroke-dashoffset="326.73"
                                    class="progress-ring"/>
                            <defs>
                                <linearGradient id="grad-ring" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#61a47b"/>
                                    <stop offset="100%" stop-color="#2e6f4b"/>
                                </linearGradient>
                            </defs>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-xl font-extrabold text-ink" data-count="{{ $persen }}">{{ $persen }}%</span>
                        </div>
                    </div>
                    <div>
                        <p class="font-bold text-ink text-lg">Progres</p>
                        <p class="text-xs text-muted mt-1">{{ $unit_terjual }} dari {{ $total_unit }} unit telah terjual.</p>
                    </div>
                </div>

                {{-- Per Type --}}
                <div class="card p-6 stagger">
                    <h3 class="font-bold text-ink mb-5 text-sm">Status per Tipe</h3>
                    <div class="space-y-6">
                        @foreach ($perTipe as $tipe)
                            @php
                                $tipePersen = $tipe['total'] > 0 ? round($tipe['terjual'] / $tipe['total'] * 100) : 0;
                            @endphp
                            <div>
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="font-bold text-ink">Tipe {{ $tipe['type'] }}</span>
                                    <span class="font-bold text-brand-600">{{ $tipePersen }}% Terjual</span>
                                </div>
                                <div class="h-2.5 bg-brand-50 rounded-full overflow-hidden flex">
                                    @if ($tipe['total'] > 0)
                                        <div class="bg-[#61a47b]" style="width: {{ round($tipe['terjual'] / $tipe['total'] * 100) }}%"></div>
                                        <div class="bg-gold-400" style="width: {{ round($tipe['dipesan'] / $tipe['total'] * 100) }}%"></div>
                                        <div class="bg-sky-400" style="width: {{ round($tipe['tersedia'] / $tipe['total'] * 100) }}%"></div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Kanan: Unit Grid (Scrollable) --}}
            <div class="lg:col-span-2 anim-scale card overflow-hidden border border-line">
                <div class="px-6 py-5 border-b border-line bg-brand-50/30 flex items-center justify-between sticky top-0 z-10">
                    <h3 class="font-bold text-ink">Daftar Status Unit Lengkap</h3>
                    <span class="text-xs font-bold px-3 py-1 bg-white rounded-full border border-line shadow-sm text-ink">{{ $total_unit }} Unit</span>
                </div>
                
                {{-- Scrollable Container --}}
                <div class="p-6 max-h-[500px] overflow-y-auto" style="scrollbar-width: thin;">
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-3">
                        @foreach ($unit_rumah as $unit)
                            @php
                                if ($unit->status === 'terjual') {
                                    $badge = 'bg-[#61a47b]/10 text-[#2e6f4b] border-[#61a47b]/20';
                                } elseif ($unit->status === 'dipesan') {
                                    $badge = 'bg-gold-50 text-gold-700 border-gold-200';
                                } else {
                                    $badge = 'bg-sky-50 text-sky-700 border-sky-200';
                                }
                            @endphp
                            <div class="flex flex-row items-center justify-between p-3 rounded-xl border border-line hover:border-brand-300 hover:shadow-sm transition-all bg-white">
                                <div>
                                    <p class="text-sm font-bold text-ink">{{ $unit->block ?? 'Blok -' }}</p>
                                    <p class="text-[11px] text-muted">Tipe {{ $unit->tipe }}</p>
                                </div>
                                <span class="px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider rounded border {{ $badge }}">
                                    {{ $unit->status }}
                                </span>
                            </div>
                        @endforeach
                    </div>
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
