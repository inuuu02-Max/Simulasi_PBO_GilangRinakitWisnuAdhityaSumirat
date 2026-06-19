-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 19, 2026 at 03:22 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simulasi_pbo_kelas_gilangrinakitwisnuadhityasumirat`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pendaftaran`
--

CREATE TABLE `tabel_pendaftaran` (
  `id_pendaftaran` int NOT NULL,
  `nama_calon` varchar(100) NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `nilai_ujian` decimal(5,2) NOT NULL,
  `biaya_pendaftaran_dasar` decimal(10,2) NOT NULL,
  `jalur_pendaftaran` enum('Reguler','Prestasi','Kedinasan') NOT NULL,
  `pilihan_prodi` varchar(100) DEFAULT NULL,
  `lokasi_kampus` varchar(100) DEFAULT NULL,
  `jenis_prestasi` varchar(100) DEFAULT NULL,
  `tingkat_prestasi` varchar(50) DEFAULT NULL,
  `sk_ikatan_dinas` varchar(100) DEFAULT NULL,
  `instansi_sponsor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_pendaftaran`
--

INSERT INTO `tabel_pendaftaran` (`id_pendaftaran`, `nama_calon`, `asal_sekolah`, `nilai_ujian`, `biaya_pendaftaran_dasar`, `jalur_pendaftaran`, `pilihan_prodi`, `lokasi_kampus`, `jenis_prestasi`, `tingkat_prestasi`, `sk_ikatan_dinas`, `instansi_sponsor`) VALUES
(1, 'Ahmad Fauzan', 'SMAN 1 Wonosobo', 82.50, 300000.00, 'Reguler', 'Ilmu Politik', 'Kampus Utama', NULL, NULL, NULL, NULL),
(2, 'Siti Rahmawati', 'SMAN 1 Kawunganten', 78.00, 300000.00, 'Reguler', 'Ilmu Administrasi Negara', 'Kampus Utama', NULL, NULL, NULL, NULL),
(3, 'Dimas Anggara', 'SMAN 2 Wonosobo', 80.00, 300000.00, 'Reguler', 'Ilmu Komunikasi', 'Kampus 2', NULL, NULL, NULL, NULL),
(4, 'Nisa Sabyan', 'MAN 2 Wonosobo', 85.00, 300000.00, 'Reguler', 'Ilmu Politik', 'Kampus Utama', NULL, NULL, NULL, NULL),
(5, 'Rizal Kurniawan', 'SMAN 1 Cilacap', 76.50, 300000.00, 'Reguler', 'Ilmu Administrasi Negara', 'Kampus Utama', NULL, NULL, NULL, NULL),
(6, 'Dewi Lestari', 'SMKN 1 Wonosobo', 81.00, 300000.00, 'Reguler', 'Ilmu Politik', 'Kampus 2', NULL, NULL, NULL, NULL),
(7, 'Gilang Pratama', 'SMA Muhammadiyah', 79.50, 300000.00, 'Reguler', 'Ilmu Komunikasi', 'Kampus Utama', NULL, NULL, NULL, NULL),
(8, 'Budi Santoso', 'SMAN 1 Wonosobo', 92.00, 300000.00, 'Prestasi', 'Ilmu Administrasi Negara', 'Kampus Utama', 'Juara 1 Lomba Debat', 'Nasional', NULL, NULL),
(9, 'Andi Wijaya', 'SMAN 1 Kawunganten', 89.50, 300000.00, 'Prestasi', 'Ilmu Politik', 'Kampus Utama', 'Olimpiade Sosiologi', 'Provinsi', NULL, NULL),
(10, 'Rina Melati', 'SMAN 2 Wonosobo', 91.00, 300000.00, 'Prestasi', 'Ilmu Komunikasi', 'Kampus Utama', 'Juara 1 Pidato Bahasa Inggris', 'Kabupaten', NULL, NULL),
(11, 'Dian Pelangi', 'MAN 1 Cilacap', 88.00, 300000.00, 'Prestasi', 'Ilmu Politik', 'Kampus 2', 'Hafidz Quran 10 Juz', 'Nasional', NULL, NULL),
(12, 'Fajar Nugroho', 'SMAN 3 Cilacap', 90.50, 300000.00, 'Prestasi', 'Ilmu Administrasi Negara', 'Kampus Utama', 'Atlet Pencak Silat', 'Provinsi', NULL, NULL),
(13, 'Maya Safitri', 'SMKN 1 Wonosobo', 93.00, 300000.00, 'Prestasi', 'Ilmu Komunikasi', 'Kampus Utama', 'Juara 1 Desain Grafis', 'Nasional', NULL, NULL),
(14, 'Eko Prasetyo', 'SMA Takhassus Al-Quran', 89.00, 300000.00, 'Prestasi', 'Ilmu Politik', 'Kampus Utama', 'Lomba Karya Tulis Ilmiah', 'Provinsi', NULL, NULL),
(15, 'Aditya Pratama', 'SMAN 1 Cilacap', 87.00, 300000.00, 'Kedinasan', 'Ilmu Administrasi Negara', 'Kampus Utama', NULL, NULL, 'SK-PEMDA-001', 'Pemkab Cilacap'),
(16, 'Putri Ayu', 'SMAN 1 Wonosobo', 86.50, 300000.00, 'Kedinasan', 'Ilmu Administrasi Negara', 'Kampus Utama', NULL, NULL, 'SK-PEMDA-022', 'Pemkab Wonosobo'),
(17, 'Wahyu Hidayat', 'SMKN 2 Cilacap', 85.00, 300000.00, 'Kedinasan', 'Ilmu Politik', 'Kampus Utama', NULL, NULL, 'SK-BUMN-104', 'PT Pertamina'),
(18, 'Ratna Galih', 'SMAN 1 Kawunganten', 88.50, 300000.00, 'Kedinasan', 'Ilmu Komunikasi', 'Kampus Utama', NULL, NULL, 'SK-KEMENAG-99', 'Kemenag Cilacap'),
(19, 'Surya Saputra', 'MAN 2 Wonosobo', 84.00, 300000.00, 'Kedinasan', 'Ilmu Administrasi Negara', 'Kampus Utama', NULL, NULL, 'SK-DESA-05', 'Pemerintah Desa Ujungmanik'),
(20, 'Intan Permata', 'SMAN 2 Wonosobo', 87.50, 300000.00, 'Kedinasan', 'Ilmu Politik', 'Kampus Utama', NULL, NULL, 'SK-PEMDA-045', 'Pemprov Jawa Tengah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  MODIFY `id_pendaftaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
