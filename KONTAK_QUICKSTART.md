# PANDUAN SINGKAT - HALAMAN KONTAK TTIS

## 🚀 Quick Start

### 1. Import Database
Jalankan query SQL di phpMyAdmin (database: ttis):

```sql
CREATE TABLE kontak_info (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  alamat text, latitude varchar(50), longitude varchar(50),
  email varchar(100), jam_operasional text,
  google_maps_api_key varchar(255)
);

CREATE TABLE kontak_operator (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  nama varchar(100) NOT NULL, jabatan varchar(100),
  no_whatsapp varchar(20) NOT NULL, urutan int(11) DEFAULT 0,
  created_at datetime DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE kontak_dokumen (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  judul varchar(200) NOT NULL, deskripsi text,
  nama_file varchar(255) NOT NULL, ukuran_file int(11),
  tanggal_upload datetime DEFAULT CURRENT_TIMESTAMP,
  jumlah_download int(11) DEFAULT 0
);
```

### 2. Akses Admin
- Login: http://localhost/ttis/auth
- Menu Kontak → Pengaturan Kontak

### 3. Setup Google Maps
1. Dapatkan API Key: https://console.cloud.google.com/
2. Enable "Maps JavaScript API"
3. Paste API key di pengaturan kontak

### 4. Tambah Operator
- Menu Kontak → Kelola Operator → Tambah
- Format WA: 628123456789 (gunakan 62, bukan 08)

### 5. Upload Dokumen
- Menu Kontak → Kelola Dokumen → Upload
- Max: 10MB, Format: PDF

## 📍 URL Penting

**Publik:**
- Halaman Kontak: `/kontak`

**Admin (perlu login):**
- Pengaturan: `/kontak/admin_setting`
- Operator: `/kontak/admin_operator`
- Dokumen: `/kontak/admin_dokumen`

## ✅ Fitur

1. ✅ **Operator WhatsApp** - Tombol klik langsung chat
2. ✅ **Google Maps** - Peta interaktif lokasi kantor
3. ✅ **Download PDF** - Upload dokumen untuk publik
4. ✅ **Tracking** - Statistik jumlah download
5. ✅ **Responsive** - Mobile friendly

## 🔧 Cara Dapatkan Koordinat

1. Buka Google Maps
2. Cari lokasi kantor
3. Klik kanan → Klik koordinat
4. Paste ke form (contoh: -3.7091, 103.6234)

## 📝 Contoh Data

**Operator:**
- Nama: John Doe
- Jabatan: Staff IT
- WA: 628123456789

**Dokumen:**
- Panduan Pelaporan Insiden
- SOP Penanganan
- Form Pelaporan

## ⚠️ Troubleshooting

**Peta tidak muncul?**
→ Cek API key sudah benar & Maps API sudah enable

**WA tidak berfungsi?**
→ Pastikan format 628xxx (bukan 08xxx)

**Upload gagal?**
→ Cek folder assets/uploads/kontak/dokumen/ writable

---
Lihat dokumentasi lengkap di: README_KONTAK.md
