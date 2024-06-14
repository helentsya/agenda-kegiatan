-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2024 at 10:32 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipagenda`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidangs`
--

CREATE TABLE `bidangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_bidang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bidangs`
--

INSERT INTO `bidangs` (`id`, `nama_bidang`, `created_at`, `updated_at`) VALUES
(1, 'Bidang Sekretariat', '2024-06-13 06:23:45', '2024-06-13 06:23:45'),
(2, 'Bidang Informatika', '2024-06-13 06:23:45', '2024-06-13 06:23:45'),
(3, 'Bidang Komunikasi', '2024-06-13 06:23:45', '2024-06-13 06:23:45'),
(4, 'Bidang Statistika Persandian', '2024-06-13 06:23:45', '2024-06-13 06:23:45');

-- --------------------------------------------------------

--
-- Table structure for table `cutis`
--

CREATE TABLE `cutis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pegawai` bigint(20) UNSIGNED NOT NULL,
  `jenis_cuti` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mulai_cuti` date NOT NULL,
  `lama_cuti` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_approved` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kategori` bigint(20) UNSIGNED NOT NULL,
  `id_ruangan` bigint(20) UNSIGNED NOT NULL,
  `id_bidang` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dihadiri` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pakaian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_event` datetime NOT NULL,
  `end_event` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `id_kategori`, `id_ruangan`, `id_bidang`, `title`, `dihadiri`, `pakaian`, `keterangan`, `start_event`, `end_event`) VALUES
(2, 2, 1, 3, 'Acara 1 hbjbj', 'as dasndkas', 's adkandkadnasd', 'aj ssdjknasdnas', '2024-06-13 10:10:00', NULL),
(4, 2, 1, 2, 'Acara 1 hbjbj', 'as dasndkas', 's adkandkadnasd', 'aj ssdjknasdnas', '2024-06-14 10:10:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_kegiatans`
--

CREATE TABLE `kategori_kegiatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_kegiatans`
--

INSERT INTO `kategori_kegiatans` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Pendidikan', '2024-06-13 06:23:45', '2024-06-13 06:23:45'),
(2, 'Pelatihan', '2024-06-13 06:23:45', '2024-06-13 06:23:45'),
(3, 'Seminar', '2024-06-13 06:23:45', '2024-06-13 06:23:45'),
(4, 'Workshop', '2024-06-13 06:23:45', '2024-06-13 06:23:45'),
(5, 'Pengabdian Masyarakat', '2024-06-13 06:23:45', '2024-06-13 06:23:45'),
(6, 'Penelitian', '2024-06-13 06:23:45', '2024-06-13 06:23:45'),
(7, 'Pengembangan Diri', '2024-06-13 06:23:45', '2024-06-13 06:23:45'),
(8, 'Lainnya', '2024-06-13 06:23:45', '2024-06-13 06:23:45');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_12_28_032118_create_table_whatsapp', 1),
(3, '2024_04_06_090117_create_bidangs_table', 1),
(4, '2024_04_06_090118_create_pegawais_table', 1),
(5, '2024_04_23_131938_create_table_users', 1),
(6, '2024_04_26_091326_create_table_cutis', 1),
(7, '2024_04_30_103417_create_ruangans_table', 1),
(8, '2024_04_30_103418_create_kategori_kegiatans_table', 1),
(9, '2024_04_30_103419_create_table_events', 1),
(10, '2024_05_07_065136_create_pengumumen_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pegawais`
--

CREATE TABLE `pegawais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_bidang` bigint(20) UNSIGNED NOT NULL,
  `nip` int(11) NOT NULL,
  `nama_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawais`
--

INSERT INTO `pegawais` (`id`, `id_bidang`, `nip`, `nama_pegawai`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `jabatan`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 1, 123456789, 'Budi', 'Laki-laki', 'Jakarta', '1990-01-01', 'Kepala Bagian', 'Jl. Jendral Sudirman No. 1', '2024-06-13 06:23:45', '2024-06-13 06:23:45'),
(2, 2, 987654321, 'Ani', 'Perempuan', 'Bandung', '1991-01-01', 'Staff', 'Jl. Jendral Sudirman No. 2', '2024-06-13 06:23:45', '2024-06-13 06:23:45'),
(3, 3, 123123123, 'Cici', 'Perempuan', 'Surabaya', '1992-01-01', 'Staff', 'Jl. Jendral Sudirman No. 3', '2024-06-13 06:23:45', '2024-06-13 06:23:45'),
(5, 3, 123321, 'Andri May', 'laki-laki', 'Marabahan', '2024-06-14', 'Pegawai', 'Marabahan', '2024-06-13 16:52:32', '2024-06-13 16:52:32');

-- --------------------------------------------------------

--
-- Table structure for table `pengumumen`
--

CREATE TABLE `pengumumen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul_pengumuman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_pengumuman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pengumuman` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ruangans`
--

CREATE TABLE `ruangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_ruangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kapasitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_ruang` enum('tersedia','tidak tersedia') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ruangans`
--

INSERT INTO `ruangans` (`id`, `nama_ruangan`, `kapasitas`, `status_ruang`, `created_at`, `updated_at`) VALUES
(1, 'Ruangan 1', '11', 'tersedia', '2024-06-13 14:31:45', '2024-06-13 14:31:47'),
(2, 'Ruangan 2', '10', 'tersedia', '2024-06-13 14:31:58', '2024-06-13 14:31:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pegawai` bigint(20) UNSIGNED NOT NULL,
  `nama_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` enum('pegawai','admin','kepalapejabat','bidang') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_pegawai`, `nama_user`, `username`, `password`, `email`, `roles`) VALUES
(1, 1, 'Budi', 'admin', '$2y$12$skb02TKbhLzkSqzFrdzeWOcBKLoK/ToaPqYdzRhlyLCVuku8nvqd6', 'admin@test.com', 'admin'),
(2, 2, 'Ani', 'pegawai1', '$2y$12$skb02TKbhLzkSqzFrdzeWOcBKLoK/ToaPqYdzRhlyLCVuku8nvqd6', 'pegawai1@test.com', 'pegawai'),
(3, 3, 'Cici', 'kepalapejabat', '$2y$12$skb02TKbhLzkSqzFrdzeWOcBKLoK/ToaPqYdzRhlyLCVuku8nvqd6', 'pegawai2@test.com', 'kepalapejabat'),
(5, 5, 'Andri May', 'andri', '$2y$12$irLDsJxeHg4Wqv3jQzPpNekLo0ocdrwDPRtFp3iJZCy99ioH.L3Y6', 'andri@gmail.com', 'bidang');

-- --------------------------------------------------------

--
-- Table structure for table `whatsapp`
--

CREATE TABLE `whatsapp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_telepon` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bidangs`
--
ALTER TABLE `bidangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cutis`
--
ALTER TABLE `cutis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cutis_id_pegawai_foreign` (`id_pegawai`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_id_kategori_foreign` (`id_kategori`),
  ADD KEY `events_id_ruangan_foreign` (`id_ruangan`);

--
-- Indexes for table `kategori_kegiatans`
--
ALTER TABLE `kategori_kegiatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawais`
--
ALTER TABLE `pegawais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pegawais_id_bidang_foreign` (`id_bidang`);

--
-- Indexes for table `pengumumen`
--
ALTER TABLE `pengumumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `ruangans`
--
ALTER TABLE `ruangans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id_pegawai_foreign` (`id_pegawai`);

--
-- Indexes for table `whatsapp`
--
ALTER TABLE `whatsapp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bidangs`
--
ALTER TABLE `bidangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cutis`
--
ALTER TABLE `cutis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori_kegiatans`
--
ALTER TABLE `kategori_kegiatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pegawais`
--
ALTER TABLE `pegawais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengumumen`
--
ALTER TABLE `pengumumen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ruangans`
--
ALTER TABLE `ruangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `whatsapp`
--
ALTER TABLE `whatsapp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cutis`
--
ALTER TABLE `cutis`
  ADD CONSTRAINT `cutis_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawais` (`id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_kegiatans` (`id`),
  ADD CONSTRAINT `events_id_ruangan_foreign` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangans` (`id`);

--
-- Constraints for table `pegawais`
--
ALTER TABLE `pegawais`
  ADD CONSTRAINT `pegawais_id_bidang_foreign` FOREIGN KEY (`id_bidang`) REFERENCES `bidangs` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawais` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
