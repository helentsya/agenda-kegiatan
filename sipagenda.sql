/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : sipagenda

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 02/07/2024 16:29:20
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bidangs
-- ----------------------------
DROP TABLE IF EXISTS `bidangs`;
CREATE TABLE `bidangs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_bidang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bidangs
-- ----------------------------
INSERT INTO `bidangs` VALUES (1, 'Bidang Sekretariat', '2024-06-13 14:23:45', '2024-06-13 14:23:45');
INSERT INTO `bidangs` VALUES (2, 'Bidang Informatika', '2024-06-13 14:23:45', '2024-06-13 14:23:45');
INSERT INTO `bidangs` VALUES (3, 'Bidang Komunikasi', '2024-06-13 14:23:45', '2024-06-13 14:23:45');
INSERT INTO `bidangs` VALUES (4, 'Bidang Statistika Persandian', '2024-06-13 14:23:45', '2024-06-13 14:23:45');

-- ----------------------------
-- Table structure for cutis
-- ----------------------------
DROP TABLE IF EXISTS `cutis`;
CREATE TABLE `cutis`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_pegawai` bigint UNSIGNED NOT NULL,
  `jenis_cuti` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mulai_cuti` date NOT NULL,
  `lama_cuti` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_approved` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cutis_id_pegawai_foreign`(`id_pegawai` ASC) USING BTREE,
  CONSTRAINT `cutis_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawais` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cutis
-- ----------------------------
INSERT INTO `cutis` VALUES (3, 6, 'cuti tahunan', '2024-06-14', '5', 'sakit', 0, '2024-06-19 13:56:33', '2024-06-19 13:56:33');
INSERT INTO `cutis` VALUES (4, 7, 'cuti tahunan', '2024-07-01', '3', 'Acara Keluarga', 0, '2024-06-30 01:48:52', '2024-06-30 01:48:52');

-- ----------------------------
-- Table structure for events
-- ----------------------------
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_kategori` bigint UNSIGNED NOT NULL,
  `id_ruangan` bigint UNSIGNED NOT NULL,
  `id_bidang` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dihadiri` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pakaian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_event` datetime NOT NULL,
  `end_event` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `events_id_kategori_foreign`(`id_kategori` ASC) USING BTREE,
  INDEX `events_id_ruangan_foreign`(`id_ruangan` ASC) USING BTREE,
  INDEX `events_id_bidang_foreign`(`id_bidang` ASC) USING BTREE,
  CONSTRAINT `events_id_bidang_foreign` FOREIGN KEY (`id_bidang`) REFERENCES `bidangs` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `events_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_kegiatans` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `events_id_ruangan_foreign` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangans` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of events
-- ----------------------------
INSERT INTO `events` VALUES (2, 2, 1, 3, 'Acara 1 hbjbj', 'as dasndkas', 's adkandkadnasd', 'aj ssdjknasdnas', '2024-06-13 10:10:00', NULL);
INSERT INTO `events` VALUES (4, 2, 1, 2, 'Acara 1 hbjbj', 'as dasndkas', 's adkandkadnasd', 'aj ssdjknasdnas', '2024-06-14 10:10:00', NULL);
INSERT INTO `events` VALUES (5, 1, 1, 1, 'Tes', 'Iya', 'PDH Coklat', 'tes', '2024-06-19 21:42:00', NULL);

-- ----------------------------
-- Table structure for kategori_kegiatans
-- ----------------------------
DROP TABLE IF EXISTS `kategori_kegiatans`;
CREATE TABLE `kategori_kegiatans`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kategori_kegiatans
-- ----------------------------
INSERT INTO `kategori_kegiatans` VALUES (1, 'Pendidikan', '2024-06-13 14:23:45', '2024-06-13 14:23:45');
INSERT INTO `kategori_kegiatans` VALUES (2, 'Pelatihan', '2024-06-13 14:23:45', '2024-06-13 14:23:45');
INSERT INTO `kategori_kegiatans` VALUES (3, 'Seminar', '2024-06-13 14:23:45', '2024-06-13 14:23:45');
INSERT INTO `kategori_kegiatans` VALUES (4, 'Workshop', '2024-06-13 14:23:45', '2024-06-13 14:23:45');
INSERT INTO `kategori_kegiatans` VALUES (5, 'Pengabdian Masyarakat', '2024-06-13 14:23:45', '2024-06-13 14:23:45');
INSERT INTO `kategori_kegiatans` VALUES (6, 'Penelitian', '2024-06-13 14:23:45', '2024-06-13 14:23:45');
INSERT INTO `kategori_kegiatans` VALUES (7, 'Pengembangan Diri', '2024-06-13 14:23:45', '2024-06-13 14:23:45');
INSERT INTO `kategori_kegiatans` VALUES (8, 'Lainnya', '2024-06-13 14:23:45', '2024-06-13 14:23:45');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (2, '2023_12_28_032118_create_table_whatsapp', 1);
INSERT INTO `migrations` VALUES (3, '2024_04_06_090117_create_bidangs_table', 1);
INSERT INTO `migrations` VALUES (4, '2024_04_06_090118_create_pegawais_table', 1);
INSERT INTO `migrations` VALUES (5, '2024_04_23_131938_create_table_users', 1);
INSERT INTO `migrations` VALUES (6, '2024_04_26_091326_create_table_cutis', 1);
INSERT INTO `migrations` VALUES (7, '2024_04_30_103417_create_ruangans_table', 1);
INSERT INTO `migrations` VALUES (8, '2024_04_30_103418_create_kategori_kegiatans_table', 1);
INSERT INTO `migrations` VALUES (9, '2024_04_30_103419_create_table_events', 1);
INSERT INTO `migrations` VALUES (10, '2024_05_07_065136_create_pengumumen_table', 1);
INSERT INTO `migrations` VALUES (14, '2024_06_15_070257_create_sessions_table', 2);
INSERT INTO `migrations` VALUES (15, '2024_06_17_120817_add_id_bidang_to_users_table', 2);
INSERT INTO `migrations` VALUES (16, '2024_06_30_060521_add_hari_tanggal_durasi_pemakaian_to_ruangans_table', 2);
INSERT INTO `migrations` VALUES (17, '2024_07_01_122820_add_foreign_key_to_events_table', 3);

-- ----------------------------
-- Table structure for pegawais
-- ----------------------------
DROP TABLE IF EXISTS `pegawais`;
CREATE TABLE `pegawais`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_bidang` bigint UNSIGNED NOT NULL,
  `nip` int NOT NULL,
  `nama_pegawai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pegawais_id_bidang_foreign`(`id_bidang` ASC) USING BTREE,
  CONSTRAINT `pegawais_id_bidang_foreign` FOREIGN KEY (`id_bidang`) REFERENCES `bidangs` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pegawais
-- ----------------------------
INSERT INTO `pegawais` VALUES (1, 1, 123456789, 'Budi', 'Laki-laki', 'Jakarta', '1990-01-01', 'Kepala Bagian', 'Jl. Jendral Sudirman No. 1', '2024-06-13 14:23:45', '2024-06-13 14:23:45');
INSERT INTO `pegawais` VALUES (2, 2, 987654321, 'Ani', 'Perempuan', 'Bandung', '1991-01-01', 'Staff', 'Jl. Jendral Sudirman No. 2', '2024-06-13 14:23:45', '2024-06-13 14:23:45');
INSERT INTO `pegawais` VALUES (3, 3, 123123123, 'Cici', 'Perempuan', 'Surabaya', '1992-01-01', 'Staff', 'Jl. Jendral Sudirman No. 3', '2024-06-13 14:23:45', '2024-06-13 14:23:45');
INSERT INTO `pegawais` VALUES (5, 3, 123321, 'Andri May', 'laki-laki', 'Marabahan', '2024-06-14', 'Pegawai', 'Marabahan', '2024-06-14 00:52:32', '2024-06-14 00:52:32');
INSERT INTO `pegawais` VALUES (6, 2, 123, 'Alghi Nuub', 'laki-laki', 'bjbe', '2003-02-22', 'HRD', 'Bbjb', '2024-06-17 12:47:32', '2024-06-18 13:45:12');
INSERT INTO `pegawais` VALUES (7, 1, 3021, 'Pegawai Sekretariat', 'laki-laki', 'Rantau', '2005-01-13', 'Pegawai Sekretariat', 'Bjb', '2024-06-30 01:48:14', '2024-06-30 01:48:14');
INSERT INTO `pegawais` VALUES (8, 1, 1, 'Muhammad Sumbul', 'laki-laki', 'Banjarbaru', '2013-01-29', 'Kepala Bidang Sekretariat', 'Banjarbaru', '2024-06-30 02:06:52', '2024-06-30 02:06:52');
INSERT INTO `pegawais` VALUES (9, 3, 3, 'Ismail Ahmad Kanabawi', 'laki-laki', 'Banjarbaru', '1993-12-30', 'Kepala Bidang Komunikasi', 'Banjarbaru', '2024-06-30 02:11:34', '2024-06-30 02:11:34');
INSERT INTO `pegawais` VALUES (10, 4, 4, 'Khalid Khasmiri', 'laki-laki', 'Mesir', '1988-06-30', 'Kepala Bidang Statistika Persandian', 'Banjarbaru', '2024-06-30 02:13:23', '2024-06-30 02:13:23');
INSERT INTO `pegawais` VALUES (11, 1, 0, 'klas', 'laki-laki', 'Banjarbaru', '2016-01-07', 'HRD', 'Banjarbaru', '2024-06-30 07:13:57', '2024-06-30 07:13:57');

-- ----------------------------
-- Table structure for pengumumen
-- ----------------------------
DROP TABLE IF EXISTS `pengumumen`;
CREATE TABLE `pengumumen`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `judul_pengumuman` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_pengumuman` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pengumuman` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengumumen
-- ----------------------------
INSERT INTO `pengumumen` VALUES (1, 'Pelantikan CPNS', 'loremloremlorem', '2024-07-01', NULL, NULL);
INSERT INTO `pengumumen` VALUES (2, 'Pengumuman Baru', 'BSSN Kembali Diserang, Ini tanggapan kita', '2024-07-02', '2024-07-02 07:12:22', '2024-07-02 07:12:32');
INSERT INTO `pengumumen` VALUES (3, 'Tes Pengumuman', 'Poliban kembali membuka penerimaan Mahasiswa', '2024-07-10', '2024-07-02 07:34:42', '2024-07-02 07:34:42');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for ruangans
-- ----------------------------
DROP TABLE IF EXISTS `ruangans`;
CREATE TABLE `ruangans`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_ruangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `kapasitas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status_ruang` enum('tersedia','tidak tersedia') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `hari` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `durasi_pemakaian` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ruangans
-- ----------------------------
INSERT INTO `ruangans` VALUES (1, 'Ruangan 1', '11', 'tersedia', NULL, NULL, NULL, '2024-06-13 22:31:45', '2024-06-13 22:31:47');
INSERT INTO `ruangans` VALUES (2, 'Ruangan 2', '10', 'tersedia', NULL, NULL, NULL, '2024-06-13 22:31:58', '2024-06-13 22:31:59');
INSERT INTO `ruangans` VALUES (3, 'Aula Kayuh Baimbai', '200', 'tidak tersedia', NULL, NULL, NULL, '2024-06-30 06:46:24', '2024-06-30 06:47:35');

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id` ASC) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('MNecNkoioAYwNgsXNKlMtcuXAs5rzceNILCTypsS', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiajJRY1lWVG5jNU1waHY1RmZFWWJlb3BTd1YwaTlnRnN5bTJQamc1MyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9iaWRhbmcvNC9hZ2VuZGEiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1719907101);
INSERT INTO `sessions` VALUES ('rYSmzDjUB9MYg2cpHirX13IZ0zh2GeAYH0c1NXyY', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoicFlZYkE1NGdvUjhiZlZxbFk4a1JHdXFmUzFzclk1YlNYMm5jM3IxRyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3ByaW50LXBkZiI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vcHJpbnQtcGRmIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1719840564);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_pegawai` bigint UNSIGNED NOT NULL,
  `id_bidang` bigint UNSIGNED NULL DEFAULT NULL,
  `nama_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` enum('pegawai','admin','kepalapejabat','bidang') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `users_id_pegawai_foreign`(`id_pegawai` ASC) USING BTREE,
  CONSTRAINT `users_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawais` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 1, NULL, 'Budi', 'admin', '$2y$12$skb02TKbhLzkSqzFrdzeWOcBKLoK/ToaPqYdzRhlyLCVuku8nvqd6', 'admin@test.com', 'admin');
INSERT INTO `users` VALUES (2, 2, 2, 'Ani', 'pegawai1', '$2y$12$skb02TKbhLzkSqzFrdzeWOcBKLoK/ToaPqYdzRhlyLCVuku8nvqd6', 'pegawai1@test.com', 'pegawai');
INSERT INTO `users` VALUES (3, 3, NULL, 'Cici', 'kepalapejabat', '$2y$12$skb02TKbhLzkSqzFrdzeWOcBKLoK/ToaPqYdzRhlyLCVuku8nvqd6', 'pegawai2@test.com', 'kepalapejabat');
INSERT INTO `users` VALUES (5, 5, NULL, 'Andri May', 'andri', '$2y$12$irLDsJxeHg4Wqv3jQzPpNekLo0ocdrwDPRtFp3iJZCy99ioH.L3Y6', 'andri@gmail.com', 'bidang');
INSERT INTO `users` VALUES (6, 6, NULL, 'Alghi Nuub', 'ColonialGT', '$2y$12$s8v02ST9HnJUZhmtG9pRq.r.rfoNe/SuGQcG9jlah8WZigZk3QZPW', 'alghe@gmail.com', 'bidang');
INSERT INTO `users` VALUES (7, 7, 1, 'Pegawai Sekretariat', 'pegawaisekre', '$2y$12$/.WOpCEfRlKJbwLjGwXh6.qhD9Btz8BuZuXWfXGQM8FQw1AOz0Uum', 'pegawaisekre@gmail.com', 'bidang');
INSERT INTO `users` VALUES (8, 8, 1, 'Muhammad Sumbul', 'kepalasekre', '$2y$12$7p7NVi9rxK4nb1fPsg3CD.FotVBgz7CjuGRP/5hkWWi3q7ab4Vioa', 'kepalasekre@gmail.com', 'pegawai');
INSERT INTO `users` VALUES (9, 9, 3, 'Ismail Ahmad Kanabawi', 'kepalakomunikasi', '$2y$12$r9sHvGELbXJEOvcNbmi7a.Tortep8zMhB8SUM0C7wSoj3XdYyVip2', 'kepalakomunikasi@gmail.com', 'pegawai');
INSERT INTO `users` VALUES (10, 10, 4, 'Khalid Khasmiri', 'kepalastatistika', '$2y$12$a1qByeqaGm/GwBjXJK171uztvRvSjPmD/BZgU2aojHD6btfUG47wy', 'kepalastatistika@gmail.com', 'pegawai');
INSERT INTO `users` VALUES (11, 11, NULL, 'klas', 'klas', '$2y$12$dUImZXyoiU/mVxPwlhUq2.nWiju/Fghi0IB.rEFsktP/rsjTGRJdG', 'klas@gmail.com', 'bidang');

-- ----------------------------
-- Table structure for whatsapp
-- ----------------------------
DROP TABLE IF EXISTS `whatsapp`;
CREATE TABLE `whatsapp`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomor_telepon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of whatsapp
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
