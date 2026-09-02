# Dokumentasi Fitur PGP Public Key

## Overview
Fitur ini memungkinkan **admin** untuk mengupload PGP public key yang dapat didownload oleh pengunjung. Sistem ini sederhana seperti dokumen PDF - admin upload, pengunjung download.

## Database

### Tabel: kontak_publickey
```sql
CREATE TABLE kontak_publickey (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(200) NOT NULL,
    deskripsi TEXT,
    nama_file VARCHAR(255) NOT NULL,
    ukuran_file INT,
    jumlah_download INT DEFAULT 0,
    tanggal_upload TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

**Field:**
- `id`: Primary key
- `judul`: Judul public key (contoh: "PGP Public Key TTIS")
- `deskripsi`: Deskripsi/keterangan tambahan
- `nama_file`: Nama file yang diupload di server
- `ukuran_file`: Ukuran file dalam KB
- `jumlah_download`: Counter jumlah download
- `tanggal_upload`: Timestamp upload

## Files Structure

```
application/
├── controllers/
│   └── Kontak.php (updated)
│       - download_publickey($id)         # Download public key
│       - admin_publickey()               # Admin manage page
│       - admin_publickey_upload()        # Admin upload key
│       - admin_publickey_delete($id)     # Admin delete key
│
├── models/
│   └── Kontak_model.php (updated)
│       - get_all_publickey()
│       - get_publickey($id)
│       - insert_publickey($data)
│       - update_publickey($id, $data)
│       - delete_publickey($id)
│       - increment_publickey_download($id)
│
└── views/
    └── kontak/
        ├── index.php (updated)           # Tampil keys di paling atas
        └── admin_publickey.php           # Admin manage & upload

assets/
└── uploads/
    └── kontak/
        └── publickey/                    # Folder untuk file .asc/.gpg
```

## URL Routes

| URL | Method | Akses | Deskripsi |
|-----|--------|-------|-----------|
| `/kontak` | GET | Public | Halaman kontak (public key di paling atas) |
| `/kontak/download_publickey/{id}` | GET | Public | Download public key |
| `/kontak/admin_publickey` | GET | Admin | Manage public keys |
| `/kontak/admin_publickey_upload` | POST | Admin | Upload public key |
| `/kontak/admin_publickey_delete/{id}` | GET | Admin | Delete public key |

## Workflow

### 1. Upload Public Key (Admin)

**Halaman:** http://localhost/ttis/kontak/admin_publickey

**Akses:** Login admin → Kontak Setting → Kelola Public Key → Upload Public Key

**Form Fields:**
- Judul (required) - Contoh: "PGP Public Key TTIS"
- Deskripsi (optional) - Keterangan tambahan
- File Public Key (required, format: .asc, .gpg, .txt, .key, .pgp)

**Validasi:**
- File type: .asc, .gpg, .txt, .key, .pgp
- Max size: 1 MB
- Judul wajib diisi

**Process:**
1. Admin login dan akses halaman manage
2. Klik "Upload Public Key"
3. Isi form dan upload file
4. File disimpan ke `assets/uploads/kontak/publickey/`
5. Data disimpan ke database
6. Public key langsung muncul di halaman kontak publik

### 2. Lihat & Download (Pengunjung)

**Halaman:** http://localhost/ttis/kontak

**Tampilan:**
- Public key ditampilkan **di paling atas halaman kontak**
- Informasi: Judul, Deskripsi, Tanggal upload, Jumlah download, Ukuran file
- Badge besar "Download" untuk setiap key

**Download:**
- Klik pada card public key
- File akan ter-download
- Counter download otomatis bertambah

### 3. Manage (Admin)

**Halaman:** http://localhost/ttis/kontak/admin_publickey

**Actions:**
- **View**: Lihat file yang diupload (buka di tab baru)
- **Delete**: Hapus permanent (file + database)

**Tabel Info:**
- No, Judul, Deskripsi, File name, Ukuran, Jumlah download, Aksi

## File Upload Configuration

```php
$config['upload_path'] = './assets/uploads/kontak/publickey/';
$config['allowed_types'] = 'asc|gpg|txt|key|pgp';
$config['max_size'] = 1024; // 1MB
$config['file_name'] = 'publickey_' . time();
```

## Security Features

1. **File Type Validation**: Hanya accept .asc, .gpg, .txt, .key, .pgp
2. **Size Limit**: Maksimal 1 MB
3. **XSS Protection**: Input sanitization dengan TRUE parameter
4. **Admin Only Upload**: Upload hanya bisa dilakukan admin (role = 'A')
5. **File Cleanup**: Auto hapus file jika insert database gagal
6. **Download Counter**: Track jumlah download setiap key

## Testing

### Test Upload (Admin)
1. Login sebagai admin
2. Akses: http://localhost/ttis/kontak/admin_publickey
3. Klik "Upload Public Key"
4. Isi judul: "PGP Public Key TTIS"
5. Deskripsi: "Untuk komunikasi terenkripsi"
6. Upload file .asc
7. Klik "Upload"
8. Cek flash message dan tabel

### Test Display (Publik)
1. Akses: http://localhost/ttis/kontak
2. Public key harus muncul **di paling atas** sebelum info kontak
3. Klik card public key
4. File seharusnya ter-download
5. Refresh halaman, counter download bertambah

### Test Delete (Admin)
1. Di admin_publickey
2. Klik tombol hapus (trash icon)
3. Confirm delete
4. File dan data terhapus
5. Public key hilang dari halaman publik

## Generate Test PGP Key

### Menggunakan GPG (Command Line)
```bash
# Generate key pair
gpg --full-generate-key

# Export public key
gpg --armor --export your-email@example.com > my-public-key.asc

# Lihat key info
gpg --list-keys
```

### Menggunakan Kleopatra (Windows GUI)
1. Download Gpg4win: https://gpg4win.org
2. Install dan buka Kleopatra
3. File → New OpenPGP Key Pair
4. Isi nama dan email
5. Create
6. Klik kanan key → Export
7. Simpan sebagai .asc file

## Troubleshooting

**Error: "Upload gagal: The filetype you are attempting to upload is not allowed."**
- Pastikan file extension adalah .asc, .gpg, .txt, .key, atau .pgp
- Pastikan file type valid (bukan .exe atau file lain)

**Error: "Gagal menyimpan public key ke database"**
- Cek database connection
- Cek permissions folder upload (0777)
- Cek log di `application/logs/`

**Public key tidak muncul di halaman publik**
- Refresh halaman kontak (Ctrl+F5)
- Cek query: `SELECT * FROM kontak_publickey`
- Pastikan data ada di database

**Folder upload tidak ada**
- Folder sudah dibuat otomatis di: `assets/uploads/kontak/publickey/`
- Jika perlu buat manual dengan permission 0777

## SQL Queries

```sql
-- Cek semua public keys
SELECT * FROM kontak_publickey ORDER BY tanggal_upload DESC;

-- Insert manual untuk test
INSERT INTO kontak_publickey (judul, deskripsi, nama_file, ukuran_file) 
VALUES ('PGP Public Key TTIS', 'Untuk komunikasi terenkripsi', 'test_key.asc', 1);

-- Update download counter
UPDATE kontak_publickey SET jumlah_download = jumlah_download + 1 WHERE id = 1;

-- Reset untuk test
TRUNCATE TABLE kontak_publickey;

-- Delete specific key
DELETE FROM kontak_publickey WHERE id = 1;
```

## Integration Points

1. **Halaman Kontak Publik** (`kontak/index.php`)
   - Public keys ditampilkan **di paling atas**
   - Full width card dengan border secondary
   - Badge download yang besar dan jelas

2. **Admin Dashboard** (`kontak/admin_setting.php`)
   - Link ke admin_publickey
   - Menu "Kelola Public Key"

3. **Admin Publickey** (`kontak/admin_publickey.php`)
   - Upload via modal
   - Tabel list dengan view & delete

## Perbedaan dengan Sistem Sebelumnya

**Sistem Lama (Kompleks):**
- Pengunjung upload key mereka
- Admin approve/reject
- Status: pending/approved/rejected
- Field: nama, email, status, keterangan

**Sistem Baru (Sederhana):**
- Admin upload key organisasi
- Langsung muncul di publik
- Tidak ada approval workflow
- Field: judul, deskripsi, jumlah_download

**Keuntungan Sistem Baru:**
- Lebih sederhana dan mudah dikelola
- Tidak ada queue pending yang perlu direview
- Admin full control atas konten
- Mirip dengan sistem dokumen PDF yang sudah ada
- Public key di posisi paling atas halaman (lebih menonjol)

## Next Steps / Enhancements

- [ ] Multiple file upload sekaligus
- [ ] Parse PGP key untuk extract Key ID dan Fingerprint
- [ ] Verify key validity sebelum save
- [ ] Search/filter functionality di admin
- [ ] Pagination untuk list keys
- [ ] Export key sebagai QR code
- [ ] Email notification saat ada key baru

## Database

### Tabel: kontak_publickey
```sql
CREATE TABLE kontak_publickey (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    nama_file VARCHAR(255) NOT NULL,
    ukuran_file INT NOT NULL,
    status ENUM('pending','approved','rejected') DEFAULT 'pending',
    keterangan TEXT,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

**Field:**
- `id`: Primary key
- `nama`: Nama lengkap pemilik public key
- `email`: Email yang terdaftar di PGP key
- `nama_file`: Nama file yang diupload di server
- `ukuran_file`: Ukuran file dalam KB
- `status`: Status approval (pending/approved/rejected)
- `keterangan`: Catatan admin (alasan reject, dll)
- `uploaded_at`: Timestamp upload

## Files Structure

```
application/
├── controllers/
│   └── Kontak.php (updated)
│       - upload_publickey()          # Form upload untuk pengunjung
│       - publickey_submit()          # Process upload
│       - download_publickey($id)     # Download approved key
│       - admin_publickey()           # Admin manage page
│       - admin_publickey_approve($id)
│       - admin_publickey_reject($id)
│       - admin_publickey_delete($id)
│
├── models/
│   └── Kontak_model.php (updated)
│       - get_all_publickey($status)
│       - get_approved_publickey()
│       - get_publickey($id)
│       - insert_publickey($data)
│       - update_publickey_status($id, $status, $keterangan)
│       - delete_publickey($id)
│       - count_pending_publickey()
│
└── views/
    └── kontak/
        ├── index.php (updated)           # Tampil approved keys
        ├── upload_publickey.php          # Form upload publik
        └── admin_publickey.php           # Admin manage

assets/
└── uploads/
    └── kontak/
        └── publickey/                    # Folder untuk file .asc/.gpg
```

## URL Routes

| URL | Method | Akses | Deskripsi |
|-----|--------|-------|-----------|
| `/kontak/upload-publickey` | GET | Public | Form upload public key |
| `/kontak/publickey_submit` | POST | Public | Submit public key |
| `/kontak/download_publickey/{id}` | GET | Public | Download approved key |
| `/kontak/admin_publickey` | GET | Admin | Manage public keys |
| `/kontak/admin_publickey_approve/{id}` | GET | Admin | Approve key |
| `/kontak/admin_publickey_reject/{id}` | POST | Admin | Reject key |
| `/kontak/admin_publickey_delete/{id}` | GET | Admin | Delete key |

## Workflow

### 1. Upload Public Key (Pengunjung)

**Halaman:** http://localhost/ttis/kontak/upload-publickey

**Form Fields:**
- Nama Lengkap (required)
- Email (required, valid email)
- File Public Key (required, format: .asc, .gpg, .txt, .key)

**Validasi:**
- File type: .asc, .gpg, .txt, .key
- Max size: 512 KB
- Nama dan email wajib diisi

**Process:**
1. Pengunjung mengisi form
2. Upload file ke `assets/uploads/kontak/publickey/`
3. Data disimpan dengan status `pending`
4. Flash message: "Public key berhasil diupload! Menunggu persetujuan admin."

### 2. Review & Approve (Admin)

**Halaman:** http://localhost/ttis/kontak/admin_publickey

**Akses:** Login admin → Kontak Setting → Kelola Public Key

**Actions:**
- **View**: Lihat file yang diupload
- **Approve**: Set status menjadi `approved`
- **Reject**: Set status menjadi `rejected` + keterangan
- **Delete**: Hapus permanent (file + database)

**Stats Dashboard:**
- Pending count
- Approved count
- Rejected count

### 3. Download Public Key (Pengunjung)

**Halaman:** http://localhost/ttis/kontak

**Tampilan:**
- List semua public key dengan status `approved`
- Informasi: Nama, Email, Tanggal upload, Ukuran file
- Tombol download

**Download:**
- Klik tombol download
- File akan ter-download dengan nama: `{nama}_public_key.{ext}`

## File Upload Configuration

```php
$config['upload_path'] = './assets/uploads/kontak/publickey/';
$config['allowed_types'] = 'asc|gpg|txt|key';
$config['max_size'] = 512; // KB
$config['file_name'] = 'pubkey_' . time();
```

## Security Features

1. **File Type Validation**: Hanya accept .asc, .gpg, .txt, .key
2. **Size Limit**: Maksimal 512 KB
3. **XSS Protection**: Input sanitization dengan TRUE parameter
4. **Admin Only**: Approval/reject hanya bisa dilakukan admin (role = 'A')
5. **Status Check**: Download hanya untuk status `approved`
6. **File Cleanup**: Auto hapus file jika insert database gagal

## Testing

### Test Upload (Pengunjung)
1. Akses: http://localhost/ttis/kontak/upload-publickey
2. Isi nama dan email
3. Upload file .asc (test dengan file text biasa dulu)
4. Klik "Upload Public Key"
5. Cek flash message

### Test Admin Approval
1. Login sebagai admin
2. Akses: http://localhost/ttis/kontak/admin_publickey
3. Lihat list pending keys
4. Klik approve ✓
5. Refresh halaman publik kontak
6. Public key seharusnya muncul

### Test Download
1. Di halaman kontak publik
2. Scroll ke bagian "PGP Public Keys"
3. Klik "Download" pada salah satu key
4. File seharusnya ter-download

## Generate Test PGP Key

### Menggunakan GPG (Command Line)
```bash
# Generate key pair
gpg --full-generate-key

# Export public key
gpg --armor --export your-email@example.com > my-public-key.asc

# Lihat key info
gpg --list-keys
```

### Menggunakan Kleopatra (Windows GUI)
1. Download Gpg4win: https://gpg4win.org
2. Install dan buka Kleopatra
3. File → New OpenPGP Key Pair
4. Isi nama dan email
5. Create
6. Klik kanan key → Export
7. Simpan sebagai .asc file

## Troubleshooting

**Error: "Upload gagal: The filetype you are attempting to upload is not allowed."**
- Pastikan file extension adalah .asc, .gpg, .txt, atau .key
- Pastikan file type valid (bukan .exe atau file lain)

**Error: "Gagal menyimpan public key ke database"**
- Cek database connection
- Cek permissions folder upload (0777)
- Cek log di `application/logs/`

**Public key tidak muncul di halaman publik**
- Pastikan status = 'approved' (bukan pending/rejected)
- Refresh halaman kontak
- Cek query: `SELECT * FROM kontak_publickey WHERE status='approved'`

**Folder upload tidak ada**
- Folder sudah dibuat otomatis di: `assets/uploads/kontak/publickey/`
- Jika perlu buat manual dengan permission 0777

## SQL Queries

```sql
-- Cek semua public keys
SELECT * FROM kontak_publickey ORDER BY uploaded_at DESC;

-- Count by status
SELECT status, COUNT(*) FROM kontak_publickey GROUP BY status;

-- Get pending keys
SELECT * FROM kontak_publickey WHERE status = 'pending';

-- Approve manual
UPDATE kontak_publickey SET status = 'approved' WHERE id = 1;

-- Reset untuk test
TRUNCATE TABLE kontak_publickey;
```

## Integration Points

1. **Halaman Kontak Publik** (`kontak/index.php`)
   - Menampilkan approved keys
   - Link ke form upload

2. **Admin Dashboard** (`kontak/admin_setting.php`)
   - Link ke admin_publickey
   - Menu "Kelola Public Key"

3. **Navigation** (public header/footer)
   - Tombol "Upload Key Anda" di card public keys

## Next Steps / Enhancements

- [ ] Email notification ke admin saat ada upload baru
- [ ] Email notification ke user saat approved/rejected
- [ ] Parse PGP key untuk extract Key ID dan Fingerprint
- [ ] Verify key validity sebelum approve
- [ ] Search/filter functionality di admin
- [ ] Pagination untuk list keys
- [ ] Export list approved keys sebagai file
