<x-admin-layout judul="Manajemen Unit Rumah">
    <div class="card p-5 sm:p-6">
        <h2 class="font-display font-semibold text-lg text-ink mb-4">Tambah Unit</h2>
        <form method="POST" action="{{ route('admin.unit.simpan') }}" class="grid gap-4 sm:grid-cols-4">
            @csrf
            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Blok / Nomor</label>
                <input type="text" name="block" required maxlength="20" placeholder="contoh: F1"
                       class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Tipe Rumah</label>
                <select name="unit_type_id" required class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                    @foreach ($tipe as $t)
                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wide text-muted mb-1.5">Status</label>
                <select name="status" required class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                    @foreach (['tersedia', 'dipesan', 'terjual'] as $s)
                        <option value="{{ $s }}">{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="btn btn-primary btn-sm w-full sm:w-auto">Tambah</button>
            </div>
        </form>
    </div>

    <div class="card overflow-hidden">
        <div class="px-5 sm:px-6 py-4 border-b border-line flex items-center justify-between flex-wrap gap-3">
            <h2 class="font-display font-semibold text-lg text-ink">Daftar Unit</h2>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.unit.index') }}"
                   class="rounded-full px-3.5 py-1.5 text-xs font-bold ring-1 transition-colors {{ $status === '' ? 'bg-brand-950 text-white ring-brand-950' : 'bg-white text-muted ring-line hover:text-ink' }}">
                    Semua ({{ $jumlah['semua'] }})
                </a>
                <a href="{{ route('admin.unit.index', ['status' => 'tersedia']) }}"
                   class="rounded-full px-3.5 py-1.5 text-xs font-bold ring-1 transition-colors {{ $status === 'tersedia' ? 'bg-emerald-600 text-white ring-emerald-600' : 'bg-white text-muted ring-line hover:text-ink' }}">
                    Tersedia ({{ $jumlah['tersedia'] }})
                </a>
                <a href="{{ route('admin.unit.index', ['status' => 'dipesan']) }}"
                   class="rounded-full px-3.5 py-1.5 text-xs font-bold ring-1 transition-colors {{ $status === 'dipesan' ? 'bg-gold-500 text-white ring-gold-500' : 'bg-white text-muted ring-line hover:text-ink' }}">
                    Dipesan ({{ $jumlah['dipesan'] }})
                </a>
                <a href="{{ route('admin.unit.index', ['status' => 'terjual']) }}"
                   class="rounded-full px-3.5 py-1.5 text-xs font-bold ring-1 transition-colors {{ $status === 'terjual' ? 'bg-rose-600 text-white ring-rose-600' : 'bg-white text-muted ring-line hover:text-ink' }}">
                    Terjual ({{ $jumlah['terjual'] }})
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-muted text-xs uppercase tracking-wide border-b border-line bg-brand-950/5">
                        <th class="py-3 px-5 sm:px-6">Blok</th>
                        <th class="py-3 px-4">Tipe</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-5 sm:px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($unit as $u)
                        <tr class="border-b border-line last:border-0 hover:bg-brand-50/40">
                            <td class="py-3 px-5 sm:px-6 font-bold text-ink">{{ $u->block }}</td>
                            <td class="py-3 px-4">{{ $u->tipeRumah?->name ?? '-' }}</td>
                            <td class="py-3 px-4">
                                <form method="POST" action="{{ route('admin.unit.status', $u) }}" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="rounded-lg border border-line px-2 py-1.5 text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-brand-600 bg-white">
                                        @foreach (['tersedia', 'dipesan', 'terjual'] as $s)
                                            <option value="{{ $s }}" @selected($u->status === $s)>{{ ucfirst($s) }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td class="py-3 px-5 sm:px-6 text-right">
                                <form method="POST" action="{{ route('admin.unit.hapus', $u) }}" onsubmit="return confirm('Hapus unit {{ $u->block }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-600 hover:text-rose-700 font-semibold text-xs">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center text-muted">Belum ada unit.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>