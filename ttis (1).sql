-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Sep 2025 pada 03.10
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `kegiatan_id` int(11) NOT NULL,
  `nama_peserta` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `asal_opd` varchar(255) DEFAULT NULL,
  `saran_masukan` text DEFAULT NULL,
  `waktu_absen` datetime DEFAULT current_timestamp(),
  `kepuasan` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id`, `kegiatan_id`, `nama_peserta`, `email`, `asal_opd`, `saran_masukan`, `waktu_absen`, `kepuasan`) VALUES
(42, 1, 'Dony Hartadi', 'ghhh@sksk.com', 'Donnie', 'Testingg', '2025-09-25 14:52:30', 'Ya'),
(43, 1, 'Rulian Mardiansyah ', 'rulianmardiansyah3@gmail.com', 'Diskominfo ', 'Tausksslsms', '2025-09-26 08:36:42', 'Ya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `isi` text NOT NULL,
  `ringkasan` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `penulis` varchar(100) DEFAULT NULL,
  `dibuat_pada` datetime DEFAULT current_timestamp(),
  `diperbarui_pada` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('draft','publish') DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id`, `judul`, `tanggal`, `kategori`, `isi`, `ringkasan`, `gambar`, `slug`, `penulis`, `dibuat_pada`, `diperbarui_pada`, `status`) VALUES
(7, 'DAMPAK PORNOGRAFI PADA ANAK', '2025-07-25', 'Literasi Digital', 'Halodoc, Jakarta – Ada sekitar 569 pasangan di Kabupaten Kediri, Jawa Timur, yang mengajukan dispensasi untuk bisa menikah di bawah usia yang ditentukan oleh Undang-Undang Nomor 16 Tahun 2019 tentang Perkawinan. Kebanyakan pasangan tersebut berusia 15-17 tahun dan sebagian permohonan diajukan karena pasangan telah hamil di luar nikah.\r\n\r\nMenurut humas dari Dinas Pengendalian Penduduk, Keluarga Berencana, Pemberdayaan Perempuan, dan Perlindungan Anak Kabupaten Kediri, tingginya anak yang hamil diluar nikah bisa disebabkan oleh beberapa faktor, salah satunya pengaruh tontonan pornografi. Kecanduan pornografi memang dapat menyebabkan ancaman bagi perkembangan dan pertumbuhan anak.\r\n\r\nSebaiknya orang tua tetap waspada terhadap dampak negatif akibat kecanduan pornografi. Lakukanlah tindakan pencegahan atas kondisi ini agar tumbuh kembang anak bisa berjalan secara optimal.\r\nHalodoc, Jakarta – Ada sekitar 569 pasangan di Kabupaten Kediri, Jawa Timur, yang mengajukan dispensasi untuk bisa menikah di bawah usia yang ditentukan oleh Undang-Undang Nomor 16 Tahun 2019 tentang Perkawinan. Kebanyakan pasangan tersebut berusia 15-17 tahun dan sebagian permohonan diajukan karena pasangan telah hamil di luar nikah.\r\n\r\nMenurut humas dari Dinas Pengendalian Penduduk, Keluarga Berencana, Pemberdayaan Perempuan, dan Perlindungan Anak Kabupaten Kediri, tingginya anak yang hamil diluar nikah bisa disebabkan oleh beberapa faktor, salah satunya pengaruh tontonan pornografi. Kecanduan pornografi memang dapat menyebabkan ancaman bagi perkembangan dan pertumbuhan anak.\r\n\r\nSebaiknya orang tua tetap waspada terhadap dampak negatif akibat kecanduan pornografi. Lakukanlah tindakan pencegahan atas kondisi ini agar tumbuh kembang anak bisa berjalan secara optimal.\r\n', 'Halodoc, Jakarta – Ada sekitar 569 pasangan di Kabupaten Kediri, Jawa Timur, yang mengajukan dispensasi untuk bisa menikah di bawah usia yang ditentukan oleh Undang-Undang Nomor 16 Tahun 2019 tentang&#8230;', '1753414930.jpg', 'terintegrasi', NULL, '2025-07-25 10:42:10', '2025-07-25 10:46:26', 'draft'),
(11, 'Tim TTIS Kabupaten Muara Enim melaksanankan pelaporan inovasi', '2025-07-28', 'Inovasi daerah', 'Muara Enim, 29 Juli 2025 – Pelaporan inovasi tahunan Tim TTIS Kabupaten Muara Enim tahun ini dilaksanakan secara daring melalui sistem SINOME (Sistem Inovasi Menembus Era-digital). Terdengar canggih, tapi tidak bagi para petugas yang masih trauma dengan loading tanpa ujung dan captcha bergambar zebra silang.\r\n\r\nDua staf pelaksana, Septa dan Dony, sejak pagi sudah siap di depan laptop. Tapi bukan langsung mengisi data—mereka menghabiskan 45 menit hanya untuk klik “Lupa Password”.\r\n\r\n“Saya yakin password-nya TTIS2023, eh ternyata akun saya malah dikunci,” kata Dony yang akhirnya harus pakai akun Septa buat login.\r\n\r\nSepta, yang biasanya jago bikin konten medsos, sempat terpaku 20 menit karena field isian SINOME “tidak menerima emoji dan kata alay”. “Saya kira bisa dikasih judul inovasi: ‘Senyum Rakyat Ceriaaa~’, ternyata ditolak sistem,” ujarnya kecewa.\r\n\r\nSementara itu, Alex, staf senior, tetap santai. Ia sudah menyiapkan semua data sejak seminggu lalu. \"Kuncinya cuma satu: jangan percaya jaringan internet saat deadline,\" katanya sambil membuka hotspot pribadi dan menolak tawaran kopi sachet.\r\n\r\nKetua Tim, Bu Yuliani, memimpin dengan penuh semangat meskipun sempat salah kirim pelaporan ke akun kabupaten sebelah. “Saya kira cuma ada satu Muara Enim. Ternyata itu Muara Enim yang dummy,” katanya sambil tertawa sambil menahan stres.\r\n\r\nTak cukup sampai di situ, saat hendak mengunggah file PDF inovasi, SINOME tiba-tiba menampilkan pesan sakral:\r\n\r\n“Ukuran file melebihi batas. Maksimal 2 MB. Harap dikompres tanpa mengurangi kualitas dan jiwa inovatif Anda.”\r\n\r\nSetelah melewati berbagai rintangan seperti:\r\n\r\nFormat file wajib PDF-A (yang entah beda apa dengan PDF biasa),\r\n\r\nIsian deskripsi maksimal 1000 karakter (padahal penjelasan Dony 3 halaman A4),\r\n\r\nDan tombol \"Simpan\" yang hanya aktif kalau browser dalam mode incognito,\r\n\r\nAkhirnya laporan berhasil di-submit.\r\n\r\n“Ini bukan sekadar pelaporan. Ini survival digital,” kata Bu Yuliani, bangga, walau dengan tatapan kosong seperti habis ikut webinar 8 jam tanpa snack.', 'Muara Enim, 29 Juli 2025 – Pelaporan inovasi tahunan Tim TTIS Kabupaten Muara Enim tahun ini dilaksanakan secara daring melalui sistem SINOME (Sistem Inovasi Menembus Era-digital). Terdengar canggih, tapi tidak&#8230;', '1753667212.jpg', 'tim-ttis-kabupaten-muara-enim-melaksanankan-pelaporan-inovasi', NULL, '2025-07-28 08:46:52', '2025-07-29 07:40:37', 'draft'),
(12, 'Survey Pelayanan Publik Diskominfo SP Bidang Perski', '2025-07-28', 'Survey', 'Muara Enim, 29 Juli 2025 – Bidang Persandian dan Keamanan Informasi (Perski) Diskominfo SP Kabupaten Muara Enim kembali melaksanakan kegiatan Survey Kepuasan Masyarakat (SKM). Kali ini bukan sekadar rutinitas biasa, tapi juga ajang unjuk gaya tiap personel—dari yang rajin nginput sampai yang rajin bercanda.\r\n\r\nSepta memulai hari dengan membuka laptop sambil berkata, “Target kita hari ini: 100 responden, 0 typo, dan 1 kopi hitam.” Ia dengan serius memeriksa satu per satu jawaban warga, bahkan sampai menghitung jumlah huruf pada kolom komentar. “Ini penting, siapa tahu ada kata kunci tersembunyi,” ujarnya penuh dedikasi.\r\n\r\nDi sisi lain, Dony sudah mulai frustrasi saat mendapati ada responden yang hanya isi satu kolom, lalu submit. “Ini survei, bukan kuis tebak-tebakan. Masa cuma jawab ‘oke’?” katanya sambil menghela napas panjang, lalu ngisi ulang minuman isotoniknya.\r\n\r\nDatanglah Anita, sang pemecah suasana. Dengan donat di tangan dan semangat 80?rcanda 20% kerja, dia menyapa:\r\n\r\n“Kalau survei ini berhasil, saya mau usul: tahun depan bikin survei tentang siapa paling lucu di kantor. Tapi saya sudah tahu pemenangnya: Bu Yuliani!”\r\n\r\nBu Yuliani, yang sedang mengetik rekap indikator pelayanan sambil tahan ketawa, menimpali, “Nita, kamu itu cocoknya jadi indikator kebahagiaan karyawan, bukan pelaksana survei.”\r\n\r\nDi tengah riuhnya suasana, muncullah Alex—staf senior penuh wibawa dan teh panas. Ia tidak banyak bicara, tapi setiap kalimatnya seperti kutipan buku motivasi.\r\n\r\n“Kualitas pelayanan itu cerminan dari cara kita memandang data. Jangan cuma cari nilai tinggi, cari makna di balik responden,” ucapnya sambil memperbaiki format dokumen dan menutup 17 tab browser yang dibuka Dony tanpa sadar.\r\n\r\nAlex juga jadi penengah saat Septa dan Dony mulai berdiskusi panjang soal format grafik. “Kita bukan mau bikin infografis buat NASA. Bikin sederhana tapi kena,” katanya bijak sambil menyeruput teh.\r\n\r\nSaat sistem SINOME sempat lemot selama 10 menit, semua panik—kecuali Alex. “Tenang, ini bagian dari ujian kesabaran. Namanya juga sistem, bukan keajaiban.”\r\n\r\nDi akhir hari, tim berhasil menyelesaikan entri data tanpa korban perasaan atau konflik antar-spreadsheet. Bu Yuliani menutup kegiatan dengan kalimat penyemangat:\r\n\r\n“Terima kasih semua. Ini bukan cuma soal survei, ini bukti kalau kerja tim bisa terasa kayak keluarga—keluarga yang suka debat soal warna grafik.”\r\n\r\nAnita pun menambahkan, “Yang penting, masyarakat puas. Kita? Cukup dengan donat dan tawa.”\r\nKarena meskipun di balik layar ada Septa yang serius, Dony yang ngulik, Anita yang bercanda, Alex yang bijak, dan Bu Yuliani yang multitasking sambil tahan tawa—semua ini dilakukan demi satu tujuan: memberikan pelayanan publik yang lebih baik, lebih cepat, dan lebih ramah untuk kamu.\r\n\r\nSetiap jawaban yang kamu isi, sekecil apapun, jadi bahan refleksi dan perbaikan kami.\r\nMau pelayanan makin mantap? Mau sistem makin mudah diakses? Atau sekadar ingin bilang “semangat ya, Diskominfo!”? Semua bisa kamu sampaikan lewat survey ini. ???? Isi surveinya sekarang. Biar kamu gak cuma jadi penonton perubahan, tapi bagian dari yang bikin perubahan itu terjadi. Karena pelayanan publik yang baik… dimulai dari feedback publik yang jujur. Link bisa diakses lewat QR atau langsung di https://skmmuaraenimkab.pandhie.id/survey/7 , terimakasih ! ', 'Muara Enim, 29 Juli 2025 – Bidang Persandian dan Keamanan Informasi (Perski) Diskominfo SP Kabupaten Muara Enim kembali melaksanakan kegiatan Survey Kepuasan Masyarakat (SKM). Kali ini bukan sekadar rutinitas biasa,&#8230;', '1753671156.jpg', 'survey-pelayanan-publik-diskominfo-sp-bidang-perski', NULL, '2025-07-28 09:52:36', '2025-07-29 07:46:55', 'draft');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `waktu_kegiatan` datetime DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `sertifikat_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_absensi_open` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `nama_kegiatan`, `waktu_kegiatan`, `keterangan`, `gambar`, `lampiran`, `sertifikat_link`, `created_at`, `is_absensi_open`) VALUES
(1, 'WEBINAR KEGIATAN KEAMANAN INFORMASI PERANGKAT DAERAH SEKABUPATEN MUARA ENIM', '2025-10-08 08:00:00', 'Diskominfo kab. Muara Enim mengundang Anda untuk bergabung ke rapat Zoom yang terjadwal.\r\nTopik: Webinar Keamanan Informasi dengan Tema \"Literasi Digital untuk Perlindungan Data di Era Teknologi 4.0\"\r\nWaktu: 8 Okt 2025 08:00 AM Jakarta\r\nBergabung ke Rapat Zoom\r\nhttps://zoom.us/j/7561254901?pwd=vCZ5AhMppmBJdLFl9bRkHiF4aAtqM7.1&omn=97735551523\r\nID Rapat: 756 125 4901\r\nKode Sandi: muaraenim\r\n', '1757992335.png', '[\"d29dda66076e01c9a57d6c3be6a561ef.pdf\"]', '', '2025-09-16 03:09:53', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
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
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `kode_resi`, `nama_pelapor`, `no_hp`, `judul_laporan`, `link`, `deskripsi`, `eviden`, `status_laporan`, `waktu_laporan`, `status`) VALUES
(51, 'LAP-757EF9A1', 'Reva Tasqirah', '082112504406', 'Website tidak bisa diakses', 'www.muaraenimkab.go.id', 'Lorem Ipsum Dolor Sit Amet Nasfff fiofwq-3 -qq3-e0e-0qeiqe qe  ee-0q0e-qi  -ie-0ieje fpsjfsf  epfp fe sjpofs epfonafnaw;ef    [wejf pejf apj  jfpwpfjwfw pfjwe fwe[fj weapf wej fwe fiew fewi[fjeif[wej fiew[ fjweifwe[ fewj fi[e je [fie [weifwejfwe[jwefewfwefwefweopfj', '84655195_p0.jpg', 'belum', '2025-07-18 08:47:05', 'Selesai'),
(52, 'LAP-2BAFC4E7', 'rivo', '08127899999', 'Slot Ilegal / Judi Online', 'https://www.youtube.com/watch?v=ZJrzOFUw2zs&list=RDc93yGcxH8mY&index=15', 'ada iklan judi online mahjong 888', 'jadwal_jihan.jpg', 'belum', '2025-07-22 08:17:55', 'Diproses'),
(53, 'LAP-E376F063', 'Angga', '081272427629', 'Slot Ilegal / Judi Online', 'https://e-layanan.muaraenimkab.go.id/?ez=GACOR+ANTI+RUNGKAD', 'Mohon dibantu dihapus link yang terkena slot gacor website Pemkab Muara Enim berikut', '22_Juli_2025.png', 'belum', '2025-07-22 08:24:12', 'Menunggu'),
(54, 'LAP-6C4D341A', 'adminnnnn', '323423', 'Server down', 'www.muaraenimkab.go.id', 'lh  hl hll h hl h hlh kbjkbk', 'unnamed0.jpg', 'belum', '2025-07-28 09:07:59', 'Menunggu'),
(55, 'LAP-FF82440E', 'CSRF', '23123123', 'Server down', 'www.muaraenimkab.go.id', 'FADSDFSDF', 'ab779bdeadfc1c055341a92b67b99486.jpg', 'belum', '2025-07-28 11:18:18', 'Menunggu'),
(56, 'LAP-DAA1C6CC', 'DEBUGGING', '323423', 'Email tidak terkirim', 'www.muaraenimkab.go.id', 'QEQWRWQE', 'surat_permohonan_kerjasama_promosi_.pdf', 'belum', '2025-07-29 08:43:03', 'Menunggu'),
(57, 'LAP-4D14242E', 'adinh', '323423', 'Email tidak terkirim', 'www.muaraenimkab.go.id', '4TAW', 'RDG_EVALUASI_SMP_TW_1_4_Juni.pdf', 'belum', '2025-07-29 09:15:56', 'Selesai'),
(58, 'LAP-65B85820', 'LIDIA', '4324324234234', 'Server down', 'www.muaraenimkab.go.id', 'gwergdfbbdfbdfb', 'RDG_EVALUASI_SMP_TW_1_4_Juni1.pdf', 'belum', '2025-07-29 15:04:45', 'Selesai'),
(59, 'LAP-BDB6A921', 'Septa Putra Anggara', '082176227628', 'Slot Ilegal / Judi Online', 'https://cdn.muaraenimkab.go.id/', 'Website Terinject Domain \"cdn\"', 'Untitled.png', 'belum', '2025-08-06 10:01:16', 'Diproses'),
(60, 'LAP-9FB8B9BC', 'tes hari ini', '34343', 'Website tidak bisa diakses', 'www.muaraenimkab.go.id', 'ded', 'bulaweng.jpg', 'belum', '2025-08-19 11:07:53', 'Menunggu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(128) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'Dony Hartadi', '$2y$10$3ISsnGFBuYer2u7GvRgRaOods/Ls8RaJhjPPB2hF3qrjt3I0IMgPK', 'A'),
(2, 'Hartadi', '$2y$10$fAngKEZ95LRR6wR/Xpi0y.FM5w99hwTkl8M7usc2Df4pwFRY3vrhS', 'A');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kegiatan_id` (`kegiatan_id`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
