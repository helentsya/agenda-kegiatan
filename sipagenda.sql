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

 Date: 13/07/2024 14:40:25
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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of bidangs
-- ----------------------------
INSERT INTO `bidangs` VALUES (1, 'Super Admin', '2024-06-13 14:23:45', '2024-06-13 14:23:45');
INSERT INTO `bidangs` VALUES (2, 'Bidang Sekretariat', '2024-06-13 14:23:45', '2024-06-13 14:23:45');
INSERT INTO `bidangs` VALUES (3, 'Bidang Informatika', '2024-06-13 14:23:45', '2024-06-13 14:23:45');
INSERT INTO `bidangs` VALUES (4, 'Bidang Komunikasi', '2024-06-13 14:23:45', '2024-06-13 14:23:45');
INSERT INTO `bidangs` VALUES (5, 'Bidang Statistika Persandian', NULL, NULL);

-- ----------------------------
-- Table structure for cutis
-- ----------------------------
DROP TABLE IF EXISTS `cutis`;
CREATE TABLE `cutis`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_pegawai` bigint UNSIGNED NOT NULL,
  `id_bidang` bigint UNSIGNED NULL DEFAULT NULL,
  `jenis_cuti` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mulai_cuti` date NOT NULL,
  `lama_cuti` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_approved` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cutis_id_pegawai_foreign`(`id_pegawai` ASC) USING BTREE,
  INDEX `cutis_id_bidang_foreign`(`id_bidang` ASC) USING BTREE,
  CONSTRAINT `cutis_id_bidang_foreign` FOREIGN KEY (`id_bidang`) REFERENCES `bidangs` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cutis_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawais` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cutis
-- ----------------------------
INSERT INTO `cutis` VALUES (5, 20, 3, 'cuti melahirkan', '2003-05-29', '5', 'Saya mau melahirkan', 1, '2024-07-10 13:30:44', '2024-07-10 14:35:59');
INSERT INTO `cutis` VALUES (6, 19, 3, 'cuti besar', '2000-05-24', '15', 'Umroh', 0, '2024-07-10 13:52:29', '2024-07-10 13:52:29');
INSERT INTO `cutis` VALUES (7, 21, 2, 'cuti besar', '2000-04-22', '16', 'sakit', 0, '2024-07-10 14:08:03', '2024-07-10 14:08:03');

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
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of events
-- ----------------------------
INSERT INTO `events` VALUES (10, 5, 3, 2, 'Lirpa', 'Semua pegawai ASN', 'Sasirangan', 'harap berhadir', '2024-07-10 21:24:00', '2024-07-12 21:24:00');
INSERT INTO `events` VALUES (11, 8, 2, 3, 'Pengembangan Aplikasi', 'Semua pegawai ASN', 'Kasual', 'harap berhadir', '2024-07-13 20:30:00', '2024-07-15 14:34:00');

-- ----------------------------
-- Table structure for jabatans
-- ----------------------------
DROP TABLE IF EXISTS `jabatans`;
CREATE TABLE `jabatans`  (
  `id_jabatan` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_jabatan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jabatans
-- ----------------------------
INSERT INTO `jabatans` VALUES (1, 'Kepala Dinas', NULL, NULL);
INSERT INTO `jabatans` VALUES (2, 'Kepala Bidang Sekretariat', NULL, NULL);
INSERT INTO `jabatans` VALUES (3, 'Kepala Bidang Informatika', NULL, NULL);
INSERT INTO `jabatans` VALUES (4, 'Kepala Bidang Komunikasi', NULL, NULL);
INSERT INTO `jabatans` VALUES (5, 'Kepala Bidang Statistika Persandian', NULL, NULL);
INSERT INTO `jabatans` VALUES (6, 'Pegawai Bidang Sekretariat', NULL, NULL);
INSERT INTO `jabatans` VALUES (7, 'Pegawai Bidang Informatika', NULL, NULL);
INSERT INTO `jabatans` VALUES (8, 'Pegawai Bidang Komunikasi', NULL, NULL);
INSERT INTO `jabatans` VALUES (9, 'Pegawai Bidang Statistika Persandian', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

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
INSERT INTO `migrations` VALUES (18, '2024_07_07_052753_create_jabatans_table', 4);
INSERT INTO `migrations` VALUES (19, '2024_07_10_134412_add_id_bidang_to_cutis_table', 5);
INSERT INTO `migrations` VALUES (20, '2024_07_12_140528_change_nip_length_in_pegawais_table', 6);

-- ----------------------------
-- Table structure for pegawais
-- ----------------------------
DROP TABLE IF EXISTS `pegawais`;
CREATE TABLE `pegawais`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_jabatan` bigint UNSIGNED NULL DEFAULT NULL,
  `id_bidang` bigint UNSIGNED NOT NULL,
  `nip` varchar(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  INDEX `pegawais_id_jabatan_foreign`(`id_jabatan` ASC) USING BTREE,
  CONSTRAINT `pegawais_id_bidang_foreign` FOREIGN KEY (`id_bidang`) REFERENCES `bidangs` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `pegawais_id_jabatan_foreign` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatans` (`id_jabatan`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pegawais
-- ----------------------------
INSERT INTO `pegawais` VALUES (1, 0, 1, '123456789', 'Budi', 'Laki-laki', 'Jakarta', '1990-01-01', 'Admin', 'Jl. Jendral Sudirman No. 1', '2024-06-13 14:23:45', '2024-06-13 14:23:45');
INSERT INTO `pegawais` VALUES (17, 3, 3, '3', 'Muhammad Iklas', 'laki-laki', 'Gambut', '2002-05-20', 'Kepala Bidang Informatika', 'Basirih', '2024-07-08 02:43:15', '2024-07-08 02:43:15');
INSERT INTO `pegawais` VALUES (18, 2, 2, '4', 'Muhammad CAHYA Adi Fuadi', 'laki-laki', 'Banjarbaru', '2001-05-29', 'Kepala Bidang Sekretariat', 'Bjb', '2024-07-08 02:45:01', '2024-07-08 02:48:06');
INSERT INTO `pegawais` VALUES (19, 7, 3, '3', 'Pegawai Informatika', 'laki-laki', 'BJB', '2008-01-29', 'Pegawai Bidang Informatika', 'Banjarbaru', '2024-07-09 06:33:08', '2024-07-09 06:46:10');
INSERT INTO `pegawais` VALUES (20, 7, 3, '753735', 'Indra cahyani', 'laki-laki', 'Sambang Lihum', '2003-05-24', 'Pegawai Bidang Informatika', 'Banjarbaru', '2024-07-10 13:27:56', '2024-07-10 13:28:16');
INSERT INTO `pegawais` VALUES (21, 6, 2, '61335', 'Hasan', 'laki-laki', 'Rantau', '2002-02-25', 'Pegawai Bidang Sekretariat', 'Banjarbaru', '2024-07-10 13:59:22', '2024-07-10 13:59:22');
INSERT INTO `pegawais` VALUES (22, 9, 5, '2632', 'Pegawai Statistik', 'laki-laki', 'Banjarbaru', '1999-05-23', 'Pegawai Bidang Statistika Persandian', 'Basirih', '2024-07-12 13:36:57', '2024-07-12 13:36:57');
INSERT INTO `pegawais` VALUES (25, 7, 3, '123456789012345678', 'Tes Panjang NIP', 'laki-laki', 'Kampung Arab', '2000-06-29', 'Pegawai Bidang Informatika', 'Banjarbaru', '2024-07-12 14:07:35', '2024-07-12 14:07:35');
INSERT INTO `pegawais` VALUES (26, 1, 3, '1234215123', 'Kepala Dinas', 'laki-laki', 'Banjarbaru', '2003-05-29', 'Kepala Dinas', 'Banjarbaru', '2024-07-12 14:09:21', '2024-07-12 14:09:21');
INSERT INTO `pegawais` VALUES (27, 4, 4, '190057637345526246', 'Muhammad Yamani', 'laki-laki', 'Banjarmasin', '1995-02-22', 'Kepala Bidang Komunikasi', 'Banjarmasin', '2024-07-13 06:12:16', '2024-07-13 06:12:16');
INSERT INTO `pegawais` VALUES (28, 5, 5, '1967485358431354', 'Muhammad Sumbul', 'laki-laki', 'Rantau', '1990-06-25', 'Kepala Bidang Statistika Persandian', 'Banjarbaru', '2024-07-13 06:14:40', '2024-07-13 06:14:40');
INSERT INTO `pegawais` VALUES (29, 8, 4, '193532678821456785', 'Novie Sari', 'perempuan', 'Gambut', '1999-08-25', 'Pegawai Bidang Komunikasi', 'Mandiri Permai', '2024-07-13 06:16:33', '2024-07-13 06:16:33');

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('8UoSLHjPwDevCrYf34FPyUvWnzr6ogYp21joS46b', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNnMzQVB3eHk4bW1EZGV6V0tBYzRkQlVaTXdTbE00Wnh0SkxwVkFSMCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9iaWRhbmcvMy9hZ2VuZGEiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1720852697);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_jabatan` bigint UNSIGNED NULL DEFAULT NULL,
  `id_pegawai` bigint UNSIGNED NOT NULL,
  `id_bidang` bigint UNSIGNED NULL DEFAULT NULL,
  `nama_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` enum('pegawai','admin','kepalapejabat','bidang') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `users_id_pegawai_foreign`(`id_pegawai` ASC) USING BTREE,
  INDEX `users_id_jabatan_foreign`(`id_jabatan` ASC) USING BTREE,
  CONSTRAINT `users_id_jabatan_foreign` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatans` (`id_jabatan`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `users_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawais` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 0, 1, 0, 'Budi', 'admin', '$2y$12$skb02TKbhLzkSqzFrdzeWOcBKLoK/ToaPqYdzRhlyLCVuku8nvqd6', 'admin@test.com', 'admin');
INSERT INTO `users` VALUES (17, 3, 17, 3, 'Muhammad Iklas', 'klas', '$2y$12$ILBc3lsTXTZuIMNGo2UA2ebm024kDJfyCsdR5pJRjUr7ZxtQEN7ZW', 'klas@gmail.com', 'pegawai');
INSERT INTO `users` VALUES (18, 2, 18, 2, 'Muhammad CAHYA Adi Fuadi', 'adi1234', '$2y$12$n5Tfw63oLBgGjv8VEq77XuDK/bKzPjDh31eQfmxom42UDj4TzjKey', 'adi@gmail.com', 'pegawai');
INSERT INTO `users` VALUES (19, 7, 19, 3, 'Pegawai Informatika', 'pegawaiinfo', '$2y$12$TImREPCPQkFyQrXSbwAQje3uHFORnOkW80kNMRWhHD00PraaA5PhK', 'pegawaiinfo@gmail.com', 'bidang');
INSERT INTO `users` VALUES (20, 7, 20, 3, 'Indra cahyani', 'indra', '$2y$12$EZbXC2rGMgYu4j.fbde4b.PDwi2tcdAPDW5VjggetY8r7Wu15h/9y', 'indracahyuadi@gmail.com', 'bidang');
INSERT INTO `users` VALUES (21, 6, 21, 2, 'Hasan', 'hasan', '$2y$12$Ycc2sCGnynsE/1QO.DfPVuNUrazSn35StBxuNL1P.rcLGzn1.UAXO', 'hasan@gmail.com', 'bidang');
INSERT INTO `users` VALUES (22, 9, 22, 5, 'Pegawai Statistik', 'pegawaistatis', '$2y$12$VL0h2eECN2yh4MPBDvFhnuKf3Me0o84GhhIK3TU0ck/9HWmfBnJzm', 'pegawaistat@gmail.com', 'bidang');
INSERT INTO `users` VALUES (25, 7, 25, 3, 'Tes Panjang NIP', 'nipo', '$2y$12$uSt0xitb2Yi5YA.e8MP5DeeN7dx5m2KpUi7lNK.NwxXcUT4fC97mO', 'adminnip@example.com', 'bidang');
INSERT INTO `users` VALUES (26, 1, 26, 3, 'Kepala Dinas', 'kepaladinas', '$2y$12$Qmx5Clms30G3B.hjgBdV4uQ1V5JhFAUBV4LyaYlWUJ0CpN842EhGC', 'kepaladinas@test.com', 'kepalapejabat');
INSERT INTO `users` VALUES (27, 4, 27, 4, 'Muhammad Yamani', 'yamani', '$2y$12$ivfiL5EpFVr98IlOTxupKuUPWZOuthCEsQx1lH/oNpETz2iCj7/Xa', 'pakyam@gmail.com', 'pegawai');
INSERT INTO `users` VALUES (28, 5, 28, 5, 'Muhammad Sumbul', 'sumbul', '$2y$12$1EJzNTwlSK/hEoGrjyXUC.RB8s1DFepnrprwYY/pOxhX8/DKdRK5m', 'muhamadsumbul@gmail.com', 'pegawai');
INSERT INTO `users` VALUES (29, 8, 29, 4, 'Novie Sari', 'novie', '$2y$12$2Z/PFvjvmfjoFG1nokjaWelLcri6dvSvrd5.IscKYv.4cVpdCFqJq', 'noviesari@gmail.com', 'bidang');

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of whatsapp
-- ----------------------------
INSERT INTO `whatsapp` VALUES (1, '085156120370', '2024-07-13 06:25:30', '2024-07-13 06:25:30');

SET FOREIGN_KEY_CHECKS = 1;
