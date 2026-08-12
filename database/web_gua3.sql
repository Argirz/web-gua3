
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
DROP TABLE IF EXISTS `brochures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brochures` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `brochures` WRITE;
/*!40000 ALTER TABLE `brochures` DISABLE KEYS */;
INSERT INTO `brochures` VALUES (1,'Brosur Griya Utama Asri 3 Depan','brosur/all-brosur.pdf','images/brosur/gua3-depan.png','Tampak depan Griya Utama Asri 3.',1,1,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(2,'Brosur Griya Utama Asri 3 Belakang','brosur/all-brosur.pdf','images/brosur/gua3-belakang.png','Tampak belakang Griya Utama Asri 3.',1,2,'2026-08-09 16:58:13','2026-08-09 16:58:13');
/*!40000 ALTER TABLE `brochures` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `gallery_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gallery_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `gallery_items` WRITE;
/*!40000 ALTER TABLE `gallery_items` DISABLE KEYS */;
INSERT INTO `gallery_items` VALUES (1,'Tampak Depan Rumah','Unit contoh tipe 36 Griya Utama Asri 3','images/foto-rumah-depan.png',1,1,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(2,'Rumah Tampak Samping','Dokumentasi Griya Utama Asri 3','images/DSC04251.JPG',1,2,'2026-08-09 21:38:14','2026-08-09 21:38:14'),(3,'Rumah Tampak Depan','Dokumentasi Griya Utama Asri 3','images/DSC04257.JPG',1,3,'2026-08-09 21:38:14','2026-08-09 21:38:14'),(4,'Rumah Tampak Serong','Dokumentasi Griya Utama Asri 3','images/DSC04260.JPG',1,4,'2026-08-09 21:38:14','2026-08-09 21:38:14'),(5,'Bangunan Rumah 2','Dokumentasi Griya Utama Asri 3','images/DSC04262.JPG',1,5,'2026-08-09 21:38:14','2026-08-09 21:38:14'),(6,'Bangunan Rumah 3','Dokumentasi Griya Utama Asri 3','images/DSC04268.JPG',1,6,'2026-08-09 21:38:14','2026-08-09 21:38:14'),(7,'Suasana Perumahan','Dokumentasi Griya Utama Asri 3','images/DSC04320.JPG',1,7,'2026-08-09 21:38:14','2026-08-09 21:38:14');
/*!40000 ALTER TABLE `gallery_items` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `handovers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `handovers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `unit` varchar(255) DEFAULT NULL,
  `customer` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `handover_date` date DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `handovers` WRITE;
/*!40000 ALTER TABLE `handovers` DISABLE KEYS */;
/*!40000 ALTER TABLE `handovers` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_01_01_000001_create_settings_table',1),(5,'2026_01_01_000002_create_gallery_items_table',1),(6,'2026_01_01_000003_create_handovers_table',1),(7,'2026_01_01_000004_create_siteplans_table',1),(8,'2026_01_01_000005_create_units_table',1),(9,'2026_01_01_000006_create_specifications_table',1),(10,'2026_01_01_000007_create_brochures_table',1),(11,'2026_01_01_000008_create_pricelists_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `pricelists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pricelists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `land_area` decimal(10,2) DEFAULT NULL,
  `building_area` decimal(10,2) DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `discount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `pricelists` WRITE;
/*!40000 ALTER TABLE `pricelists` DISABLE KEYS */;
INSERT INTO `pricelists` VALUES (1,'Tipe 36A / 72',72.00,36.00,185000000.00,5000000.00,1,1,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(2,'Tipe 36B / 72',72.00,36.00,185000000.00,0.00,1,2,'2026-08-09 16:58:13','2026-08-09 16:58:13');
/*!40000 ALTER TABLE `pricelists` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('E7m7t3pTtQUKa0J3Iagt92Kdyo0Uibu9TJAA45Tv',NULL,'::1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.8972','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWmNmRWJwUWhXdGlnaEZHaDF4cG5YSFF0Y2ZwRmY3Mzl2YTgzUzdCaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvd2ViLWd1YTMvcHVibGljIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1786379607),('exmLakNVURT3gn52rs7n9MGyllNLcaGCxT75lOiO',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.132.0 Chrome/148.0.7778.280 Electron/42.7.1 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNVVFdzRhZmh5ZnUxN2hjalV1UHFDY1ZybmwyMnNIZlhoTkZFNTJoRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvd2ViLWd1YTMvcHVibGljIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1786401958),('IGuivWZ7IRJTcAwvo8SYGIt69zki5enEGL12UvT0',NULL,'::1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.8972','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUkVSTGVJWXJTeW43Y201akg0Z1M0aENqMEZjeUhPYXdreVB3bTZSbiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvd2ViLWd1YTMvcHVibGljIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1786401859),('k3h7jpGMWrVviMdNoiau5orTQwgICMtkd9u5wXOT',NULL,'::1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.8972','YTozOntzOjY6Il90b2tlbiI7czo0MDoicjdsWVZmTFRKZnoydWJrTjdja2pYOVdkWE96eWpwQXpscHdNTkJxSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvd2ViLWd1YTMvcHVibGljIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1786401844),('VSiX9fVo4tyrzAtwdWmFvX6Ts98IjUvhJMaC0uex',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.132.0 Chrome/148.0.7778.280 Electron/42.7.1 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMjg1eFpxS1hMOWxKVzFZb1FyRk5USHdMN2ZvUFdncnZpcG5WRnlRYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvd2ViLWd1YTMvcHVibGljIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1786380397),('YsV12C0wjudkYVNvAL2eLCHxiKd7j9KBv5vpHSdV',NULL,'::1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.8972','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVEtWcGVnYnA4bGZ0Y2N6UGJicnFBcDdseGVrdUZSWURUWTRqd0VhOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Qvd2ViLWd1YTMvcHVibGljIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1786401786);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'nama_perumahan','Griya Utama Asri 3','2026-08-09 16:58:13','2026-08-09 16:58:13'),(2,'nama_perusahaan','PT. Sinar Berlian Jaya Utama','2026-08-09 16:58:13','2026-08-09 16:58:13'),(3,'tagline','Hunian asri, nyaman, dan terjangkau untuk keluarga Indonesia.','2026-08-09 16:58:13','2026-08-09 16:58:13'),(4,'alamat','HQJ8+3X, Syamsudin Noor, Kec. Landasan Ulin, Kota Banjar Baru, Kalimantan Selatan 70721','2026-08-09 16:58:13','2026-08-09 16:58:13'),(5,'telepon','081348190849','2026-08-09 16:58:13','2026-08-09 16:58:13'),(6,'whatsapp','081348190849','2026-08-09 16:58:13','2026-08-09 16:58:13'),(7,'email','info@griyautamaasri3.id','2026-08-09 16:58:13','2026-08-09 16:58:13'),(8,'jam_operasional','Senin ΓÇô Sabtu, 08.00 ΓÇô 16.30 WITA','2026-08-09 16:58:13','2026-08-09 16:58:13'),(9,'deskripsi','Griya Utama Asri 3 merupakan kawasan perumahan modern dengan suasana hijau dan asri. Lokasi strategis dengan akses mudah ke pusat kota, dekat dengan fasilitas pendidikan, perbelanjaan, dan kesehatan.','2026-08-09 16:58:13','2026-08-09 16:58:13'),(10,'instagram','https://www.instagram.com/griyautamasri3?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==','2026-08-09 16:58:13','2026-08-09 16:58:13');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `siteplans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siteplans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `siteplans` WRITE;
/*!40000 ALTER TABLE `siteplans` DISABLE KEYS */;
INSERT INTO `siteplans` VALUES (1,'Denah Tipe 36A / 72','images/denah-tipe-36a.png','Tipe 36A: 2 Kamar Tidur, 1 Kamar Mandi, Ruang Tamu, Dapur, Teras, Carport. Luas tanah 72 m┬▓, luas bangunan 36 m┬▓.',1,1,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(2,'Denah Tipe 36B / 72','images/denah-tipe-36b.png','Tipe 36B: 2 Kamar Tidur, 1 Kamar Mandi, Ruang Tamu, Dapur, Teras, Carport. Luas tanah 72 m┬▓, luas bangunan 36 m┬▓. Layout alternatif.',1,2,'2026-08-09 16:58:13','2026-08-09 16:58:13');
/*!40000 ALTER TABLE `siteplans` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `specifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `specifications` WRITE;
/*!40000 ALTER TABLE `specifications` DISABLE KEYS */;
INSERT INTO `specifications` VALUES (1,'Struktur & Pondasi','Pondasi','Batu kali / cakar ayam',1,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(2,'Struktur & Pondasi','Struktur','Beton bertulang',2,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(3,'Struktur & Pondasi','Dinding','Bata ringan & plester',3,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(4,'Atap','Rangka','Baja ringan',4,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(5,'Atap','Penutup','Genteng beton',5,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(6,'Lantai','Ruang tamu & kamar','Keramik 60x60 / 50x50',6,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(7,'Lantai','Teras & KM','Keramik anti slip',7,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(8,'Plafon','Material','Gypsum board / multipleks',8,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(9,'Pintu & Jendela','Pintu utama','Kusen aluminium / kayu',9,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(10,'Pintu & Jendela','Jendela','Aluminium + kaca',10,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(11,'Elektrikal','Listrik','1.300 VA (PLN)',11,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(12,'Elektrikal','Instalasi','Standar SNI',12,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(13,'Sanitasi','Air','Sumur bor / PAM',13,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(14,'Sanitasi','Kloset','Duduk (monoblok)',14,'2026-08-09 16:58:13','2026-08-09 16:58:13'),(15,'Fasilitas','Fasilitas umum','Masjid, taman, jalan lebar',15,'2026-08-09 16:58:13','2026-08-09 16:58:13');
/*!40000 ALTER TABLE `specifications` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `units` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `block` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `land_area` decimal(10,2) DEFAULT NULL,
  `building_area` decimal(10,2) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `status` enum('tersedia','dipesan','terjual') NOT NULL DEFAULT 'tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES (1,'A1','Tipe 36A',72.00,36.00,185000000.00,'terjual','2026-08-09 16:58:13','2026-08-09 16:58:13'),(2,'A2','Tipe 36A',72.00,36.00,185000000.00,'terjual','2026-08-09 16:58:13','2026-08-09 16:58:13'),(3,'A3','Tipe 36B',72.00,36.00,185000000.00,'tersedia','2026-08-09 16:58:13','2026-08-09 16:58:13'),(4,'B1','Tipe 36A',72.00,36.00,185000000.00,'dipesan','2026-08-09 16:58:13','2026-08-09 16:58:13'),(5,'B2','Tipe 36B',72.00,36.00,185000000.00,'terjual','2026-08-09 16:58:13','2026-08-09 16:58:13'),(6,'C1','Tipe 36A',72.00,36.00,185000000.00,'terjual','2026-08-09 16:58:13','2026-08-09 16:58:13'),(7,'C2','Tipe 36B',72.00,36.00,185000000.00,'tersedia','2026-08-09 16:58:13','2026-08-09 16:58:13'),(8,'C3','Tipe 36B',72.00,36.00,185000000.00,'terjual','2026-08-09 16:58:13','2026-08-09 16:58:13'),(9,'D1','Tipe 36A',72.00,36.00,185000000.00,'terjual','2026-08-09 16:58:13','2026-08-09 16:58:13'),(10,'D2','Tipe 36A',72.00,36.00,185000000.00,'tersedia','2026-08-09 16:58:13','2026-08-09 16:58:13'),(11,'E1','Tipe 36B',72.00,36.00,185000000.00,'tersedia','2026-08-09 16:58:13','2026-08-09 16:58:13');
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin GUA 3','admin@gua3.test','2026-08-09 16:58:12','$2y$12$nfrOFQzs5/hNQ6rGbyjlv.6hCjnyndAXKM6JYJ1WOX5MizZb6w0wC','bKbmHuD70M','2026-08-09 16:58:13','2026-08-09 16:58:13');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

