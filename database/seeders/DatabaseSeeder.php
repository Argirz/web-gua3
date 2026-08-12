<?php

namespace Database\Seeders;

use App\Models\Brochure;
use App\Models\GalleryItem;
use App\Models\Handover;
use App\Models\Pricelist;
use App\Models\Setting;
use App\Models\Siteplan;
use App\Models\Specification;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin GUA 3',
            'email' => 'admin@gua3.test',
        ]);

        $settings = [
            'nama_perumahan' => 'Griya Utama Asri 3',
            'nama_perusahaan' => 'PT. Sinar Berlian Jaya Utama',
            'tagline' => 'Hunian asri, nyaman, dan terjangkau untuk keluarga Indonesia.',
            'alamat' => 'HQJ8+3X, Syamsudin Noor, Kec. Landasan Ulin, Kota Banjar Baru, Kalimantan Selatan 70721',
            'telepon' => '081348190849',
            'whatsapp' => '081348190849',
            'email' => 'info@griyautamaasri3.id',
            'jam_operasional' => 'Senin – Sabtu, 08.00 – 16.30 WITA',
            'deskripsi' => 'Griya Utama Asri 3 merupakan kawasan perumahan modern dengan suasana hijau dan asri. Lokasi strategis dengan akses mudah ke pusat kota, dekat dengan fasilitas pendidikan, perbelanjaan, dan kesehatan.',
            'instagram' => 'https://www.instagram.com/griyautamasri3?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        GalleryItem::insert([
            ['title' => 'Tampak Depan Rumah', 'description' => 'Unit contoh tipe 36 Griya Utama Asri 3', 'image' => 'images/foto-rumah-depan.png', 'active' => true, 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Rumah Tampak Samping', 'description' => 'Dokumentasi Griya Utama Asri 3', 'image' => 'images/DSC04251.JPG', 'active' => true, 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Rumah Tampak Depan', 'description' => 'Dokumentasi Griya Utama Asri 3', 'image' => 'images/DSC04257.JPG', 'active' => true, 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Rumah Tampak Serong', 'description' => 'Dokumentasi Griya Utama Asri 3', 'image' => 'images/DSC04260.JPG', 'active' => true, 'sort_order' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Bangunan Rumah 2', 'description' => 'Dokumentasi Griya Utama Asri 3', 'image' => 'images/DSC04262.JPG', 'active' => true, 'sort_order' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Bangunan Rumah 3', 'description' => 'Dokumentasi Griya Utama Asri 3', 'image' => 'images/DSC04268.JPG', 'active' => true, 'sort_order' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Suasana Perumahan', 'description' => 'Dokumentasi Griya Utama Asri 3', 'image' => 'images/DSC04320.JPG', 'active' => true, 'sort_order' => 7, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Handover data kosong sementara - belum ada foto serah terima

        Siteplan::insert([
            ['title' => 'Denah Tipe 36A / 72', 'image' => 'images/denah-tipe-36a.png', 'description' => 'Tipe 36A: 2 Kamar Tidur, 1 Kamar Mandi, Ruang Tamu, Dapur, Teras, Carport. Luas tanah 72 m², luas bangunan 36 m².', 'active' => true, 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Denah Tipe 36B / 72', 'image' => 'images/denah-tipe-36b.png', 'description' => 'Tipe 36B: 2 Kamar Tidur, 1 Kamar Mandi, Ruang Tamu, Dapur, Teras, Carport. Luas tanah 72 m², luas bangunan 36 m². Layout alternatif.', 'active' => true, 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $units = [];
        $data = [
            ['block' => 'A1', 'type' => 'Tipe 36A', 'land' => 72, 'build' => 36, 'price' => 185000000, 'status' => 'terjual'],
            ['block' => 'A2', 'type' => 'Tipe 36A', 'land' => 72, 'build' => 36, 'price' => 185000000, 'status' => 'terjual'],
            ['block' => 'A3', 'type' => 'Tipe 36B', 'land' => 72, 'build' => 36, 'price' => 185000000, 'status' => 'tersedia'],
            ['block' => 'B1', 'type' => 'Tipe 36A', 'land' => 72, 'build' => 36, 'price' => 185000000, 'status' => 'dipesan'],
            ['block' => 'B2', 'type' => 'Tipe 36B', 'land' => 72, 'build' => 36, 'price' => 185000000, 'status' => 'terjual'],
            ['block' => 'C1', 'type' => 'Tipe 36A', 'land' => 72, 'build' => 36, 'price' => 185000000, 'status' => 'terjual'],
            ['block' => 'C2', 'type' => 'Tipe 36B', 'land' => 72, 'build' => 36, 'price' => 185000000, 'status' => 'tersedia'],
            ['block' => 'C3', 'type' => 'Tipe 36B', 'land' => 72, 'build' => 36, 'price' => 185000000, 'status' => 'terjual'],
            ['block' => 'D1', 'type' => 'Tipe 36A', 'land' => 72, 'build' => 36, 'price' => 185000000, 'status' => 'terjual'],
            ['block' => 'D2', 'type' => 'Tipe 36A', 'land' => 72, 'build' => 36, 'price' => 185000000, 'status' => 'tersedia'],
            ['block' => 'E1', 'type' => 'Tipe 36B', 'land' => 72, 'build' => 36, 'price' => 185000000, 'status' => 'tersedia'],
        ];
        foreach ($data as $d) {
            $units[] = [
                'block' => $d['block'],
                'type' => $d['type'],
                'land_area' => $d['land'],
                'building_area' => $d['build'],
                'price' => $d['price'],
                'status' => $d['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Unit::insert($units);

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
            $spec['created_at'] = now();
            $spec['updated_at'] = now();
            Specification::create($spec);
        }

        Brochure::insert([
            ['title' => 'Brosur Griya Utama Asri 3 Depan', 'file' => 'brosur/all-brosur.pdf', 'cover' => 'images/brosur/gua3-depan.png', 'description' => 'Tampak depan Griya Utama Asri 3.', 'active' => true, 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Brosur Griya Utama Asri 3 Belakang', 'file' => 'brosur/all-brosur.pdf', 'cover' => 'images/brosur/gua3-belakang.png', 'description' => 'Tampak belakang Griya Utama Asri 3.', 'active' => true, 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);

        Pricelist::insert([
            ['title' => 'Tipe 36A / 72', 'land_area' => 72, 'building_area' => 36, 'price' => 185000000, 'discount' => 5000000, 'active' => true, 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Tipe 36B / 72', 'land_area' => 72, 'building_area' => 36, 'price' => 185000000, 'discount' => 0, 'active' => true, 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}