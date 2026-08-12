<!DOCTYPE html>
<html lang="id" class="scroll-smooth overflow-x-clip">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $settings['tagline'] ?? 'Perumahan Griya Utama Asri 3' }}">
    <title>{{ $settings['nama_perumahan'] ?? 'Griya Utama Asri 3' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cream text-ink font-sans antialiased overflow-x-hidden">

    @include('partials.navbar')

    <main>
        {{ $slot }}
    </main>

    @include('partials.footer')

    @include('partials.wa-float')

</body>
</html>
