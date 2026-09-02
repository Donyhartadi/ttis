## TROUBLESHOOTING - Kontak Module

### Test yang Sudah Dilakukan:

1. ✅ Database tabel sudah dibuat dengan benar
2. ✅ Folder upload sudah dibuat: `assets/uploads/kontak/dokumen/`
3. ✅ Database insert berfungsi (test manual berhasil)
4. ✅ CSRF protection aktif
5. ✅ Form validation library sudah di-autoload
6. ✅ Controller sudah ditambahkan error handling

### Cara Test Manual:

**Test Tambah Operator:**
1. Login sebagai admin
2. Akses: http://localhost/ttis/kontak/admin_operator
3. Klik tombol "Tambah Operator"
4. Isi form dengan data:
   - Nama: Test Operator
   - Jabatan: Staff IT  
   - No WA: 628123456789
   - Urutan: 1
5. Klik "Tambah"
6. Cek apakah muncul flash message sukses/error

**Jika Gagal:**
- Cek error di browser console (F12 → Console)
- Cek error log di: `application/logs/log-2026-09-01.php`
- Pastikan sudah login sebagai admin (role = 'A')

**Test Upload Dokumen:**
1. Akses: http://localhost/ttis/kontak/admin_dokumen
2. Klik "Upload Dokumen"
3. Isi judul dan pilih file PDF
4. Klik "Upload"

**Debug Manual via SQL:**
```sql
-- Tambah operator langsung
INSERT INTO kontak_operator (nama, jabatan, no_whatsapp, urutan) 
VALUES ('John Doe', 'Helpdesk', '628123456789', 1);

-- Cek data
SELECT * FROM kontak_operator;

-- Hapus jika perlu
DELETE FROM kontak_operator WHERE id = X;
```

### Perbaikan yang Sudah Dilakukan:

1. ✅ Update controller dengan try-catch error handling
2. ✅ Tambahkan XSS filtering dengan TRUE parameter di input->post()
3. ✅ Tambahkan return statement setelah redirect
4. ✅ Tambahkan cleanup file upload jika insert gagal
5. ✅ Folder upload otomatis dibuat jika belum ada

### Kemungkinan Masalah:

1. **Session Login Expired** - Coba login ulang
2. **CSRF Token Expired** - Refresh halaman sebelum submit
3. **Browser Cache** - Tekan Ctrl+F5 untuk hard refresh
4. **Permission Folder** - Pastikan folder writable (sudah dibuat dengan 0777)

### Next Steps:

Jika masih error, cek:
1. Browser console untuk JavaScript errors
2. Application logs untuk PHP errors
3. Apache error.log
4. Pastikan jQuery dan Bootstrap JS sudah load dengan benar
