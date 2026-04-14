<main class="container-fluid px-4 py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <div style="font-family:var(--font-mono);color:var(--cyber-cyan);font-size:0.75rem;letter-spacing:2px;">// MANAJEMEN KONTEN</div>
      <h2 class="mb-0" style="font-family:var(--font-display);color:var(--cyber-text);">Manajemen Berita</h2>
    </div>
    <a href="<?= site_url('berita/tambah') ?>" class="btn btn-cyber">
      <i class="bi bi-plus-lg me-1"></i>Tambah Berita
    </a>
  </div>

  <?php if ($this->session->flashdata('success')): ?>
    <div class="alert-cyber-success mb-4"><?= $this->session->flashdata('success') ?></div>
  <?php endif; ?>

  <div class="row g-4">
    <?php foreach ($berita as $b): ?>
      <div class="col-md-6 col-lg-4">
        <div class="cyber-card h-100 d-flex flex-column">
          <?php if ($b->gambar): ?>
            <img src="<?= base_url('assets/uploads/berita/' . $b->gambar) ?>" class="w-100 rounded mb-3" style="height:180px;object-fit:cover;border:1px solid var(--cyber-border);" alt="<?= htmlspecialchars($b->judul) ?>">
          <?php else: ?>
            <div class="w-100 rounded mb-3 d-flex align-items-center justify-content-center" style="height:180px;background:var(--cyber-bg);border:1px solid var(--cyber-border);color:var(--cyber-text-dim);">
              <i class="bi bi-image fs-2"></i>
            </div>
          <?php endif; ?>
          <div class="flex-grow-1">
            <div class="mb-2">
              <span class="badge-cyber-cyan"><?= $b->kategori ?></span>
              <span class="ms-2" style="color:var(--cyber-text-dim);font-size:0.8rem;"><?= date('d M Y', strtotime($b->tanggal)) ?></span>
            </div>
            <h6 class="mb-2" style="color:var(--cyber-text);font-weight:600;"><?= $b->judul ?></h6>
            <p style="color:var(--cyber-text-dim);font-size:0.85rem;line-height:1.5;"><?= word_limiter($b->ringkasan ?: strip_tags($b->isi), 18) ?></p>
          </div>
          <div class="d-flex gap-2 mt-3">
            <a href="<?= site_url('berita/edit/' . $b->id) ?>" class="btn btn-cyber btn-sm flex-fill" style="background:rgba(255,176,32,0.08);border-color:var(--cyber-amber);color:var(--cyber-amber);">
              <i class="bi bi-pencil me-1"></i>Edit
            </a>
            <a href="<?= site_url('berita/hapus/' . $b->id) ?>" class="btn btn-cyber btn-sm flex-fill" style="background:rgba(255,59,92,0.08);border-color:var(--cyber-red);color:var(--cyber-red);" onclick="return confirm('Hapus berita ini?')">
              <i class="bi bi-trash me-1"></i>Hapus
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    <?php if (empty($berita)): ?>
      <div class="col-12">
        <div class="cyber-card text-center py-5">
          <i class="bi bi-newspaper" style="font-size:3rem;color:var(--cyber-text-dim);"></i>
          <p class="mt-3" style="color:var(--cyber-text-dim);">Belum ada berita. Klik Tambah Berita untuk memulai.</p>
        </div>
      </div>
    <?php endif; ?>
  </div>
</main>
