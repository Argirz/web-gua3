<x-layout :$pengaturan>
    @include('partials.hero')

    {{-- Foto Progress + Foto Rumah (slide) --}}
    @include('partials.section-slides')

    {{-- Dokumentasi Serah Terima Kunci --}}
    @include('partials.section-handover')

    {{-- Siteplan --}}
    @include('partials.section-siteplan')

    {{-- Rumah Terjual --}}
    @include('partials.section-terjual')

    {{-- Spek --}}
    @include('partials.section-spek')

    {{-- Brosur --}}
    @include('partials.section-brosur')

    {{-- Pricelist --}}
    @include('partials.section-pricelist')

    {{-- Lokasi / Google Maps --}}
    @include('partials.section-lokasi')

    {{-- Kontak / Penutup --}}
    @include('partials.section-kontak')

    {{-- Formulir Minat Prospek --}}
    @include('partials.section-prospek')
</x-layout>
