/*
SQLyog Community
MySQL - 10.4.32-MariaDB : Database - db_magang
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_magang` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `db_magang`;

/*Table structure for table `artikels` */

DROP TABLE IF EXISTS `artikels`;

CREATE TABLE `artikels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `artikels` */

insert  into `artikels`(`id`,`judul`,`konten`,`gambar`,`created_at`,`updated_at`) values 
(3,'Pengumungan peting','Հայերեն Shqip ‫العربية Български Català 中文简体 Hrvatski Česky Dansk Nederlands English Eesti Filipino Suomi Français ქართული Deutsch Ελληνικά ‫עברית हिन्दी Magyar Indonesia Italiano Latviski Lietuviškai македонски Melayu Norsk Polski Português Româna Pyccкий Српски Slovenčina Slovenščina Español Svenska ไทย Türkçe Українська Tiếng Việt\r\nLorem Ipsum\r\n\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...\"\r\n\"There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...\"\r\nWhat is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nWhy do we use it?\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n\r\n\r\nWhere does it come from?\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.\r\n\r\nWhere can I get some?\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\r\n\r\n5\r\n	paragraphs\r\n	words\r\n	bytes\r\n	lists\r\n	Start with \'Lorem\r\nipsum dolor sit amet...\'\r\n\r\nDonate: If you use this site regularly and would like to help keep the site on the Internet, please consider donating a small sum to help pay for the hosting and bandwidth bill. There is no minimum donation, any sum is appreciated - click here to donate using PayPal. Thank you for your support. Donate bitcoin: 16UQLq1HZ3CNwhvgrarV6pMoA2CDjb4tyF\r\nTranslations: Can you help translate this site into a foreign language ? Please email us with details if you can help.\r\nThere is a set of mock banners available here in three colours and in a range of standard banner sizes:\r\nBannersBannersBanners\r\nNodeJS Python Interface GTK Lipsum Rails .NET\r\nThe standard Lorem Ipsum passage, used since the 1500s\r\n\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\r\n\r\nSection 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\r\n\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"\r\n\r\n1914 translation by H. Rackham\r\n\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\"\r\n\r\nSection 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\r\n\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"\r\n\r\n1914 translation by H. Rackham\r\n\"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.\"\r\n\r\nhelp@lipsum.com\r\nPrivacy Policy ·','artikel/NAeX9oKKv23uwGBT9dCRhSrvp06N8NKw7qRlNOfA.png','2025-07-29 02:02:57','2025-08-04 00:52:12'),
(5,'Pelepasan Mahasiswa Magang','Pelepasan Mahasiswa Magang UPN dan UNAIR: Satu Bulan Pengalaman Berharga\r\nBPS Kabupaten Kediri, 1 Agustus 2025 — Setelah menjalani kegiatan magang selama satu bulan penuh, sejumlah mahasiswa dari Universitas Pembangunan Nasional \"Veteran\" Jawa Timur (UPN) dan Universitas Airlangga (UNAIR) resmi dilepas pada hari ini, menandai berakhirnya masa magang yang dimulai sejak 31 Juni 2025.\r\n\r\nSelama masa magang, para mahasiswa telah mengikuti berbagai kegiatan yang menunjang pemahaman praktis mereka terhadap dunia kerja, mulai dari pengelolaan administrasi, pelaksanaan program kerja, hingga pelibatan dalam sejumlah kegiatan internal instansi. Tidak hanya itu, mereka juga menunjukkan inisiatif, etos kerja yang tinggi, serta semangat kolaborasi yang positif dalam lingkungan kerja.\r\n\r\nPihak instansi menyampaikan apresiasi setinggi-tingginya kepada para mahasiswa atas dedikasi dan kontribusinya selama ini. Kehadiran mereka tidak hanya memberikan warna baru di lingkungan kerja, tetapi juga menunjukkan bahwa generasi muda memiliki potensi besar dalam mendukung kemajuan organisasi.\r\n\r\n“Kami mengucapkan terima kasih atas kerjasama yang telah terjalin. Semoga pengalaman ini menjadi bekal berharga bagi para mahasiswa dalam menapaki jenjang karier di masa depan,” ujar salah satu perwakilan instansi dalam sambutan pelepasan.\r\n\r\nSebagai penutup, kegiatan ditutup dengan sesi foto bersama, pembagian sertifikat, dan pesan-pesan inspiratif dari pembimbing lapangan. Para mahasiswa pun menyampaikan rasa terima kasih mereka atas bimbingan dan kesempatan yang diberikan selama proses magang berlangsung.\r\n\r\nDengan berakhirnya masa magang ini, diharapkan terjalin hubungan yang baik antara instansi dan perguruan tinggi sebagai mitra dalam mencetak generasi profesional yang kompeten dan berintegritas.','artikel/WFFRsVEVbo8d9DbHJpyQlzp9u4UTfRlaeqWUVuXq.jpg','2025-08-04 01:11:19','2025-08-04 01:11:19'),
(6,'Pengumuman','halo','artikel/j34XMED7lV7q9IcbjJqNDPLX7CpazE53OivOA33u.png','2025-08-21 01:41:16','2025-08-21 01:41:16');

/*Table structure for table `biodata_peserta` */

DROP TABLE IF EXISTS `biodata_peserta`;

CREATE TABLE `biodata_peserta` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `nim_nis` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `no_wa` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` enum('siswa','mahasiswa') NOT NULL DEFAULT 'mahasiswa',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `instansi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `biodata_peserta_user_id_foreign` (`user_id`),
  CONSTRAINT `biodata_peserta_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `biodata_peserta` */

insert  into `biodata_peserta`(`id`,`user_id`,`nim_nis`,`jurusan`,`no_wa`,`foto`,`status`,`created_at`,`updated_at`,`nama`,`instansi`) values 
(90,52,'123','AKUNTANSI','85648758932','foto_peserta/ogs3y9h8cYYsoCK08ph0QpceynZfvfmEsWgKxAKk.png','mahasiswa','2025-08-21 00:49:08','2025-08-21 00:49:08','Nadia Fika Nurahma','UNIVERSITAS NUSANTARA PGRI KEDIRI'),
(91,50,'12345','Komputasi','85748196884','foto_peserta/UdsNZLAFWMhKFlTNZXJjRinajHHnC86aMVR7gnhE.png','mahasiswa','2025-08-21 01:36:50','2025-08-21 01:36:50','Agape Bagus Rega Anggara','STIS'),
(92,49,'5678','informatika','865679986437','foto_peserta/QYzoe142vF8taSDNwDK0vx0TfuaDcUXhOuLiGACw.png','mahasiswa','2025-08-21 01:55:13','2025-08-21 01:55:13','Ahmad Febrian Muharom','Polinema'),
(93,35,'1235','Informatika','85748196888','foto_peserta/wGpUyD9Flb9YGHy1ubVE9Kk2LpXeHKskWQV4No8l.png','mahasiswa','2025-08-21 08:21:37','2025-08-21 08:21:37','FaizIvanIlyasa','Politeknik Negeri Malang');

/*Table structure for table `cache` */

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache` */

/*Table structure for table `cache_locks` */

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache_locks` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'2025_07_05_024058_create_sessions_table',1),
(4,'2025_07_11_064453_create_biodata_peserta_table',1),
(5,'2025_07_11_064455_create_pendaftaran_magang_table',1),
(6,'2025_07_11_064457_create_artikels_table',1),
(7,'2025_07_28_074931_create_surat_balasans_table',2),
(8,'2025_07_28_080144_create_surat_balasan_table',3),
(9,'2025_07_28_080405_create_surat_balasan_table',4),
(10,'2025_07_30_025513_create_sertifikats_table',5),
(11,'2025_08_12_024847_add_file_and_status_to_sertifikats_table',6),
(12,'2025_08_19_225631_update_enum_status_pendaftaran_magang',7),
(13,'2025_08_20_111836_add_status_to_biodata_peserta_table',8),
(14,'2025_08_21_081406_remove_bagian_penempatan_and_bersedia_ditempatkan_lain_from_pendaftaran_magang',9),
(15,'2025_08_21_120828_add_new_columns_to_sertifikats_table',10);

/*Table structure for table `pendaftaran_magang` */

DROP TABLE IF EXISTS `pendaftaran_magang`;

CREATE TABLE `pendaftaran_magang` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `surat_pengantar` varchar(255) NOT NULL,
  `proposal` varchar(255) NOT NULL,
  `jenis_magang` enum('mandiri','wajib') NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status` enum('menunggu','diterima','ditolak','selesai') DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pendaftaran_magang_user_id_foreign` (`user_id`),
  CONSTRAINT `pendaftaran_magang_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pendaftaran_magang` */

insert  into `pendaftaran_magang`(`id`,`user_id`,`surat_pengantar`,`proposal`,`jenis_magang`,`tanggal_mulai`,`tanggal_selesai`,`status`,`created_at`,`updated_at`) values 
(175,47,'surat_pengantar/QVxoCkiIrpBrA6yCbVbf6jXXyGVV9dH0BZhOeooe.pdf','proposal/e9boRWRFj5LT0mKZS0to3NZHVcQJ29FNHSyivhh9.pdf','wajib','2025-08-01','2025-08-19','selesai','2025-08-20 07:43:30','2025-08-20 07:43:31'),
(176,53,'surat_pengantar/rwqzAhaHFDeEmOIeZ1hjb31UYB14x8YXxwdqza9u.pdf','proposal/l9UdJ1efxuEdFS8fQOk31qoUZ0eQiLac6iB7icRm.pdf','wajib','2025-08-01','2025-08-22','menunggu','2025-08-21 00:41:52','2025-08-21 00:41:52'),
(177,52,'surat_pengantar/hQPEc9AZ32i9VdIMkT0Pl5VyQyfg4pSVvoGwJy1C.pdf','proposal/dYhGRiVRnYrYXPje54GQUe1cbbJKu0rr5YsckIsu.pdf','wajib','2025-08-01','2025-08-22','diterima','2025-08-21 00:50:33','2025-08-21 01:00:53'),
(178,50,'surat_pengantar/ZR8MjSVGjOZs4bfvk2pyBNrLuSAcf0ijgA6QJ6CO.pdf','proposal/7O3wpWPXcv8AgrfRPtzkvSolOyu5OKc5yWz12gu2.pdf','wajib','2025-08-01','2025-08-22','diterima','2025-08-21 01:37:32','2025-08-21 01:38:22'),
(179,49,'surat_pengantar/q8d58frCZICsU4Z3DdTdtYY9DoR4lPubVP5ulDPV.pdf','proposal/5nhB8L75G1yCHuVyKDbhE01VKnN3YYIsPMeqwQKV.pdf','wajib','2025-08-01','2025-08-22','ditolak','2025-08-21 01:55:39','2025-08-21 01:56:34'),
(180,35,'surat_pengantar/LVJUVHNKArosCSwLXqksRa2VsqqUElShRlFPdyr6.pdf','proposal/1TH0e7NkEmg7m839AO4N4KloPDI4zvMVLkqxdfqh.pdf','mandiri','2025-08-14','2025-08-22','diterima','2025-08-21 08:22:17','2025-08-21 14:39:23');

/*Table structure for table `sertifikats` */

DROP TABLE IF EXISTS `sertifikats`;

CREATE TABLE `sertifikats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `nomor_sertifikat` varchar(255) NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `jabatan_penandatangan` varchar(255) DEFAULT NULL,
  `nama_penandatangan` varchar(255) DEFAULT NULL,
  `status` enum('pending','selesai') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sertifikats_nomor_sertifikat_unique` (`nomor_sertifikat`),
  KEY `sertifikats_user_id_foreign` (`user_id`),
  CONSTRAINT `sertifikats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sertifikats` */

insert  into `sertifikats`(`id`,`user_id`,`nomor_sertifikat`,`file_path`,`deskripsi`,`jabatan_penandatangan`,`nama_penandatangan`,`status`,`created_at`,`updated_at`) values 
(12,34,'001/3506/HM.340/08/2025',NULL,NULL,NULL,NULL,'pending','2025-08-20 05:40:36','2025-08-20 05:40:36'),
(14,50,'004/3506/HM.340/08/2025','sertifikat/IAIyRhbYmP3mGsQcIfPBozodbAKr1qklTRM1cO77.pdf',NULL,NULL,NULL,'pending','2025-08-21 01:39:38','2025-08-21 01:40:18'),
(15,52,'005/3506/HM.340/08/2025',NULL,'telah menyelesaikan Magang Praktik Kerja di Badan Pusat Statistik Kabupaten Kediri','Kepala Badan Pusat Statistik Kabupaten Kediri','BAMBANG INDARTO, S.Si., M.Si.','pending','2025-08-21 13:24:20','2025-08-21 13:24:20');

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values 
('zeTwFI1vtKesfwtjjNdQflt7qc7dT0rbblrCCzCG',35,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoieDZhQlV4aTFQMTRUS0kxenhiNTlIYThsNTM5RTU1ZXc2eUZtWUkxNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MzU7fQ==',1755788895);

/*Table structure for table `surat_balasan` */

DROP TABLE IF EXISTS `surat_balasan`;

CREATE TABLE `surat_balasan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `surat_balasan_user_id_foreign` (`user_id`),
  CONSTRAINT `surat_balasan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `surat_balasan` */

insert  into `surat_balasan`(`id`,`user_id`,`file`,`created_at`,`updated_at`) values 
(11,52,'surat_balasan/m40pybuVyzFuHUEQ0CvgBnyZ6iuXTQr6O9JUM7N9.pdf','2025-08-21 01:04:24','2025-08-21 01:04:24'),
(12,50,'surat_balasan/N9je5A8Tgjcf9WrrJdL1C3VjJrYYdMAbnAciQZnX.pdf','2025-08-21 01:38:52','2025-08-21 01:38:52');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','peserta') NOT NULL DEFAULT 'peserta',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`nama`,`email`,`password`,`role`,`created_at`,`updated_at`) values 
(4,'Admin','admin@gmail.com','$2y$12$mG7i1kxzx./qyef5756TbuTnnZIyd.gteZyXA842J/geG9FzPnsDO','admin','2025-07-22 15:37:36','2025-08-15 07:06:23'),
(10,'Leni sagita','leni@gmail.com','$2y$12$.tq1GtaZE6TXUQxhixVsH.dQjkyiagMPADyJHL8Fjreg7hP1IWFeu','admin','2025-08-15 08:31:16','2025-08-15 08:31:16'),
(33,'Akmal Nasirudin Muzaki','AkmalNasirudinMuzaki@gmail.com','$2y$12$W99Rsu2LaahUSDe9Ot3z5uInABQXTJss8twUzsGrteQ/XgKNC/APC','peserta','2025-08-20 03:25:58','2025-08-20 03:25:58'),
(34,'Danang Hermawan','DanangHermawan@gmail.com','$2y$12$XdvKeeRU4RkjuvIh24O.XuzLV51hTnJ6mo3dGKQ41/.gHmtndPfHq','peserta','2025-08-20 03:25:59','2025-08-20 03:25:59'),
(35,'Faiz Ivan Ilyasa','FaizIvanIlyasa@gmail.com','$2y$12$x3WbjuymtQZBuyJGUOFEv.xtxNEPdoJtSyLJg/vEoLq/A9/mG.r7W','peserta','2025-08-20 03:25:59','2025-08-20 03:25:59'),
(36,'Leondra Halim Khaiza','LeondraHalimKhaiza@gmail.com','$2y$12$4XrUF7T0Y7IE17xrELmxGe7GBX1bZljNq9sCtJ9wXxemHbUAV45Iy','peserta','2025-08-20 03:25:59','2025-08-20 03:25:59'),
(37,'Wahyuni Damayanti','WahyuniDamayanti@gmail.com','$2y$12$gZ8V4Vl5JZm8RogxMm1GwOPKBAXl/UamV91/6KExeCVJNMIbHyEGK','peserta','2025-08-20 03:26:00','2025-08-20 03:26:00'),
(38,'Safira sofi alfiana','SafiraSofiAlfiana@gmail.com','$2y$12$vZ0GkvonfkTKR8eEcWXCm.x3Ke0SSkhf1no10oLlr7klpy/BP.ix.','peserta','2025-08-20 03:26:00','2025-08-20 03:26:00'),
(39,'Arya Qurnia Gusti','AryaQurniaGusti@gmail.com','$2y$12$BF7nZ36vw2iFJi.nheVzM.H8MmCHrMGvEkByQjvPfrCKlMZ2f5xoy','peserta','2025-08-20 03:26:00','2025-08-20 03:26:00'),
(40,'Divana Febtiga N','DivanaFebtigaN@gmail.com','$2y$12$C63QGlkXSs7YpYPHDIscbuj8wPrwYPxKPL317Y.Hv.av8OUbx0qJO','peserta','2025-08-20 03:26:01','2025-08-20 03:26:01'),
(41,'Ananda Sri Devi','AnandaSriDevi@gmail.com','$2y$12$7/e8Vio6Cagw4PmX92XmkeDpOBDMcy.Omgd3K3oKLaJarGNZjhIvO','peserta','2025-08-20 03:26:01','2025-08-20 03:26:01'),
(42,'Annisa Nur Salsabila','AnnisaNurSalsabila@gmail.com','$2y$12$zJpZk09IJZuENJyB1B3pz.eDUn6eMkBDGoEWqrFWSYT0vR45mqkXm','peserta','2025-08-20 03:26:01','2025-08-20 03:26:01'),
(43,'Noviane Febriliani','NovianeFebriliani@gmail.com','$2y$12$GLybQ1b9Hk.Wnlwi7iB7we.OO0lJBhpDR8FbmSuZAgEkouRw/IqYK','peserta','2025-08-20 03:26:01','2025-08-20 03:26:01'),
(44,'Addina Nurkamila','AddinaNurkamila@gmail.com','$2y$12$NoE/X6W2yXS2DfeZDecSh.YbximhDC7H6sl3eCKgFWB2aAarrQI/a','peserta','2025-08-20 03:26:02','2025-08-20 03:26:02'),
(45,'Marshella Agatha Pramuditha','MarshellaAgathaPramuditha@gmail.com','$2y$12$l/2UH0XfJ5I.yNEmLtF9duX8HznknsyHjNgsLGSqZTrlseQwcqhRu','peserta','2025-08-20 03:26:02','2025-08-20 03:26:02'),
(46,'Davin Firmansha','DavinFirmansha@gmail.com','$2y$12$do9ZI9dMVOdVt63jYyPtqOvwLjChzw0/ABNKhKrbQmG3wrMiu7TiC','peserta','2025-08-20 03:26:02','2025-08-20 03:26:02'),
(47,'Fitri Dwi Anisa','FitriDwiAnisa@gmail.com','$2y$12$CjTr1y01XhjYgEzTx5pRFe4UF/vs8XiL0BJHQnygB5av.kKqacYry','peserta','2025-08-20 03:26:03','2025-08-20 03:26:03'),
(48,'Baran Hidayat Azzahra','BaranHidayatAzzahra@gmail.com','$2y$12$4zhrAKXDy3oslfXswn7T2O30sEQtWTcb0l/t0Zc.BJP9rgmNhAhwe','peserta','2025-08-20 03:26:03','2025-08-20 03:26:03'),
(49,'Ahmad Febrian Muharom','AhmadFebrianMuharom@gmail.com','$2y$12$IjfTWK8rubBih5iFvGMvYOCWQdijaRID/wnZlL6RrLnxJXdDpjEvi','peserta','2025-08-20 03:26:03','2025-08-20 03:26:03'),
(50,'Agape Bagus Rega Anggara','AgapeBagusRegaAnggara@gmail.com','$2y$12$rjupVLg6A3N9ut2dkDkwuOBws4K8QcMLRzAg6LlQemvhnYaSXeBLm','peserta','2025-08-20 03:26:04','2025-08-20 03:26:04'),
(51,'SILVY MARGARHETA','SilvyMargarheta@gmail.com','$2y$12$Gs.yJWt.N2Gyvk5Ip/yer.jFbadJ/TtKU8it18m6NIQhWjk/FQfSe','peserta','2025-08-20 03:26:04','2025-08-20 03:26:04'),
(52,'NADIA FIKA NURAHMA','NadiaFikaNurahma@gmail.com','$2y$12$gkbunAx5C1egetrkXN/1OO.0GtuIq4l7tlWXZ5WdAnA9mbW7cNcWq','peserta','2025-08-20 03:26:04','2025-08-20 03:26:04'),
(53,'DIAN PUSPITA SARI','DianPuspitaSari@gmail.com','$2y$12$vVDpwra8YOJi2.cptjhfze9Twug4CG/EIYTfrUqsaCvEKbCT/As2.','peserta','2025-08-20 03:26:04','2025-08-20 03:26:04'),
(54,'Admin1','admin1@gmail.com','$2y$12$b1177vN8mcNrSJ9LIcHy8.j1QnnZtVZeHt6HpUdV..2XWDt9fssc.','admin','2025-08-20 03:26:05','2025-08-20 03:26:05');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
