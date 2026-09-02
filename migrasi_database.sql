-- =====================================================================
-- Migrasi database TTIS - jalankan di server/VM agar skema sinkron
-- dengan environment development.
--
-- Aman dijalankan berulang kali (idempotent): tabel pakai IF NOT EXISTS,
-- kolom pakai ADD COLUMN IF NOT EXISTS (butuh MariaDB 10.0+ / MySQL 8.0.29+).
--
-- Urutan: jalankan file ini SETELAH import dump utama (ttis (1).sql) dan
-- kontak_tables.sql, karena beberapa tabel di sini melengkapi yang belum
-- ada di kedua file tersebut.
-- =====================================================================

-- Tabel public key PGP yang bisa diunduh publik (menu Kontak > Public Key)
CREATE TABLE IF NOT EXISTS `kontak_publickey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `nama_file` varchar(255) NOT NULL,
  `ukuran_file` int(11) DEFAULT NULL,
  `jumlah_download` int(11) DEFAULT 0,
  `tanggal_upload` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_upload` (`tanggal_upload`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel pesan masuk dari form kontak publik (lapor.php)
CREATE TABLE IF NOT EXISTS `kontak_pesan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subjek` varchar(200) NOT NULL,
  `pesan` text NOT NULL,
  `file_pdf` varchar(255) DEFAULT NULL,
  `tanggal` datetime NOT NULL,
  `status` enum('unread','read') DEFAULT 'unread',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabel dokumen RFC 2350 (menu admin RFC 2350 + halaman publik /rfc2350)
CREATE TABLE IF NOT EXISTS `rfc2350` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `versi` varchar(50) DEFAULT NULL,
  `tanggal_publikasi` date DEFAULT NULL,
  `nama_file` varchar(255) NOT NULL,
  `ukuran_file` int(11) DEFAULT NULL,
  `tanggal_upload` datetime DEFAULT current_timestamp(),
  `diupload_oleh` int(11) DEFAULT NULL,
  `status` enum('aktif','arsip') DEFAULT 'aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Kolom penghitung jumlah views berita (fitur "jumlah views berita")
ALTER TABLE `berita`
  ADD COLUMN IF NOT EXISTS `dilihat` int(10) unsigned NOT NULL DEFAULT 0 AFTER `status`;
