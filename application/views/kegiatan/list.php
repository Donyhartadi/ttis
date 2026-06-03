<div class="container py-5">
  <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-5">
    <div>
      <small style="color:var(--cyber-cyan);font-family:var(--font-mono);letter-spacing:3px;">// AGENDA & AKTIVITAS</small>
      <h2 style="font-family:var(--font-display);color:var(--cyber-text);margin-top:0.4rem;">Kegiatan</h2>
      <div style="width:60px;height:2px;background:linear-gradient(90deg,var(--cyber-cyan),transparent);margin-top:0.5rem;"></div>
    </div>
    <form method="get" action="<?= base_url('welcome/kegiatan') ?>" class="d-flex gap-2">
      <input type="text" name="q" class="form-control cyber-input" placeholder="Cari kegiatan..."
             value="<?= htmlspecialchars($this->input->get('q') ?? '') ?>" style="max-width:220px;">
      <button class="btn btn-cyber px-3" type="submit"><i class="bi bi-search"></i></button>
    </form>
  </div>

  <div class="row g-4">
    <?php if (!empty($kegiatan)): ?>
      <?php foreach ($kegiatan as $item): ?>
        <div class="col-md-6 col-lg-4">
          <div class="cyber-card h-100" style="display:flex;flex-direction:column;">
            <?php if ($item->gambar): ?>
              <div style="height:190px;overflow:hidden;position:relative;">
                <img src="<?= base_url('assets/uploads/kegiatan/'.$item->gambar) ?>"
                     alt="<?= htmlspecialchars($item->nama_kegiatan) ?>"
                     style="width:100%;height:100%;object-fit:cover;filter:brightness(0.75) saturate(0.9);transition:filter 0.3s;">
                <div style="position:absolute;inset:0;background:linear-gradient(180deg,transparent 40%,var(--cyber-card) 100%);"></div>
                <?php if (!empty($item->waktu_kegiatan)): ?>
                  <span style="position:absolute;top:0.75rem;left:0.75rem;background:rgba(0,0,0,0.7);border:1px solid var(--cyber-border);color:var(--cyber-cyan);font-family:var(--font-mono);font-size:0.65rem;padding:3px 10px;letter-spacing:1px;">
                    <i class="bi bi-calendar3 me-1"></i><?= date('d M Y', strtotime($item->waktu_kegiatan)) ?>
                  </span>
                <?php endif; ?>
              </div>
            <?php else: ?>
              <div style="height:80px;background:rgba(0,212,255,0.03);border-bottom:1px solid var(--cyber-border);display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-calendar-event" style="font-size:2rem;color:var(--cyber-text-dim);"></i>
              </div>
            <?php endif; ?>

            <div style="padding:1.2rem;flex:1;display:flex;flex-direction:column;">
              <h3 style="font-family:var(--font-display);font-size:0.82rem;color:var(--cyber-cyan);letter-spacing:1px;text-transform:uppercase;margin-bottom:0.75rem;">
                <?= htmlspecialchars($item->nama_kegiatan) ?>
              </h3>
              <p style="color:var(--cyber-text);font-size:0.9rem;flex:1;line-height:1.6;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">
                <?= htmlspecialchars(character_limiter(strip_tags($item->keterangan), 120)) ?>
              </p>
              <div class="mt-3">
                <a href="<?= base_url('welcome/detail_kegiatan/'.$item->id) ?>" class="btn btn-cyber btn-sm w-100">
                  <i class="bi bi-arrow-right-circle me-1"></i>Lihat Detail
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12 text-center py-5">
        <i class="bi bi-calendar-x" style="font-size:3rem;color:var(--cyber-text-dim);"></i>
        <p style="color:var(--cyber-text-dim);margin-top:1rem;font-family:var(--font-mono);">Belum ada kegiatan tersedia.</p>
      </div>
    <?php endif; ?>
  </div>
</div>
