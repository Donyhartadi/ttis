<!-- Berita Page -->
<div class="container py-5">
  <div class="mb-5">
    <small style="color:var(--cyber-cyan);font-family:var(--font-mono);letter-spacing:3px;">// PUSAT INFORMASI</small>
    <h2 style="font-family:var(--font-display);color:var(--cyber-text);margin-top:0.4rem;">Berita &amp; Pengumuman</h2>
    <div style="width:60px;height:2px;background:linear-gradient(90deg,var(--cyber-cyan),transparent);margin-top:0.5rem;"></div>
  </div>

  <?php if ($this->session->flashdata('success')): ?>
    <div style="background:rgba(0,255,136,0.08);border:1px solid var(--cyber-border2);color:var(--cyber-green);padding:1rem;border-radius:4px;margin-bottom:1.5rem;">
      <i class="bi bi-check-circle me-2"></i><?= $this->session->flashdata('success') ?>
    </div>
  <?php endif; ?>

  <div class="row g-4">
    <?php foreach ($berita as $b): ?>
      <div class="col-sm-6 col-lg-4 col-xl-3">
        <article class="cyber-card h-100 d-flex flex-col" style="display:flex;flex-direction:column;">
          <?php if ($b->gambar): ?>
            <div style="height:180px;overflow:hidden;position:relative;">
              <img src="<?= base_url('assets/uploads/berita/' . $b->gambar) ?>"
                   alt="<?= htmlspecialchars($b->judul) ?>"
                   style="width:100%;height:100%;object-fit:cover;filter:brightness(0.8) saturate(0.9);transition:filter 0.3s;">
              <div style="position:absolute;top:0;left:0;right:0;bottom:0;background:linear-gradient(180deg,transparent 50%,var(--cyber-card) 100%);"></div>
              <div style="position:absolute;top:0.5rem;right:0.5rem;">
                <span style="background:rgba(0,0,0,0.7);border:1px solid var(--cyber-border);color:var(--cyber-cyan);font-family:var(--font-mono);font-size:0.65rem;padding:2px 8px;letter-spacing:1px;"><?= strtoupper(htmlspecialchars($b->kategori)) ?></span>
              </div>
            </div>
          <?php else: ?>
            <div style="height:100px;background:rgba(0,212,255,0.04);border-bottom:1px solid var(--cyber-border);display:flex;align-items:center;justify-content:center;">
              <i class="bi bi-newspaper" style="font-size:2rem;color:var(--cyber-text-dim);"></i>
            </div>
          <?php endif; ?>

          <div style="padding:1.2rem;flex:1;display:flex;flex-direction:column;">
            <h3 style="font-family:var(--font-display);font-size:0.8rem;color:var(--cyber-cyan);letter-spacing:1px;text-transform:uppercase;margin-bottom:0.5rem;line-clamp:2;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
              <?= htmlspecialchars($b->judul) ?>
            </h3>
            <p style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:0.7rem;margin-bottom:0.75rem;">
              <?= date('d/m/Y', strtotime($b->tanggal)) ?>
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
        <p style="color:var(--cyber-text-dim);margin-top:1rem;font-family:var(--font-mono);">Belum ada berita tersedia.</p>
      </div>
    <?php endif; ?>
  </div>
</div>
