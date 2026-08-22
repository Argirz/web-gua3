<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk · Panel Admin · Griya Utama Asri 3</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-brand-950 min-h-screen flex items-center justify-center p-4 font-sans antialiased">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo-gua3.jpg') }}" alt="Logo GUA 3" class="w-16 h-16 rounded-full object-cover ring-4 ring-white/15 mx-auto mb-4">
            <h1 class="font-display text-2xl font-semibold">Griya Utama<br><em class="text-gradient font-medium not-italic">Asri 3</em></h1>
        </div>

        <div class="bg-white rounded-2xl shadow-2xl shadow-black/30 p-6 sm:p-8">
            @if ($errors->any())
                <div class="mb-5 rounded-xl bg-rose-50 ring-1 ring-rose-200 text-rose-800 px-4 py-3 text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.proses') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="username" class="block text-sm font-semibold text-ink mb-1.5">Username / Email</label>
                    <input type="text" name="username" id="username" required autofocus
                           value="{{ old('username') }}"
                           class="w-full rounded-xl border border-line bg-white px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
                <div>
                    <label for="password" class="block text-sm font-semibold text-ink mb-1.5">Kata Sandi</label>
                    <input type="password" name="password" id="password" required
                           class="w-full rounded-xl border border-line bg-white px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600">
                </div>
                <label class="flex items-center gap-2 text-sm text-muted">
                    <input type="checkbox" name="ingat" value="1" class="rounded border-line text-brand-600 focus:ring-brand-600">
                    Ingat saya
                </label>
                <button type="submit"
                        class="btn btn-primary w-full py-3 text-sm">
                    Masuk
                </button>
            </form>
        </div>
    </div>
</body>
</html>