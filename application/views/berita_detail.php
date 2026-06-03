<div class="container py-5" style="max-width:860px;">
  <!-- Breadcrumb -->
  <nav style="margin-bottom:2rem;">
    <small style="font-family:var(--font-mono);color:var(--cyber-text-dim);">
      <a href="<?= base_url() ?>" style="color:var(--cyber-cyan);text-decoration:none;">Beranda</a>
      <span class="mx-2">/</span>
      <a href="<?= base_url('welcome/berita') ?>" style="color:var(--cyber-cyan);text-decoration:none;">Berita</a>
      <span class="mx-2">/</span>
      <span style="color:var(--cyber-text);"><?= htmlspecialchars(mb_strimwidth($berita->judul, 0, 40, '...')) ?></span>
    </small>
  </nav>

  <!-- Kategori Badge -->
  <div style="margin-bottom:1rem;">
    <span style="background:rgba(0,212,255,0.1);border:1px solid var(--cyber-border);color:var(--cyber-cyan);font-family:var(--font-mono);font-size:0.7rem;padding:3px 12px;letter-spacing:2px;text-transform:uppercase;">
      <?= htmlspecialchars($berita->kategori) ?>
    </span>
  </div>

  <!-- Judul -->
  <h1 style="font-family:var(--font-display);font-size:clamp(1.4rem,3vw,2.2rem);color:var(--cyber-text);line-height:1.3;margin-bottom:1rem;">
    <?= htmlspecialchars($berita->judul) ?>
  </h1>

  <!-- Meta -->
  <div style="font-family:var(--font-mono);font-size:0.75rem;color:var(--cyber-text-dim);margin-bottom:2rem;display:flex;flex-wrap:wrap;gap:1.5rem;border-bottom:1px solid var(--cyber-border);padding-bottom:1rem;">
    <span><i class="bi bi-calendar3 me-1"></i><?= date('d M Y', strtotime($berita->tanggal)) ?></span>
    <span><i class="bi bi-person me-1"></i><?= htmlspecialchars(ucwords($berita->penulis ?? 'Tim Persandian')) ?></span>
    <span><i class="bi bi-tag me-1"></i><?= htmlspecialchars($berita->kategori) ?></span>
  </div>

  <!-- Gambar -->
  <?php if (!empty($berita->gambar)): ?>
    <div style="margin-bottom:2rem;border:1px solid var(--cyber-border);border-radius:4px;overflow:hidden;">
      <img src="<?= base_url('assets/uploads/berita/' . $berita->gambar) ?>"
           alt="<?= htmlspecialchars($berita->judul) ?>"
           style="width:100%;max-height:420px;object-fit:cover;display:block;filter:brightness(0.9) saturate(0.95);">
    </div>
  <?php endif; ?>

  <!-- Isi Berita -->
  <div style="color:var(--cyber-text);font-size:1rem;line-height:1.9;text-align:justify;">
    <?= nl2br($berita->isi) ?>
  </div>

  <!-- Back Button -->
  <div style="margin-top:3rem;padding-top:1.5rem;border-top:1px solid var(--cyber-border);">
    <a href="<?= base_url('welcome/berita') ?>" class="btn btn-cyber-outline btn-cyber">
      <i class="bi bi-arrow-left me-2"></i>Kembali ke Berita
    </a>
  </div>
</div>
