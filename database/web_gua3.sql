-- =====================================================================
--  Database : web_gua3
--  Website  : Griya Utama Asri 3 (perumahan)
--  Versi    : 3.0 - PRD: prospek (leads), role, PDF per tipe, kategori foto
--
--  Daftar tabel & relasi:
--
--   pengaturan      (konfigurasi situs, key-value)               [mandiri]
--   foto_rumah      (foto rumah; tipe_rumah_id + kategori)       [mandiri]
--   brosur          (brosur / dokumen PDF)                       [mandiri]
--   spesifikasi     (spesifikasi bangunan)                       [mandiri]
--   tipe_rumah      (master tipe: denah + luas + harga + PDF)
--      |-- 1:N -->  unit_rumah   (stok unit per blok)
--      |                |-- 1:N -->  serah_terima (dokumentasi serah terima)
--      |-- 1:N -->  prospek     (lead peminat / data calon pembeli)
--      |-- 1:N -->  foto_rumah  (foto per tipe rumah)
--   pengguna        (akun admin / marketing, kolom role)
--      |-- 1:N -->  sesi         (sesi login)
--   migrasi         (riwayat migrasi Laravel)                    [mandiri]
--
--  Untuk impor ulang: cukup jalankan file ini di phpMyAdmin (Import).
-- =====================================================================

-- =====================================================================
-- DROP TABEL (aman diimpor ulang; tabel versi lama ikut dibersihkan)
-- =====================================================================
-- Tabel framework / versi lama yang tidak dipakai
DROP TABLE IF EXISTS `brochures`, `cache`, `cache_locks`, `failed_jobs`,
  `gallery_items`, `galeri`, `handovers`, `job_batches`, `jobs`, `migrations`,
  `password_reset_tokens`, `pricelists`, `sessions`, `settings`,
  `siteplans`, `specifications`, `units`, `users`;

-- =====================================================================
-- Tabel aktif versi sekarang (CREATE + DATA + RELASI dari live DB)
-- =====================================================================
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `brosur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brosur` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `brosur_active_sort_index` (`active`,`sort_order`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `brosur` WRITE;
/*!40000 ALTER TABLE `brosur` DISABLE KEYS */;
INSERT INTO `brosur` VALUES (1,'Brosur Griya Utama Asri 3 Depan','brosur/all-brosur.pdf','images/brosur/gua3-depan.png','Tampak depan Griya Utama Asri 3.',1,1,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(2,'Brosur Griya Utama Asri 3 Belakang','brosur/all-brosur.pdf','images/brosur/gua3-belakang.png','Tampak belakang Griya Utama Asri 3.',1,2,'2026-08-09 16:58:13','2026-08-09 16:58:13');
/*!40000 ALTER TABLE `brosur` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `foto_rumah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `foto_rumah` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipe_rumah_id` bigint(20) unsigned DEFAULT NULL,
  `kategori` enum('unit','serah_terima','siteplan') NOT NULL DEFAULT 'unit',
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `galeri_active_sort_index` (`active`,`sort_order`),
  KEY `foto_rumah_tipe_rumah_id_foreign` (`tipe_rumah_id`),
  CONSTRAINT `foto_rumah_tipe_rumah_id_foreign` FOREIGN KEY (`tipe_rumah_id`) REFERENCES `tipe_rumah` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `foto_rumah` WRITE;
/*!40000 ALTER TABLE `foto_rumah` DISABLE KEYS */;
INSERT INTO `foto_rumah` VALUES (1,NULL,'unit','Tampak Depan Rumah','Unit contoh tipe 36 Griya Utama Asri 3','images/foto-rumah-depan.png',1,1,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(2,NULL,'unit','Rumah Tampak Samping','Dokumentasi Griya Utama Asri 3','images/DSC04251.JPG',1,2,'2026-08-09 21:38:14','2026-08-09 21:38:14'),(3,NULL,'unit','Rumah Tampak Depan','Dokumentasi Griya Utama Asri 3','images/DSC04257.JPG',1,3,'2026-08-09 21:38:14','2026-08-09 21:38:14'),(4,NULL,'unit','Rumah Tampak Serong','Dokumentasi Griya Utama Asri 3','images/DSC04260.JPG',1,4,'2026-08-09 21:38:14','2026-08-09 21:38:14'),(5,NULL,'unit','Bangunan Rumah 2','Dokumentasi Griya Utama Asri 3','images/DSC04262.JPG',1,5,'2026-08-09 21:38:14','2026-08-09 21:38:14'),(6,NULL,'unit','Bangunan Rumah 3','Dokumentasi Griya Utama Asri 3','images/DSC04268.JPG',1,6,'2026-08-09 21:38:14','2026-08-09 21:38:14'),(7,NULL,'unit','Suasana Perumahan','Dokumentasi Griya Utama Asri 3','images/DSC04320.JPG',1,7,'2026-08-09 21:38:14','2026-08-09 21:38:14');
/*!40000 ALTER TABLE `foto_rumah` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `migrasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrasi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `migrasi` WRITE;
/*!40000 ALTER TABLE `migrasi` DISABLE KEYS */;
INSERT INTO `migrasi` VALUES (1,'0001_01_01_000000_create_pengguna_table',1),(2,'2026_01_01_000001_create_pengaturan_table',1),(3,'2026_01_01_000002_create_galeri_table',1),(4,'2026_01_01_000003_create_tipe_rumah_table',1),(5,'2026_01_01_000004_create_unit_rumah_table',1),(6,'2026_01_01_000005_create_serah_terima_table',1),(7,'2026_01_01_000006_create_spesifikasi_table',1),(8,'2026_01_01_000007_create_brosur_table',1),(9,'2026_01_01_000008_tambah_foto_rumah_prospek_dan_role_pengguna',2);
/*!40000 ALTER TABLE `migrasi` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `pengaturan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengaturan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pengaturan_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `pengaturan` WRITE;
/*!40000 ALTER TABLE `pengaturan` DISABLE KEYS */;
INSERT INTO `pengaturan` VALUES (1,'nama_perumahan','Griya Utama Asri 3','2026-08-09 16:58:13','2026-08-09 16:58:13'),(2,'nama_perusahaan','PT. Sinar Berlian Jaya Utama','2026-08-09 16:58:13','2026-08-09 16:58:13'),(3,'tagline','Hunian asri, modern, dan aman di kawasan strategis Banjarbaru dengan harga terjangkau.','2026-08-09 16:58:13','2026-08-09 16:58:13'),(4,'alamat','HQJ8+3X, Syamsudin Noor, Kec. Landasan Ulin, Kota Banjar Baru, Kalimantan Selatan 70721','2026-08-09 16:58:13','2026-08-09 16:58:13'),(5,'telepon','081348190849','2026-08-09 16:58:13','2026-08-09 16:58:13'),(6,'whatsapp','081348190849','2026-08-09 16:58:13','2026-08-09 16:58:13'),(7,'email','info@griyautamaasri3.id','2026-08-09 16:58:13','2026-08-09 16:58:13'),(8,'jam_operasional','Senin – Sabtu, 08.00 – 16.30 WITA','2026-08-09 16:58:13','2026-08-09 16:58:13'),(9,'deskripsi','Griya Utama Asri 3 merupakan kawasan perumahan modern dengan suasana hijau dan asri. Lokasi strategis dengan akses mudah ke pusat kota, dekat dengan fasilitas pendidikan, perbelanjaan, dan kesehatan.','2026-08-09 16:58:13','2026-08-09 16:58:13'),(10,'instagram','https://www.instagram.com/griyautamasri3?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==','2026-08-09 16:58:13','2026-08-09 16:58:13');
/*!40000 ALTER TABLE `pengaturan` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `pengguna`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengguna` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','marketing') NOT NULL DEFAULT 'admin',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pengguna_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `pengguna` WRITE;
/*!40000 ALTER TABLE `pengguna` DISABLE KEYS */;
INSERT INTO `pengguna` VALUES (1,'Admin GUA 3','admin@gua3.test','admin','2026-08-09 16:58:12','$2y$12$nfrOFQzs5/hNQ6rGbyjlv.6hCjnyndAXKM6JYJ1WOX5MizZb6w0wC','bKbmHuD70M','2026-08-09 16:58:13','2026-08-09 16:58:13');
/*!40000 ALTER TABLE `pengguna` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `prospek`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prospek` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipe_rumah_id` bigint(20) unsigned DEFAULT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nomor_wa` varchar(255) NOT NULL,
  `sumber` enum('brosur','pricelist','kontak') NOT NULL DEFAULT 'brosur',
  `status` enum('baru','dihubungi','deal','gugur') NOT NULL DEFAULT 'baru',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prospek_tipe_rumah_id_foreign` (`tipe_rumah_id`),
  KEY `prospek_status_index` (`status`),
  CONSTRAINT `prospek_tipe_rumah_id_foreign` FOREIGN KEY (`tipe_rumah_id`) REFERENCES `tipe_rumah` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `prospek` WRITE;
/*!40000 ALTER TABLE `prospek` DISABLE KEYS */;
/*!40000 ALTER TABLE `prospek` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `serah_terima`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serah_terima` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `unit_rumah_id` bigint(20) unsigned DEFAULT NULL,
  `customer` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `handover_date` date DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `serah_terima_unit_rumah_id_foreign` (`unit_rumah_id`),
  KEY `serah_terima_active_sort_index` (`active`,`sort_order`),
  KEY `serah_terima_handover_date_index` (`handover_date`),
  CONSTRAINT `serah_terima_unit_rumah_id_foreign` FOREIGN KEY (`unit_rumah_id`) REFERENCES `unit_rumah` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `serah_terima` WRITE;
/*!40000 ALTER TABLE `serah_terima` DISABLE KEYS */;
/*!40000 ALTER TABLE `serah_terima` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `sesi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sesi` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sesi_user_id_foreign` (`user_id`),
  KEY `sesi_last_activity_index` (`last_activity`),
  CONSTRAINT `sesi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `pengguna` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `sesi` WRITE;
/*!40000 ALTER TABLE `sesi` DISABLE KEYS */;
INSERT INTO `sesi` VALUES ('VGENJLRGtElKlFBoiPMD3gTRIkD4vOaukYuj3JaC',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiR2NkUEg1OWtpVXZrenJhaExaeW1CV2tYV1lXT2N3VkVuRzV6U3AxcyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1786580326),('Y7JP2BZQSpWOfJAEEkKvLR7lsAMeUodWQ5xXdUGE',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.132.1 Chrome/148.0.7778.280 Electron/42.7.1 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWk9hODBYb2VqZ1VzUVVpckkyYzlsZG0xZTdaN1hyVzlvZnJMeVR2ayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1786582565);
/*!40000 ALTER TABLE `sesi` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `spesifikasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spesifikasi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `spesifikasi_category_index` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `spesifikasi` WRITE;
/*!40000 ALTER TABLE `spesifikasi` DISABLE KEYS */;
INSERT INTO `spesifikasi` VALUES (1,'Struktur & Pondasi','Pondasi','Batu kali / cakar ayam',1,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(2,'Struktur & Pondasi','Struktur','Beton bertulang',2,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(3,'Struktur & Pondasi','Dinding','Bata ringan & plester',3,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(4,'Atap','Rangka','Baja ringan',4,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(5,'Atap','Penutup','Genteng beton',5,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(6,'Lantai','Ruang tamu & kamar','Keramik 60x60 / 50x50',6,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(7,'Lantai','Teras & KM','Keramik anti slip',7,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(8,'Plafon','Material','Gypsum board / multipleks',8,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(9,'Pintu & Jendela','Pintu utama','Kusen aluminium / kayu',9,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(10,'Pintu & Jendela','Jendela','Aluminium + kaca',10,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(11,'Elektrikal','Listrik','1.300 VA (PLN)',11,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(12,'Elektrikal','Instalasi','Standar SNI',12,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(13,'Sanitasi','Air','Sumur bor / PAM',13,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(14,'Sanitasi','Kloset','Duduk (monoblok)',14,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(15,'Fasilitas','Fasilitas umum','Masjid, taman, jalan lebar',15,'2026-08-09 16:58:13','2026-08-09 16:58:13');
/*!40000 ALTER TABLE `spesifikasi` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `tipe_rumah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipe_rumah` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `brochure_pdf` varchar(255) DEFAULT NULL,
  `pricelist_pdf` varchar(255) DEFAULT NULL,
  `land_area` decimal(10,2) NOT NULL DEFAULT 0.00,
  `building_area` decimal(10,2) NOT NULL DEFAULT 0.00,
  `bedrooms` tinyint(3) unsigned DEFAULT NULL,
  `bathrooms` tinyint(3) unsigned DEFAULT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tipe_rumah_name_unique` (`name`),
  UNIQUE KEY `tipe_rumah_slug_unique` (`slug`),
  KEY `tipe_rumah_active_sort_index` (`active`,`sort_order`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `tipe_rumah` WRITE;
/*!40000 ALTER TABLE `tipe_rumah` DISABLE KEYS */;
INSERT INTO `tipe_rumah` VALUES (1,'Tipe 36A / 72','tipe-36a-72','images/denah-tipe-36a.png','Tipe 36A: 2 Kamar Tidur, 1 Kamar Mandi, Ruang Tamu, Dapur, Teras, Carport. Luas tanah 72 m², luas bangunan 36 m².',NULL,NULL,72.00,36.00,2,1,185000000.00,5000000.00,1,1,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(2,'Tipe 36B / 72','tipe-36b-72','images/denah-tipe-36b.png','Tipe 36B: 2 Kamar Tidur, 1 Kamar Mandi, Ruang Tamu, Dapur, Teras, Carport. Luas tanah 72 m², luas bangunan 36 m². Layout alternatif.',NULL,NULL,72.00,36.00,2,1,185000000.00,0.00,1,2,'2026-08-09 16:58:13','2026-08-09 16:58:13');
/*!40000 ALTER TABLE `tipe_rumah` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `unit_rumah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unit_rumah` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `block` varchar(255) NOT NULL,
  `unit_type_id` bigint(20) unsigned NOT NULL,
  `status` enum('tersedia','dipesan','terjual') NOT NULL DEFAULT 'tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unit_rumah_block_unique` (`block`),
  KEY `unit_rumah_unit_type_id_foreign` (`unit_type_id`),
  KEY `unit_rumah_status_index` (`status`),
  CONSTRAINT `unit_rumah_unit_type_id_foreign` FOREIGN KEY (`unit_type_id`) REFERENCES `tipe_rumah` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `unit_rumah` WRITE;
/*!40000 ALTER TABLE `unit_rumah` DISABLE KEYS */;
INSERT INTO `unit_rumah` VALUES (1,'A1',1,'terjual','2026-08-09 16:58:13','2026-08-09 16:58:13'),(2,'A2',1,'terjual','2026-08-09 16:58:13','2026-08-09 16:58:13'),(3,'A3',2,'tersedia','2026-08-09 16:58:13','2026-08-09 16:58:13'),(4,'B1',1,'dipesan','2026-08-09 16:58:13','2026-08-09 16:58:13'),(5,'B2',2,'terjual','2026-08-09 16:58:13','2026-08-09 16:58:13'),(6,'C1',1,'terjual','2026-08-09 16:58:13','2026-08-09 16:58:13'),(7,'C2',2,'tersedia','2026-08-09 16:58:13','2026-08-09 16:58:13'),(8,'C3',2,'terjual','2026-08-09 16:58:13','2026-08-09 16:58:13'),(9,'D1',1,'terjual','2026-08-09 16:58:13','2026-08-09 16:58:13'),(10,'D2',1,'tersedia','2026-08-09 16:58:13','2026-08-09 16:58:13'),(11,'E1',2,'tersedia','2026-08-09 16:58:13','2026-08-09 16:58:13');
/*!40000 ALTER TABLE `unit_rumah` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

