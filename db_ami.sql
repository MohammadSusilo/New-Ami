-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.24-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for ami_dev
CREATE DATABASE IF NOT EXISTS `ami_dev` /*!40100 DEFAULT CHARACTER SET armscii8 COLLATE armscii8_bin */;
USE `ami_dev`;

-- Dumping structure for table ami_dev.bahan_rapattm
CREATE TABLE IF NOT EXISTS `bahan_rapattm` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deskripsi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `car_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tm_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bahan_rapattm_tm_id_foreign` (`tm_id`),
  CONSTRAINT `bahan_rapattm_tm_id_foreign` FOREIGN KEY (`tm_id`) REFERENCES `tinjauan_manajemen` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.bahan_rapattm: ~0 rows (approximately)

-- Dumping structure for table ami_dev.bukti_kinerja
CREATE TABLE IF NOT EXISTS `bukti_kinerja` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `namaBukti` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokDokBukti` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` year(4) NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `unitkerja_id` int(10) unsigned NOT NULL,
  `renop_id` int(10) unsigned NOT NULL,
  `kinerjaUnit_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bukti_kinerja_kinerjaunit_id_foreign` (`kinerjaUnit_id`),
  CONSTRAINT `bukti_kinerja_kinerjaunit_id_foreign` FOREIGN KEY (`kinerjaUnit_id`) REFERENCES `kinerja_unit` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.bukti_kinerja: ~0 rows (approximately)

-- Dumping structure for table ami_dev.car
CREATE TABLE IF NOT EXISTS `car` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `analisiPenyebabMasalah` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tindakanPenyelesaian` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tindakanPencegahan` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasilPemeriksaan` enum('sesuai','nonsesuai') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rekomendasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('open','process','closed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_bahanTM` int(10) NOT NULL DEFAULT 0,
  `laporanaudit_id` int(10) unsigned NOT NULL,
  `acc` int(20) DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `car_laporanaudit_id_foreign` (`laporanaudit_id`),
  CONSTRAINT `car_laporanaudit_id_foreign` FOREIGN KEY (`laporanaudit_id`) REFERENCES `laporan_audit` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.car: ~0 rows (approximately)
INSERT INTO `car` (`id`, `analisiPenyebabMasalah`, `tindakanPenyelesaian`, `tindakanPencegahan`, `hasilPemeriksaan`, `rekomendasi`, `status`, `is_bahanTM`, `laporanaudit_id`, `acc`, `file`, `created_at`, `updated_at`) VALUES
	(82, '<p><strong>The reason for this is if you view the source it inserts a line return automatically during editing. Normally I can fix this quite easily with jQuery, but because that concept made my head explode, I had to find a different way.</strong></p>\r\n\r\n<p><strong>The trim() method didn&rsquo;t come along in JavaScript until version 1.8.1. So while my current browser users are okay, my older browsers users such as IE8 aren&rsquo;t so lucky.</strong></p>\r\n\r\n<p><strong>To resolve this issue, I test for the &ldquo;trim()&rdquo; prototype method. If it doesn&rsquo;t exist I extend the String prototype object with a trim() method. So thanks to some guy with the alias &ldquo;<a href="http://blog.stevenlevithan.com/archives/faster-trim-javascript" target="_blank">Timo</a>&rdquo; I&rsquo;ve put this thinking into place. The length result of string &ldquo;test&rdquo; now returns an accurate value of 4.</strong></p>', '<p><s>The reason for this is if you view the source it inserts a line return automatically during editing. Normally I can fix this quite easily with jQuery, but because that concept made my head explode, I had to find a different way.</s></p>\r\n\r\n<p><s>The trim() method didn&rsquo;t come along in JavaScript until version 1.8.1. So while my current browser users are okay, my older browsers users such as IE8 aren&rsquo;t so lucky.</s></p>\r\n\r\n<p><s>To resolve this issue, I test for the &ldquo;trim()&rdquo; prototype method. If it doesn&rsquo;t exist I extend the String prototype object with a trim() method. So thanks to some guy with the alias &ldquo;<a href="http://blog.stevenlevithan.com/archives/faster-trim-javascript" target="_blank">Timo</a>&rdquo; I&rsquo;ve put this thinking into place. The length result of string &ldquo;test&rdquo; now returns an accurate value of 4.</s></p>', '<p><strong><s><em>The reason for this is if you view the source it inserts a line return automatically during editing. Normally I can fix this quite easily with jQuery, but because that concept made my head explode, I had to find a different way.</em></s></strong></p>\r\n\r\n<p><strong><s><em>The trim() method didn&rsquo;t come along in JavaScript until version 1.8.1. So while my current browser users are okay, my older browsers users such as IE8 aren&rsquo;t so lucky.</em></s></strong></p>\r\n\r\n<p><strong><s><em>To resolve this issue, I test for the &ldquo;trim()&rdquo; prototype method. If it doesn&rsquo;t exist I extend the String prototype object with a trim() method. So thanks to some guy with the alias &ldquo;<a href="http://blog.stevenlevithan.com/archives/faster-trim-javascript" target="_blank">Timo</a>&rdquo; I&rsquo;ve put this thinking into place. The length result of string &ldquo;test&rdquo; now returns an accurate value of 4.</em></s></strong></p>', 'nonsesuai', 'Silahkan dicek kembali', 'closed', 0, 100, 271, NULL, '2022-12-09 12:02:20', '2022-12-09 20:14:46');

-- Dumping structure for table ami_dev.dokumencheklist
CREATE TABLE IF NOT EXISTS `dokumencheklist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` year(4) NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unitkerja_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dokumencheklist_unitkerja_id_foreign` (`unitkerja_id`),
  CONSTRAINT `dokumencheklist_unitkerja_id_foreign` FOREIGN KEY (`unitkerja_id`) REFERENCES `unitkerja` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.dokumencheklist: ~0 rows (approximately)
INSERT INTO `dokumencheklist` (`id`, `name`, `tahun`, `lokasi`, `status`, `unitkerja_id`, `created_at`, `updated_at`) VALUES
	(12, 'Checklist Area Informatika', '2023', 'storage/files/Pusat/PPMP/Dokumen Checklist/2023/6233-15179-1-PB.pdf', 'aktif', 66, '2023-03-30 19:52:28', '2023-03-30 19:52:28');

-- Dumping structure for table ami_dev.dokumeninduk
CREATE TABLE IF NOT EXISTS `dokumeninduk` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_aktif` year(4) NOT NULL,
  `tahun_selesai` year(4) DEFAULT NULL,
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sifatDokumen` enum('private','public') COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.dokumeninduk: ~5 rows (approximately)
INSERT INTO `dokumeninduk` (`id`, `name`, `tahun_aktif`, `tahun_selesai`, `nomor`, `revisi`, `status`, `sifatDokumen`, `lokasi`, `created_at`, `updated_at`) VALUES
	(2, 'SPMI', '2021', '2024', 'SPMI/01', '4', 'aktif', 'public', 'storage/files/Pusat/PPMP/Dokumen Induk/2022/Area AMI Tahun 2021-2024.pdf', '2021-12-27 04:40:28', '2022-02-09 12:21:15'),
	(6, 'Perjanjian Kinerja', '2022', '2024', '0531/PL4.6.2/PK/2021', '1', 'aktif', 'private', 'storage/files/Pusat/PPMP/Dokumen Induk/2022/PK_2021.pdf', '2022-01-07 07:09:41', '2022-01-07 07:09:41'),
	(10, 'PK', '2022', '2025', '01/AMI/11/2022', '1', 'aktif', 'private', 'storage/files/Pusat/PPMP/Dokumen Induk/2022/PK_2021.pdf', '2022-11-03 16:13:41', '2022-11-03 16:13:41'),
	(11, 'AMI', '2021', '2024', '02/AMI/11/2022', '1', 'aktif', 'private', 'storage/files/Pusat/PPMP/Dokumen Induk/2022/Area AMI Tahun 2021-2024.pdf', '2022-11-03 16:13:41', '2022-11-03 16:13:41'),
	(12, 'Kebijakan SPMI', '2018', '2022', '2018', '1', 'aktif', 'public', 'storage/files/Pusat/PPMP/Dokumen Induk/2022/1 BUKU KEBIJAKAN SPMI_SMM I 2017-TTD.pdf', '2022-11-16 02:08:11', '2022-11-16 02:08:30');

-- Dumping structure for table ami_dev.faqs
CREATE TABLE IF NOT EXISTS `faqs` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `subjek` varchar(255) NOT NULL,
  `uraian` varchar(255) NOT NULL,
  `urutan` int(10) NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ami_dev.faqs: ~2 rows (approximately)
INSERT INTO `faqs` (`id`, `subjek`, `uraian`, `urutan`, `status`, `created_at`, `update_at`) VALUES
	(1, 'Cara Pengunnaan Audit Mutu Internal?', 'deskripsiAudit Mutu', 1, 'aktif', '2021-12-24 04:43:13', '2021-12-24 05:42:19'),
	(2, 'TES2', 'DESC2', 2, 'nonaktif', '2021-12-24 08:08:10', '2021-12-24 08:28:39');

-- Dumping structure for table ami_dev.frontend
CREATE TABLE IF NOT EXISTS `frontend` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tittle` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `welcome` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ami_dev.frontend: ~0 rows (approximately)
INSERT INTO `frontend` (`id`, `tittle`, `logo`, `favicon`, `welcome`, `created_at`, `updated_at`) VALUES
	(1, 'Audit Mutu Internal', 'storage/files/Pusat/Setting/logoku (1).png', 'storage/files/Pusat/Setting/apple-icon-152x152.png', 'Selamat Datang Di Audit Mutu Internal Politeknik Negeri Semarang', '2022-11-19 15:47:59', '2022-11-19 22:47:59');

-- Dumping structure for table ami_dev.frontend_banner
CREATE TABLE IF NOT EXISTS `frontend_banner` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `path` varchar(255) NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL,
  `frontend_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `frontend_id` (`frontend_id`),
  CONSTRAINT `frontEnd_banner_ibfk_1` FOREIGN KEY (`frontend_id`) REFERENCES `frontend` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ami_dev.frontend_banner: ~4 rows (approximately)
INSERT INTO `frontend_banner` (`id`, `name`, `deskripsi`, `path`, `status`, `frontend_id`, `created_at`, `updated_at`) VALUES
	(1, 'Langkah-Langkah Penggunaan AMI', 'Langkah-Langkah Penggunaan AMI', 'storage/files/Pusat/Setting/Banner/1.jpg', 'aktif', 1, '2021-12-24 14:29:56', '2021-12-24 21:29:56'),
	(2, 'Jadwal AMI 2022', 'Jadwal AMI 2022', 'storage/files/Pusat/Setting/Banner/2.jpg', 'aktif', 1, '2021-12-24 14:30:35', '2021-12-24 21:30:35'),
	(3, 'contoh 1', 'des1', 'storage/files/Pusat/Setting/Banner/1.jpg', 'aktif', 1, '2022-11-19 08:19:58', '2021-12-24 18:07:55'),
	(4, 'contoh 2', 'des2', 'storage/files/Pusat/Setting/Banner/2.jpg', 'aktif', 1, '2022-11-19 08:20:03', '2021-12-24 18:07:55');

-- Dumping structure for table ami_dev.hasil_rapattm
CREATE TABLE IF NOT EXISTS `hasil_rapattm` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subjek` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasilPembahasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hadir` int(255) NOT NULL,
  `tidakHadir` int(255) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tm_id` int(10) unsigned NOT NULL,
  `bahan_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hasil_rapattm_tm_id_foreign` (`tm_id`),
  CONSTRAINT `hasil_rapattm_tm_id_foreign` FOREIGN KEY (`tm_id`) REFERENCES `tinjauan_manajemen` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.hasil_rapattm: ~0 rows (approximately)

-- Dumping structure for table ami_dev.jadwal_audit
CREATE TABLE IF NOT EXISTS `jadwal_audit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `periode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tglAudit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `unitkerja_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `soft_delete` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.jadwal_audit: ~50 rows (approximately)
INSERT INTO `jadwal_audit` (`id`, `tahun`, `periode`, `tglAudit`, `waktu`, `status`, `unitkerja_id`, `created_at`, `updated_at`, `soft_delete`) VALUES
	(136, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 1, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(137, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 2, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(138, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 3, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(139, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 4, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(140, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 5, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(141, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 6, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(142, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 7, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(143, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 8, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(144, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 9, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(145, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 10, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(146, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 11, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(147, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 12, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(148, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 13, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(149, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 14, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(150, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 15, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(151, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 16, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(152, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 17, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(153, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 18, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(154, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 19, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(155, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 20, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(156, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 21, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(157, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 22, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(158, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 23, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(159, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 24, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(160, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 25, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(161, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 26, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(162, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 27, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(163, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 28, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(164, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 29, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(165, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 30, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(166, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 31, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(167, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 32, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(168, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 33, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(169, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 34, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(170, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 35, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(171, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 36, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(172, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 37, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(173, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 38, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(174, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 43, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(175, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 44, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(176, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 45, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(177, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 46, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(178, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 47, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(179, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 48, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(180, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 49, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(181, '2022', '1', '2022-11-26#2022-12-31', '09:00#15:00', 'nonaktif', 50, '2022-11-26 03:07:53', '2022-11-29 22:35:59', NULL),
	(182, '2022', '2', '2022-11-11#2022-11-19', '12:00#13:00', 'nonaktif', 1, '2022-11-26 16:22:43', '2022-11-29 22:35:59', NULL),
	(183, '2022', '1', '2022-11-30#2022-12-31', '09:00#12:00', 'aktif', 60, '2022-11-29 17:40:37', '2022-11-30 08:22:31', NULL),
	(184, '2022', '1', '2022-11-30#2022-12-31', '09:00#12:00', 'aktif', 65, '2022-11-29 17:41:12', '2022-11-30 08:22:43', NULL),
	(185, '2022', '1', '2022-11-30#2022-12-31', '09:00#12:00', 'aktif', 52, '2022-11-29 17:41:54', '2022-11-30 08:22:54', NULL);

-- Dumping structure for table ami_dev.kinerja_unit
CREATE TABLE IF NOT EXISTS `kinerja_unit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nilaiCapaian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` year(4) NOT NULL,
  `unitCapaian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `unitkerja_id` int(10) unsigned NOT NULL,
  `renop_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kinerja_unit_renop_id_foreign` (`renop_id`),
  CONSTRAINT `kinerja_unit_renop_id_foreign` FOREIGN KEY (`renop_id`) REFERENCES `renop` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.kinerja_unit: ~0 rows (approximately)

-- Dumping structure for table ami_dev.laporan_audit
CREATE TABLE IF NOT EXISTS `laporan_audit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kategoriTemuan` enum('OFI','AOC','NC') COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraianTemuan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `saranPerbaikan` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `audit_id` int(10) unsigned NOT NULL,
  `standar_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `laporan_audit_audit_id_foreign` (`audit_id`),
  KEY `standar_id` (`standar_id`),
  CONSTRAINT `laporan_audit_audit_id_foreign` FOREIGN KEY (`audit_id`) REFERENCES `jadwal_audit` (`id`) ON DELETE CASCADE,
  CONSTRAINT `laporan_audit_ibfk_1` FOREIGN KEY (`standar_id`) REFERENCES `standar` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.laporan_audit: ~2 rows (approximately)
INSERT INTO `laporan_audit` (`id`, `kategoriTemuan`, `uraianTemuan`, `saranPerbaikan`, `audit_id`, `standar_id`, `created_at`, `updated_at`) VALUES
	(99, 'NC', '<p>TEs</p>', NULL, 185, 4, '2022-12-09 11:49:42', '2022-12-09 18:49:42'),
	(100, 'NC', '<p>TES12345</p>', NULL, 184, 6, '2022-12-09 11:49:42', '2022-12-09 18:49:42');

-- Dumping structure for table ami_dev.led_c1
CREATE TABLE IF NOT EXISTS `led_c1` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uk_id` int(10) unsigned NOT NULL,
  `latarb` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebijakan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mp_vmts` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sos_vmts` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hub_vmts` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eval_vmts` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `simpulan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `led_c1_ibfk_1` (`uk_id`),
  CONSTRAINT `led_c1_ibfk_1` FOREIGN KEY (`uk_id`) REFERENCES `unitkerja` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.led_c1: ~0 rows (approximately)

-- Dumping structure for table ami_dev.led_c2
CREATE TABLE IF NOT EXISTS `led_c2` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uk_id` int(10) unsigned NOT NULL,
  `latarb` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebijakan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sps` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iku_a` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iku_b` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iku_c` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ikt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eval` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `simpulan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `led_c2_ibfk_1` (`uk_id`),
  CONSTRAINT `led_c2_ibfk_1` FOREIGN KEY (`uk_id`) REFERENCES `unitkerja` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.led_c2: ~0 rows (approximately)

-- Dumping structure for table ami_dev.led_c3
CREATE TABLE IF NOT EXISTS `led_c3` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uk_id` int(10) unsigned NOT NULL,
  `latarb` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebijakan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sps` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iku_a` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iku_b` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iku_c` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ikt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eval` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `simpulan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `led_c3_ibfk_1` (`uk_id`),
  CONSTRAINT `led_c3_ibfk_1` FOREIGN KEY (`uk_id`) REFERENCES `unitkerja` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.led_c3: ~0 rows (approximately)

-- Dumping structure for table ami_dev.led_c4
CREATE TABLE IF NOT EXISTS `led_c4` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uk_id` int(10) unsigned NOT NULL,
  `latarb` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebijakan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sps` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iku_a` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iku_b` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iku_c` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ikt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eval` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `simpulan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `led_c4_ibfk_1` (`uk_id`),
  CONSTRAINT `led_c4_ibfk_1` FOREIGN KEY (`uk_id`) REFERENCES `unitkerja` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.led_c4: ~0 rows (approximately)

-- Dumping structure for table ami_dev.led_c5
CREATE TABLE IF NOT EXISTS `led_c5` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uk_id` int(10) unsigned NOT NULL,
  `latarb` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebijakan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sps` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iku_a` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iku_b` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ikt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eval` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `simpulan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `led_c5_ibfk_1` (`uk_id`),
  CONSTRAINT `led_c5_ibfk_1` FOREIGN KEY (`uk_id`) REFERENCES `unitkerja` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.led_c5: ~0 rows (approximately)

-- Dumping structure for table ami_dev.led_c6
CREATE TABLE IF NOT EXISTS `led_c6` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uk_id` int(10) unsigned NOT NULL,
  `latarb` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebijakan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sps` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iku_a` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iku_b` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iku_c` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iku_d` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ikt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eval` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `simpulan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `led_c6_ibfk_1` (`uk_id`),
  CONSTRAINT `led_c6_ibfk_1` FOREIGN KEY (`uk_id`) REFERENCES `unitkerja` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.led_c6: ~0 rows (approximately)

-- Dumping structure for table ami_dev.led_c7
CREATE TABLE IF NOT EXISTS `led_c7` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uk_id` int(10) unsigned NOT NULL,
  `latarb` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebijakan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sps` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iku_a` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iku_b` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ikt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eval` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `simpulan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `led_c7_ibfk_1` (`uk_id`),
  CONSTRAINT `led_c7_ibfk_1` FOREIGN KEY (`uk_id`) REFERENCES `unitkerja` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.led_c7: ~0 rows (approximately)

-- Dumping structure for table ami_dev.led_c8
CREATE TABLE IF NOT EXISTS `led_c8` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uk_id` int(10) unsigned NOT NULL,
  `latarb` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kebijakan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sps` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iku_a` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iku_b` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ikt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eval` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `simpulan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `led_c8_ibfk_1` (`uk_id`),
  CONSTRAINT `led_c8_ibfk_1` FOREIGN KEY (`uk_id`) REFERENCES `unitkerja` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.led_c8: ~0 rows (approximately)

-- Dumping structure for table ami_dev.led_c9
CREATE TABLE IF NOT EXISTS `led_c9` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uk_id` int(10) unsigned NOT NULL,
  `iku_a` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iku_b` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ikt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eval` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `simpulan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `led_c9_ibfk_1` (`uk_id`),
  CONSTRAINT `led_c9_ibfk_1` FOREIGN KEY (`uk_id`) REFERENCES `unitkerja` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.led_c9: ~0 rows (approximately)

-- Dumping structure for table ami_dev.led_cover
CREATE TABLE IF NOT EXISTS `led_cover` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uk_id` int(10) unsigned NOT NULL,
  `namaPT` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kotaPT` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `upps` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_ps` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sk_pt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_sk_pt` date DEFAULT NULL,
  `pp_sk_pt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sk_ps` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_sk_ps` date DEFAULT NULL,
  `pp_sk_ps` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lamp_skpps` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `th_awal` year(4) DEFAULT NULL,
  `akre_ps` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sk_terakhir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lamp_skppt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lamp_skapst` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pys1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nidn_pys1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan_pys1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_pya1` date DEFAULT NULL,
  `ttd_pys1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pys2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nidn_pys2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan_pys2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_pya2` date DEFAULT NULL,
  `ttd_pys2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pys3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nidn_pys3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan_pys3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_pya3` date DEFAULT NULL,
  `ttd_pys3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pys4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nidn_pys4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan_pys4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_pya4` date DEFAULT NULL,
  `ttd_pys4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kata_pengantar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ringkasan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `unitkerja_id_foreign` (`uk_id`),
  CONSTRAINT `led_cover_ibfk_1` FOREIGN KEY (`uk_id`) REFERENCES `unitkerja` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.led_cover: ~0 rows (approximately)
INSERT INTO `led_cover` (`id`, `uk_id`, `namaPT`, `kotaPT`, `tahun`, `upps`, `jenis_ps`, `alamat`, `telp`, `email_web`, `sk_pt`, `tgl_sk_pt`, `pp_sk_pt`, `sk_ps`, `tgl_sk_ps`, `pp_sk_ps`, `lamp_skpps`, `th_awal`, `akre_ps`, `sk_terakhir`, `lamp_skppt`, `lamp_skapst`, `nama_pys1`, `nidn_pys1`, `jabatan_pys1`, `tgl_pya1`, `ttd_pys1`, `nama_pys2`, `nidn_pys2`, `jabatan_pys2`, `tgl_pya2`, `ttd_pys2`, `nama_pys3`, `nidn_pys3`, `jabatan_pys3`, `tgl_pya3`, `ttd_pys3`, `nama_pys4`, `nidn_pys4`, `jabatan_pys4`, `tgl_pya4`, `ttd_pys4`, `kata_pengantar`, `ringkasan`, `created_at`, `updated_at`) VALUES
	(5, 66, 'POLITEKNIK NEGERI SEMARANG', 'KOTA SEMARANG', '2023', 'tes', 'tes', 'Gedongan Lor, Wonosari, Trucuk, Klaten', '+6285329447937', 'mzsusilo@gmail.com', '123457', '2023-03-08', 'susilo', '123456', '2023-03-15', 'testimon', NULL, '2024', 'B', '09876', NULL, NULL, 'Sukamto, S.Kom., M.T.', '17017103', 'Ketua PSTI', '2019-08-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-31 06:57:25', '2023-03-31 13:57:25');

-- Dumping structure for table ami_dev.led_cover_lampiran
CREATE TABLE IF NOT EXISTS `led_cover_lampiran` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `led_cover_id` int(10) unsigned NOT NULL,
  `lampiran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `led_cover_lampiran_ibfk_1` (`led_cover_id`),
  CONSTRAINT `led_cover_lampiran_ibfk_1` FOREIGN KEY (`led_cover_id`) REFERENCES `led_cover` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.led_cover_lampiran: ~0 rows (approximately)

-- Dumping structure for table ami_dev.led_cover_upps
CREATE TABLE IF NOT EXISTS `led_cover_upps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `led_cover_id` int(10) unsigned NOT NULL,
  `jp_upps` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prodi_upps` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_tgl_sk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_kdw` date DEFAULT NULL,
  `jml_mhs` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `led_cover_upps_ibfk_1` (`led_cover_id`),
  CONSTRAINT `led_cover_upps_ibfk_1` FOREIGN KEY (`led_cover_id`) REFERENCES `led_cover` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.led_cover_upps: ~2 rows (approximately)
INSERT INTO `led_cover_upps` (`id`, `led_cover_id`, `jp_upps`, `prodi_upps`, `status`, `no_tgl_sk`, `tgl_kdw`, `jml_mhs`, `created_at`, `updated_at`) VALUES
	(7, 5, 'B', 'Susilo', 'A', '12345', '2023-03-08', 67, NULL, NULL),
	(8, 5, 'A', 'titidj', 'B', '9049857483', '2023-03-08', 87, NULL, NULL);

-- Dumping structure for table ami_dev.led_koneks
CREATE TABLE IF NOT EXISTS `led_koneks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uk_id` int(10) unsigned NOT NULL,
  `des` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `led_koneks_ibfk_1` (`uk_id`),
  CONSTRAINT `led_koneks_ibfk_1` FOREIGN KEY (`uk_id`) REFERENCES `unitkerja` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.led_koneks: ~1 rows (approximately)
INSERT INTO `led_koneks` (`id`, `uk_id`, `des`, `created_at`, `updated_at`) VALUES
	(3, 66, 'Test Kondisi', '2023-05-08 19:31:38', '2023-05-09 02:31:38');

-- Dumping structure for table ami_dev.led_lampiran
CREATE TABLE IF NOT EXISTS `led_lampiran` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uk_id` int(10) unsigned NOT NULL,
  `lampiran` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `led_lampiran_ibfk_1` (`uk_id`),
  CONSTRAINT `led_lampiran_ibfk_1` FOREIGN KEY (`uk_id`) REFERENCES `unitkerja` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.led_lampiran: ~0 rows (approximately)

-- Dumping structure for table ami_dev.led_pendahuluan
CREATE TABLE IF NOT EXISTS `led_pendahuluan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uk_id` int(10) unsigned NOT NULL,
  `pendahuluan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `led_pendahuluan_ibfk_1` (`uk_id`),
  CONSTRAINT `led_pendahuluan_ibfk_1` FOREIGN KEY (`uk_id`) REFERENCES `unitkerja` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.led_pendahuluan: ~0 rows (approximately)
INSERT INTO `led_pendahuluan` (`id`, `uk_id`, `pendahuluan`, `created_at`, `updated_at`) VALUES
	(3, 66, 'test&nbsp; penndahuluan', '2023-05-08 19:45:27', '2023-05-09 02:45:27');

-- Dumping structure for table ami_dev.led_penmutu
CREATE TABLE IF NOT EXISTS `led_penmutu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uk_id` int(10) unsigned NOT NULL,
  `ppmi_upps` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dok` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kpm_upps` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pelaksanaan_ami` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengakuan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `des_pkp` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `led_penmutu_ibfk_1` (`uk_id`),
  CONSTRAINT `led_penmutu_ibfk_1` FOREIGN KEY (`uk_id`) REFERENCES `unitkerja` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.led_penmutu: ~0 rows (approximately)
INSERT INTO `led_penmutu` (`id`, `uk_id`, `ppmi_upps`, `dok`, `kpm_upps`, `pelaksanaan_ami`, `pengakuan`, `des_pkp`, `created_at`, `updated_at`) VALUES
	(3, 66, '<h3 style="font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41); text-align: -webkit-center;">PENJAMINAN MUTU 1</h3>', '<h3 style="font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41); text-align: -webkit-center;">PENJAMINAN MUTU 2</h3>', '<h3 style="font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41); text-align: -webkit-center;">PENJAMINAN MUTU 3</h3>', '<h3 style="font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41); text-align: -webkit-center;">PENJAMINAN MUTU 4</h3>', '<h3 style="font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41); text-align: -webkit-center;">PENJAMINAN MUTU 5</h3>', '<h3 style="font-family: &quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; color: rgb(33, 37, 41); text-align: -webkit-center;">PENJAMINAN MUTU 6</h3>', '2023-04-30 15:06:26', '2023-04-30 22:06:26');

-- Dumping structure for table ami_dev.led_penutup
CREATE TABLE IF NOT EXISTS `led_penutup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uk_id` int(10) unsigned NOT NULL,
  `penutup` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `led_penutup_ibfk_1` (`uk_id`),
  CONSTRAINT `led_penutup_ibfk_1` FOREIGN KEY (`uk_id`) REFERENCES `unitkerja` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.led_penutup: ~0 rows (approximately)
INSERT INTO `led_penutup` (`id`, `uk_id`, `penutup`, `created_at`, `updated_at`) VALUES
	(2, 66, 'tes', '2023-05-08 19:26:32', '2023-05-09 02:26:32');

-- Dumping structure for table ami_dev.led_ppb
CREATE TABLE IF NOT EXISTS `led_ppb` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uk_id` int(10) unsigned NOT NULL,
  `swot` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tujuan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keberlanjutan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `led_ppb_ibfk_1` (`uk_id`),
  CONSTRAINT `led_ppb_ibfk_1` FOREIGN KEY (`uk_id`) REFERENCES `unitkerja` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.led_ppb: ~2 rows (approximately)
INSERT INTO `led_ppb` (`id`, `uk_id`, `swot`, `tujuan`, `keberlanjutan`, `created_at`, `updated_at`) VALUES
	(1, 66, '1', '2', '3', '2023-04-30 10:54:29', '2023-04-30 17:54:29'),
	(2, 51, 'tes 1', 'tes 2', 'tes 3', '2023-04-30 11:23:36', '2023-04-30 18:23:36');

-- Dumping structure for table ami_dev.led_stpmk
CREATE TABLE IF NOT EXISTS `led_stpmk` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uk_id` int(10) unsigned NOT NULL,
  `des` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `led_stpmk_ibfk_1` (`uk_id`),
  CONSTRAINT `led_stpmk_ibfk_1` FOREIGN KEY (`uk_id`) REFERENCES `unitkerja` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.led_stpmk: ~0 rows (approximately)

-- Dumping structure for table ami_dev.led_stpmk_dosen
CREATE TABLE IF NOT EXISTS `led_stpmk_dosen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `led_stpmk_id` int(10) unsigned NOT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `des_kerja` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `led_stpmk_dosen_ibfk_1` (`led_stpmk_id`),
  CONSTRAINT `led_stpmk_dosen_ibfk_1` FOREIGN KEY (`led_stpmk_id`) REFERENCES `led_stpmk` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.led_stpmk_dosen: ~0 rows (approximately)

-- Dumping structure for table ami_dev.led_stpmk_tk
CREATE TABLE IF NOT EXISTS `led_stpmk_tk` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `led_stpmk_id` int(10) unsigned NOT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `des_kerja` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `led_stpmk_tk_ibfk_1` (`led_stpmk_id`),
  CONSTRAINT `led_stpmk_tk_ibfk_1` FOREIGN KEY (`led_stpmk_id`) REFERENCES `led_stpmk` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.led_stpmk_tk: ~0 rows (approximately)

-- Dumping structure for table ami_dev.led_upps
CREATE TABLE IF NOT EXISTS `led_upps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uk_id` int(10) unsigned NOT NULL,
  `des` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `led_upps_ibfk_1` (`uk_id`),
  CONSTRAINT `led_upps_ibfk_1` FOREIGN KEY (`uk_id`) REFERENCES `unitkerja` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.led_upps: ~0 rows (approximately)
INSERT INTO `led_upps` (`id`, `uk_id`, `des`, `created_at`, `updated_at`) VALUES
	(1, 66, '<p>Test Profile</p>', '2023-04-15 04:24:34', '2023-04-15 11:24:34');

-- Dumping structure for table ami_dev.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `master` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sorting` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.menu: ~29 rows (approximately)
INSERT INTO `menu` (`id`, `name`, `level`, `master`, `url`, `icon`, `role_id`, `sorting`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Home', 'main_menu_0', 0, '/', 'fas fa-home', '1,2,3,4', '1', 'aktif', '2021-06-29 07:02:08', '2021-06-29 07:02:08'),
	(2, 'Dashboard', 'main_menu_1', 0, 'dashboard', 'fas fa-tachometer-alt', '1,2,3,4', '2', 'aktif', '2021-06-29 07:02:08', '2021-06-29 07:02:08'),
	(3, 'Master Data', 'main_menu_2', 0, '', 'fa fa-database', '1,2,3', '3', 'aktif', '2021-06-29 07:02:08', '2021-06-29 07:02:08'),
	(4, 'Dokumen, Renop, & Kinerja (Bukti)', 'sub_menu_2', 1, 'renstraRenop.index', 'far fa-circle', '1,2,3', '4', 'aktif', '2021-06-29 07:02:08', '2021-06-29 07:02:08'),
	(5, 'Pimpinan, Pengelola, &  Unit Kerja', 'sub_menu_2', 1, 'pimpinanUK.index', 'far fa-circle', '1', '5', 'aktif', NULL, NULL),
	(6, 'AMI', 'main_menu_3', 0, 'ami.index', 'fas fa-newspaper', '1,2,3', '6', 'aktif', NULL, NULL),
	(7, 'Tinjauan Manajemen', 'main_menu_4', 0, 'tinjauanManajemen.index', 'fas fa-newspaper', '1,2,3', '7', 'aktif', NULL, NULL),
	(8, 'SPME', 'main_menu_5', 0, '', 'fas fa-newspaper', '1,2,3', '8', NULL, NULL, NULL),
	(9, 'LAM Teknik', 'sub_menu_5', 1, 'LAMTeknik.index', 'far fa-circle', '1,2,3', '9', NULL, NULL, NULL),
	(10, 'LAM EMBA', 'sub_menu_5', 1, 'LAMEmba.index', 'far fa-circle', '1,2,3', '10', NULL, NULL, NULL),
	(11, 'LAM INFOKOM', 'sub_menu_5', 1, 'LAMInfokom.index', 'far fa-circle', '1,2,3', '11', NULL, NULL, NULL),
	(12, 'BAN PT', 'sub_menu_5', 1, 'BANPT.index', 'far fa-circle', '1,2,3', '12', NULL, NULL, NULL),
	(13, 'Reports', 'main_menu_6', 0, '', 'fas fa-copy', '1,4', '13', 'aktif', NULL, NULL),
	(14, 'Chart', 'sub_menu_6', 1, 'chart.index', 'far fa-circle', '1,4', '14', 'aktif', NULL, NULL),
	(15, 'Periode', 'sub_menu_6', 1, 'chart.create', 'far fa-circle', '1,4', '15', 'aktif', NULL, NULL),
	(16, 'Master Pengguna', 'main_menu_7', 0, '', 'fas fa-users', '1', '16', 'aktif', NULL, NULL),
	(17, 'Pengguna', 'sub_menu_7', 1, 'users.index', 'far fa-circle', '1', '17', 'aktif', NULL, NULL),
	(18, 'Rule', 'sub_menu_7', 1, 'roles.index', 'far fa-circle', '1', '18', 'aktif', NULL, NULL),
	(19, 'Apps', 'main_menu_8', 0, '', 'fab fa-app-store', '1', '19', 'aktif', NULL, NULL),
	(20, 'Setting Apps', 'sub_menu_8', 1, 'setting', 'far fa-circle', '1', '20', 'aktif', NULL, NULL),
	(21, 'File Manager', 'sub_menu_8', 1, 'filemanager', 'far fa-circle', '1', '21', 'aktif', NULL, NULL),
	(22, 'Menu', 'sub_menu_8', 1, 'menu', 'far fa-circle', '1', '22', 'nonaktif', NULL, NULL),
	(23, 'Backup', 'sub_menu_8', 1, 'backupmanager', 'far fa-circle', '1', '23', 'aktif', NULL, NULL),
	(24, 'Dokumen Pendukung', 'main_menu_9', 0, 'dokumen', 'far fa-folder', '1,2,3', '24', 'aktif', NULL, NULL),
	(25, 'Documentation', 'main_menu_10', 0, 'documentation', 'fa fa-book', '1,2,3', '25', 'aktif', NULL, NULL),
	(26, 'Logout', 'main_menu_11', 0, '', 'fas fa-sign-out-alt', '1,2,3', '26', 'aktif', NULL, NULL),
	(45, 'Scheduling', 'sub_menu_3', 1, 'auditee/scheduling', 'far fa-circle', '', '', 'aktif', NULL, NULL),
	(46, 'CAR Reports', 'sub_menu_3', 1, 'auditor/CarReports', 'far fa-circle', '', '', 'aktif', NULL, NULL),
	(47, 'CAR Reports', 'sub_menu_3', 1, 'auditee/CarReports', 'far fa-circle', '', '', 'aktif', NULL, NULL);

-- Dumping structure for table ami_dev.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.migrations: ~3 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(6, '2021_08_19_120947_create_jadwal_audits_table', 2),
	(7, '2021_08_19_123851_create_kinerja_units_table', 2);

-- Dumping structure for table ami_dev.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ami_dev.password_resets: ~2 rows (approximately)
INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
	('mohammadsusilo99@gmail.com', '$2y$10$YnI3GvWsb13h.WhVAqkrXOi7DEM6hjQlU8wOuk4afV.rmxMxGy5B.', '2022-11-23 08:39:13'),
	('irfanardian1@gmail.com', '$2y$10$dvIRf8u57TeJ5CWpaM4ob.U7H5KyaLZmedaPi7lRw7JG2ilogQMjq', '2022-11-23 11:19:07');

-- Dumping structure for table ami_dev.pengelolaunitkerja
CREATE TABLE IF NOT EXISTS `pengelolaunitkerja` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.pengelolaunitkerja: ~6 rows (approximately)
INSERT INTO `pengelolaunitkerja` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Jurusan Elektro', 'aktif', '2021-07-18 21:01:59', '2021-07-18 21:01:59'),
	(2, 'Jurusan Mesin', 'aktif', '2021-07-18 21:02:37', '2021-07-18 21:02:37'),
	(3, 'Jurusan Sipil', 'aktif', '2021-07-18 21:03:07', '2021-07-18 21:03:07'),
	(4, 'Jurusan Administrasi Bisnis', 'aktif', '2021-07-18 21:03:56', '2021-07-18 21:03:56'),
	(5, 'Jurusan Akuntansi', 'aktif', '2021-07-18 21:04:19', '2021-07-18 21:04:19'),
	(6, 'Pusat', 'aktif', '2021-07-18 21:04:38', '2021-07-18 21:04:38');

-- Dumping structure for table ami_dev.pengelola_pimpinan
CREATE TABLE IF NOT EXISTS `pengelola_pimpinan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pimpinan_id` int(10) unsigned NOT NULL,
  `pengelola_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pengelola_pimpinan_pimpinan_id_foreign` (`pimpinan_id`),
  KEY `pengelola_pimpinan_pengelola_id_foreign` (`pengelola_id`),
  CONSTRAINT `pengelola_pimpinan_pengelola_id_foreign` FOREIGN KEY (`pengelola_id`) REFERENCES `pengelolaunitkerja` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pengelola_pimpinan_pimpinan_id_foreign` FOREIGN KEY (`pimpinan_id`) REFERENCES `pimpinan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.pengelola_pimpinan: ~12 rows (approximately)
INSERT INTO `pengelola_pimpinan` (`id`, `pimpinan_id`, `pengelola_id`, `created_at`, `updated_at`) VALUES
	(22, 12, 1, '2021-07-18 21:01:59', '2021-07-19 04:01:59'),
	(23, 15, 1, '2021-07-18 21:01:59', '2021-07-19 04:01:59'),
	(24, 12, 2, '2021-07-18 21:02:37', '2021-07-19 04:02:37'),
	(26, 12, 3, '2021-07-18 21:03:07', '2021-07-19 04:03:07'),
	(27, 13, 3, '2021-07-18 21:03:07', '2021-07-19 04:03:07'),
	(28, 12, 4, '2021-07-18 21:03:56', '2021-07-19 04:03:56'),
	(29, 13, 4, '2021-07-18 21:03:56', '2021-07-19 04:03:56'),
	(30, 15, 5, '2021-07-18 21:04:20', '2021-07-19 04:04:20'),
	(41, 13, 2, '2021-08-11 10:42:11', '2021-08-11 17:42:11'),
	(42, 14, 2, '2021-08-11 10:44:40', '2021-08-11 17:44:40'),
	(43, 12, 5, '2021-08-11 11:05:25', '2021-08-11 18:05:25'),
	(44, 12, 6, '2021-08-11 11:05:25', '2021-08-11 18:05:25');

-- Dumping structure for table ami_dev.pimpinan
CREATE TABLE IF NOT EXISTS `pimpinan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.pimpinan: ~5 rows (approximately)
INSERT INTO `pimpinan` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
	(12, 'Prof. Dr. Totok Prasetyo, B.Eng (Hons), M.T., IPU, ACPE', 'D0', '2021-07-18 09:08:40', '2021-12-15 10:25:15'),
	(13, 'Ir. Endro Wasito, M.Kom.', 'WD1', '2021-07-18 09:09:07', '2021-07-18 09:09:07'),
	(14, 'Saniman Widodo, S.E., M.M.', 'WD2', '2021-07-18 09:09:22', '2021-07-18 09:09:22'),
	(15, 'Adhy Purnomo, S.T., M.T.', 'WD3', '2021-07-18 09:09:30', '2021-07-18 09:09:30'),
	(16, 'Drs. Budi Prasetya, M.Si.', 'WD4', '2021-07-18 09:10:09', '2021-07-18 09:10:09');

-- Dumping structure for table ami_dev.profile
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profile_user_id_foreign` (`user_id`),
  CONSTRAINT `profile_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=257 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.profile: ~85 rows (approximately)
INSERT INTO `profile` (`id`, `jabatan`, `foto`, `signature`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'Admin PPMP', 'storage/files/Pusat/Profile/2021/avatar4.png', 'storage/files/Pusat/Profile/2021/61c7fdcf19587.png', 1, '2021-09-03 17:31:08', '2021-12-26 05:29:51'),
	(4, NULL, NULL, NULL, 5, '2021-12-27 05:21:58', '2021-12-27 05:21:58'),
	(17, NULL, NULL, 'storage/files/Pusat/Profile/2022/6374fa7c1d117.png', 19, '2022-02-09 13:40:53', '2022-11-16 14:58:04'),
	(20, NULL, NULL, NULL, 22, '2022-02-09 23:00:59', '2022-02-09 23:00:59'),
	(21, NULL, NULL, NULL, 23, '2022-02-09 23:01:35', '2022-02-09 23:01:35'),
	(22, NULL, NULL, NULL, 24, '2022-02-09 23:01:58', '2022-02-09 23:01:58'),
	(23, NULL, NULL, NULL, 25, '2022-02-09 23:02:30', '2022-02-09 23:02:30'),
	(26, NULL, NULL, NULL, 28, '2022-02-09 23:08:02', '2022-02-09 23:08:02'),
	(29, NULL, NULL, NULL, 31, '2022-02-09 23:09:06', '2022-02-09 23:09:06'),
	(35, NULL, NULL, NULL, 37, '2022-02-09 23:31:15', '2022-02-09 23:31:15'),
	(76, NULL, NULL, NULL, 78, '2022-03-26 19:00:05', '2022-03-26 19:00:05'),
	(77, NULL, NULL, NULL, 79, '2022-03-28 10:37:55', '2022-03-28 10:37:55'),
	(79, NULL, NULL, NULL, 82, '2022-09-23 00:26:10', '2022-09-23 00:26:10'),
	(185, NULL, NULL, NULL, 202, '2022-11-29 16:13:56', '2022-11-29 16:13:56'),
	(186, NULL, NULL, NULL, 203, '2022-11-29 16:13:56', '2022-11-29 16:13:56'),
	(187, NULL, NULL, NULL, 204, '2022-11-29 16:13:56', '2022-11-29 16:13:56'),
	(188, NULL, NULL, NULL, 205, '2022-11-29 16:13:57', '2022-11-29 16:13:57'),
	(189, NULL, NULL, NULL, 206, '2022-11-29 16:13:57', '2022-11-29 16:13:57'),
	(190, NULL, NULL, NULL, 207, '2022-11-29 16:17:32', '2022-11-29 16:17:32'),
	(191, NULL, NULL, NULL, 208, '2022-11-29 16:29:15', '2022-11-29 16:29:15'),
	(192, NULL, NULL, NULL, 209, '2022-11-29 16:40:18', '2022-11-29 16:40:18'),
	(193, NULL, NULL, NULL, 210, '2022-11-29 16:40:19', '2022-11-29 16:40:19'),
	(194, NULL, NULL, NULL, 211, '2022-11-29 16:40:19', '2022-11-29 16:40:19'),
	(195, NULL, NULL, NULL, 212, '2022-11-29 16:40:19', '2022-11-29 16:40:19'),
	(196, NULL, NULL, NULL, 213, '2022-11-29 16:40:20', '2022-11-29 16:40:20'),
	(197, NULL, NULL, NULL, 214, '2022-11-29 16:40:20', '2022-11-29 16:40:20'),
	(198, NULL, NULL, NULL, 215, '2022-11-29 16:40:20', '2022-11-29 16:40:20'),
	(199, NULL, NULL, NULL, 216, '2022-11-29 16:40:20', '2022-11-29 16:40:20'),
	(200, NULL, NULL, NULL, 217, '2022-11-29 16:40:21', '2022-11-29 16:40:21'),
	(201, NULL, NULL, NULL, 218, '2022-11-29 16:40:21', '2022-11-29 16:40:21'),
	(202, NULL, NULL, NULL, 219, '2022-11-29 16:40:21', '2022-11-29 16:40:21'),
	(203, NULL, NULL, NULL, 220, '2022-11-29 16:40:21', '2022-11-29 16:40:21'),
	(204, NULL, NULL, NULL, 221, '2022-11-29 16:48:04', '2022-11-29 16:48:04'),
	(205, NULL, NULL, NULL, 222, '2022-11-29 16:48:05', '2022-11-29 16:48:05'),
	(206, NULL, NULL, NULL, 223, '2022-11-29 16:48:05', '2022-11-29 16:48:05'),
	(207, NULL, NULL, NULL, 224, '2022-11-29 16:48:05', '2022-11-29 16:48:05'),
	(208, NULL, NULL, NULL, 225, '2022-11-29 16:48:05', '2022-11-29 16:48:05'),
	(209, NULL, NULL, NULL, 226, '2022-11-29 16:48:06', '2022-11-29 16:48:06'),
	(210, NULL, NULL, NULL, 227, '2022-11-29 16:48:06', '2022-11-29 16:48:06'),
	(211, NULL, NULL, NULL, 228, '2022-11-29 16:48:06', '2022-11-29 16:48:06'),
	(212, NULL, NULL, NULL, 229, '2022-11-29 16:55:15', '2022-11-29 16:55:15'),
	(213, NULL, NULL, NULL, 230, '2022-11-29 16:55:15', '2022-11-29 16:55:15'),
	(214, NULL, NULL, NULL, 231, '2022-11-29 16:55:15', '2022-11-29 16:55:15'),
	(215, NULL, NULL, NULL, 232, '2022-11-29 16:55:15', '2022-11-29 16:55:15'),
	(216, NULL, NULL, NULL, 233, '2022-11-29 16:55:16', '2022-11-29 16:55:16'),
	(217, NULL, NULL, NULL, 234, '2022-11-29 16:55:16', '2022-11-29 16:55:16'),
	(218, NULL, NULL, NULL, 235, '2022-11-29 16:55:16', '2022-11-29 16:55:16'),
	(219, NULL, NULL, NULL, 236, '2022-11-29 16:55:16', '2022-11-29 16:55:16'),
	(220, NULL, NULL, NULL, 237, '2022-11-29 16:58:56', '2022-11-29 16:58:56'),
	(221, NULL, NULL, NULL, 238, '2022-11-29 16:58:56', '2022-11-29 16:58:56'),
	(222, NULL, NULL, NULL, 239, '2022-11-29 16:58:56', '2022-11-29 16:58:56'),
	(223, NULL, NULL, NULL, 240, '2022-11-29 16:58:57', '2022-11-29 16:58:57'),
	(224, NULL, NULL, NULL, 241, '2022-11-29 16:58:57', '2022-11-29 16:58:57'),
	(225, NULL, NULL, NULL, 242, '2022-11-29 16:58:57', '2022-11-29 16:58:57'),
	(226, NULL, NULL, NULL, 243, '2022-11-29 17:11:25', '2022-11-29 17:11:25'),
	(227, NULL, NULL, NULL, 244, '2022-11-29 17:11:25', '2022-11-29 17:11:25'),
	(228, NULL, NULL, NULL, 245, '2022-11-29 17:11:25', '2022-11-29 17:11:25'),
	(229, NULL, NULL, NULL, 246, '2022-11-29 17:11:25', '2022-11-29 17:11:25'),
	(230, NULL, NULL, NULL, 247, '2022-11-29 17:11:26', '2022-11-29 17:11:26'),
	(231, NULL, NULL, NULL, 248, '2022-11-29 17:11:26', '2022-11-29 17:11:26'),
	(232, NULL, NULL, NULL, 249, '2022-11-29 17:11:26', '2022-11-29 17:11:26'),
	(233, NULL, NULL, NULL, 250, '2022-11-29 17:11:26', '2022-11-29 17:11:26'),
	(234, NULL, NULL, NULL, 251, '2022-11-29 17:11:27', '2022-11-29 17:11:27'),
	(235, NULL, NULL, NULL, 252, '2022-11-29 17:11:27', '2022-11-29 17:11:27'),
	(236, NULL, NULL, NULL, 253, '2022-11-29 17:11:27', '2022-11-29 17:11:27'),
	(237, NULL, NULL, NULL, 254, '2022-11-29 17:11:27', '2022-11-29 17:11:27'),
	(238, NULL, NULL, NULL, 255, '2022-11-29 17:11:28', '2022-11-29 17:11:28'),
	(239, NULL, NULL, NULL, 256, '2022-11-29 17:11:28', '2022-11-29 17:11:28'),
	(240, NULL, NULL, NULL, 257, '2022-11-29 17:11:28', '2022-11-29 17:11:28'),
	(241, NULL, NULL, NULL, 258, '2022-11-29 17:11:28', '2022-11-29 17:11:28'),
	(242, NULL, NULL, NULL, 259, '2022-11-29 17:11:29', '2022-11-29 17:11:29'),
	(243, NULL, NULL, NULL, 260, '2022-11-29 17:11:29', '2022-11-29 17:11:29'),
	(244, NULL, NULL, NULL, 261, '2022-11-29 17:11:29', '2022-11-29 17:11:29'),
	(245, NULL, NULL, NULL, 262, '2022-11-29 17:11:29', '2022-11-29 17:11:29'),
	(246, NULL, NULL, NULL, 263, '2022-11-29 17:11:30', '2022-11-29 17:11:30'),
	(247, NULL, NULL, NULL, 264, '2022-11-29 17:11:30', '2022-11-29 17:11:30'),
	(248, NULL, NULL, NULL, 265, '2022-11-29 17:11:30', '2022-11-29 17:11:30'),
	(249, NULL, NULL, NULL, 266, '2022-11-29 17:14:41', '2022-11-29 17:14:41'),
	(250, NULL, NULL, NULL, 267, '2022-11-29 17:14:42', '2022-11-29 17:14:42'),
	(251, NULL, NULL, NULL, 268, '2022-11-29 17:37:39', '2022-11-29 17:37:39'),
	(252, NULL, NULL, NULL, 269, '2022-11-29 17:37:39', '2022-11-29 17:37:39'),
	(253, NULL, NULL, NULL, 270, '2022-11-29 17:37:39', '2022-11-29 17:37:39'),
	(254, NULL, NULL, NULL, 271, '2022-11-29 17:37:40', '2022-11-29 17:37:40'),
	(255, NULL, NULL, NULL, 272, '2022-11-29 17:37:40', '2022-11-29 17:37:40'),
	(256, NULL, NULL, NULL, 273, '2022-12-02 13:12:41', '2022-12-02 13:12:41');

-- Dumping structure for table ami_dev.renop
CREATE TABLE IF NOT EXISTS `renop` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` int(11) NOT NULL,
  `unit_target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` year(4) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unitkerja_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `renop_unitkerja_id_foreign` (`unitkerja_id`),
  CONSTRAINT `renop_unitkerja_id_foreign` FOREIGN KEY (`unitkerja_id`) REFERENCES `unitkerja` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.renop: ~0 rows (approximately)

-- Dumping structure for table ami_dev.renop_renstra
CREATE TABLE IF NOT EXISTS `renop_renstra` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `renop_id` int(10) unsigned NOT NULL,
  `renstra_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `renop_renstra_renop_id_foreign` (`renop_id`),
  KEY `renop_renstra_renstra_id_foreign` (`renstra_id`),
  CONSTRAINT `renop_renstra_renop_id_foreign` FOREIGN KEY (`renop_id`) REFERENCES `renop` (`id`) ON DELETE CASCADE,
  CONSTRAINT `renop_renstra_renstra_id_foreign` FOREIGN KEY (`renstra_id`) REFERENCES `renstra` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.renop_renstra: ~0 rows (approximately)

-- Dumping structure for table ami_dev.renstra
CREATE TABLE IF NOT EXISTS `renstra` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` int(11) NOT NULL,
  `unit_target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_indikator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` year(4) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referensi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` enum('renstra','PK') COLLATE utf8mb4_unicode_ci NOT NULL,
  `dokumen_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `renstra_dokumen_id_foreign` (`dokumen_id`),
  CONSTRAINT `renstra_dokumen_id_foreign` FOREIGN KEY (`dokumen_id`) REFERENCES `dokumeninduk` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.renstra: ~7 rows (approximately)
INSERT INTO `renstra` (`id`, `kode`, `deskripsi`, `target`, `unit_target`, `tipe_indikator`, `tahun`, `status`, `referensi`, `jenis`, `dokumen_id`, `created_at`, `updated_at`) VALUES
	(1, 'PK2021', 'Perjanjian Kinerja Tahun 2021 Direktur Politeknik Negeri Semarang Dengan Direktur Jenderal Pendidikan Vokasi', 55, '100', 'angka', '2021', 'aktif', 'PK1', 'PK', 6, '2022-01-07 14:31:58', '2022-01-11 07:30:52'),
	(3, 'RS2020', 'Renstra 2020-2024', 96, '100', '%', '2020', 'nonaktif', 'rs20', 'renstra', 2, '2022-01-07 15:08:31', '2022-02-25 18:19:28'),
	(4, 'R001', 'Renstra', 100, '100', '%', '2022', 'aktif', 'rs01', 'renstra', 2, '2022-04-15 01:26:04', '2022-04-15 01:26:04'),
	(5, 'PK2022', 'Perjanjian Kinerja 2022', 100, '100', 'Utama', '2022', 'aktif', 'pk22', 'PK', 6, '2022-04-15 02:05:51', '2022-04-15 02:05:51'),
	(6, 'IKU.1.01.04', 'Target Peminjaman Buku', 50, 'buah', 'per bulan', '2022', 'aktif', 'data perpus', 'PK', 10, '2022-11-03 16:29:27', '2022-11-03 16:29:27'),
	(7, 'IKU.1.01.04', 'Target Peminjaman Buku', 50, 'buah', 'per bulan', '2022', 'aktif', 'data perpus', 'PK', 10, '2022-11-03 16:31:05', '2022-11-03 16:31:05'),
	(8, 'IKU.1.01.05', 'Target Keuangan', 10000000, 'rupiah', 'per bulan', '2022', 'aktif', NULL, 'renstra', 11, '2022-11-03 16:31:05', '2022-11-03 16:31:05');

-- Dumping structure for table ami_dev.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.roles: ~4 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `desc`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'Super Admin AMI', 'aktif', '2021-07-08 08:00:29', '2021-08-05 17:41:03'),
	(2, 'Auditor', 'Auditor AMI', 'aktif', '2021-07-08 08:00:29', '2021-12-23 12:26:22'),
	(3, 'Auditee', 'Auditee AMI', 'aktif', '2021-07-08 08:00:29', '2021-07-08 08:00:29'),
	(4, 'Pimpinan', 'Pimpinan AMI', 'aktif', '2021-08-03 06:51:34', '2021-08-03 06:51:34');

-- Dumping structure for table ami_dev.spme
CREATE TABLE IF NOT EXISTS `spme` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `spme_type_id` int(10) unsigned NOT NULL,
  `spme_lembaga_id` int(10) unsigned NOT NULL,
  `led_cover_id` int(10) unsigned NOT NULL,
  `led_pendahuluan_id` int(10) unsigned NOT NULL,
  `led_stpmk_id` int(10) unsigned NOT NULL,
  `led_koneks_id` int(10) unsigned NOT NULL,
  `led_upps_id` int(10) unsigned NOT NULL,
  `led_c1_id` int(10) unsigned NOT NULL,
  `led_c2_id` int(10) unsigned NOT NULL,
  `led_c3_id` int(10) unsigned NOT NULL,
  `led_c4_id` int(10) unsigned NOT NULL,
  `led_c5_id` int(10) unsigned NOT NULL,
  `led_c6_id` int(10) unsigned NOT NULL,
  `led_c7_id` int(10) unsigned NOT NULL,
  `led_c8_id` int(10) unsigned NOT NULL,
  `led_c9_id` int(10) unsigned NOT NULL,
  `led_penmutu_id` int(10) unsigned NOT NULL,
  `led_ppb_id` int(10) unsigned NOT NULL,
  `led_penutup_id` int(10) unsigned NOT NULL,
  `led_lampiran_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `spme_ibfk_1` (`spme_lembaga_id`),
  KEY `spme_ibfk_2` (`spme_type_id`),
  KEY `spme_ibfk_3` (`led_cover_id`),
  KEY `spme_ibfk_4` (`led_pendahuluan_id`),
  KEY `spme_ibfk_5` (`led_stpmk_id`),
  KEY `spme_ibfk_6` (`led_koneks_id`),
  KEY `spme_ibfk_7` (`led_upps_id`),
  KEY `spme_ibfk_8` (`led_c1_id`),
  KEY `spme_ibfk_9` (`led_c2_id`),
  KEY `spme_ibfk_10` (`led_c3_id`),
  KEY `spme_ibfk_11` (`led_c4_id`),
  KEY `spme_ibfk_12` (`led_c5_id`),
  KEY `spme_ibfk_13` (`led_c6_id`),
  KEY `spme_ibfk_14` (`led_c7_id`),
  KEY `spme_ibfk_15` (`led_c8_id`),
  KEY `spme_ibfk_16` (`led_c9_id`),
  KEY `spme_ibfk_17` (`led_penmutu_id`),
  KEY `spme_ibfk_18` (`led_ppb_id`),
  KEY `spme_ibfk_19` (`led_penutup_id`),
  KEY `spme_ibfk_20` (`led_lampiran_id`),
  CONSTRAINT `spme_ibfk_1` FOREIGN KEY (`spme_lembaga_id`) REFERENCES `spme_lembaga` (`id`) ON DELETE CASCADE,
  CONSTRAINT `spme_ibfk_10` FOREIGN KEY (`led_c3_id`) REFERENCES `led_c3` (`id`) ON DELETE CASCADE,
  CONSTRAINT `spme_ibfk_11` FOREIGN KEY (`led_c4_id`) REFERENCES `led_c4` (`id`) ON DELETE CASCADE,
  CONSTRAINT `spme_ibfk_12` FOREIGN KEY (`led_c5_id`) REFERENCES `led_c5` (`id`) ON DELETE CASCADE,
  CONSTRAINT `spme_ibfk_13` FOREIGN KEY (`led_c6_id`) REFERENCES `led_c6` (`id`) ON DELETE CASCADE,
  CONSTRAINT `spme_ibfk_14` FOREIGN KEY (`led_c7_id`) REFERENCES `led_c7` (`id`) ON DELETE CASCADE,
  CONSTRAINT `spme_ibfk_15` FOREIGN KEY (`led_c8_id`) REFERENCES `led_c8` (`id`) ON DELETE CASCADE,
  CONSTRAINT `spme_ibfk_16` FOREIGN KEY (`led_c9_id`) REFERENCES `led_c9` (`id`) ON DELETE CASCADE,
  CONSTRAINT `spme_ibfk_17` FOREIGN KEY (`led_penmutu_id`) REFERENCES `led_penmutu` (`id`) ON DELETE CASCADE,
  CONSTRAINT `spme_ibfk_18` FOREIGN KEY (`led_ppb_id`) REFERENCES `led_ppb` (`id`) ON DELETE CASCADE,
  CONSTRAINT `spme_ibfk_19` FOREIGN KEY (`led_penutup_id`) REFERENCES `led_penutup` (`id`) ON DELETE CASCADE,
  CONSTRAINT `spme_ibfk_2` FOREIGN KEY (`spme_type_id`) REFERENCES `spme_type` (`id`) ON DELETE CASCADE,
  CONSTRAINT `spme_ibfk_20` FOREIGN KEY (`led_lampiran_id`) REFERENCES `led_lampiran` (`id`) ON DELETE CASCADE,
  CONSTRAINT `spme_ibfk_3` FOREIGN KEY (`led_cover_id`) REFERENCES `led_cover` (`id`) ON DELETE CASCADE,
  CONSTRAINT `spme_ibfk_4` FOREIGN KEY (`led_pendahuluan_id`) REFERENCES `led_pendahuluan` (`id`) ON DELETE CASCADE,
  CONSTRAINT `spme_ibfk_5` FOREIGN KEY (`led_stpmk_id`) REFERENCES `led_stpmk` (`id`) ON DELETE CASCADE,
  CONSTRAINT `spme_ibfk_6` FOREIGN KEY (`led_koneks_id`) REFERENCES `led_koneks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `spme_ibfk_7` FOREIGN KEY (`led_upps_id`) REFERENCES `led_upps` (`id`) ON DELETE CASCADE,
  CONSTRAINT `spme_ibfk_8` FOREIGN KEY (`led_c1_id`) REFERENCES `led_c1` (`id`) ON DELETE CASCADE,
  CONSTRAINT `spme_ibfk_9` FOREIGN KEY (`led_c2_id`) REFERENCES `led_c2` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.spme: ~0 rows (approximately)

-- Dumping structure for table ami_dev.spme_lembaga
CREATE TABLE IF NOT EXISTS `spme_lembaga` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.spme_lembaga: ~0 rows (approximately)

-- Dumping structure for table ami_dev.spme_type
CREATE TABLE IF NOT EXISTS `spme_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.spme_type: ~0 rows (approximately)

-- Dumping structure for table ami_dev.standar
CREATE TABLE IF NOT EXISTS `standar` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kodeStandar` varchar(255) NOT NULL,
  `namaStandar` varchar(255) NOT NULL,
  `kriteria` enum('Akademik','NonAkademik','Penelitian','Pendidikan','PengabdianMasyarakat') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ami_dev.standar: ~30 rows (approximately)
INSERT INTO `standar` (`id`, `kodeStandar`, `namaStandar`, `kriteria`, `created_at`, `updated_at`) VALUES
	(1, 'SAk.4.01', 'STANDAR TEKNOLOGI INFORMASI DAN KOMUNIKASI', 'Akademik', '2022-12-06 11:16:55', '2022-12-06 18:16:55'),
	(2, 'SAk.4.02', 'STANDAR PEMANTAUAN DAN EVALUASI', 'Akademik', '2022-12-06 13:08:14', '2022-12-06 07:37:26'),
	(3, 'SAk.4.03', 'STANDAR LAYANAN PUBLIK', 'Akademik', '2022-12-06 08:21:22', '2022-12-06 15:21:22'),
	(4, 'SAk.4.04', 'STANDAR KERJA SAMA', 'Akademik', '2022-12-06 08:21:41', '2022-12-06 15:21:41'),
	(5, 'SLit.2.08', 'STANDAR PENDANAAN DAN PEMBIAYAAN PENELITIAN', 'Penelitian', '2022-12-06 08:30:30', '2022-12-06 15:21:59'),
	(6, 'SLit.2.01', 'STANDAR HASIL PENELITIAN', 'Penelitian', '2022-12-06 08:28:54', '2022-12-06 09:22:42'),
	(7, 'SLit.2.02', 'STANDAR ISI PENELITIAN', 'Penelitian', '2022-12-06 08:28:54', '2022-12-06 09:22:42'),
	(8, 'SLit.2.03', 'STANDAR PROSES PENELITIAN', 'Penelitian', '2022-12-06 08:28:54', '2022-12-06 09:22:42'),
	(9, 'SLit.2.04', 'STANDAR PENILAIAN PENELITIAN', 'Penelitian', '2022-12-06 08:28:54', '2022-12-06 09:22:42'),
	(10, 'SLit.2.05', 'STANDAR PENELITI', 'Penelitian', '2022-12-06 08:28:54', '2022-12-06 09:22:42'),
	(11, 'SLit.2.06', 'STANDAR SARANA DAN PRASARANA PENELITIAN', 'Penelitian', '2022-12-06 08:28:54', '2022-12-06 09:22:42'),
	(12, 'SLit.2.07', 'STANDAR PENGELOLAAN PENELITIAN', 'Penelitian', '2022-12-06 08:28:54', '2022-12-06 09:22:42'),
	(13, 'SNAk.5.01', 'STANDAR KEMAHASISWAAN', 'NonAkademik', '2022-12-06 08:30:21', '2022-12-06 09:22:42'),
	(14, 'SNAk.5.02', 'STANDAR TATA KELOLA', 'NonAkademik', '2022-12-06 08:30:18', '2022-12-06 09:22:42'),
	(15, 'SPd.1.01', 'STANDAR KOMPETENSI LULUSAN', 'Pendidikan', '2022-12-06 08:28:54', '2022-12-06 09:22:42'),
	(16, 'SPd.1.02', 'STANDAR ISI PEMBELAJARAN', 'Pendidikan', '2022-12-06 08:28:54', '2022-12-06 09:22:42'),
	(17, 'SPd.1.03', 'STANDAR PROSES PEMBELAJARAN', 'Pendidikan', '2022-12-06 08:28:54', '2022-12-06 09:22:42'),
	(18, 'SPd.1.04', 'STANDAR PENILAIAN PEMBELAJARAN', 'Pendidikan', '2022-12-06 08:28:54', '2022-12-06 09:22:42'),
	(19, 'SPd.1.05', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'Pendidikan', '2022-12-06 08:28:54', '2022-12-06 09:22:42'),
	(20, 'SPd.1.06', 'STANDAR SARANA DAN PRASARANA PEMBELAJARAN', 'Pendidikan', '2022-12-06 08:28:54', '2022-12-06 09:22:42'),
	(21, 'SPd.1.07', 'STANDAR PENGELOLAAN PEMBELAJARAN', 'Pendidikan', '2022-12-06 08:28:54', '2022-12-06 09:22:42'),
	(22, 'SPd.1.08', 'STANDAR PEMBIAYAAN PEMBELAJARAN', 'Pendidikan', '2022-12-06 08:28:54', '2022-12-06 09:22:42'),
	(23, 'SPkM.3.06', 'STANDAR SARANA DAN PRASARANA PENGABDIAN KEPADA MAS...', 'PengabdianMasyarakat', '2022-12-06 08:30:48', '2022-12-06 09:22:42'),
	(24, 'SPkM.3.02', 'STANDAR ISI PENGABDIAN KEPADA MASYARAKAT', 'PengabdianMasyarakat', '2022-12-06 08:30:58', '2022-12-06 09:22:42'),
	(25, 'SPkM.3.03', 'STANDAR PROSES PENGABDIAN KEPADA MASYARAKAT', 'PengabdianMasyarakat', '2022-12-06 08:31:44', '2022-12-06 09:22:42'),
	(26, 'SPkM.3.04', 'STANDAR PENILAIAN PENGABDIAN KEPADA MASYARAKAT', 'PengabdianMasyarakat', '2022-12-06 08:31:47', '2022-12-06 09:22:42'),
	(27, 'SPkM.3.08', 'STANDAR PENDANAAN DAN PEMBIAYAAN PENGABDIAN KEPADA MASYARAKAT', 'PengabdianMasyarakat', '2022-12-06 08:31:50', '2022-12-06 09:22:42'),
	(28, 'SPkM.3.05', 'STANDAR PELAKSANA PENGABDIAN KEPADA MASYARAKAT', 'PengabdianMasyarakat', '2022-12-06 08:28:54', '2022-12-06 09:22:42'),
	(29, 'SPkM.3.01', 'STANDAR HASIL PENGABDIAN KEPADA MASYARAKAT', 'PengabdianMasyarakat', '2022-12-06 08:31:37', '2022-12-06 09:31:09'),
	(30, 'SPkM.3.07', 'STANDAR PENGELOLAAN PENGABDIAN KEPADA MASYARAKAT', 'PengabdianMasyarakat', '2022-12-06 08:31:37', '2022-12-06 09:31:09');

-- Dumping structure for table ami_dev.tblstandar
CREATE TABLE IF NOT EXISTS `tblstandar` (
  `kode` varchar(12) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kriteria` varchar(255) NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ami_dev.tblstandar: ~30 rows (approximately)
INSERT INTO `tblstandar` (`kode`, `nama`, `kriteria`) VALUES
	('SAk.04.01', 'STANDAR TEKNOLOGI INFORMASI DAN KOMUNIKAS', 'STANDAR AKADEMIK'),
	('SAk.4.02', 'STANDAR PEMANTAUAN DAN EVALUAS', 'STANDAR AKADEMIK'),
	('SAk.4.03', 'STANDAR LAYANAN PUBLIK', 'STANDAR AKADEMIK'),
	('SAk.4.04', 'STANDAR KERJA SAMA', 'STANDAR AKADEMIK'),
	('SLit.02.08', 'STANDAR PENDANAAN DAN PEMBIAYAAN PENELITIAN', 'STANDAR PENELITIAN'),
	('SLit.2.01', 'STANDAR HASIL PENELITIAN', 'STANDAR PENELITIAN'),
	('SLit.2.02', 'STANDAR ISI PENELITIAN', 'STANDAR PENELITIAN'),
	('SLit.2.03', 'STANDAR PROSES PENELITIAN', 'STANDAR PENELITIAN'),
	('SLit.2.04', 'STANDAR PENILAIAN PENELITIAN', 'STANDAR PENELITIAN'),
	('SLit.2.05', 'STANDAR PENELITI', 'STANDAR PENELITIAN'),
	('SLit.2.06', 'STANDAR SARANA DAN PRASARANA PENELITIAN', 'STANDAR PENELITIAN'),
	('SLit.2.07', 'STANDAR PENGELOLAAN PENELITIAN', 'STANDAR PENELITIAN'),
	('SNAk.05.01', 'STANDAR KEMAHASISWAAN', 'STANDAR NONAKADEMIK'),
	('SNAk.5.01', 'STANDAR TATA KELOLA', 'STANDAR NONAKADEMIK'),
	('SPd.1.01', 'STANDAR KOMPETENSI LULUSAN', 'STANDAR PENDIDIKAN'),
	('SPd.1.02', 'STANDAR ISI PEMBELAJARAN', 'STANDAR PENDIDIKAN'),
	('SPd.1.03', 'STANDAR PROSES PEMBELAJARAN', 'STANDAR PENDIDIKAN'),
	('SPd.1.04', 'STANDAR PENILAIAN PEMBELAJARAN', 'STANDAR PENDIDIKAN'),
	('SPd.1.05', 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN', 'STANDAR PENDIDIKAN'),
	('SPd.1.06', 'STANDAR SARANA DAN PRASARANA PEMBELAJARAN', 'STANDAR PENDIDIKAN'),
	('SPd.1.07', 'STANDAR PENGELOLAAN PEMBELAJARAN', 'STANDAR PENDIDIKAN'),
	('SPd.1.08', 'STANDAR PEMBIAYAAN PEMBELAJARAN', 'STANDAR PENDIDIKAN'),
	('SPkM.03.0 6', 'STANDAR SARANA DAN PRASARANA PENGABDIAN KEPADA MASYARAKAT', 'STANDAR PENGABDIAN KEPADA MASYARAKAT'),
	('SPkM.03.01', 'STANDAR HASIL\r\nPENGABDIAN KEPADA MASYARAKAT', 'STANDAR PENGABDIAN KEPADA MASYARAKAT'),
	('SPkM.03.02', 'STANDAR ISI PENGABDIAN KEPADA MASYARAKAT', 'STANDAR PENGABDIAN KEPADA MASYARAKAT'),
	('SPkM.03.03', 'STANDAR PROSES PENGABDIAN KEPADA MASYARAKAT', 'STANDAR PENGABDIAN KEPADA MASYARAKAT'),
	('SPkM.03.04', 'STANDAR PENILAIAN PENGABDIAN KEPADA MASYARAKAT', 'STANDAR PENGABDIAN KEPADA MASYARAKAT'),
	('SPkM.03.08', 'STANDAR PENDANAAN DAN PEMBIAYAAN PENGABDIAN KEPADA MASYARAKAT', 'STANDAR PENGABDIAN KEPADA MASYARAKAT'),
	('SPkM.3.05', 'STANDAR PELAKSANA PENGABDIAN KEPADA MASYARAKAT', 'STANDAR PENGABDIAN KEPADA MASYARAKAT'),
	('SPkM.3.07', 'STANDAR PENGELOLAAN PENGABDIAN KEPADA MASYARAKAT', 'STANDAR PENGABDIAN KEPADA MASYARAKAT');

-- Dumping structure for table ami_dev.tindak_lanjuttm
CREATE TABLE IF NOT EXISTS `tindak_lanjuttm` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tindakLanjut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `realisasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PIC` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('selesai','nonselesai') COLLATE utf8mb4_unicode_ci NOT NULL,
  `hslrpt_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tindak_lanjuttm_hslrpt_id_foreign` (`hslrpt_id`),
  CONSTRAINT `tindak_lanjuttm_hslrpt_id_foreign` FOREIGN KEY (`hslrpt_id`) REFERENCES `hasil_rapattm` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.tindak_lanjuttm: ~0 rows (approximately)

-- Dumping structure for table ami_dev.tinjauan_manajemen
CREATE TABLE IF NOT EXISTS `tinjauan_manajemen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `tglTM` date NOT NULL,
  `waktuTM` time NOT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `audit_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tinjauan_manajemen_audit_id_foreign` (`audit_id`),
  CONSTRAINT `tinjauan_manajemen_audit_id_foreign` FOREIGN KEY (`audit_id`) REFERENCES `jadwal_audit` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.tinjauan_manajemen: ~0 rows (approximately)

-- Dumping structure for table ami_dev.uk_spme
CREATE TABLE IF NOT EXISTS `uk_spme` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `uk_id` int(10) unsigned NOT NULL,
  `spme_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `UK_SPMEuk_id_foreign` (`uk_id`) USING BTREE,
  KEY `UK_SPMEspme_id_foreign` (`spme_id`) USING BTREE,
  CONSTRAINT `UK_SPME_ibfk_1` FOREIGN KEY (`uk_id`) REFERENCES `unitkerja` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `UK_SPME_ibfk_2` FOREIGN KEY (`spme_id`) REFERENCES `spme` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.uk_spme: ~0 rows (approximately)

-- Dumping structure for table ami_dev.unitkerja
CREATE TABLE IF NOT EXISTS `unitkerja` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namaRepo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengelola_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `unitkerja_pengelola_id_foreign` (`pengelola_id`),
  CONSTRAINT `unitkerja_pengelola_id_foreign` FOREIGN KEY (`pengelola_id`) REFERENCES `pengelolaunitkerja` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.unitkerja: ~44 rows (approximately)
INSERT INTO `unitkerja` (`id`, `name`, `namaRepo`, `status`, `pengelola_id`, `created_at`, `updated_at`) VALUES
	(51, 'Pimpinan', 'storage/files/Pusat/Unit Kerja/Pimpinan', 'aktif', 6, '2022-11-29 15:52:02', '2022-11-29 15:52:02'),
	(52, 'Jurusan Teknik Sipil', 'storage/files/Pusat/Unit Kerja/Jurusan Teknik Sipil', 'aktif', 3, '2022-11-29 15:52:45', '2022-11-29 15:52:45'),
	(53, 'Prodi Kontruksi Sipil', 'storage/files/Pusat/Unit Kerja/Prodi Kontruksi Sipil', 'aktif', 3, '2022-11-29 15:53:14', '2022-11-29 15:53:14'),
	(54, 'Prodi Kontruksi Gedung', 'storage/files/Pusat/Unit Kerja/Prodi Kontruksi Gedung', 'aktif', 3, '2022-11-29 15:53:31', '2022-11-29 15:53:31'),
	(55, 'Prodi Perbaikan dan Perawatan Gedung (STr)', 'storage/files/Pusat/Unit Kerja/Prodi Perbaikan dan Perawatan Gedung (STr)', 'aktif', 3, '2022-11-29 15:53:59', '2022-11-29 15:53:59'),
	(56, 'Prodi Perancangan Jalan dan Jembatan (STr)', 'storage/files/Pusat/Unit Kerja/Prodi Perancangan Jalan dan Jembatan (STr)', 'aktif', 3, '2022-11-29 15:54:24', '2022-11-29 15:54:24'),
	(57, 'Jurusan Teknik Mesin', 'storage/files/Pusat/Unit Kerja/Jurusan Teknik Mesin', 'aktif', 2, '2022-11-29 15:54:49', '2022-11-29 15:54:49'),
	(58, 'Prodi Teknik Mesin', 'storage/files/Pusat/Unit Kerja/Prodi Teknik Mesin', 'aktif', 2, '2022-11-29 15:55:12', '2022-11-29 15:55:12'),
	(59, 'Prodi Konversi Energi', 'storage/files/Pusat/Unit Kerja/Prodi Konversi Energi', 'aktif', 2, '2022-11-29 15:55:54', '2022-11-29 15:55:54'),
	(60, 'Prodi Mesin Produksi dan Perawatan (STr)', 'storage/files/Pusat/Unit Kerja/Prodi Mesin Produksi dan Perawatan (STr)', 'aktif', 2, '2022-11-29 15:56:19', '2022-11-29 15:56:19'),
	(61, 'Prodi Rekayasa Pembangkit Energi (STr)', 'storage/files/Pusat/Unit Kerja/Prodi Rekayasa Pembangkit Energi (STr)', 'aktif', 2, '2022-11-29 15:56:43', '2022-11-29 15:56:43'),
	(62, 'Jurusan Teknik Elektro', 'storage/files/Pusat/Unit Kerja/Jurusan Teknik Elektro', 'aktif', 1, '2022-11-29 15:57:02', '2022-11-29 15:57:02'),
	(63, 'Prodi Teknik Listrik', 'storage/files/Pusat/Unit Kerja/Prodi Teknik Listrik', 'aktif', 1, '2022-11-29 15:57:22', '2022-11-29 15:57:22'),
	(64, 'Prodi Teknik Elektronika', 'storage/files/Pusat/Unit Kerja/Prodi Teknik Elektronika', 'aktif', 1, '2022-11-29 15:57:42', '2022-11-29 15:57:42'),
	(65, 'Prodi Teknik Telekomunikasi', 'storage/files/Pusat/Unit Kerja/Prodi Teknik Telekomunikasi', 'aktif', 1, '2022-11-29 15:58:00', '2022-11-29 15:58:00'),
	(66, 'Prodi Teknik Informatika', 'storage/files/Pusat/Unit Kerja/Prodi Teknik Informatika', 'aktif', 1, '2022-11-29 15:58:20', '2022-11-29 15:58:20'),
	(67, 'Prodi Teknik Telekomunikasi (STr)', 'storage/files/Pusat/Unit Kerja/Prodi Teknik Telekomunikasi (STr)', 'aktif', 1, '2022-11-29 15:58:43', '2022-11-29 15:58:43'),
	(68, 'Prodi Magister Terapan', 'storage/files/Pusat/Unit Kerja/Prodi Magister Terapan', 'aktif', 1, '2022-11-29 15:59:00', '2022-11-29 15:59:00'),
	(69, 'Prodi Teknologi Rekayasa Instalasi Listrik (STr)', 'storage/files/Pusat/Unit Kerja/Prodi Teknologi Rekayasa Instalasi Listrik (STr)', 'aktif', 1, '2022-11-29 15:59:32', '2022-11-29 15:59:32'),
	(70, 'Prodi Teknologi Rekayasa Komputer (STr)', 'storage/files/Pusat/Unit Kerja/Prodi Teknologi Rekayasa Komputer (STr)', 'aktif', 1, '2022-11-29 16:00:03', '2022-11-29 16:00:03'),
	(71, 'Jurusan Akuntansi', 'storage/files/Pusat/Unit Kerja/Jurusan Akuntansi', 'aktif', 5, '2022-11-29 16:00:20', '2022-11-29 16:00:20'),
	(72, 'Prodi Akuntansi', 'storage/files/Pusat/Unit Kerja/Prodi Akuntansi', 'aktif', 5, '2022-11-29 16:00:33', '2022-11-29 16:00:33'),
	(73, 'Prodi Keuangan Perbankan', 'storage/files/Pusat/Unit Kerja/Prodi Keuangan Perbankan', 'aktif', 5, '2022-11-29 16:00:49', '2022-11-29 16:00:49'),
	(74, 'Prodi Komputerisasi Komputer (STr)', 'storage/files/Pusat/Unit Kerja/Prodi Komputerisasi Komputer (STr)', 'aktif', 5, '2022-11-29 16:01:23', '2022-11-29 16:01:23'),
	(75, 'Prodi Perbankan Syariah (STr)', 'storage/files/Pusat/Unit Kerja/Prodi Perbankan Syariah (STr)', 'aktif', 5, '2022-11-29 16:01:44', '2022-11-29 16:01:44'),
	(76, 'Prodi Analis Keuangan (STr)', 'storage/files/Pusat/Unit Kerja/Prodi Analis Keuangan (STr)', 'aktif', 5, '2022-11-29 16:02:04', '2022-11-29 16:02:04'),
	(77, 'Prodi Akuntansi Manajerial (STr)', 'storage/files/Pusat/Unit Kerja/Prodi Akuntansi Manajerial (STr)', 'aktif', 5, '2022-11-29 16:02:28', '2022-11-29 16:02:28'),
	(78, 'Jurusan Administrasi Bisnis', 'storage/files/Pusat/Unit Kerja/Jurusan Administrasi Bisnis', 'aktif', 4, '2022-11-29 16:02:46', '2022-11-29 16:02:46'),
	(79, 'Prodi Administrasi Bisnis', 'storage/files/Pusat/Unit Kerja/Prodi Administrasi Bisnis', 'aktif', 4, '2022-11-29 16:03:06', '2022-11-29 16:03:06'),
	(80, 'Prodi Manajemen Pemasaran', 'storage/files/Pusat/Unit Kerja/Prodi Manajemen Pemasaran', 'aktif', 4, '2022-11-29 16:03:27', '2022-11-29 16:03:27'),
	(81, 'Prodi Administrasi Bisnis Terapan (STr)', 'storage/files/Pusat/Unit Kerja/Prodi Administrasi Bisnis Terapan (STr)', 'aktif', 4, '2022-11-29 16:03:54', '2022-11-29 16:03:54'),
	(82, 'Prodi Manajemen Bisnis Internasional (STr)', 'storage/files/Pusat/Unit Kerja/Prodi Manajemen Bisnis Internasional (STr)', 'aktif', 4, '2022-11-29 16:04:14', '2022-11-29 16:04:14'),
	(83, 'Bagian Umum dan Keuangan', 'storage/files/Pusat/Unit Kerja/Bagian Umum dan Keuangan', 'aktif', 6, '2022-11-29 16:04:31', '2022-11-29 16:04:31'),
	(84, 'Bagian Administrasi Kemahasiswaan dan Perencanaan Kegiatan', 'storage/files/Pusat/Unit Kerja/Bagian Administrasi Kemahasiswaan dan Perencanaan Kegiatan', 'aktif', 6, '2022-11-29 16:05:01', '2022-11-29 16:05:01'),
	(85, 'Pusat Penelitian dan Pengabdian kepada Masyarakat', 'storage/files/Pusat/Unit Kerja/Pusat Penelitian dan Pengabdian kepada Masyarakat', 'aktif', 6, '2022-11-29 16:05:24', '2022-11-29 16:05:24'),
	(86, 'Pusat Pengembangan Pembelajaran dan Penjaminan Mutu Pendidikan', 'storage/files/Pusat/Unit Kerja/Pusat Pengembangan Pembelajaran dan Penjaminan Mutu Pendidikan', 'aktif', 6, '2022-11-29 16:05:45', '2022-11-29 16:05:45'),
	(87, 'Pusat Teknologi Informasi dan Komunikasi', 'storage/files/Pusat/Unit Kerja/Pusat Teknologi Informasi dan Komunikasi', 'aktif', 6, '2022-11-29 16:06:09', '2022-11-29 16:06:09'),
	(88, 'UPT Perpustakaan', 'storage/files/Pusat/Unit Kerja/UPT Perpustakaan', 'aktif', 6, '2022-11-29 16:06:31', '2022-11-29 16:06:31'),
	(89, 'UPT Bahasa', 'storage/files/Pusat/Unit Kerja/UPT Bahasa', 'aktif', 6, '2022-11-29 16:06:42', '2022-11-29 16:06:42'),
	(90, 'Urusan Hubungan Industri (UHI)', 'storage/files/Pusat/Unit Kerja/Urusan Hubungan Industri (UHI)', 'aktif', 6, '2022-11-29 16:07:05', '2022-11-29 16:07:05'),
	(91, 'Urusan Internasional (UUI)', 'storage/files/Pusat/Unit Kerja/Urusan Internasional (UUI)', 'aktif', 6, '2022-11-29 16:07:22', '2022-11-29 16:07:22'),
	(92, 'UPT Perbaikan dan Perawatan Sarana Pendidikan', 'storage/files/Pusat/Unit Kerja/UPT Perbaikan dan Perawatan Sarana Pendidikan', 'aktif', 6, '2022-11-29 16:07:47', '2022-11-29 16:07:47'),
	(93, 'Satuan Pengendali Internal', 'storage/files/Pusat/Unit Kerja/Satuan Pengendali Internal', 'aktif', 6, '2022-11-29 16:08:00', '2022-11-29 16:08:00'),
	(94, 'Lembaga Sertifikasi Profesi (LSP)', 'storage/files/Pusat/Unit Kerja/Lembaga Sertifikasi Profesi (LSP)', 'aktif', 6, '2022-11-29 16:08:12', '2022-11-29 16:08:12');

-- Dumping structure for table ami_dev.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `unitkerja_id` int(10) unsigned DEFAULT NULL,
  `is_pimpinan` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  KEY `users_unitkerja_id_foreign` (`unitkerja_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_unitkerja_id_foreign` FOREIGN KEY (`unitkerja_id`) REFERENCES `unitkerja` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=274 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ami_dev.users: ~85 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `unitkerja_id`, `is_pimpinan`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Super admin', 'admin@admin.com', '2021-07-08 08:00:29', '$2y$10$7aTXy8ThU2hLPJFwBBuTbedvEA8WG650YSDxSz.Bi76j1j5HGjrge', 1, NULL, '', 'aktif', 'SuiFreBHNGACOKTdAkhGZaPb04objYHqFsAz1hX2XPbLKYzC3YTF54qsMaN7', '2021-07-08 08:00:29', '2021-07-08 15:00:29'),
	(5, 'Pimpinan', 'pimpinan@admin.com', NULL, '$2y$10$36Ux8nQUtY4pObpwMd4QteZZ56R02z2tkNDIhgzPvK6rQ33X2SEiG', 4, NULL, '', 'nonaktif', NULL, '2021-12-27 05:21:58', '2021-12-27 12:21:58'),
	(19, 'Direktur', 'direktur@pimpinan.com', NULL, '$2y$10$VLne8JmOs4/op932lI5c9OIVHBKWJyAb13RBCMnOu.clPDTu3siCG', 4, NULL, 'D0', 'aktif', NULL, '2022-02-09 13:40:53', '2022-03-27 02:00:05'),
	(22, 'Wakil Direktur 1', 'wadir1@pimpinan.com', NULL, '$2y$10$5OiXGTZXc0L/3h1rVqaJd.XCnF.DsMn2g9mIiKO876JPOvcBG.rRC', 4, NULL, '', 'aktif', NULL, '2022-02-09 23:00:59', '2022-02-10 06:56:42'),
	(23, 'Wakil Direktur 2', 'wadir2@pimpinan.com', NULL, '$2y$10$9lXsHBTky295TGSQCNf9.OoEWsTMhr/Z54OJH.06y/uEmynL6/Xwu', 4, NULL, '', 'aktif', NULL, '2022-02-09 23:01:35', '2022-02-10 06:01:35'),
	(24, 'Wakil Direktur 3', 'wadir3@pimpinan.com', NULL, '$2y$10$sXcX.OSN7atXwZD/BUtI4.et6in20GJlyu0iHtBPvsG/ybyAV7Mie', 4, NULL, '', 'aktif', NULL, '2022-02-09 23:01:58', '2022-02-10 06:01:58'),
	(25, 'Wakil Direktur 4', 'wadir4@pimpinan.com', NULL, '$2y$10$5v2g7xm01NA2Aej2oMWW4eVy6B5wpa23CeXQTqHffNTrAiRqmarMa', 4, NULL, '', 'aktif', NULL, '2022-02-09 23:02:30', '2022-02-10 06:02:30'),
	(28, 'Jurusan Teknik Sipil', 'jurusansipil@pimpinan.com', NULL, '$2y$10$ELGOaZz.B9E7/nDA5WIuVe31H/d1hDKI3kTokN3RxoBhHH7NAQCM.', 3, NULL, '', 'aktif', NULL, '2022-02-09 23:08:02', '2022-11-29 23:16:44'),
	(31, 'Pusat', 'pusat@pimpinan.com', NULL, '$2y$10$vK.vfcUnBKK015QuEytfIuGG2320VyIJnLPF6kaFJLalAJxRAqaRa', 4, NULL, '', 'nonaktif', NULL, '2022-02-09 23:09:06', '2022-02-10 06:09:06'),
	(37, 'Auditee Pusat', 'pusat@auditee.com', NULL, '$2y$10$jPh8fFIq.eMr9DRy5P/zfeC6NYNuaJDiPlavuHQ9QZ6WIH8v5b2fG', 3, NULL, '', 'aktif', NULL, '2022-02-09 23:31:15', '2022-02-10 06:31:15'),
	(78, 'totok', 'totok@admin.com', NULL, '$2y$10$nUJ6GGL35mcFpBjP.XkcCecers2LJggORTZcErLT3sE9SVJhGDWfO', 4, NULL, '4', 'aktif', NULL, '2022-03-26 19:00:05', '2022-03-27 02:00:05'),
	(79, 'admin', 'adm@adm.com', NULL, '$2y$10$w7846oJhXMasY8pHW.tVRuSLPo0goAyvZE5oh4abiV/ms.vKi1QVO', 1, NULL, NULL, 'aktif', NULL, '2022-03-28 10:37:54', '2022-03-28 17:37:54'),
	(82, 'diah indah', 'diahiindahs@gmail.com', NULL, '$2y$10$JxmIBQ/qwQ94.askNrOsHuYP8QWJqE.WjutI08T7avYndOKLO3wly', 1, NULL, NULL, 'aktif', NULL, '2022-09-23 00:26:10', '2022-09-23 07:26:10'),
	(202, 'Direktur', 'direktur@auditee.com', NULL, '$2y$10$qMqF4HeK5dSU1RYM9M9SGuBe/eJIwoco0QjI5AhdM3tskA3JRv8nq', 3, 51, NULL, 'aktif', NULL, '2022-11-29 16:13:56', '2022-11-29 23:13:56'),
	(203, 'Wadir I', 'wadir1@auditee.com', NULL, '$2y$10$t/IC8HnqVrI7ghjwgU.ZWO.juGz98ba6DuuqpdvhV4Ug5VioXf9Q2', 3, 51, NULL, 'aktif', NULL, '2022-11-29 16:13:56', '2022-11-29 23:13:56'),
	(204, 'Wadir II', 'wadir2@auditee.com', NULL, '$2y$10$9hdGq/ZzL5TsR2P78ENlaOvxHM6N4UnIFeY53uaX22oGJrtHfPuRG', 3, 51, NULL, 'aktif', NULL, '2022-11-29 16:13:56', '2022-11-29 23:13:56'),
	(205, 'Wadir III', 'wadir3@auditee.com', NULL, '$2y$10$Flz0PMStMYrFxYQpQyME1.oBTAnToc3BPsBwP2Te.gJGNgorCc3cG', 3, 51, NULL, 'aktif', NULL, '2022-11-29 16:13:57', '2022-11-29 23:13:57'),
	(206, 'Wadir IV', 'wadir4@auditee.com', NULL, '$2y$10$tHehVB9bbd6G9GExtNyupuSbehc4XtzJVfscQe5nypLLsQDne./Fm', 3, 51, NULL, 'aktif', NULL, '2022-11-29 16:13:57', '2022-11-29 23:13:57'),
	(207, 'Dianita Ratna, S.T., M.T.', 'jurusansipil1@auditee.com', NULL, '$2y$10$gJWorgeFjJ62B4MkjHQK..oRIu8kmNOYnKhZbKZrD09KJ3dQBibuu', 3, 52, NULL, 'aktif', NULL, '2022-11-29 16:17:32', '2022-11-29 23:17:32'),
	(208, 'Dedi Budi S., S.T., M.T.', 'jurusansipil2@auditee.com', NULL, '$2y$10$IvM1pTHjrvQGfhe.D6Xo8u0KNGX.2kkqUVAgn7OcMsBJrgIsrS/cm', 3, 52, NULL, 'aktif', NULL, '2022-11-29 16:29:15', '2022-11-29 23:29:15'),
	(209, 'Nur Setiaji P., S.T., M.T.', 'ks1@auditee.com', NULL, '$2y$10$tdCGAYqQbMyEwpu6wq9jfOWRHZr.9EI0GZXspecihgvey2TvPgme6', 3, 52, NULL, 'aktif', NULL, '2022-11-29 16:40:18', '2022-11-29 23:40:18'),
	(210, 'Triwardaya, S.T., M.T.', 'kg1@auditee.com', NULL, '$2y$10$J/Z9osFZuJ/06pKmYcPz3.P2DBMmG7aKMn8mlRUrjOjs3eutEhsRK', 3, 54, NULL, 'aktif', NULL, '2022-11-29 16:40:19', '2022-11-29 23:40:19'),
	(211, 'Marsudi, S.T., M.T.', 'ppg1@auditee.com', NULL, '$2y$10$5YLyaM7V0gd0.lMkz55CHOASpX4HRwwlyugCSc/HvBd8bmTx.Vwxy', 3, 55, NULL, 'aktif', NULL, '2022-11-29 16:40:19', '2022-11-29 23:40:19'),
	(212, 'Leily Fatmawati, S.T., M.T.', 'pjj1@auditee.com', NULL, '$2y$10$ZaPJV02b6VQjq6OIkmFNxuCPm8cShkWjC.MaWruLt3cOjgZX1yOC6', 3, 56, NULL, 'aktif', NULL, '2022-11-29 16:40:19', '2022-11-29 23:40:19'),
	(213, 'Abdul Syukut A., S.T., M.T.', 'jurusanmesin1@auditee.com', NULL, '$2y$10$4wtZuhOqqWSjWmcgNdaXe.wBy9gKhbLnbOJb1cHhWaYhsVO/9Y7re', 3, 57, NULL, 'aktif', NULL, '2022-11-29 16:40:20', '2022-11-29 23:40:20'),
	(214, 'Dr. Yusuf Dewantoro H., S.T., M.T.', 'jurusanmesin2@auditee.com', NULL, '$2y$10$IM8ADIfEdErX9KJuX/atS.Qpgma7ra8pzAw6/5VMQWKbOtPxB2QZ2', 3, 57, NULL, 'aktif', NULL, '2022-11-29 16:40:20', '2022-11-29 23:40:20'),
	(215, 'Ir. Riles Melvy W., M.T', 'ms1@auditee.com', NULL, '$2y$10$r2ilw3CN2uAVdduZvzQqRut80yb3njkGO3h8aCZr4bhbOgUOWwP.G', 3, 58, NULL, 'aktif', NULL, '2022-11-29 16:40:20', '2022-11-29 23:40:20'),
	(216, 'Wahyono, S.T., M.T.', 'ke1@auditee.com', NULL, '$2y$10$oef.KWbPIH8ujEImU0eFUu0gYJpArmqcuDnlYGTR76HALNkdMY6MC', 3, 59, NULL, 'aktif', NULL, '2022-11-29 16:40:20', '2022-11-29 23:40:20'),
	(217, 'Dr. Ampala Khoryaton, S.T., M.T.', 'mpp1@auditee.com', NULL, '$2y$10$5MThXl7Xo8ifW2kdHQW2y.IwHez3NBndolRZB/gOUhrlek9O8LdAe', 3, 60, NULL, 'aktif', NULL, '2022-11-29 16:40:21', '2022-11-29 23:40:21'),
	(218, 'Ir. Mulyono, M.T.', 'rpe1@auditee.com', NULL, '$2y$10$O5E9wjLdD8y4M8dNKcklseORcKpgA1b92s3h.AeV5sCjcr6BvAKIC', 3, 61, NULL, 'aktif', NULL, '2022-11-29 16:40:21', '2022-11-29 23:40:21'),
	(219, 'Yusnan Badruzzaman, S.T., M.Eng', 'jurusanelektro1@auditee.com', NULL, '$2y$10$9MtSrPYvjA4PGIX0GDTGsO0A.e2QIzqH0D4i98mWuWS2UCybCSxrC', 3, 62, NULL, 'aktif', NULL, '2022-11-29 16:40:21', '2022-11-29 23:40:21'),
	(220, 'Drs. Parsumo Rahardjo, M.Kom.', 'jurusanelektro2@auditee.com', NULL, '$2y$10$eExoDf8r7jwrfgoJRMwG9.YtAf4gEPRTtRGcnerOwpNJICkw3ml.a', 3, 62, NULL, 'aktif', NULL, '2022-11-29 16:40:21', '2022-11-29 23:40:21'),
	(221, 'Adi Wasono, B.Eng., M.Eng.', 'lis1@auditee.com', NULL, '$2y$10$ZLfyXYDrFKGYuYCfew.FRu2X0kxcNQbz/ChxNFXi042z67XdVTocW', 3, 63, NULL, 'aktif', NULL, '2022-11-29 16:48:04', '2022-11-29 23:48:04'),
	(222, 'Ilham Sayekti, S.T., M.Kom.', 'ek1@auditee.com', NULL, '$2y$10$lcXNPOEExWMB7eFyvPFyceROD4b0oJMhueZs5pkMicWn7Rhny/rje', 3, 64, NULL, 'aktif', NULL, '2022-11-29 16:48:05', '2022-11-29 23:48:05'),
	(223, 'Helmy, S.T., M.Eng.', 'te1@auditee.com', NULL, '$2y$10$yzTvDcgtmkIGthKlLEg1TunLLDbYwipQhVMG3wlKlEVokSd/8iEiO', 3, 65, NULL, 'aktif', NULL, '2022-11-29 16:48:05', '2022-12-02 17:46:35'),
	(224, 'Idhawati Hgestiningsih, S.Kom., M.Kom.', 'ik1@auditee.com', NULL, '$2y$10$nwnFW4B2x7Z9N.fRPEAShuFf204uNxLqSpW0VDgllSyaP8ZMqFtc2', 3, 66, NULL, 'aktif', NULL, '2022-11-29 16:48:05', '2022-11-29 23:48:05'),
	(225, 'Ari Sriyanto Nugroho, S.T., M.T.', 'tt1@auditee.com', NULL, '$2y$10$VOJ981OqdB9gRKbvC1lDN.RWtwG1BH.XbzMqGdCmiz9/kI1kfvYNi', 3, 67, NULL, 'aktif', NULL, '2022-11-29 16:48:05', '2022-11-29 23:48:05'),
	(226, 'Dr. Amin Suharjono, S.T., M.T.', 'mst1@auditee.com', NULL, '$2y$10$8ZZoswClpkB2AtsRr1RA6erKf4otwYnSyzuDAfj4A8BYrXOcbm/pm', 3, 68, NULL, 'aktif', NULL, '2022-11-29 16:48:06', '2022-11-29 23:48:06'),
	(227, 'Syahid, S.T., M.T.', 'tril1@auditee.com', NULL, '$2y$10$asqm1/gz7lbERxWFkbAiLeiQWk1ZkdRoHLFyBEpFxCcvvA/XPSbwO', 3, 69, NULL, 'aktif', NULL, '2022-11-29 16:48:06', '2022-11-29 23:48:06'),
	(228, 'Tri Raharjo Yudantoro, S.Kom., M.Kom.', 'trk1@auditee.com', NULL, '$2y$10$EEGNGnJDyTO.bctlzYrdHO5Q6Lxd/JRAyfR4IjuQzlvD92Vk4PQ0.', 3, 70, NULL, 'aktif', NULL, '2022-11-29 16:48:06', '2022-11-29 23:48:06'),
	(229, 'Siti Arbainah, S.E., M.M.', 'jurusanakuntansi1@auditee.com', NULL, '$2y$10$MItRSKbId8kGklRoKw3BcuNomVxh/.vwAKeyLrQ3s6Uotf/cjJzb2', 3, 71, NULL, 'aktif', NULL, '2022-11-29 16:55:15', '2022-11-29 23:55:15'),
	(230, 'Sugiarti, S.E., M.M.', 'jurusanakuntansi2@auditee.com', NULL, '$2y$10$gHj6SO2mDXQwLo3T8b/U.ev6hD3DYYIqdDY2t1MFOZ59AumawcpLu', 3, 71, NULL, 'aktif', NULL, '2022-11-29 16:55:15', '2022-11-29 23:55:15'),
	(231, 'Resi Yudhaningsih, S.E., M.Si.', 'ak1@auditee.com', NULL, '$2y$10$D6YoaUgRL7aY3QKW49kNde.5f8DcXGo8QrF0mJI4SazjUku4.y3sy', 3, 72, NULL, 'aktif', NULL, '2022-11-29 16:55:15', '2022-11-29 23:55:15'),
	(232, 'Jati Handayani, S.E., M.Si.', 'kp1@auditee.com', NULL, '$2y$10$Ljl7NSe9GH2z4b/f7ZvkVuoBSXqYKNG6m5S9ZxqrtXTgpY.LmcpI2', 3, 73, NULL, 'aktif', NULL, '2022-11-29 16:55:15', '2022-11-29 23:55:15'),
	(233, 'Afiat Sadida, S.Kom., M.Kom.', 'ksk1@auditee.com', NULL, '$2y$10$NUByGfi52AXHUYM9R3MQjOzIWgyvlhci1MwZf3vix4Z7/Cxac0qhu', 3, 74, NULL, 'aktif', NULL, '2022-11-29 16:55:16', '2022-11-29 23:55:16'),
	(234, 'Samani, S.E., M.Si.', 'ps1@auditee.com', NULL, '$2y$10$9nJXGh5bbTa3MImknQMi4O2aB989IdFXaC2bEI.qik5hS08W8RVQm', 3, 75, NULL, 'aktif', NULL, '2022-11-29 16:55:16', '2022-11-29 23:55:16'),
	(235, 'M. Rosi, S.E., M.M.', 'ask1@auditee.com', NULL, '$2y$10$G0/3G9LDZIywtzvY5mVW.uWqmZnGZmhCgo.AK6R5.f7lpcv/LwNOW', 3, 76, NULL, 'aktif', NULL, '2022-11-29 16:55:16', '2022-11-29 23:55:16'),
	(236, 'M. Hasanudin, S.E., M.Si.', 'akm1@auditee.com', NULL, '$2y$10$nAO6N0QGZHdKGk8A638QZukBP1g/0d8KDSwck2UB.puie3jnOq4aq', 3, 77, NULL, 'aktif', NULL, '2022-11-29 16:55:16', '2022-11-29 23:55:16'),
	(237, 'Dr. Dody Setiyadi, S.E., M.Si.', 'jurusanadministrasibisnis1@auditee.com', NULL, '$2y$10$7ESiBUblnm/NMCuw3bVqW.XLOXxZzi1BVEgRElfTwfipvw5VYkagO', 3, 78, NULL, 'aktif', NULL, '2022-11-29 16:58:56', '2022-11-29 23:58:56'),
	(238, 'Rustono, S.E., M.M.', 'jurusanadministrasibisnis2@auditee.com', NULL, '$2y$10$4bHwQvjx8mSZso99BlekJ.uV/R2poSWkJysjp2Ofo1tVDgRCbFeD6', 3, 78, NULL, 'aktif', NULL, '2022-11-29 16:58:56', '2022-11-29 23:58:56'),
	(239, 'Dr. Endang Sulistiyani, S.E., M.M.', 'ab1@auditee.com', NULL, '$2y$10$lPGM0Q0wpV3BlQw79.ziIOnlq3Meo8D4nZ5TqV7v0YTsJ0akP5com', 3, 79, NULL, 'aktif', NULL, '2022-11-29 16:58:56', '2022-11-29 23:58:56'),
	(240, 'Andi Setiawan, S.E., M.M.', 'pm1@auditee.com', NULL, '$2y$10$rE0eJ6dkGhLYlqe8feZ0JOkkfPz5w8P/gfIu2yTF.nCkpdIxuIoxu', 3, 80, NULL, 'aktif', NULL, '2022-11-29 16:58:57', '2022-11-29 23:58:57'),
	(241, 'Yusmar Ardhi Hidayat, S.E., M.Si. Ph.D', 'abter1@auditee.com', NULL, '$2y$10$ejlz.4NI8h1mLucKZrGRxOHYKaXWsX9dRZpnKMskwDXQthu79OO6q', 3, 81, NULL, 'aktif', NULL, '2022-11-29 16:58:57', '2022-11-29 23:58:57'),
	(242, 'Dr. Iwan Hermawan, S.Kom., M.T.', 'mbi1@auditee.com', NULL, '$2y$10$OB1lTNsQ/n7M2oj7Jlx.ougTIO18mzK2HU2.DLoH7KIRb0/IZMH5e', 3, 82, NULL, 'aktif', NULL, '2022-11-29 16:58:57', '2022-11-29 23:58:57'),
	(243, 'Purnomo, S.H., M.Si.', 'buk1@auditee.com', NULL, '$2y$10$G12qKapTijC9AnYJXkjkG.XfND//VSseVtchWXhGrEem2.bMRps/q', 3, 83, NULL, 'aktif', NULL, '2022-11-29 17:11:25', '2022-11-30 00:11:25'),
	(244, 'Supanto, S.E., M.Si', 'buk2@auditee.com', NULL, '$2y$10$cqWoJtJMPbhdnAT5Gw8Q0OzhLiBJA.BnSAQh41cB1IZl9Y6hYAw.C', 3, 83, NULL, 'aktif', NULL, '2022-11-29 17:11:25', '2022-11-30 00:11:25'),
	(245, 'Eko Setiawan, S.Kom.', 'buk3@auditee.com', NULL, '$2y$10$q4fIjFbn4.NiU/ykisHtoeUePApYmMCMzNr71SNUH3hh8lNQnrh8O', 3, 83, NULL, 'aktif', NULL, '2022-11-29 17:11:25', '2022-11-30 00:11:25'),
	(246, 'Sri Yati, S.E., M.Si', 'bakpk1@auditee.com', NULL, '$2y$10$psFPUh7L8X6j.DOPcR5Qteu9TujsiDsTtLMJQsqk4cQ4HqzVBqbZS', 3, 84, NULL, 'aktif', NULL, '2022-11-29 17:11:25', '2022-11-30 00:11:25'),
	(247, 'Aris Nuryoko, S.Kom.', 'bakpk2@auditee.com', NULL, '$2y$10$YjMdIPFhiPq.N4kcOxCzjOlKyH.AomCSJ.IKDsuTIKv3D.Dw/vB5q', 3, 84, NULL, 'aktif', NULL, '2022-11-29 17:11:26', '2022-11-30 00:11:26'),
	(248, 'Dr. Kurnianingsih, S.T., M.T.', 'p3m1@auditee.com', NULL, '$2y$10$vHmcvTmTqT3EDU.lLsiUE.LzX/OGI6xEcp8SwRFuT0nHVL.91kfmi', 3, 85, NULL, 'aktif', NULL, '2022-11-29 17:11:26', '2022-11-30 00:11:26'),
	(249, 'Sahid, S.T., M.T.', 'p3m2@auditee.com', NULL, '$2y$10$flEVQgB5xE7EARpO.cbkZOGl/tOaQX709FJ3CV3QeIXAQmQphVef2', 3, 85, NULL, 'aktif', NULL, '2022-11-29 17:11:26', '2022-11-30 00:11:26'),
	(250, 'Sindung Hadwi Widi S., BSEE, M.Eng.Sc.', 'p4mp1@auditee.com', NULL, '$2y$10$FS6.PxMwq35O2nPOzJBx2uMubcDgWvIyXQVKXj2WPIu2xmdf5IbNi', 3, 86, NULL, 'aktif', NULL, '2022-11-29 17:11:26', '2022-11-30 00:11:26'),
	(251, 'Hartono, S.E., M.M.', 'p4mp2@auditee.com', NULL, '$2y$10$b/n8RtNPsy.7zEyLoGL.oOa0gVCKw8l4137nGFewoHDfYy311ilgm', 3, 86, NULL, 'aktif', NULL, '2022-11-29 17:11:27', '2022-11-30 00:11:27'),
	(252, 'Zaenal Abidin, S.T., M.T.', 'p4mp3@auditee.com', NULL, '$2y$10$PgZnf.vvdICJ63eu6k9HROCAEON6oLBxu.QTADfHFJxo2JhTJAZk6', 3, 86, NULL, 'aktif', NULL, '2022-11-29 17:11:27', '2022-11-30 00:11:27'),
	(253, 'Mardiyono, S.Kom., M.Sc.', 'ptik1@auditee.com', NULL, '$2y$10$UvyS7k.y3dvUcen/w94Ns.EOxfni/dk5ezf.bPeEyG5RscNomPgVC', 3, 87, NULL, 'aktif', NULL, '2022-11-29 17:11:27', '2022-11-30 00:11:27'),
	(254, 'Nugroho Joko U., S.Kom., M.Kom.', 'ptik2@auditee.com', NULL, '$2y$10$4yTFiYP.k.Q99uEvV1wW0OBlORtrwR6Bau.g9KyqbmY3ktKsashEO', 3, 87, NULL, 'aktif', NULL, '2022-11-29 17:11:27', '2022-11-30 00:11:27'),
	(255, 'Suwarno, S.Sos., M.I.Kom.', 'uptperpus1@auditee.com', NULL, '$2y$10$exhMPSsCwe0oFZVIRwnu9el9ngx5IkzbmFo2GY0U4wnmaqDFE3El.', 3, 88, NULL, 'aktif', NULL, '2022-11-29 17:11:28', '2022-11-30 00:11:28'),
	(256, 'Joko Mustofa, S.H.', 'uptperpus2@auditee.com', NULL, '$2y$10$EpwGOm7zvJwTUESqws4qxOTxx339hdjzWFb3/E31fwsCXUvpuNUEu', 3, 88, NULL, 'aktif', NULL, '2022-11-29 17:11:28', '2022-11-30 00:11:28'),
	(257, 'Dra. Sri Rahayu Z., M.Pd.', 'uptbahasa1@auditee.com', NULL, '$2y$10$/KycVLgJhWwWe77pysAo6ej.veAymLkVWNaW9ZoSELsRBjzecUzhW', 3, 89, NULL, 'aktif', NULL, '2022-11-29 17:11:28', '2022-11-30 00:11:28'),
	(258, 'Dewi Anggraeni, S.Pd., M.Pd.', 'uptbahasa2@auditee.com', NULL, '$2y$10$DMDB.dn3J36Fz/8w9JMgvefKKnvcJBsX7Pqyz6vyX01izPO2ti5UW', 3, 89, NULL, 'aktif', NULL, '2022-11-29 17:11:28', '2022-11-30 00:11:28'),
	(259, 'Ir. Wahjoedi, M.T.', 'uhi1@auditee.com', NULL, '$2y$10$vPHGnkKpWLEib3UR65cEWuRY1GJakOU63Gda1xG/SnpxaqLEPIwE.', 3, 90, NULL, 'aktif', NULL, '2022-11-29 17:11:29', '2022-11-30 00:11:29'),
	(260, 'Thomas Agung S., S.T., M.T.', 'uhi2@auditee.com', NULL, '$2y$10$Pb1ecL4nm4RFNNwMXvyKxeuFyW1uo/loCgYfvfX0WX4oNqw8Nk6kC', 3, 90, NULL, 'aktif', NULL, '2022-11-29 17:11:29', '2022-11-30 00:11:29'),
	(261, 'Prof. Dr. M. Mukhlisin, S.T., M.T.', 'uui1@auditee.com', NULL, '$2y$10$bYNUYpg4Bj22wTCwupH.kexsMBmtECR3zDzHsFFddE1oZAXGzq9du', 3, 91, NULL, 'aktif', NULL, '2022-11-29 17:11:29', '2022-11-30 00:11:29'),
	(262, 'Vita Arum Sari, SST., M.Sc.', 'uui2@auditee.com', NULL, '$2y$10$XgIR1ZqT1m90vJcuNAP4o.OtCshER2X0iRUM.7BUCl3IYPVBgaBf.', 3, 91, NULL, 'aktif', NULL, '2022-11-29 17:11:29', '2022-11-30 00:11:29'),
	(263, 'Bambang Sumiarso, S.T., M.T.', 'uptppsp1@auditee.com', NULL, '$2y$10$zX7JKhfT/dfqMXWUBGCPtODwOP.KBANTMKHrCNn0hgSIdHQqbcshW', 3, 92, NULL, 'aktif', NULL, '2022-11-29 17:11:30', '2022-11-30 00:11:30'),
	(264, 'Sadik Budi S., S.T.', 'uptppsp2@auditee.com', '2023-03-30 17:17:36', '$2y$10$/LC8OtAhlZjjwwWtQ1bpeubC2ms77ARs59ANTxNY4sFm2.A9bZDkm', 3, 92, NULL, 'aktif', NULL, '2022-11-29 17:11:30', '2022-11-30 00:11:30'),
	(265, 'Rudi Handoyono, S.E., M.Si.', 'spi1@auditee.com', NULL, '$2y$10$7FZAa8xcqlts.lyLNTcK8.QcgG4xqgK8yK2/45UMuQlTkr3IjrVP.', 3, 93, NULL, 'aktif', NULL, '2022-11-29 17:11:30', '2022-11-30 00:11:30'),
	(266, 'Siti Mutmainah, S.E., M.Si.', 'spi2@auditee.com', NULL, '$2y$10$XcHZrXLZFLi4tuKu48dJBe58zx7zsqgjXM3lKfyRe58m5HWUbajE.', 3, 93, NULL, 'aktif', NULL, '2022-11-29 17:14:41', '2022-11-30 00:14:41'),
	(267, 'Edy Wijayanto, S.E., M.Si.', 'lsp1@auditee.com', NULL, '$2y$10$bqXMKfTQ9XJ.peS2SDxXcuhP6DEllSkNOMwE.ODMG5Ze0H/PUO7cu', 3, 94, NULL, 'aktif', NULL, '2022-11-29 17:14:42', '2022-11-30 00:14:42'),
	(268, 'Abdul Syukur Alfauzi, S.T., M.T.', 'abdlsyukura@gmail.com', NULL, '$2y$10$OsoJaSHoc97cy/4bceZ4qel0CRQjMd01hA0Y0opuPT7LzbzhbpiQq', 2, 60, NULL, 'aktif', NULL, '2022-11-29 17:37:39', '2022-11-30 00:37:39'),
	(269, 'Drs. Arif Nursyahid, M.T.', 'arif.nursyahid@polines.ac.id', NULL, '$2y$10$/r1E1EZyJ9JRzcOzDS6NKufcyi6E16q1Hbl..27oJFebOXJ80w9VW', 2, 65, NULL, 'aktif', NULL, '2022-11-29 17:37:39', '2022-11-30 00:37:39'),
	(270, 'Dra. Budhi Adhiani Christina, M.T.', 'budhi_ac@yahoo.com', NULL, '$2y$10$wnPxP7ob/qU5L4BBYWqGBezmw5oFw7djT0EspogsBhuNKRQk8A.oq', 2, 74, NULL, 'aktif', NULL, '2022-11-29 17:37:39', '2022-11-30 00:37:39'),
	(271, 'Dedi Budi Setiawan, S.T., M.T.', 'dedibudisetiawan@yahoo.co.id', NULL, '$2y$10$AH84Q7I8swt2KtBlPSoM/uMSJJQ3ZD5V7XRTIAzcqx0CKHn/NdNB.', 2, 52, NULL, 'aktif', NULL, '2022-11-29 17:37:40', '2022-11-30 21:00:52'),
	(272, 'Dianita Ratna Kusumastuti, S.T., M.T.', 'dianita.ratna.k@gmail.com', NULL, '$2y$10$uwoN5BwnrgBMgtV7VS58sOyKrA3C0wsGMHZ0zQROEvsroAixhmQCW', 2, 53, NULL, 'aktif', NULL, '2022-11-29 17:37:40', '2022-11-30 00:37:40'),
	(273, 'Wahyu Sulistiyo, S.T., M.Kom.', 'wahyu.sulistiyo@polines.ac.id', NULL, '$2y$10$nzjmuGFjQDTSNoycMaVmWOlpeEb6jBY2xDOzMungY4m7oSKNiOT7C', 2, 66, NULL, 'aktif', NULL, '2022-12-02 13:12:41', '2022-12-02 20:12:41');

-- Dumping structure for table ami_dev.users_jadwalaudit
CREATE TABLE IF NOT EXISTS `users_jadwalaudit` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `jadwal_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_jadwalaudit_user_id_foreign` (`user_id`) USING BTREE,
  KEY `users_jadwalaudit_jadwal_id_foreign` (`jadwal_id`) USING BTREE,
  CONSTRAINT `users_jadwalaudit_ibfk_1` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal_audit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_jadwalaudit_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=531 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ami_dev.users_jadwalaudit: ~11 rows (approximately)
INSERT INTO `users_jadwalaudit` (`id`, `user_id`, `jadwal_id`, `created_at`, `updated_at`) VALUES
	(518, 268, 183, '2022-11-29 17:40:37', '2022-11-30 00:40:37'),
	(519, 217, 183, '2022-11-29 17:40:37', '2022-11-30 00:40:37'),
	(521, 223, 184, '2022-11-29 17:41:12', '2022-11-30 00:41:12'),
	(523, 207, 185, '2022-11-29 17:41:54', '2022-11-30 00:41:54'),
	(524, 208, 185, '2022-11-29 17:41:54', '2022-11-30 00:41:54'),
	(525, 209, 185, '2022-11-29 17:41:54', '2022-11-30 00:41:54'),
	(526, 270, 185, '2022-11-30 01:07:59', '2022-11-30 08:07:59'),
	(527, 271, 185, '2022-11-30 06:27:13', '2022-11-30 13:27:13'),
	(528, 271, 184, '2022-11-30 07:23:24', '2022-11-30 14:23:24'),
	(529, 273, 183, '2022-12-02 13:12:56', '2022-12-02 20:12:56'),
	(530, 273, 184, '2022-12-02 13:13:10', '2022-12-02 20:13:10');

-- Dumping structure for table ami_dev.verifybackup
CREATE TABLE IF NOT EXISTS `verifybackup` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `verify_status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ami_dev.verifybackup: ~3 rows (approximately)
INSERT INTO `verifybackup` (`id`, `verify_status`) VALUES
	(1, 'backup'),
	(2, 'tes'),
	(3, 'tes2');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
