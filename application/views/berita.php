<!-- Berita Page -->
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-5 scroll-reveal">
    <div>
      <small style="color:var(--cyber-cyan);font-family:var(--font-mono);letter-spacing:3px;">// PUSAT INFORMASI</small>
      <h2 style="font-family:var(--font-display);color:var(--cyber-text);margin-top:0.4rem;">Berita &amp; Pengumuman</h2>
      <div class="cyber-divider"></div>
    </div>
    <form method="get" action="<?= base_url('welcome/berita') ?>" class="d-flex gap-2 align-items-start" style="margin-top:0.5rem;">
      <input type="text" name="q" class="form-control cyber-input" placeholder="Cari berita..."
             value="<?= htmlspecialchars($q ?? '') ?>" style="max-width:220px;">
      <button class="btn btn-cyber px-3" type="submit"><i class="bi bi-search"></i></button>
      <?php if (!empty($q)): ?>
        <a href="<?= base_url('welcome/berita') ?>" class="btn btn-cyber px-3" style="background:transparent;border-color:var(--cyber-border);color:var(--cyber-text-dim);" title="Reset"><i class="bi bi-x-lg"></i></a>
      <?php endif; ?>
    </form>
  </div>

  <?php if (!empty($q)): ?>
    <div style="margin-bottom:1.5rem;font-family:var(--font-mono);font-size:0.8rem;color:var(--cyber-text-dim);">
      <i class="bi bi-funnel me-1" style="color:var(--cyber-cyan);"></i>
      Hasil untuk: <strong style="color:var(--cyber-cyan);">"<?= htmlspecialchars($q) ?>"</strong>
      — <?= count($berita) ?> berita ditemukan
    </div>
  <?php endif; ?>

  <div class="row g-4">
    <?php foreach ($berita as $b): ?>
      <div class="col-sm-6 col-lg-4 col-xl-3 scroll-reveal">
        <article class="cyber-card cyber-card-shine h-100 d-flex flex-column">
          <?php if ($b->gambar): ?>
            <div style="height:180px;overflow:hidden;position:relative;flex-shrink:0;">
              <img src="<?= base_url('assets/uploads/berita/' . $b->gambar) ?>"
                   alt="<?= htmlspecialchars($b->judul) ?>"
                   style="width:100%;height:100%;object-fit:cover;filter:brightness(0.8) saturate(0.9);">
              <div style="position:absolute;inset:0;background:linear-gradient(180deg,transparent 45%,var(--cyber-card) 100%);pointer-events:none;"></div>
              <div style="position:absolute;top:0.5rem;right:0.5rem;">
                <span style="background:rgba(0,0,0,0.72);border:1px solid var(--cyber-border);color:var(--cyber-cyan);font-family:var(--font-mono);font-size:0.65rem;padding:2px 8px;letter-spacing:1px;"><?= strtoupper(htmlspecialchars($b->kategori)) ?></span>
              </div>
            </div>
          <?php else: ?>
            <div style="height:100px;background:rgba(0,212,255,0.04);border-bottom:1px solid var(--cyber-border);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
              <i class="bi bi-newspaper" style="font-size:2rem;color:var(--cyber-text-dim);"></i>
            </div>
          <?php endif; ?>

          <div style="padding:1.2rem;flex:1;display:flex;flex-direction:column;">
            <h3 style="font-family:var(--font-display);font-size:0.8rem;color:var(--cyber-cyan);letter-spacing:1px;text-transform:uppercase;margin-bottom:0.5rem;line-clamp:2;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
              <?= htmlspecialchars($b->judul) ?>
            </h3>
            <p style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:0.7rem;margin-bottom:0.75rem;display:flex;align-items:center;gap:0.75rem;">
              <span><?= date('d/m/Y', strtotime($b->tanggal)) ?></span>
              <span><i class="bi bi-eye me-1"></i><?= number_format($b->dilihat ?? 0) ?></span>
            </p>
            <p style="color:var(--cyber-text);font-size:0.9rem;flex:1;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;line-height:1.5;">
              <?= htmlspecialchars(word_limiter($b->ringkasan ?: strip_tags($b->isi), 18)) ?>
            </p>
            <div class="mt-3">
              <a href="<?= site_url('welcome/detail/' . $b->slug) ?>" class="btn btn-cyber btn-sm w-100">
                <i class="bi bi-arrow-right-circle me-1"></i>Baca Selengkapnya
              </a>
            </div>
          </div>
        </article>
      </div>
    <?php endforeach; ?>
    <?php if (empty($berita)): ?>
      <div class="col-12 text-center py-5">
        <i class="bi bi-inbox" style="font-size:3rem;color:var(--cyber-text-dim);"></i>
        <?php if (!empty($q)): ?>
          <p style="color:var(--cyber-text-dim);margin-top:1rem;font-family:var(--font-mono);">
            Tidak ada berita untuk pencarian <strong>"<?= htmlspecialchars($q) ?>"</strong>.
          </p>
          <a href="<?= base_url('welcome/berita') ?>" class="btn btn-cyber btn-sm mt-2">Tampilkan Semua</a>
        <?php else: ?>
          <p style="color:var(--cyber-text-dim);margin-top:1rem;font-family:var(--font-mono);">Belum ada berita tersedia.</p>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
