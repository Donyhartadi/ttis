<div class="container py-5" style="max-width:960px;">
  <!-- Breadcrumb -->
  <nav style="margin-bottom:2rem;">
    <small style="font-family:var(--font-mono);color:var(--cyber-text-dim);">
      <a href="<?= base_url() ?>" style="color:var(--cyber-cyan);text-decoration:none;">Beranda</a>
      <span class="mx-2">/</span>
      <a href="<?= base_url('welcome/kegiatan') ?>" style="color:var(--cyber-cyan);text-decoration:none;">Kegiatan</a>
      <span class="mx-2">/</span>
      <span style="color:var(--cyber-text);"><?= htmlspecialchars(mb_strimwidth($kegiatan->nama_kegiatan, 0, 40, '...')) ?></span>
    </small>
  </nav>

  <div class="cyber-card overflow-hidden">
    <div class="row g-0">
      
      <!-- Gambar -->
      <?php if (!empty($kegiatan->gambar)): ?>
        <div class="col-lg-5" style="max-height:520px;overflow:hidden;">
          <img src="<?= base_url('assets/uploads/kegiatan/'.$kegiatan->gambar) ?>"
               alt="<?= htmlspecialchars($kegiatan->nama_kegiatan) ?>"
               style="width:100%;height:100%;object-fit:cover;filter:brightness(0.85) saturate(0.9);">
        </div>
      <?php endif; ?>

      <!-- Konten -->
      <div class="<?= !empty($kegiatan->gambar) ? 'col-lg-7' : 'col-12' ?>" style="padding:2rem 2.5rem;">
        
        <div style="font-family:var(--font-mono);font-size:0.7rem;color:var(--cyber-green);letter-spacing:2px;margin-bottom:0.75rem;">// DETAIL KEGIATAN</div>
        
        <h2 style="font-family:var(--font-display);font-size:clamp(1.1rem,2.5vw,1.5rem);color:var(--cyber-cyan);letter-spacing:1px;line-height:1.3;margin-bottom:1.2rem;">
          <?= htmlspecialchars($kegiatan->nama_kegiatan) ?>
        </h2>

        <?php if (!empty($kegiatan->waktu_kegiatan)): ?>
          <div style="margin-bottom:1rem;">
            <span style="background:rgba(0,212,255,0.08);border:1px solid var(--cyber-border);color:var(--cyber-cyan);font-family:var(--font-mono);font-size:0.75rem;padding:4px 14px;letter-spacing:1px;">
              <i class="bi bi-calendar3 me-1"></i><?= date('d M Y, H:i', strtotime($kegiatan->waktu_kegiatan)) ?> WIB
            </span>
          </div>
        <?php endif; ?>

        <div style="color:var(--cyber-text);font-size:0.95rem;line-height:1.8;margin-bottom:1.5rem;">
          <?= nl2br(htmlspecialchars($kegiatan->keterangan)) ?>
        </div>

        <!-- Lampiran -->
        <?php if (!empty($kegiatan->lampiran)): ?>
          <?php
            $lampiran_list = json_decode($kegiatan->lampiran, true);
            if (!is_array($lampiran_list)) $lampiran_list = [$kegiatan->lampiran];
          ?>
          <div style="margin-bottom:1.5rem;">
            <div style="font-family:var(--font-mono);font-size:0.7rem;color:var(--cyber-text-dim);letter-spacing:2px;margin-bottom:0.5rem;">LAMPIRAN</div>
            <div class="d-flex flex-wrap gap-2">
              <?php foreach ($lampiran_list as $idx => $lampiran): ?>
                <a href="<?= base_url('assets/uploads/lampiran/' . $lampiran) ?>"
                   class="btn btn-cyber btn-sm" target="_blank" download>
                  <i class="bi bi-download me-1"></i>Lampiran <?= count($lampiran_list) > 1 ? ($idx+1) : '' ?>
                </a>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>

        <!-- Sertifikat -->
        <?php if (!empty($kegiatan->sertifikat_link)): ?>
          <div style="margin-bottom:1.5rem;">
            <a href="<?= htmlspecialchars($kegiatan->sertifikat_link) ?>" class="btn btn-cyber-green btn-cyber btn-sm" target="_blank">
              <i class="bi bi-award me-1"></i>Lihat Sertifikat
            </a>
          </div>
        <?php endif; ?>

        <!-- Action Buttons -->
        <div class="d-flex flex-wrap gap-2 mt-3">
          <a href="<?= base_url('welcome/kegiatan') ?>" class="btn btn-cyber-outline btn-cyber btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Kembali
          </a>
          <?php if (!empty($kegiatan->is_absensi_open) && $kegiatan->is_absensi_open): ?>
            <a href="<?= base_url('welcome/absen/'.$kegiatan->id) ?>" class="btn btn-cyber-green btn-cyber">
              <i class="bi bi-person-check me-1"></i>Isi Absensi
            </a>
          <?php else: ?>
            <button class="btn btn-cyber btn-sm" disabled style="opacity:0.4;cursor:not-allowed;">
              <i class="bi bi-x-circle me-1"></i>Absensi Ditutup
            </button>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
