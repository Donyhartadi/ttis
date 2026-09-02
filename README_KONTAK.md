# HALAMAN KONTAK - TTIS

## Fitur yang Dibuat

Halaman kontak lengkap dengan fitur:
1. **Halaman Publik** - Menampilkan informasi kontak, peta Google Maps, operator WhatsApp, dan dokumen download
2. **Panel Admin** - Untuk mengatur informasi kontak, mengelola operator, dan upload dokumen

## Fitur Utama

### 1. Kontak Operator WhatsApp
- Admin bisa menambah/edit/hapus daftar operator
- Setiap operator punya tombol WhatsApp di halaman publik
- Pengunjung tinggal klik untuk langsung chat WhatsApp
- Bisa diatur urutan tampilan
- Tampilkan nama, jabatan, dan nomor WA

### 2. Google Maps API
- Menampilkan peta interaktif dengan Google Maps
- Admin bisa setting API key, latitude, dan longitude
- Marker otomatis di lokasi kantor
- Info window saat marker diklik

### 3. Upload Dokumen PDF
- Admin bisa upload dokumen PDF untuk publik
- Pengunjung bisa download langsung
- Tracking jumlah download
- Tampilan judul, deskripsi, tanggal, dan ukuran file
- Maksimal 10MB per file

## File yang Dibuat

### 1. Controller
- `application/controllers/Kontak.php` - Controller untuk menangani semua fungsi kontak

### 2. Model
- `application/models/Kontak_model.php` - Model untuk operasi database

### 3. Views
- `application/views/kontak/index.php` - Halaman kontak publik
- `application/views/kontak/admin_setting.php` - Halaman pengaturan kontak admin
- `application/views/kontak/admin_operator.php` - Halaman kelola operator WhatsApp
- `application/views/kontak/admin_dokumen.php` - Halaman kelola dokumen download

### 4. Database
- `kontak_tables.sql` - SQL untuk membuat tabel database

## Cara Instalasi

### 1. Import Database
Jalankan file `kontak_tables.sql` di database Anda atau copy-paste query ini:

```sql
-- Tabel informasi kontak
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

-- Tabel operator WhatsApp
CREATE TABLE IF NOT EXISTS `kontak_operator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `no_whatsapp` varchar(20) NOT NULL,
  `urutan` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel dokumen download
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
```

### 2. Buat Folder Upload
Pastikan folder untuk upload PDF ada:
```bash
# Folder akan otomatis dibuat oleh aplikasi
# Atau buat manual:
mkdir assets/uploads/kontak/dokumen
```

### 3. Dapatkan Google Maps API Key
1. Buka [Google Cloud Console](https://console.cloud.google.com/)
2. Buat project baru atau pilih existing
3. Enable "Maps JavaScript API"
4. Buat credentials → API Key
5. (Opsional) Restrict API key untuk keamanan
6. Copy API key dan simpan

### 4. Akses Halaman

#### Untuk Publik:
- URL: `http://localhost/ttis/kontak`
- Menu: Klik "Kontak" di navigasi atas

#### Untuk Admin:
- Login sebagai admin terlebih dahulu
- URL Pengaturan: `http://localhost/ttis/kontak/admin_setting`
- URL Kelola Operator: `http://localhost/ttis/kontak/admin_operator`
- URL Kelola Dokumen: `http://localhost/ttis/kontak/admin_dokumen`
- Menu: Klik "Kontak" di navigasi admin

## Cara Penggunaan

### A. Mengatur Informasi Kontak (Admin)

1. Login sebagai admin
2. Klik menu "Kontak" di navigasi atas
3. Isi form dengan informasi:
   - **Email**: Email resmi kantor
   - **Alamat**: Alamat lengkap kantor
   - **Jam Operasional**: Hari dan jam kerja
   - **Google Maps API Key**: API key dari Google Cloud
   - **Latitude & Longitude**: Koordinat untuk peta

#### Cara Mendapatkan Koordinat:
1. Buka Google Maps (https://maps.google.com)
2. Cari lokasi kantor Anda
3. Klik kanan pada titik lokasi
4. Klik koordinat yang muncul
5. Paste ke form (contoh: -3.7091, 103.6234)

4. Klik "Simpan Perubahan"

### B. Mengelola Operator WhatsApp (Admin)

1. Login sebagai admin
2. Klik menu "Kontak" > "Kelola Operator"
3. Klik tombol "Tambah Operator"
4. Isi form:
   - **Nama**: Nama operator
   - **Jabatan**: Posisi operator (opsional)
   - **Nomor WhatsApp**: Format 628xxx (gunakan 62 untuk Indonesia)
   - **Urutan**: Urutan tampil (dari terkecil)
5. Klik "Tambah"

#### Format Nomor WhatsApp yang Benar:
- ✅ `628123456789`
- ✅ `62-812-3456-789`
- ❌ `08123456789` (harus gunakan kode negara 62)
- ❌ `+628123456789` (tanpa tanda +)

**Edit Operator:**
- Klik tombol edit (icon pensil) pada operator yang ingin diubah
- Update data yang diperlukan
- Klik "Simpan"

**Hapus Operator:**
- Klik tombol hapus (icon tempat sampah)
- Konfirmasi penghapusan

### C. Mengelola Dokumen PDF (Admin)

1. Login sebagai admin
2. Klik menu "Kontak" > "Kelola Dokumen"
3. Klik tombol "Upload Dokumen"
4. Isi form:
   - **Judul**: Judul dokumen (wajib)
   - **Deskripsi**: Deskripsi singkat (opsional)
   - **File PDF**: Pilih file PDF (maksimal 10MB)
5. Klik "Upload"

**Contoh Dokumen yang Bisa Diupload:**
- Panduan Pelaporan Insiden
- SOP Penanganan
- Form Pelaporan
- Dokumen Kebijakan Keamanan
- Panduan Teknis

**Hapus Dokumen:**
- Klik tombol hapus (icon tempat sampah)
- Konfirmasi penghapusan
- File PDF akan terhapus dari server

**Statistik Download:**
- Setiap kali pengunjung download, counter akan bertambah
- Admin bisa lihat berapa kali dokumen didownload

### D. Pengunjung Menggunakan Halaman Kontak

**1. Lihat Informasi Kontak**
- Buka halaman kontak
- Lihat email, alamat, jam operasional

**2. Chat dengan Operator**
- Klik tombol operator yang ingin dihubungi
- Otomatis diarahkan ke WhatsApp
- Bisa langsung chat

**3. Lihat Lokasi di Peta**
- Scroll ke peta Google Maps
- Klik marker untuk info lengkap
- Bisa zoom in/out

**4. Download Dokumen**
- Scroll ke bagian "Dokumen & Panduan"
- Klik dokumen yang ingin didownload
- File PDF akan terdownload

## Struktur Database

### Tabel: kontak_info
Menyimpan informasi kontak kantor.

| Field | Type | Keterangan |
|-------|------|------------|
| id | int(11) | Primary key |
| alamat | text | Alamat kantor |
| latitude | varchar(50) | Koordinat latitude untuk peta |
| longitude | varchar(50) | Koordinat longitude untuk peta |
| email | varchar(100) | Email kantor |
| jam_operasional | text | Jam operasional kantor |
| google_maps_api_key | varchar(255) | API key Google Maps |

### Tabel: kontak_operator
Menyimpan daftar operator WhatsApp.

| Field | Type | Keterangan |
|-------|------|------------|
| id | int(11) | Primary key |
| nama | varchar(100) | Nama operator |
| jabatan | varchar(100) | Jabatan/posisi |
| no_whatsapp | varchar(20) | Nomor WhatsApp (format 628xxx) |
| urutan | int(11) | Urutan tampil di halaman publik |
| created_at | datetime | Tanggal dibuat |

### Tabel: kontak_dokumen
Menyimpan dokumen PDF untuk download publik.

| Field | Type | Keterangan |
|-------|------|------------|
| id | int(11) | Primary key |
| judul | varchar(200) | Judul dokumen |
| deskripsi | text | Deskripsi dokumen |
| nama_file | varchar(255) | Nama file di server |
| ukuran_file | int(11) | Ukuran file (KB) |
| tanggal_upload | datetime | Tanggal upload |
| jumlah_download | int(11) | Counter download |

## Fitur Keamanan

1. **Login Required**: Halaman admin hanya bisa diakses oleh user yang login
2. **Role Check**: Hanya admin (role 'A') yang bisa mengakses panel admin
3. **File Validation**: Upload hanya menerima file PDF dengan maksimal 10MB
4. **CSRF Protection**: Menggunakan CodeIgniter CSRF protection
5. **XSS Protection**: Data di-escape dengan htmlspecialchars()
6. **WhatsApp Format**: Validasi format nomor WhatsApp

## Teknologi yang Digunakan

1. **CodeIgniter 3** - Framework PHP
2. **Bootstrap 5** - CSS Framework (untuk publik)
3. **AdminLTE** - Admin template
4. **Google Maps JavaScript API** - Library peta interaktif
5. **Font Awesome / Bootstrap Icons** - Icon library

## Troubleshooting

### Peta tidak muncul
- Pastikan Google Maps API Key sudah diisi dan valid
- Pastikan latitude dan longitude sudah diisi dengan benar
- Cek console browser untuk melihat error
- Pastikan Maps JavaScript API sudah dienable di Google Cloud Console
- Cek quota API key (gratis: $200/bulan)

### Tombol WhatsApp tidak berfungsi
- Pastikan format nomor menggunakan 62 (bukan 08)
- Cek nomor sudah benar tanpa spasi atau karakter khusus
- Test nomor dengan format: `https://wa.me/628123456789`

### Upload PDF gagal
- Pastikan folder `assets/uploads/kontak/dokumen/` ada dan writable
- Cek ukuran file, maksimal 10MB
- Pastikan file yang diupload adalah PDF
- Cek error log di `application/logs/`

### Error 404 saat akses halaman
- Pastikan routes sudah ditambahkan di `application/config/routes.php`
- Clear cache browser
- Cek .htaccess untuk URL rewriting

### Admin tidak bisa akses
- Pastikan sudah login dengan akun yang memiliki role 'A' (Admin)
- Cek session di browser (clear cookie jika perlu)

## Update & Maintenance

**Update Informasi Kontak:**
1. Login sebagai admin
2. Ke menu Kontak > Pengaturan
3. Edit informasi
4. Simpan perubahan

**Update Operator:**
1. Ke menu Kontak > Kelola Operator
2. Edit atau hapus operator yang perlu diupdate
3. Tambah operator baru jika perlu

**Update Dokumen:**
1. Ke menu Kontak > Kelola Dokumen
2. Upload dokumen baru
3. Hapus dokumen lama jika sudah tidak relevan

**Monitoring Download:**
- Cek statistik download di halaman admin
- Dokumen dengan download tinggi = informasi yang banyak dicari

## Tips & Best Practices

### Google Maps API
1. **Restrict API Key** - Batasi penggunaan API key ke domain Anda saja
2. **Enable Billing** - Aktifkan billing di Google Cloud (gratis $200/bulan)
3. **Monitor Usage** - Cek penggunaan API di Google Cloud Console
4. **Fallback** - Jika quota habis, tampilkan pesan atau gunakan static map

### WhatsApp
1. **Format Konsisten** - Selalu gunakan format 62xxx
2. **Test Nomor** - Test setiap nomor sebelum dipublish
3. **Jam Kerja** - Informasikan jam operasional operator
4. **Response Time** - Pastikan operator responsif

### Dokumen
1. **Naming** - Gunakan nama file yang jelas dan deskriptif
2. **Update Rutin** - Update dokumen yang sudah kadaluarsa
3. **Ukuran File** - Compress PDF jika terlalu besar
4. **Backup** - Backup dokumen penting secara terpisah
5. **Monitoring** - Hapus dokumen yang tidak pernah didownload

## Catatan Penting

1. **Backup Database**: Selalu backup database sebelum melakukan perubahan
2. **File Upload**: File PDF disimpan di `assets/uploads/kontak/dokumen/`
3. **Keamanan**: Jangan share API key atau kredensial admin
4. **Update Regular**: Check dan update informasi secara berkala
5. **Testing**: Test semua fitur setelah update

## Support & Resources

**Dokumentasi:**
- CodeIgniter: https://codeigniter.com/userguide3/
- Google Maps API: https://developers.google.com/maps/documentation
- WhatsApp Business API: https://developers.facebook.com/docs/whatsapp

**Troubleshooting:**
- Cek error log di `application/logs/`
- Enable debug mode di `config.php` untuk development
- Gunakan browser console untuk debug JavaScript

---
Dibuat untuk TTIS Kabupaten Muara Enim  
Last updated: 2026-09-01
