<main class="container-fluid px-4 py-4">
  <nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb" style="background:transparent;padding:0;">
      <li class="breadcrumb-item"><a href="<?= site_url('admin/berita') ?>" style="color:var(--cyber-cyan);text-decoration:none;">Berita</a></li>
      <li class="breadcrumb-item active" style="color:var(--cyber-text-dim);">Detail</li>
    </ol>
  </nav>

  <div class="cyber-card" style="max-width:860px;">
    <?php if (!empty($berita->gambar)): ?>
      <img src="<?= base_url('assets/uploads/berita/' . $berita->gambar) ?>" alt="<?= htmlspecialchars($berita->judul) ?>" class="w-100 rounded mb-4" style="max-height:400px;object-fit:cover;border:1px solid var(--cyber-border);">
    <?php endif; ?>

    <div class="mb-2">
      <span class="badge-cyber-cyan me-2"><?= $berita->kategori ?></span>
      <span style="color:var(--cyber-text-dim);font-size:0.85rem;"><?= date('d M Y', strtotime($berita->tanggal)) ?></span>
      <?php if (!empty($berita->waktu_kegiatan)): ?>
        <span style="color:var(--cyber-text-dim);font-size:0.85rem;"> &middot; <?= date('H:i', strtotime($berita->waktu_kegiatan)) ?> WIB</span>
      <?php endif; ?>
    </div>

    <h2 class="mb-3" style="font-family:var(--font-display);color:var(--cyber-text);font-size:1.6rem;"><?= $berita->judul ?></h2>

    <div class="mb-4 pb-3" style="border-bottom:1px solid var(--cyber-border);">
      <small style="color:var(--cyber-text-dim);font-family:var(--font-mono);">Tim Persandian dan Keamanan Informasi</small>
    </div>

    <div style="color:var(--cyber-text);line-height:1.85;text-align:justify;">
      <?= nl2br($berita->isi) ?>
    </div>

    <div class="mt-4 pt-3 d-flex gap-2" style="border-top:1px solid var(--cyber-border);">
      <a href="<?= site_url('berita/edit/' . $berita->id) ?>" class="btn btn-cyber" style="background:rgba(255,176,32,0.08);border-color:var(--cyber-amber);color:var(--cyber-amber);">
        <i class="bi bi-pencil me-1"></i>Edit
      </a>
      <a href="<?= site_url('berita') ?>" class="btn btn-cyber" style="background:transparent;border-color:var(--cyber-border);color:var(--cyber-text-dim);">
        <i class="bi bi-arrow-left me-1"></i>Kembali
      </a>
    </div>
  </div>
</main>
