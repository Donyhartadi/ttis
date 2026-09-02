# Fix Upload File .asc untuk PGP Public Key

## Masalah
File .asc ditolak saat upload dengan error: "The filetype you are attempting to upload is not allowed."

## Penyebab
CodeIgniter memeriksa MIME type file berdasarkan konfigurasi di `application/config/mimes.php`. File .asc, .gpg, .key, dan .pgp belum terdaftar dalam file tersebut.

## Solusi

### 1. Update MIME Types (✅ DONE)
File: `application/config/mimes.php`

Ditambahkan entry untuk PGP files:
```php
// PGP Public Key files
'asc'	=>	array('text/plain', 'application/pgp-keys', 'application/pgp', 'application/octet-stream'),
'gpg'	=>	array('application/pgp-encrypted', 'application/pgp', 'application/octet-stream'),
'key'	=>	array('text/plain', 'application/pgp-keys', 'application/octet-stream'),
'pgp'	=>	array('application/pgp-encrypted', 'application/pgp-keys', 'application/octet-stream'),
```

### 2. Improved Error Messages (✅ DONE)
File: `application/controllers/Kontak.php`

**Public Key Upload:**
- Ditambahkan logging error
- Error message lebih informatif
- Menampilkan tipe file yang diperbolehkan

**Dokumen Upload:**
- Ditambahkan logging error
- Error message lebih informatif

**Upload Config Improvements:**
- Ditambahkan `encrypt_name => FALSE` (keep original filename pattern)
- Ditambahkan `overwrite => FALSE` (prevent accidental overwrites)

## Testing

### File Test Sudah Dibuat
Location: `C:\Users\User\Downloads\test_ttis_publickey.asc`

### Cara Test:
1. Login sebagai admin
2. Akses: http://localhost/ttis/kontak/admin_publickey
3. Klik "Upload Public Key"
4. Isi form:
   - Judul: `PGP Public Key TTIS 2026`
   - Deskripsi: `Public key resmi untuk komunikasi terenkripsi`
   - File: Pilih `test_ttis_publickey.asc` dari Downloads
5. Klik "Upload"
6. Seharusnya berhasil dengan flash message sukses

### Verifikasi:
```sql
-- Cek database
SELECT * FROM kontak_publickey ORDER BY id DESC LIMIT 1;

-- Cek file
dir assets\uploads\kontak\publickey\
```

### Jika Masih Error:
1. Cek error log di `application/logs/log-2026-09-01.php`
2. Pastikan folder `assets/uploads/kontak/publickey/` writable
3. Cek MIME type file dengan PowerShell:
```powershell
Get-ItemProperty "C:\Users\User\Downloads\test_ttis_publickey.asc" | Select-Object *
```

## Supported File Types
Setelah fix ini, file yang bisa diupload:
- `.asc` - ASCII armored PGP key (RECOMMENDED)
- `.gpg` - GPG binary format
- `.key` - Generic key file
- `.pgp` - PGP format
- `.txt` - Text file (sudah support dari sebelumnya)

## MIME Types yang Diterima
Untuk setiap extension di atas, CodeIgniter akan menerima MIME types berikut:
- `text/plain`
- `application/pgp-keys`
- `application/pgp`
- `application/pgp-encrypted`
- `application/octet-stream`

## Notes
- Max file size: 1 MB (cukup untuk public key)
- File akan disimpan dengan nama: `publickey_[timestamp].[ext]`
- Original extension dipertahankan
- Auto cleanup jika database insert gagal
