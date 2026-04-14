<main class="container-fluid px-4 py-4">
  <div class="mb-4">
    <div style="font-family:var(--font-mono);color:var(--cyber-cyan);font-size:0.75rem;letter-spacing:2px;">// TAMBAH KONTEN</div>
    <h2 class="mb-0" style="font-family:var(--font-display);color:var(--cyber-text);">Tambah Berita</h2>
  </div>

  <?php if (isset($error)): ?>
    <div class="alert-cyber-danger mb-4"><?= $error ?></div>
  <?php endif; ?>

  <div class="cyber-card" style="max-width:760px;">
    <form action="<?= site_url('berita/tambah') ?>" method="post" enctype="multipart/form-data">
      <div class="mb-4">
        <label class="cyber-label">Judul</label>
        <input type="text" name="judul" class="cyber-input" placeholder="Judul berita" required>
      </div>
      <div class="mb-4">
        <label class="cyber-label">Kategori</label>
        <input type="text" name="kategori" class="cyber-input" placeholder="Misal: Keamanan Siber" required>
      </div>
      <div class="mb-4">
        <label class="cyber-label">Isi Berita</label>
        <textarea name="isi" rows="8" class="cyber-input" placeholder="Tulis isi lengkap berita..." required></textarea>
      </div>
      <div class="mb-4">
        <label class="cyber-label">Gambar <span style="color:var(--cyber-text-dim);font-weight:400;">(opsional)</span></label>
        <input type="file" name="gambar" class="cyber-input" accept=".jpg,.jpeg,.png,.webp">
      </div>
      <div class="d-flex gap-3">
        <button type="submit" class="btn btn-cyber"><i class="bi bi-save me-1"></i>Simpan</button>
        <a href="<?= site_url('admin/berita') ?>" class="btn btn-cyber" style="background:transparent;border-color:var(--cyber-border);color:var(--cyber-text-dim);">Batal</a>
      </div>
    </form>
  </div>
</main>
