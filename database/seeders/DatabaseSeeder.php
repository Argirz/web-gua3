<?php

namespace Database\Seeders;

use App\Models\Brosur;
use App\Models\FotoRumah;
use App\Models\Pengaturan;
use App\Models\Pengguna;
use App\Models\Spesifikasi;
use App\Models\TipeRumah;
use App\Models\UnitRumah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Pengguna::updateOrCreate(
            ['email' => 'admin@gua3.test'],
            [
                'name' => 'Admin GUA 3',
                'role' => 'admin',
                'password' => env('ADMIN_PASSWORD') ? Hash::make(env('ADMIN_PASSWORD')) : Hash::make('password'),
            ]
        );

        $settings = [
            'nama_perumahan' => 'Griya Utama Asri 3',
            'nama_perusahaan' => 'PT. Sinar Berlian Jaya Utama',
            'tagline' => 'Hunian asri, modern, dan aman di kawasan strategis Banjarbaru dengan harga terjangkau.',
            'alamat' => 'HQJ8+3X, Syamsudin Noor, Kec. Landasan Ulin, Kota Banjar Baru, Kalimantan Selatan 70721',
            'telepon' => '081348190849',
            'whatsapp' => '081348190849',
            'email' => 'info@griyautamaasri3.id',
            'jam_operasional' => 'Senin – Sabtu, 08.00 – 16.30 WITA',
            'deskripsi' => 'Griya Utama Asri 3 merupakan kawasan perumahan modern dengan suasana hijau dan asri. Lokasi strategis dengan akses mudah ke pusat kota, dekat dengan fasilitas pendidikan, perbelanjaan, dan kesehatan.',
            'instagram' => 'https://www.instagram.com/griyautamasri3?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==',
        ];

        foreach ($settings as $key => $value) {
            Pengaturan::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        FotoRumah::insert([
            ['title' => 'Tampak Depan Rumah', 'description' => 'Unit contoh tipe 36 Griya Utama Asri 3', 'image' => 'images/foto-rumah-depan.png', 'active' => true, 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Rumah Tampak Samping', 'description' => 'Dokumentasi Griya Utama Asri 3', 'image' => 'images/DSC04251.JPG', 'active' => true, 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Rumah Tampak Depan', 'description' => 'Dokumentasi Griya Utama Asri 3', 'image' => 'images/DSC04257.JPG', 'active' => true, 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Rumah Tampak Serong', 'description' => 'Dokumentasi Griya Utama Asri 3', 'image' => 'images/DSC04260.JPG', 'active' => true, 'sort_order' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Bangunan Rumah 2', 'description' => 'Dokumentasi Griya Utama Asri 3', 'image' => 'images/DSC04262.JPG', 'active' => true, 'sort_order' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Bangunan Rumah 3', 'description' => 'Dokumentasi Griya Utama Asri 3', 'image' => 'images/DSC04268.JPG', 'active' => true, 'sort_order' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Suasana Perumahan', 'description' => 'Dokumentasi Griya Utama Asri 3', 'image' => 'images/DSC04320.JPG', 'active' => true, 'sort_order' => 7, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Handover data kosong sementara - belum ada foto serah terima

        $tipe36a = TipeRumah::create([
            'name' => 'Tipe 36A / 72',
            'slug' => Str::slug('Tipe 36A / 72'),
            'image' => 'images/denah-tipe-36a.png',
            'description' => 'Tipe 36A: 2 Kamar Tidur, 1 Kamar Mandi, Ruang Tamu, Dapur, Teras, Carport. Luas tanah 72 m², luas bangunan 36 m².',
            'land_area' => 72,
            'building_area' => 36,
            'bedrooms' => 2,
            'bathrooms' => 1,
            'price' => 185000000,
            'discount' => 5000000,
            'sort_order' => 1,
        ]);

        $tipe36b = TipeRumah::create([
            'name' => 'Tipe 36B / 72',
            'slug' => Str::slug('Tipe 36B / 72'),
            'image' => 'images/denah-tipe-36b.png',
            'description' => 'Tipe 36B: 2 Kamar Tidur, 1 Kamar Mandi, Ruang Tamu, Dapur, Teras, Carport. Luas tanah 72 m², luas bangunan 36 m². Layout alternatif.',
            'land_area' => 72,
            'building_area' => 36,
            'bedrooms' => 2,
            'bathrooms' => 1,
            'price' => 185000000,
            'discount' => 0,
            'sort_order' => 2,
        ]);

        $data = [
            ['block' => 'A1', 'type' => $tipe36a, 'status' => 'terjual'],
            ['block' => 'A2', 'type' => $tipe36a, 'status' => 'terjual'],
            ['block' => 'A3', 'type' => $tipe36b, 'status' => 'tersedia'],
            ['block' => 'B1', 'type' => $tipe36a, 'status' => 'dipesan'],
            ['block' => 'B2', 'type' => $tipe36b, 'status' => 'terjual'],
            ['block' => 'C1', 'type' => $tipe36a, 'status' => 'terjual'],
            ['block' => 'C2', 'type' => $tipe36b, 'status' => 'tersedia'],
            ['block' => 'C3', 'type' => $tipe36b, 'status' => 'terjual'],
            ['block' => 'D1', 'type' => $tipe36a, 'status' => 'terjual'],
            ['block' => 'D2', 'type' => $tipe36a, 'status' => 'tersedia'],
            ['block' => 'E1', 'type' => $tipe36b, 'status' => 'tersedia'],
        ];

        foreach ($data as $d) {
            UnitRumah::create([
                'block' => $d['block'],
                'unit_type_id' => $d['type']->id,
                'status' => $d['status'],
            ]);
        }

        $specs = [
            ['category' => 'Struktur & Pondasi', 'name' => 'Pondasi', 'value' => 'Batu kali / cakar ayam'],
            ['category' => 'Struktur & Pondasi', 'name' => 'Struktur', 'value' => 'Beton bertulang'],
            ['category' => 'Struktur & Pondasi', 'name' => 'Dinding', 'value' => 'Bata ringan & plester'],
            ['category' => 'Atap', 'name' => 'Rangka', 'value' => 'Baja ringan'],
            ['category' => 'Atap', 'name' => 'Penutup', 'value' => 'Genteng beton'],
            ['category' => 'Lantai', 'name' => 'Ruang tamu & kamar', 'value' => 'Keramik 60x60 / 50x50'],
            ['category' => 'Lantai', 'name' => 'Teras & KM', 'value' => 'Keramik anti slip'],
            ['category' => 'Plafon', 'name' => 'Material', 'value' => 'Gypsum board / multipleks'],
            ['category' => 'Pintu & Jendela', 'name' => 'Pintu utama', 'value' => 'Kusen aluminium / kayu'],
            ['category' => 'Pintu & Jendela', 'name' => 'Jendela', 'value' => 'Aluminium + kaca'],
            ['category' => 'Elektrikal', 'name' => 'Listrik', 'value' => '1.300 VA (PLN)'],
            ['category' => 'Elektrikal', 'name' => 'Instalasi', 'value' => 'Standar SNI'],
            ['category' => 'Sanitasi', 'name' => 'Air', 'value' => 'Sumur bor / PAM'],
            ['category' => 'Sanitasi', 'name' => 'Kloset', 'value' => 'Duduk (monoblok)'],
            ['category' => 'Fasilitas', 'name' => 'Fasilitas umum', 'value' => 'Masjid, taman, jalan lebar'],
        ];

        foreach ($specs as $i => $spec) {
            $spec['sort_order'] = $i + 1;
            Spesifikasi::create($spec);
        }

        Brosur::insert([
            ['title' => 'Brosur Griya Utama Asri 3 Depan', 'file' => 'brosur/all-brosur.pdf', 'cover' => 'images/brosur/gua3-depan.png', 'description' => 'Tampak depan Griya Utama Asri 3.', 'active' => true, 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Brosur Griya Utama Asri 3 Belakang', 'file' => 'brosur/all-brosur.pdf', 'cover' => 'images/brosur/gua3-belakang.png', 'description' => 'Tampak belakang Griya Utama Asri 3.', 'active' => true, 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}