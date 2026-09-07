# Griya Utama Asri 3 (GUA3)

Website perumahan Griya Utama Asri 3 kawasan perumahan di Banjar Baru,
Kalimantan Selatan. Berisi informasi denah tipe, status unit, harga, galeri,
spesifikasi, dan brosur.

## Struktur

```
web-gua3/
├── app/            # backend Laravel (controllers, models)
├── config/         # konfigurasi Laravel
├── database/       # migrations, seeders, web_gua3.sql (dump database)
├── public/         # document root (index.php, images, .htaccess)
├── resources/      # Blade views + assets
├── routes/         # web.php, api.php
├── react/          # frontend React + Vite
│   ├── src/        #   komponen React (App.jsx)
│   ├── public/     #   favicon & icons
│   └── vite.config.js  # proxy dev → localhost:8000
├── netlify.toml    # config deploy Netlify (base = react)
└── DEPLOY.md       # panduan deploy
```

## Run Lokal (XAMPP)

1. **Backend** jalankan Apache + MySQL di XAMPP, akses:
   http://localhost/web-gua3/public
2. **Frontend React**:
   ```powershell
   cd react
   npm install
   npm run dev
   ```
   Akses http://localhost:5173 proxy `/api`, `/images`, `/storage`
   otomatis mengarah ke `http://localhost:8000` (jalankan `php artisan serve`).

## Kontak

- WhatsApp: 0813-4819-0849
- Instagram: @griyautamasri3