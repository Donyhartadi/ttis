<div class="container py-4 py-lg-5 kegiatan-detail-wrap">

  <!-- Breadcrumb -->
  <nav class="scroll-reveal mb-3 mb-lg-4">
    <small style="font-family:var(--font-mono);color:var(--cyber-text-dim);font-size:0.7rem;">
      <a href="<?= base_url() ?>" style="color:var(--cyber-cyan);text-decoration:none;">Beranda</a>
      <span style="margin:0 .4rem;opacity:.35;">/</span>
      <a href="<?= base_url('welcome/kegiatan') ?>" style="color:var(--cyber-cyan);text-decoration:none;">Kegiatan</a>
      <span style="margin:0 .4rem;opacity:.35;">/</span>
      <span style="color:var(--cyber-text);"><?= htmlspecialchars(mb_strimwidth($kegiatan->nama_kegiatan, 0, 42, '...')) ?></span>
    </small>
  </nav>

  <?php
    $is_open = !empty($kegiatan->is_absensi_open) && $kegiatan->is_absensi_open == 1;
    $lampiran_list = [];
    if (!empty($kegiatan->lampiran)) {
      $decoded = json_decode($kegiatan->lampiran, true);
      $lampiran_list = is_array($decoded) ? $decoded : [$kegiatan->lampiran];
    }
  ?>

  <!-- ===== HERO ===== -->
  <?php if (!empty($kegiatan->gambar)): ?>
    <div class="scroll-reveal kegiatan-hero-wrap">
      <img src="<?= base_url('assets/uploads/kegiatan/'.$kegiatan->gambar) ?>"
           alt="<?= htmlspecialchars($kegiatan->nama_kegiatan) ?>"
           class="kegiatan-hero-img">

      <!-- gradient overlay -->
      <div class="kegiatan-hero-grad"></div>

      <!-- status badge top-right -->
      <div class="kegiatan-hero-badge">
        <?php if ($is_open): ?>
          <span class="kg-badge-open">
            <span class="kg-dot"></span>ABSENSI TERBUKA
          </span>
        <?php else: ?>
          <span class="kg-badge-closed">ABSENSI DITUTUP</span>
        <?php endif; ?>
      </div>

      <!-- title + date bottom-left -->
      <div class="kegiatan-hero-body">
        <div class="kg-label">// DETAIL KEGIATAN</div>
        <h1 class="kg-title"><?= htmlspecialchars($kegiatan->nama_kegiatan) ?></h1>
        <?php if (!empty($kegiatan->waktu_kegiatan)): ?>
          <span class="kg-date-badge d-none d-lg-inline-block">
            <i class="bi bi-calendar3 me-1"></i><?= date('d M Y', strtotime($kegiatan->waktu_kegiatan)) ?>
            <span class="kg-time"><?= date('H:i', strtotime($kegiatan->waktu_kegiatan)) ?> WIB</span>
          </span>
        <?php endif; ?>
      </div>
    </div>

  <?php else: ?>
    <!-- No image header -->
    <div class="scroll-reveal kegiatan-noimg-header">
      <div class="kg-label">// DETAIL KEGIATAN</div>
      <h1 class="kg-title-noimg"><?= htmlspecialchars($kegiatan->nama_kegiatan) ?></h1>
      <div class="d-flex flex-wrap align-items-center gap-2 mt-3">
        <?php if (!empty($kegiatan->waktu_kegiatan)): ?>
          <span class="kg-date-badge">
            <i class="bi bi-calendar3 me-1"></i><?= date('d M Y', strtotime($kegiatan->waktu_kegiatan)) ?>
            <span class="kg-time"><?= date('H:i', strtotime($kegiatan->waktu_kegiatan)) ?> WIB</span>
          </span>
        <?php endif; ?>
        <?php if ($is_open): ?>
          <span class="kg-badge-open"><span class="kg-dot"></span>ABSENSI TERBUKA</span>
        <?php else: ?>
          <span class="kg-badge-closed">ABSENSI DITUTUP</span>
        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>

  <!-- ===== MOBILE INFO STRIP (hidden on lg+) ===== -->
  <div class="kegiatan-mobile-strip d-lg-none scroll-reveal">
    <?php if (!empty($kegiatan->waktu_kegiatan)): ?>
      <div class="kg-strip-item">
        <i class="bi bi-calendar3" style="color:var(--cyber-cyan);"></i>
        <span><?= date('d M Y', strtotime($kegiatan->waktu_kegiatan)) ?></span>
      </div>
      <div class="kg-strip-sep"></div>
      <div class="kg-strip-item">
        <i class="bi bi-clock" style="color:var(--cyber-green);"></i>
        <span style="color:var(--cyber-green);"><?= date('H:i', strtotime($kegiatan->waktu_kegiatan)) ?> WIB</span>
      </div>
      <?php if (!empty($lampiran_list)): ?>
        <div class="kg-strip-sep"></div>
        <div class="kg-strip-item">
          <i class="bi bi-paperclip" style="color:var(--cyber-purple);"></i>
          <span style="color:var(--cyber-purple);"><?= count($lampiran_list) ?> lampiran</span>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>

  <!-- ===== MOBILE ABSENSI CTA (shown before content on mobile) ===== -->
  <div class="d-lg-none scroll-reveal mb-4">
    <?php if ($is_open): ?>
      <div class="kg-absensi-cta-mobile">
        <div class="d-flex align-items-center gap-2 mb-2">
          <span class="kg-dot" style="width:8px;height:8px;"></span>
          <span style="font-family:var(--font-mono);font-size:0.7rem;color:var(--cyber-green);letter-spacing:2px;">ABSENSI SEDANG TERBUKA</span>
        </div>
        <a href="<?= base_url('welcome/absen/'.$kegiatan->id) ?>"
           class="btn btn-cyber w-100"
           style="border-color:var(--cyber-green);color:var(--cyber-green);background:rgba(0,255,136,0.07);padding:.8rem;font-size:1rem;">
          <i class="bi bi-person-check-fill me-2"></i>Isi Absensi Sekarang
        </a>
      </div>
    <?php else: ?>
      <div class="kg-absensi-closed-mobile">
        <i class="bi bi-x-circle me-2" style="color:var(--cyber-text-dim);"></i>
        <span style="font-family:var(--font-mono);font-size:0.78rem;color:var(--cyber-text-dim);">Absensi belum dibuka atau sudah berakhir</span>
      </div>
    <?php endif; ?>
  </div>

  <!-- ===== MAIN CONTENT GRID ===== -->
  <div class="row g-4">

    <!-- ===== LEFT: Keterangan + Lampiran + Nav ===== -->
    <div class="col-lg-8">

      <!-- Keterangan -->
      <div class="cyber-card scroll-reveal" style="margin-bottom:1.25rem;">
        <div class="kg-section-label" style="color:var(--cyber-cyan);">
          <i class="bi bi-file-text me-1"></i>KETERANGAN
        </div>
        <div class="kg-body-text">
          <?= nl2br(htmlspecialchars($kegiatan->keterangan)) ?>
        </div>
      </div>

      <!-- Lampiran -->
      <?php if (!empty($lampiran_list)): ?>
        <div class="cyber-card scroll-reveal" style="margin-bottom:1.25rem;">
          <div class="kg-section-label" style="color:var(--cyber-purple);">
            <i class="bi bi-paperclip me-1"></i>LAMPIRAN (<?= count($lampiran_list) ?> file)
          </div>
          <div class="d-flex flex-column flex-sm-row flex-wrap gap-2">
            <?php foreach ($lampiran_list as $idx => $lampiran):
              $ext = strtolower(pathinfo($lampiran, PATHINFO_EXTENSION));
              $icon = in_array($ext, ['jpg','jpeg','png','webp']) ? 'bi-image' :
                      ($ext === 'pdf' ? 'bi-file-earmark-pdf' :
                      (in_array($ext, ['xls','xlsx']) ? 'bi-file-earmark-excel' :
                      (in_array($ext, ['doc','docx']) ? 'bi-file-earmark-word' : 'bi-file-earmark-zip')));
            ?>
              <a href="<?= base_url('assets/uploads/lampiran/' . $lampiran) ?>"
                 target="_blank" download
                 class="btn btn-cyber btn-sm"
                 style="border-color:rgba(168,85,247,.4);color:var(--cyber-purple);">
                <i class="bi <?= $icon ?> me-1"></i>
                Lampiran <?= count($lampiran_list) > 1 ? ($idx + 1) : '' ?>
                <small style="opacity:.6;">.<?= $ext ?></small>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>

      <!-- Back button -->
      <div class="d-flex gap-2 scroll-reveal">
        <a href="<?= base_url('welcome/kegiatan') ?>"
           class="btn btn-cyber btn-sm"
           style="background:transparent;border-color:var(--cyber-border);color:var(--cyber-text-dim);">
          <i class="bi bi-arrow-left me-1"></i>Kembali ke Kegiatan
        </a>
      </div>
    </div>

    <!-- ===== RIGHT: Sidebar (desktop only visible; mobile uses strip + CTA above) ===== -->
    <div class="col-lg-4">
      <div class="kegiatan-sidebar">

        <!-- Absensi CTA (desktop only) -->
        <div class="d-none d-lg-block scroll-reveal" style="margin-bottom:1.25rem;">
          <?php if ($is_open): ?>
            <div class="kg-absensi-card-open">
              <div class="d-flex align-items-center gap-2 mb-2">
                <span class="kg-dot" style="width:8px;height:8px;flex-shrink:0;"></span>
                <span style="font-family:var(--font-mono);font-size:0.7rem;color:var(--cyber-green);letter-spacing:2px;">ABSENSI TERBUKA</span>
              </div>
              <p style="color:var(--cyber-text-dim);font-size:0.85rem;line-height:1.6;margin-bottom:1.25rem;">
                Kegiatan ini sedang menerima absensi. Isi formulir absensi Anda sekarang.
              </p>
              <a href="<?= base_url('welcome/absen/'.$kegiatan->id) ?>"
                 class="btn btn-cyber w-100"
                 style="border-color:var(--cyber-green);color:var(--cyber-green);background:rgba(0,255,136,0.06);padding:.75rem;">
                <i class="bi bi-person-check-fill me-2"></i>Isi Absensi Sekarang
              </a>
            </div>
          <?php else: ?>
            <div class="kg-absensi-card-closed">
              <div style="font-family:var(--font-mono);font-size:0.7rem;color:var(--cyber-text-dim);letter-spacing:2px;margin-bottom:0.6rem;">ABSENSI DITUTUP</div>
              <p style="color:var(--cyber-text-dim);font-size:0.83rem;margin:0;line-height:1.55;">Absensi belum dibuka atau sudah berakhir.</p>
            </div>
          <?php endif; ?>
        </div>

        <!-- Info Card (desktop) -->
        <div class="cyber-card scroll-reveal d-none d-lg-block" style="margin-bottom:1.25rem;">
          <div class="kg-section-label" style="color:var(--cyber-cyan);">
            <i class="bi bi-info-circle me-1"></i>INFORMASI
          </div>
          <div style="display:flex;flex-direction:column;gap:0.85rem;">
            <?php if (!empty($kegiatan->waktu_kegiatan)): ?>
              <div>
                <div class="kg-info-label">TANGGAL</div>
                <div style="font-family:var(--font-mono);font-size:0.9rem;color:var(--cyber-cyan);">
                  <?= date('d M Y', strtotime($kegiatan->waktu_kegiatan)) ?>
                </div>
              </div>
              <div>
                <div class="kg-info-label">WAKTU</div>
                <div style="font-family:var(--font-mono);font-size:0.9rem;color:var(--cyber-green);">
                  <?= date('H:i', strtotime($kegiatan->waktu_kegiatan)) ?> WIB
                </div>
              </div>
            <?php endif; ?>
            <div>
              <div class="kg-info-label">STATUS ABSENSI</div>
              <?php if ($is_open): ?>
                <span style="color:var(--cyber-green);font-family:var(--font-mono);font-size:0.85rem;">
                  <i class="bi bi-check-circle me-1"></i>Terbuka
                </span>
              <?php else: ?>
                <span style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:0.85rem;">
                  <i class="bi bi-x-circle me-1"></i>Ditutup
                </span>
              <?php endif; ?>
            </div>
            <?php if (!empty($lampiran_list)): ?>
              <div>
                <div class="kg-info-label">LAMPIRAN</div>
                <span style="color:var(--cyber-purple);font-family:var(--font-mono);font-size:0.85rem;">
                  <i class="bi bi-paperclip me-1"></i><?= count($lampiran_list) ?> file
                </span>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- Sertifikat -->
        <?php if (!empty($kegiatan->sertifikat_link)): ?>
          <div class="cyber-card scroll-reveal" style="margin-bottom:1.25rem;">
            <div class="kg-section-label" style="color:var(--cyber-amber);">
              <i class="bi bi-award me-1"></i>SERTIFIKAT
            </div>
            <p style="color:var(--cyber-text-dim);font-size:0.83rem;margin-bottom:0.9rem;line-height:1.5;">
              Sertifikat kegiatan tersedia untuk diunduh.
            </p>
            <a href="<?= htmlspecialchars($kegiatan->sertifikat_link) ?>" target="_blank" rel="noopener noreferrer"
               class="btn btn-cyber w-100"
               style="border-color:rgba(255,176,32,0.5);color:var(--cyber-amber);background:rgba(255,176,32,0.05);">
              <i class="bi bi-award me-1"></i>Lihat Sertifikat
            </a>
          </div>
        <?php endif; ?>

      </div>
    </div>

  </div>
</div>

<style>
/* ===== KEGIATAN DETAIL — MOBILE-FIRST STYLES ===== */
.kegiatan-detail-wrap { max-width: 980px; }

/* Hero */
.kegiatan-hero-wrap {
  position: relative;
  border-radius: 4px;
  overflow: hidden;
  margin-bottom: 0;
  border: 1px solid var(--cyber-border);
}
.kegiatan-hero-wrap .kegiatan-hero-img {
  width: 100%;
  height: 240px;
  object-fit: cover;
  display: block;
  filter: brightness(0.58) saturate(0.85);
}
.kegiatan-hero-grad {
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg, rgba(5,11,20,0.15) 0%, rgba(5,11,20,0.88) 100%);
  pointer-events: none;
}
.kegiatan-hero-badge {
  position: absolute;
  top: .75rem;
  right: .75rem;
}
.kegiatan-hero-body {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 1.25rem 1rem 1rem;
}

/* No-image header */
.kegiatan-noimg-header {
  margin-bottom: 1.25rem;
  padding-bottom: 1.25rem;
  border-bottom: 1px solid var(--cyber-border);
}
.kg-title-noimg {
  font-family: var(--font-display);
  font-size: clamp(1.15rem, 4vw, 1.7rem);
  color: var(--cyber-text);
  line-height: 1.3;
  margin: 0.5rem 0 0;
}

/* Labels */
.kg-label {
  font-family: var(--font-mono);
  font-size: 0.65rem;
  color: var(--cyber-cyan);
  letter-spacing: 3px;
  margin-bottom: 0.45rem;
}
.kg-title {
  font-family: var(--font-display);
  font-size: clamp(1rem, 4vw, 1.65rem);
  color: var(--cyber-text);
  line-height: 1.3;
  margin: 0 0 0.65rem;
}
.kg-date-badge {
  display: inline-block;
  background: rgba(0,212,255,0.12);
  border: 1px solid rgba(0,212,255,0.3);
  color: var(--cyber-cyan);
  font-family: var(--font-mono);
  font-size: 0.68rem;
  padding: 3px 10px;
  letter-spacing: 0.5px;
}
.kg-time { color: var(--cyber-green); margin-left: 0.4rem; }

/* Badges */
.kg-badge-open {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  background: rgba(0,0,0,0.82);
  border: 1px solid var(--cyber-green);
  color: var(--cyber-green);
  font-family: var(--font-mono);
  font-size: 0.62rem;
  padding: 3px 10px;
  letter-spacing: 1.5px;
}
.kg-badge-closed {
  background: rgba(0,0,0,0.82);
  border: 1px solid rgba(255,255,255,0.18);
  color: rgba(255,255,255,0.4);
  font-family: var(--font-mono);
  font-size: 0.62rem;
  padding: 3px 10px;
  letter-spacing: 1.5px;
}
.kg-dot {
  display: inline-block;
  width: 6px;
  height: 6px;
  background: var(--cyber-green);
  border-radius: 50%;
  animation: blink 1s step-end infinite;
  flex-shrink: 0;
}

/* Mobile info strip */
.kegiatan-mobile-strip {
  display: flex;
  align-items: center;
  gap: .5rem;
  flex-wrap: wrap;
  background: rgba(0,212,255,0.03);
  border: 1px solid var(--cyber-border);
  border-top: none;
  padding: .65rem 1rem;
  font-family: var(--font-mono);
  font-size: .73rem;
  color: var(--cyber-text-dim);
  margin-bottom: 1rem;
}
.kg-strip-item { display: flex; align-items: center; gap: .35rem; }
.kg-strip-sep { width: 1px; height: 14px; background: var(--cyber-border); flex-shrink: 0; }

/* Mobile absensi CTA */
.kg-absensi-cta-mobile {
  background: rgba(0,255,136,0.05);
  border: 1px solid var(--cyber-green);
  border-top: 3px solid var(--cyber-green);
  padding: 1.1rem 1rem 1rem;
  border-radius: 2px;
}
.kg-absensi-closed-mobile {
  display: flex;
  align-items: center;
  padding: .75rem 1rem;
  background: rgba(0,0,0,0.2);
  border: 1px solid rgba(255,255,255,0.07);
  border-radius: 2px;
}

/* Desktop absensi cards */
.kg-absensi-card-open {
  background: rgba(0,255,136,0.05);
  border: 1px solid var(--cyber-green);
  border-top: 3px solid var(--cyber-green);
  padding: 1.35rem;
  border-radius: 2px;
}
.kg-absensi-card-closed {
  background: rgba(0,0,0,0.2);
  border: 1px solid rgba(255,255,255,0.07);
  border-top: 3px solid rgba(255,255,255,0.12);
  padding: 1.35rem;
  border-radius: 2px;
  opacity: .65;
}

/* Sidebar sticky desktop */
.kegiatan-sidebar { position: static; }

/* Section labels inside cards */
.kg-section-label {
  font-family: var(--font-mono);
  font-size: .67rem;
  letter-spacing: 2px;
  margin-bottom: .9rem;
}
.kg-body-text {
  color: var(--cyber-text);
  font-size: .93rem;
  line-height: 1.85;
}
.kg-info-label {
  font-size: .67rem;
  color: var(--cyber-text-dim);
  font-family: var(--font-mono);
  letter-spacing: 1px;
  margin-bottom: 3px;
}

/* ===== TABLET / DESKTOP ===== */
@media (min-width: 576px) {
  .kegiatan-hero-wrap .kegiatan-hero-img { height: 300px; }
  .kegiatan-hero-body { padding: 1.5rem 1.5rem 1.25rem; }
}
@media (min-width: 768px) {
  .kegiatan-hero-wrap .kegiatan-hero-img { height: 360px; }
  .kegiatan-hero-badge { top: 1.1rem; right: 1.1rem; }
  .kegiatan-hero-body { padding: 2rem 2rem 1.75rem; }
  .kg-title { font-size: clamp(1.15rem, 2.5vw, 1.65rem); }
}
@media (min-width: 992px) {
  .kegiatan-hero-wrap .kegiatan-hero-img { height: 420px; }
  .kegiatan-sidebar { position: sticky; top: 1rem; }
}
</style>
