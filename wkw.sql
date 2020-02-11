-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 11 Feb 2020 pada 10.25
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wkw`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_logs`
--

CREATE TABLE `activity_logs` (
  `activity_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `company_id` int(11) UNSIGNED NOT NULL,
  `activity_type` varchar(64) NOT NULL,
  `activity_data` text,
  `activity_time` datetime NOT NULL,
  `activity_ip_address` varchar(15) DEFAULT NULL,
  `activity_device` varchar(32) DEFAULT NULL,
  `activity_os` varchar(16) DEFAULT NULL,
  `activity_browser` varchar(16) DEFAULT NULL,
  `activity_location` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `apbdes`
--

CREATE TABLE `apbdes` (
  `id_apbdes` int(9) NOT NULL,
  `tahun` int(4) NOT NULL,
  `keterangan` enum('pengeluaran','pendapatan') NOT NULL,
  `kategori` text NOT NULL,
  `rincian` text NOT NULL,
  `nominal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(9) NOT NULL,
  `judul` text NOT NULL,
  `foto` text NOT NULL,
  `isi` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id_berita`, `judul`, `foto`, `isi`, `created_at`) VALUES
(0, 'Kue Penyu Cap Go Meh Perlambang Panjang Usia', '1.jpg', 'Kue berbentuk penyu jadi penganan khas saat Cap Go Meh di Buleleng, Bali. Penyu dipilih sebagai hewan yang panjang usia. Warga keturunan Tionghoa berharap kue penyu dapat berdampak terhadap kehidupan.', '2020-02-10 00:00:00'),
(1, 'Perajin Arak, Tuak, dan Brem di Seluruh Bali Akan Didata', '2.jpg', 'Kepala Dinas Perindustrian dan Perdagangan Bali Wayan Jarta mengatakan, pihaknya akan mendata para perajin tuak, arak, dan brem yang ada di Bali. Sebab, sebelum dilegalkannya minuman fermentasi khas Bali, para perajian yang termasuk skala kecil memproduksi arak secara sembunyi-sembunyi. Hingga saat ini, Dinas Perindustrian dan Perdagangan Bali belum memiliki data pasti berapa jumlah perajin minuman keras khas Bali tersebut.', '2020-02-02 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kependudukan`
--

CREATE TABLE `data_kependudukan` (
  `monografi_kependudukan` int(9) NOT NULL,
  `kategori` text NOT NULL,
  `keterangan` text NOT NULL,
  `jumlah` text NOT NULL,
  `tahun` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumentasi_pemakaian_apbdes`
--

CREATE TABLE `dokumentasi_pemakaian_apbdes` (
  `id_dokumentasi_pemakaian_apbdes` int(9) NOT NULL,
  `id_apbdes` int(9) NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `masyarakat`
--

CREATE TABLE `masyarakat` (
  `id` int(9) NOT NULL,
  `user_id` int(9) NOT NULL,
  `nama` text NOT NULL,
  `alamat` text NOT NULL,
  `rt` text NOT NULL,
  `rw` text NOT NULL,
  `nik` text NOT NULL,
  `foto_ktp` text NOT NULL,
  `foto_selfie` text NOT NULL,
  `no_hp` text NOT NULL,
  `email` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` int(9) NOT NULL,
  `user_id` int(9) NOT NULL,
  `pesan` text,
  `foto` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permohonan_informasi`
--

CREATE TABLE `permohonan_informasi` (
  `id_permohonan_informasi` int(9) NOT NULL,
  `id_ppid` int(9) NOT NULL,
  `kategori` enum('Pribadi','Lembaga') NOT NULL,
  `user_id` int(9) NOT NULL,
  `nama` text NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` text NOT NULL,
  `email` text,
  `rincian_informasi_yang_dibutuhkan` text NOT NULL,
  `tujuan` text NOT NULL,
  `cara_memperoleh` text NOT NULL,
  `cara_mendapatkan` text NOT NULL,
  `file_ktp` text NOT NULL,
  `file_badan_hukum` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `potensi_desa`
--

CREATE TABLE `potensi_desa` (
  `id_potensi_desa` int(9) NOT NULL,
  `judul` text NOT NULL,
  `foto` text NOT NULL,
  `isi` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `potensi_desa`
--

INSERT INTO `potensi_desa` (`id_potensi_desa`, `judul`, `foto`, `isi`, `created_at`) VALUES
(0, 'Batik Rifaiyah', '1.jpg', 'Mengenal Batik Rifaiyah Khas Batang, Keunikan Motif hingga Proses Membatik yang Kaya Makna Spiritual', '2020-02-02 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ppid`
--

CREATE TABLE `ppid` (
  `id_ppid` int(9) NOT NULL,
  `tahun` int(4) DEFAULT NULL,
  `kategori` text NOT NULL,
  `judul` text,
  `file` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rencana_apbdes`
--

CREATE TABLE `rencana_apbdes` (
  `id_rencana_apbdes` int(9) NOT NULL,
  `tahun` int(4) NOT NULL,
  `keterangan` text NOT NULL,
  `nominal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(9) UNSIGNED NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `pass` varchar(64) DEFAULT NULL,
  `fullname` text NOT NULL,
  `photo` text,
  `total_login` int(9) UNSIGNED NOT NULL DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `login_attempts` int(9) UNSIGNED DEFAULT '0',
  `last_login_attempt` datetime DEFAULT NULL,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text,
  `ip_address` text,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `verification_token` varchar(128) DEFAULT NULL,
  `recovery_token` varchar(128) DEFAULT NULL,
  `unlock_token` varchar(128) DEFAULT NULL,
  `created_by` int(9) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(9) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` int(9) UNSIGNED DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `pass`, `fullname`, `photo`, `total_login`, `last_login`, `last_activity`, `login_attempts`, `last_login_attempt`, `remember_time`, `remember_exp`, `ip_address`, `is_active`, `verification_token`, `recovery_token`, `unlock_token`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `deleted`) VALUES
(0, 'admin', '1', 'Administrator', NULL, 9, '2020-02-10 19:05:56', '2020-02-10 19:05:56', 9, '2020-02-10 19:05:56', NULL, NULL, '::1', 1, NULL, NULL, NULL, 0, '2019-12-07 22:15:17', NULL, NULL, NULL, NULL, 0),
(1, 'adm', '1', 'Administrator', NULL, 7, '2020-02-10 06:31:54', '2020-02-10 06:31:54', 7, '2020-02-10 06:31:54', NULL, NULL, '::1', 1, NULL, NULL, NULL, 0, '2019-12-08 23:32:46', NULL, NULL, NULL, NULL, 0),
(2, 'warga', '1', 'Sugiyono', NULL, 7, '2020-02-11 16:08:12', '2020-02-11 16:08:12', 7, '2020-02-11 16:08:12', NULL, NULL, '::1', 1, NULL, NULL, NULL, 0, '2020-01-27 20:01:22', NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) UNSIGNED NOT NULL,
  `company_id` int(9) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `definition` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `route` varchar(32) DEFAULT NULL,
  `created_by` int(9) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(9) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` int(9) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `company_id`, `name`, `definition`, `description`, `route`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `deleted`) VALUES
(0, NULL, 'Super Admin', 'Super Administrator', NULL, 'admin_side/beranda', 0, '2018-10-27 17:52:08', NULL, NULL, NULL, NULL, 0),
(1, NULL, 'Admin', 'Administrator (Owner)', 'Admin Kelurahan', 'admin_side/beranda', 0, '2017-03-06 01:19:26', 2, '2018-10-27 18:55:37', NULL, NULL, 0),
(2, NULL, 'Pemohon', 'Masyarakat', NULL, 'member_side/beranda', 0, '2017-03-06 01:19:26', NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_to_role`
--

CREATE TABLE `user_to_role` (
  `user_id` int(9) UNSIGNED NOT NULL DEFAULT '0',
  `role_id` int(9) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user_to_role`
--

INSERT INTO `user_to_role` (`user_id`, `role_id`) VALUES
(0, 0),
(1, 1),
(2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apbdes`
--
ALTER TABLE `apbdes`
  ADD PRIMARY KEY (`id_apbdes`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `data_kependudukan`
--
ALTER TABLE `data_kependudukan`
  ADD PRIMARY KEY (`monografi_kependudukan`);

--
-- Indexes for table `dokumentasi_pemakaian_apbdes`
--
ALTER TABLE `dokumentasi_pemakaian_apbdes`
  ADD PRIMARY KEY (`id_dokumentasi_pemakaian_apbdes`),
  ADD KEY `id_apbdes` (`id_apbdes`);

--
-- Indexes for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `permohonan_informasi`
--
ALTER TABLE `permohonan_informasi`
  ADD PRIMARY KEY (`id_permohonan_informasi`),
  ADD KEY `id_ppid` (`id_ppid`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `potensi_desa`
--
ALTER TABLE `potensi_desa`
  ADD PRIMARY KEY (`id_potensi_desa`);

--
-- Indexes for table `ppid`
--
ALTER TABLE `ppid`
  ADD PRIMARY KEY (`id_ppid`);

--
-- Indexes for table `rencana_apbdes`
--
ALTER TABLE `rencana_apbdes`
  ADD PRIMARY KEY (`id_rencana_apbdes`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_index` (`username`),
  ADD KEY `is_active_index` (`is_active`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name_index` (`name`),
  ADD KEY `company_id_index` (`company_id`) USING BTREE;

--
-- Indexes for table `user_to_role`
--
ALTER TABLE `user_to_role`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_id_index` (`role_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apbdes`
--
ALTER TABLE `apbdes`
  MODIFY `id_apbdes` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `data_kependudukan`
--
ALTER TABLE `data_kependudukan`
  MODIFY `monografi_kependudukan` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dokumentasi_pemakaian_apbdes`
--
ALTER TABLE `dokumentasi_pemakaian_apbdes`
  MODIFY `id_dokumentasi_pemakaian_apbdes` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `masyarakat`
--
ALTER TABLE `masyarakat`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permohonan_informasi`
--
ALTER TABLE `permohonan_informasi`
  MODIFY `id_permohonan_informasi` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `potensi_desa`
--
ALTER TABLE `potensi_desa`
  MODIFY `id_potensi_desa` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ppid`
--
ALTER TABLE `ppid`
  MODIFY `id_ppid` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rencana_apbdes`
--
ALTER TABLE `rencana_apbdes`
  MODIFY `id_rencana_apbdes` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
