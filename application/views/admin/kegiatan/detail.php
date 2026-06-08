<?php /* Flash handled by footer __ttis_flash__ bridge */ ?>

<main class="container-fluid px-4 py-4">

  <!-- Page Header -->
  <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
    <div>
      <small style="color:var(--cyber-cyan);font-family:var(--font-mono);letter-spacing:2px;font-size:.72rem;">// MANAJEMEN KEGIATAN &rsaquo; DETAIL</small>
      <h4 style="font-family:var(--font-display);color:var(--cyber-text);margin:.25rem 0 .1rem;line-height:1.3;">
        <?= htmlspecialchars($kegiatan->nama_kegiatan) ?>
      </h4>
      <div style="font-family:var(--font-mono);font-size:.73rem;color:var(--cyber-text-dim);">
        <i class="bi bi-calendar-event me-1" style="color:var(--cyber-cyan);"></i>
        <?= date('d M Y', strtotime($kegiatan->waktu_kegiatan)) ?>
        <span style="color:var(--cyber-green);margin-left:.3rem;"><?= date('H:i', strtotime($kegiatan->waktu_kegiatan)) ?> WIB</span>
      </div>
    </div>

    <!-- Action Buttons -->
    <div class="d-flex gap-2 flex-wrap align-items-start">
      <a href="<?= site_url('kegiatan') ?>"
         class="btn btn-cyber btn-sm" style="border-color:rgba(168,85,247,.5);color:var(--cyber-purple);">
        <i class="bi bi-arrow-left me-1"></i>Kembali
      </a>
      <a href="<?= site_url('kegiatan/edit/' . $kegiatan->id) ?>"
         class="btn btn-cyber btn-sm" style="border-color:rgba(255,176,32,.5);color:var(--cyber-amber);">
        <i class="bi bi-pencil-square me-1"></i>Edit
      </a>
      <a href="<?= site_url('kegiatan/absensi/' . $kegiatan->id) ?>"
         class="btn btn-cyber btn-sm">
        <i class="bi bi-people me-1"></i>Data Absensi
      </a>
      <a href="<?= site_url('kegiatan/toggle_absensi/' . $kegiatan->id) ?>"
         class="btn btn-cyber btn-sm"
         style="<?= $kegiatan->is_absensi_open
           ? 'border-color:rgba(255,59,92,.5);color:var(--cyber-red);'
           : 'border-color:rgba(0,255,136,.5);color:var(--cyber-green);' ?>">
        <?php if ($kegiatan->is_absensi_open): ?>
          <i class="bi bi-lock me-1"></i>Tutup Absensi
        <?php else: ?>
          <i class="bi bi-unlock me-1"></i>Buka Absensi
        <?php endif; ?>
      </a>
      <a href="<?= site_url('kegiatan/hapus/' . $kegiatan->id) ?>"
         class="btn btn-cyber btn-sm"
         style="border-color:rgba(255,59,92,.5);color:var(--cyber-red);"
         data-confirm="Hapus kegiatan &quot;<?= htmlspecialchars(addslashes($kegiatan->nama_kegiatan)) ?>&quot;? Tindakan ini tidak dapat dibatalkan."
         data-confirm-title="HAPUS KEGIATAN">
        <i class="bi bi-trash me-1"></i>Hapus
      </a>
    </div>
  </div>

  <!-- Status Banner -->
  <div class="mb-4">
    <?php if (!empty($kegiatan->is_absensi_open) && $kegiatan->is_absensi_open == 1): ?>
      <div style="display:inline-flex;align-items:center;gap:.5rem;background:rgba(0,255,136,0.06);border:1px solid var(--cyber-green);padding:.45rem 1.1rem;border-radius:2px;">
        <span style="width:7px;height:7px;background:var(--cyber-green);border-radius:50%;animation:blink 1s step-end infinite;"></span>
        <span style="font-family:var(--font-mono);font-size:.72rem;color:var(--cyber-green);letter-spacing:2px;">ABSENSI SEDANG TERBUKA</span>
        <span style="color:var(--cyber-text-dim);font-size:.72rem;font-family:var(--font-mono);">— Peserta dapat mengisi absensi sekarang</span>
      </div>
    <?php else: ?>
      <div style="display:inline-flex;align-items:center;gap:.5rem;background:rgba(255,59,92,0.05);border:1px solid rgba(255,59,92,.3);padding:.45rem 1.1rem;border-radius:2px;">
        <span style="font-family:var(--font-mono);font-size:.72rem;color:rgba(255,59,92,.7);letter-spacing:2px;">ABSENSI DITUTUP</span>
      </div>
    <?php endif; ?>
  </div>

  <!-- Content Row -->
  <div class="row g-4">

    <!-- Left: Gambar + Keterangan -->
    <div class="col-lg-7">

      <?php if (!empty($kegiatan->gambar)): ?>
        <div class="cyber-card p-0 overflow-hidden mb-4 scroll-reveal" style="border-radius:3px;">
          <img src="<?= base_url('assets/uploads/kegiatan/' . $kegiatan->gambar) ?>"
               alt="<?= htmlspecialchars($kegiatan->nama_kegiatan) ?>"
               style="width:100%;max-height:360px;object-fit:cover;display:block;filter:brightness(0.88) saturate(0.9);">
        </div>
      <?php endif; ?>

      <?php if (!empty($kegiatan->keterangan)): ?>
        <div class="cyber-card scroll-reveal">
          <div style="font-family:var(--font-mono);font-size:.68rem;color:var(--cyber-cyan);letter-spacing:2px;margin-bottom:1rem;">
            <i class="bi bi-file-text me-1"></i>KETERANGAN
          </div>
          <div style="font-size:.92rem;color:var(--cyber-text);line-height:1.75;white-space:pre-wrap;max-height:360px;overflow-y:auto;">
            <?= htmlspecialchars($kegiatan->keterangan) ?>
          </div>
        </div>
      <?php endif; ?>
    </div>

    <!-- Right: Info + Actions -->
    <div class="col-lg-5">
      <div style="position:sticky;top:1rem;" class="d-flex flex-column gap-3">

        <!-- Info Card -->
        <div class="cyber-card scroll-reveal">
          <div style="font-family:var(--font-mono);font-size:.68rem;color:var(--cyber-cyan);letter-spacing:2px;margin-bottom:1.25rem;">
            <i class="bi bi-info-circle me-1"></i>DETAIL KEGIATAN
          </div>
          <div class="d-flex flex-column gap-3">
            <div>
              <div style="font-size:.68rem;color:var(--cyber-text-dim);font-family:var(--font-mono);letter-spacing:1px;margin-bottom:4px;">NAMA KEGIATAN</div>
              <div style="font-family:var(--font-display);font-size:.95rem;color:var(--cyber-text);font-weight:600;line-height:1.4;">
                <?= htmlspecialchars($kegiatan->nama_kegiatan) ?>
              </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;">
              <div>
                <div style="font-size:.68rem;color:var(--cyber-text-dim);font-family:var(--font-mono);letter-spacing:1px;margin-bottom:4px;">TANGGAL</div>
                <div style="font-family:var(--font-mono);font-size:.88rem;color:var(--cyber-cyan);">
                  <?= date('d M Y', strtotime($kegiatan->waktu_kegiatan)) ?>
                </div>
              </div>
              <div>
                <div style="font-size:.68rem;color:var(--cyber-text-dim);font-family:var(--font-mono);letter-spacing:1px;margin-bottom:4px;">WAKTU</div>
                <div style="font-family:var(--font-mono);font-size:.88rem;color:var(--cyber-green);">
                  <?= date('H:i', strtotime($kegiatan->waktu_kegiatan)) ?> WIB
                </div>
              </div>
            </div>
            <div>
              <div style="font-size:.68rem;color:var(--cyber-text-dim);font-family:var(--font-mono);letter-spacing:1px;margin-bottom:4px;">STATUS ABSENSI</div>
              <?php if (!empty($kegiatan->is_absensi_open) && $kegiatan->is_absensi_open): ?>
                <span style="color:var(--cyber-green);font-family:var(--font-mono);font-size:.85rem;">
                  <i class="bi bi-check-circle me-1"></i>Terbuka
                </span>
              <?php else: ?>
                <span style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:.85rem;">
                  <i class="bi bi-x-circle me-1"></i>Ditutup
                </span>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!-- Sertifikat Card -->
        <?php if (!empty($kegiatan->sertifikat_link)): ?>
          <div class="cyber-card scroll-reveal">
            <div style="font-family:var(--font-mono);font-size:.68rem;color:var(--cyber-amber);letter-spacing:2px;margin-bottom:.85rem;">
              <i class="bi bi-award me-1"></i>LINK SERTIFIKAT
            </div>
            <a href="<?= htmlspecialchars($kegiatan->sertifikat_link) ?>" target="_blank" rel="noopener noreferrer"
               style="display:block;font-family:var(--font-mono);font-size:.8rem;color:var(--cyber-cyan);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;text-decoration:none;margin-bottom:.75rem;">
              <i class="bi bi-globe me-1"></i><?= htmlspecialchars($kegiatan->sertifikat_link) ?>
            </a>
            <a href="<?= htmlspecialchars($kegiatan->sertifikat_link) ?>" target="_blank" rel="noopener noreferrer"
               class="btn btn-cyber btn-sm w-100" style="border-color:rgba(255,176,32,.5);color:var(--cyber-amber);">
              <i class="bi bi-box-arrow-up-right me-1"></i>Buka Sertifikat
            </a>
          </div>
        <?php endif; ?>

        <!-- Lampiran Card -->
        <?php
          $lampiran_files = [];
          if (!empty($kegiatan->lampiran)) {
            $decoded = json_decode($kegiatan->lampiran, true);
            $lampiran_files = is_array($decoded) ? $decoded : [$kegiatan->lampiran];
          }
        ?>
        <?php if (!empty($lampiran_files)): ?>
          <div class="cyber-card scroll-reveal">
            <div style="font-family:var(--font-mono);font-size:.68rem;color:var(--cyber-purple);letter-spacing:2px;margin-bottom:.85rem;">
              <i class="bi bi-paperclip me-1"></i>LAMPIRAN (<?= count($lampiran_files) ?> file)
            </div>
            <div class="d-flex flex-column gap-2">
              <?php foreach ($lampiran_files as $i => $file):
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                $icon = in_array($ext, ['jpg','jpeg','png','webp']) ? 'bi-image' :
                        ($ext === 'pdf' ? 'bi-file-earmark-pdf' :
                        (in_array($ext, ['xls','xlsx']) ? 'bi-file-earmark-excel' :
                        (in_array($ext, ['doc','docx']) ? 'bi-file-earmark-word' : 'bi-file-earmark-zip')));
              ?>
                <a href="<?= base_url('assets/uploads/lampiran/' . $file) ?>"
                   target="_blank" download
                   class="btn btn-cyber btn-sm"
                   style="border-color:rgba(168,85,247,.4);color:var(--cyber-purple);font-size:.78rem;justify-content:flex-start;">
                  <i class="bi <?= $icon ?> me-2"></i>
                  Lampiran <?= count($lampiran_files) > 1 ? ($i + 1) : '' ?>
                  <span style="opacity:.5;margin-left:auto;font-size:.7rem;">.<?= $ext ?></span>
                </a>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>

        <!-- Quick Actions Card -->
        <div class="cyber-card scroll-reveal">
          <div style="font-family:var(--font-mono);font-size:.68rem;color:var(--cyber-text-dim);letter-spacing:2px;margin-bottom:.85rem;">
            <i class="bi bi-lightning me-1"></i>AKSI CEPAT
          </div>
          <div class="d-grid gap-2">
            <a href="<?= site_url('kegiatan/absensi/' . $kegiatan->id) ?>" class="btn btn-cyber btn-sm">
              <i class="bi bi-people me-1"></i>Lihat Data Absensi
            </a>
            <?php if (!empty($kegiatan->is_absensi_open) && $kegiatan->is_absensi_open): ?>
              <a href="<?= site_url('kegiatan/export_excel/' . $kegiatan->id) ?>" class="btn btn-cyber btn-sm"
                 style="border-color:rgba(0,255,136,.5);color:var(--cyber-green);">
                <i class="bi bi-file-earmark-excel me-1"></i>Export Absensi Excel
              </a>
            <?php endif; ?>
            <a href="<?= site_url('kegiatan/edit/' . $kegiatan->id) ?>" class="btn btn-cyber btn-sm"
               style="border-color:rgba(255,176,32,.5);color:var(--cyber-amber);">
              <i class="bi bi-pencil-square me-1"></i>Edit Kegiatan
            </a>
          </div>
        </div>

      </div><!-- end sticky -->
    </div>

  </div>

</main>
