<x-layout :$pengaturan>
    {{-- Hero Split Screen Showcase (fixed: badge/trust-row/Tersedia removed, navbar always visible) --}}
    @include('partials.hero')

    {{-- Availability & Siteplan Live status + interactive selector --}}
    @include('partials.section-availability')

    {{-- Foto Rumah & Lingkungan (tampil selama ada data) --}}
    @if($foto_rumah->count())
        @include('partials.section-slides')
    @endif

    {{-- Specs Feature cards --}}
    @include('partials.section-specs')

    {{-- Legalitas, Brosur & Pricelist --}}
    @include('partials.section-legalitas')

    {{-- Serah Terima Masonry social proof --}}
    @include('partials.section-handover')

    {{-- Location + Formulir Combined --}}
    @include('partials.section-location')
</x-layout>
