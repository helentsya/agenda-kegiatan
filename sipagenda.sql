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

 Date: 19/06/2024 22:09:09
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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cutis
-- ----------------------------
INSERT INTO `cutis` VALUES (3, 6, 'cuti tahunan', '2024-06-14', '5', 'sakit', 0, '2024-06-19 13:56:33', '2024-06-19 13:56:33');

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
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `migrations` VALUES (11, '2024_06_15_070257_create_sessions_table', 2);
INSERT INTO `migrations` VALUES (12, '2024_06_17_120817_add_id_bidang_to_users_table', 2);

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
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pegawais
-- ----------------------------
INSERT INTO `pegawais` VALUES (1, 1, 123456789, 'Budi', 'Laki-laki', 'Jakarta', '1990-01-01', 'Kepala Bagian', 'Jl. Jendral Sudirman No. 1', '2024-06-13 14:23:45', '2024-06-13 14:23:45');
INSERT INTO `pegawais` VALUES (2, 2, 987654321, 'Ani', 'Perempuan', 'Bandung', '1991-01-01', 'Staff', 'Jl. Jendral Sudirman No. 2', '2024-06-13 14:23:45', '2024-06-13 14:23:45');
INSERT INTO `pegawais` VALUES (3, 3, 123123123, 'Cici', 'Perempuan', 'Surabaya', '1992-01-01', 'Staff', 'Jl. Jendral Sudirman No. 3', '2024-06-13 14:23:45', '2024-06-13 14:23:45');
INSERT INTO `pegawais` VALUES (5, 3, 123321, 'Andri May', 'laki-laki', 'Marabahan', '2024-06-14', 'Pegawai', 'Marabahan', '2024-06-14 00:52:32', '2024-06-14 00:52:32');
INSERT INTO `pegawais` VALUES (6, 2, 123, 'Alghi Nuub', 'laki-laki', 'bjbe', '2003-02-22', 'HRD', 'Bbjb', '2024-06-17 12:47:32', '2024-06-18 13:45:12');

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengumumen
-- ----------------------------

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
  `nama_ruangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kapasitas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_ruang` enum('tersedia','tidak tersedia') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ruangans
-- ----------------------------
INSERT INTO `ruangans` VALUES (1, 'Ruangan 1', '11', 'tersedia', '2024-06-13 22:31:45', '2024-06-13 22:31:47');
INSERT INTO `ruangans` VALUES (2, 'Ruangan 2', '10', 'tersedia', '2024-06-13 22:31:58', '2024-06-13 22:31:59');

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
INSERT INTO `sessions` VALUES ('GQyBsDzowhtsuZ5GwveFsa2ws1t96alK2s4AlYqH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibGpVMUVFZElBaW5EcDI4am5VMDdnSVF5SVVjVG0xckdZalk4YjNlViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1718805412);

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
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 1, 0, 'Budi', 'admin', '$2y$12$skb02TKbhLzkSqzFrdzeWOcBKLoK/ToaPqYdzRhlyLCVuku8nvqd6', 'admin@test.com', 'admin');
INSERT INTO `users` VALUES (2, 2, 2, 'Ani', 'pegawai1', '$2y$12$skb02TKbhLzkSqzFrdzeWOcBKLoK/ToaPqYdzRhlyLCVuku8nvqd6', 'pegawai1@test.com', 'pegawai');
INSERT INTO `users` VALUES (3, 3, NULL, 'Cici', 'kepalapejabat', '$2y$12$skb02TKbhLzkSqzFrdzeWOcBKLoK/ToaPqYdzRhlyLCVuku8nvqd6', 'pegawai2@test.com', 'kepalapejabat');
INSERT INTO `users` VALUES (5, 5, NULL, 'Andri May', 'andri', '$2y$12$irLDsJxeHg4Wqv3jQzPpNekLo0ocdrwDPRtFp3iJZCy99ioH.L3Y6', 'andri@gmail.com', 'bidang');
INSERT INTO `users` VALUES (6, 6, NULL, 'Alghi Nuub', 'ColonialGT', '$2y$12$s8v02ST9HnJUZhmtG9pRq.r.rfoNe/SuGQcG9jlah8WZigZk3QZPW', 'alghe@gmail.com', 'bidang');

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
