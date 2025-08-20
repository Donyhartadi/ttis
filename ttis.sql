-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2025 at 09:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ttis`
--

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(8) NOT NULL,
  `kode_resi` varchar(20) NOT NULL,
  `nama_pelapor` varchar(256) NOT NULL,
  `no_hp` varchar(128) NOT NULL,
  `judul_laporan` varchar(256) NOT NULL,
  `link` varchar(128) NOT NULL,
  `deskripsi` text NOT NULL,
  `eviden` varchar(256) NOT NULL,
  `status_laporan` varchar(128) NOT NULL,
  `waktu_laporan` datetime NOT NULL,
  `status` enum('Menunggu','Diproses','Selesai') DEFAULT 'Menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `kode_resi`, `nama_pelapor`, `no_hp`, `judul_laporan`, `link`, `deskripsi`, `eviden`, `status_laporan`, `waktu_laporan`, `status`) VALUES
(32, 'LAP-0C612B98', 'DISKOMINFO SP', '082176227628', 'Website tidak bisa diakses', '10.10.10.226', 'Qiiqqi erikut adalah versi rapi dan bersih dari file HTML yang kamu berikan, khususnya pada bagian <script> di bawah yang sempat berantakan. Saya hanya fokus pada perapian dan koreksi struktur script, karena HTML-mu sudah cukup tertata baik. erikut adalah versi rapi dan bersih dari file HTML yang kamu berikan, khususnya pada bagian <script> di bawah yang sempat berantakan. Saya hanya fokus pada perapian dan koreksi struktur script, karena HTML-mu sudah cukup tertata baik.', 'IMG-20250716-WA0027.jpg', 'belum', '2025-07-16 14:33:36', 'Menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(128) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'Dony Hartadi', '$2y$10$3ISsnGFBuYer2u7GvRgRaOods/Ls8RaJhjPPB2hF3qrjt3I0IMgPK', 'A'),
(2, 'Hartadi', '$2y$10$fAngKEZ95LRR6wR/Xpi0y.FM5w99hwTkl8M7usc2Df4pwFRY3vrhS', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
