-- SQL untuk tabel kontak
-- Jalankan query ini di database ttis

-- Tabel untuk menyimpan informasi kontak (alamat, map, google maps api key)
CREATE TABLE IF NOT EXISTS `kontak_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alamat` text DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `jam_operasional` text DEFAULT NULL,
  `google_maps_api_key` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel untuk menyimpan daftar operator (dengan link WhatsApp)
CREATE TABLE IF NOT EXISTS `kontak_operator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `no_whatsapp` varchar(20) NOT NULL,
  `urutan` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel untuk menyimpan file PDF yang diupload admin untuk publik
CREATE TABLE IF NOT EXISTS `kontak_dokumen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `nama_file` varchar(255) NOT NULL,
  `ukuran_file` int(11) DEFAULT NULL,
  `tanggal_upload` datetime DEFAULT CURRENT_TIMESTAMP,
  `jumlah_download` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data default (opsional)
INSERT INTO `kontak_info` (`id`, `alamat`, `latitude`, `longitude`, `email`, `jam_operasional`, `google_maps_api_key`) 
VALUES (1, '', '', '', '', '', '')
ON DUPLICATE KEY UPDATE `id` = `id`;
