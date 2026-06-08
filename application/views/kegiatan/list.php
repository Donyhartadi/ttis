<div class="container py-5">
  <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-5 scroll-reveal">
    <div>
      <small style="color:var(--cyber-cyan);font-family:var(--font-mono);letter-spacing:3px;">// AGENDA & AKTIVITAS</small>
      <h2 style="font-family:var(--font-display);color:var(--cyber-text);margin-top:0.4rem;">Kegiatan</h2>
      <div class="cyber-divider"></div>
    </div>
    <form method="get" action="<?= base_url('welcome/kegiatan') ?>" class="d-flex gap-2 align-items-start" style="margin-top:0.5rem;">
      <input type="text" name="q" class="form-control cyber-input" placeholder="Cari kegiatan..."
             value="<?= htmlspecialchars($this->input->get('q') ?? '') ?>" style="max-width:220px;">
      <button class="btn btn-cyber px-3" type="submit"><i class="bi bi-search"></i></button>
      <?php if (!empty($this->input->get('q'))): ?>
        <a href="<?= base_url('welcome/kegiatan') ?>" class="btn btn-cyber px-3" style="background:transparent;border-color:var(--cyber-border);color:var(--cyber-text-dim);" title="Reset"><i class="bi bi-x-lg"></i></a>
      <?php endif; ?>
    </form>
  </div>

  <?php if (!empty($this->input->get('q'))): ?>
    <div style="margin-bottom:1.5rem;font-family:var(--font-mono);font-size:0.8rem;color:var(--cyber-text-dim);">
      <i class="bi bi-funnel me-1" style="color:var(--cyber-cyan);"></i>
      Hasil untuk: <strong style="color:var(--cyber-cyan);">"<?= htmlspecialchars($this->input->get('q')) ?>"</strong>
      &mdash; <?= count($kegiatan) ?> kegiatan ditemukan
    </div>
  <?php endif; ?>

  <div class="row g-4">
    <?php if (!empty($kegiatan)): ?>
      <?php foreach ($kegiatan as $item):
        $is_open = !empty($item->is_absensi_open) && $item->is_absensi_open == 1;
      ?>
        <div class="col-md-6 col-lg-4 scroll-reveal">
          <div class="cyber-card cyber-card-shine h-100" style="display:flex;flex-direction:column;padding:0;">

            <!-- Thumbnail -->
            <?php if ($item->gambar): ?>
              <div style="height:200px;overflow:hidden;position:relative;flex-shrink:0;border-radius:2px 2px 0 0;">
                <img src="<?= base_url('assets/uploads/kegiatan/'.$item->gambar) ?>"
                     alt="<?= htmlspecialchars($item->nama_kegiatan) ?>"
                     style="width:100%;height:100%;object-fit:cover;filter:brightness(0.75) saturate(0.9);">
                <div style="position:absolute;inset:0;background:linear-gradient(180deg,transparent 40%,var(--cyber-card) 100%);pointer-events:none;"></div>

                <!-- Status badge -->
                <div style="position:absolute;top:0.65rem;left:0.65rem;">
                  <?php if ($is_open): ?>
                    <span style="display:inline-flex;align-items:center;gap:4px;background:rgba(0,0,0,0.75);border:1px solid var(--cyber-green);color:var(--cyber-green);font-family:var(--font-mono);font-size:0.62rem;padding:3px 9px;letter-spacing:1px;">
                      <span style="width:5px;height:5px;background:var(--cyber-green);border-radius:50%;animation:blink 1s step-end infinite;"></span>ABSENSI BUKA
                    </span>
                  <?php else: ?>
                    <span style="background:rgba(0,0,0,0.75);border:1px solid rgba(255,255,255,0.15);color:rgba(255,255,255,0.45);font-family:var(--font-mono);font-size:0.62rem;padding:3px 9px;letter-spacing:1px;">ABSENSI TUTUP</span>
                  <?php endif; ?>
                </div>

                <!-- Date overlay -->
                <?php if (!empty($item->waktu_kegiatan)): ?>
                  <div style="position:absolute;bottom:0.65rem;left:0.75rem;font-family:var(--font-mono);font-size:0.67rem;color:rgba(255,255,255,0.8);">
                    <i class="bi bi-calendar3 me-1" style="color:var(--cyber-cyan);"></i><?= date('d M Y', strtotime($item->waktu_kegiatan)) ?>
                    <span style="color:var(--cyber-cyan);margin-left:0.35rem;"><?= date('H:i', strtotime($item->waktu_kegiatan)) ?> WIB</span>
                  </div>
                <?php endif; ?>
              </div>
            <?php else: ?>
              <div style="height:120px;background:rgba(0,212,255,0.04);border-bottom:1px solid var(--cyber-border);display:flex;align-items:center;justify-content:center;flex-shrink:0;position:relative;">
                <i class="bi bi-calendar-event" style="font-size:2.5rem;color:var(--cyber-text-dim);"></i>
                <div style="position:absolute;top:0.65rem;left:0.65rem;">
                  <?php if ($is_open): ?>
                    <span style="display:inline-flex;align-items:center;gap:4px;background:rgba(0,0,0,0.75);border:1px solid var(--cyber-green);color:var(--cyber-green);font-family:var(--font-mono);font-size:0.62rem;padding:3px 9px;letter-spacing:1px;">
                      <span style="width:5px;height:5px;background:var(--cyber-green);border-radius:50%;animation:blink 1s step-end infinite;"></span>ABSENSI BUKA
                    </span>
                  <?php else: ?>
                    <span style="background:rgba(0,0,0,0.75);border:1px solid rgba(255,255,255,0.15);color:rgba(255,255,255,0.45);font-family:var(--font-mono);font-size:0.62rem;padding:3px 9px;letter-spacing:1px;">ABSENSI TUTUP</span>
                  <?php endif; ?>
                </div>
              </div>
            <?php endif; ?>

            <!-- Body -->
            <div style="padding:1.2rem 1.25rem;flex:1;display:flex;flex-direction:column;">
              <?php if (empty($item->gambar) && !empty($item->waktu_kegiatan)): ?>
                <div style="font-family:var(--font-mono);font-size:0.67rem;color:var(--cyber-cyan);margin-bottom:0.6rem;">
                  <i class="bi bi-calendar3 me-1"></i><?= date('d M Y', strtotime($item->waktu_kegiatan)) ?>
                  <span style="color:var(--cyber-text-dim);margin-left:0.35rem;"><?= date('H:i', strtotime($item->waktu_kegiatan)) ?> WIB</span>
                </div>
              <?php endif; ?>

              <h3 style="font-family:var(--font-display);font-size:0.85rem;color:var(--cyber-text);font-weight:600;letter-spacing:0.5px;line-height:1.4;margin-bottom:0.6rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                <?= htmlspecialchars($item->nama_kegiatan) ?>
              </h3>
              <p style="color:var(--cyber-text-dim);font-size:0.88rem;flex:1;line-height:1.6;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;margin:0;">
                <?= htmlspecialchars(character_limiter(strip_tags($item->keterangan ?? ''), 120)) ?>
              </p>
              <div class="mt-3 d-flex gap-2">
                <a href="<?= base_url('welcome/detail_kegiatan/'.$item->id) ?>" class="btn btn-cyber btn-sm flex-fill">
                  <i class="bi bi-arrow-right-circle me-1"></i>Lihat Detail
                </a>
                <?php if ($is_open): ?>
                  <a href="<?= base_url('welcome/absen/'.$item->id) ?>" class="btn btn-cyber btn-sm px-3"
                     style="border-color:rgba(0,255,136,0.5);color:var(--cyber-green);" title="Isi Absensi">
                    <i class="bi bi-person-check"></i>
                  </a>
                <?php endif; ?>
              </div>
            </div>

          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12 text-center py-5">
        <i class="bi bi-calendar-x" style="font-size:3rem;color:var(--cyber-text-dim);"></i>
        <?php if (!empty($this->input->get('q'))): ?>
          <p style="color:var(--cyber-text-dim);margin-top:1rem;font-family:var(--font-mono);">
            Tidak ada kegiatan untuk pencarian <strong>"<?= htmlspecialchars($this->input->get('q')) ?>"</strong>.
          </p>
          <a href="<?= base_url('welcome/kegiatan') ?>" class="btn btn-cyber btn-sm mt-2">Tampilkan Semua</a>
        <?php else: ?>
          <p style="color:var(--cyber-text-dim);margin-top:1rem;font-family:var(--font-mono);">Belum ada kegiatan tersedia.</p>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>

  <!-- Pagination -->
  <?php if (!empty($pagination)): ?>
    <div class="mt-5"><?= $pagination ?></div>
  <?php endif; ?>
</div>
