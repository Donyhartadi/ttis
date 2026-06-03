<main class="container-fluid px-4 py-4">

  <!-- Header + Tombol Aksi -->
  <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
    <div>
      <div style="font-family:var(--font-mono);color:var(--cyber-cyan);font-size:0.75rem;letter-spacing:2px;">// <?= isset($berita) ? 'EDIT' : 'TAMBAH' ?> KONTEN</div>
      <h2 class="mb-0" style="font-family:var(--font-display);color:var(--cyber-text);"><?= isset($berita) ? 'Edit' : 'Tambah' ?> Berita</h2>
    </div>
    <div class="d-flex gap-2">
      <a href="<?= site_url('berita') ?>" class="btn btn-cyber" style="background:transparent;border-color:var(--cyber-border);color:var(--cyber-text-dim);">
        <i class="bi bi-arrow-left me-1"></i>Kembali
      </a>
    </div>
  </div>

  <?= form_open_multipart('', ['id' => 'formBerita']) ?>

  <!-- Baris 1: Judul + Kategori sejajar -->
  <div class="row g-3 mb-3">
    <div class="col-lg-8">
      <label class="cyber-label">Judul Berita</label>
      <input type="text" name="judul" value="<?= isset($berita) ? htmlspecialchars($berita->judul) : '' ?>"
             class="cyber-input" placeholder="Tulis judul berita yang menarik..." required>
    </div>
    <div class="col-lg-4">
      <label class="cyber-label">Kategori</label>
      <input type="text" name="kategori" value="<?= isset($berita) ? htmlspecialchars($berita->kategori) : '' ?>"
             class="cyber-input" placeholder="Misal: Keamanan Siber" required>
    </div>
  </div>

  <!-- Baris 2: Isi + Sidebar Media/Aksi -->
  <div class="row g-3">

    <!-- Isi Berita -->
    <div class="col-lg-8">
      <div class="cyber-card" style="height:100%;">
        <label class="cyber-label mb-2">Isi Berita</label>
        <textarea name="isi" rows="18" class="cyber-input w-100" style="resize:vertical;"
                  placeholder="Tulis isi lengkap berita di sini..."><?= isset($berita) ? $berita->isi : '' ?></textarea>
      </div>
    </div>

    <!-- Sidebar: Gambar + Aksi -->
    <div class="col-lg-4 d-flex flex-column gap-3">

      <!-- Gambar -->
      <div class="cyber-card">
        <label class="cyber-label mb-3">
          <i class="bi bi-image me-1" style="color:var(--cyber-cyan);"></i>Gambar
          <span style="color:var(--cyber-text-dim);font-weight:400;font-size:0.8rem;"> (opsional)</span>
        </label>

        <?php if (!empty($berita->gambar)): ?>
          <div class="mb-3 text-center">
            <img src="<?= base_url('assets/uploads/berita/' . $berita->gambar) ?>"
                 alt="Gambar saat ini" class="rounded w-100"
                 style="object-fit:cover;max-height:220px;border:1px solid var(--cyber-border);">
            <small class="d-block mt-2" style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:0.7rem;">
              <i class="bi bi-check-circle me-1" style="color:var(--cyber-green);"></i>Gambar terpasang
            </small>
          </div>
        <?php endif; ?>

        <input type="file" name="gambar" class="cyber-input" accept=".jpg,.jpeg,.png,.webp"
               onchange="previewImg(this)">
        <div id="imgPreview" class="mt-2 text-center" style="display:none;">
          <img id="previewSrc" src="" alt="Preview" class="rounded w-100"
               style="object-fit:cover;max-height:180px;border:1px solid var(--cyber-border);">
          <small class="d-block mt-1" style="color:var(--cyber-cyan);font-size:0.75rem;">Preview gambar baru</small>
        </div>
      </div>

      <!-- Tombol Aksi -->
      <div class="cyber-card">
        <label class="cyber-label mb-3">
          <i class="bi bi-send me-1" style="color:var(--cyber-cyan);"></i>Publikasi
        </label>
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-cyber" style="padding:.75rem;">
            <i class="bi bi-save me-2"></i>Simpan Berita
          </button>
          <a href="<?= site_url('berita') ?>" class="btn btn-cyber text-center"
             style="background:transparent;border-color:var(--cyber-border);color:var(--cyber-text-dim);padding:.75rem;">
            <i class="bi bi-x-lg me-2"></i>Batal
          </a>
        </div>
        <hr style="border-color:var(--cyber-border);margin:1rem 0;">
        <div style="color:var(--cyber-text-dim);font-size:0.78rem;line-height:1.6;">
          <i class="bi bi-info-circle me-1" style="color:var(--cyber-amber);"></i>
          Format gambar: JPG, PNG, WEBP.<br>
          Slug otomatis dibuat dari judul.
        </div>
      </div>

    </div>
  </div>

  <?= form_close() ?>
</main>

<script>
function previewImg(input) {
  const preview = document.getElementById('imgPreview');
  const src = document.getElementById('previewSrc');
  if (input.files && input.files[0]) {
    src.src = URL.createObjectURL(input.files[0]);
    preview.style.display = 'block';
  }
}
</script>
