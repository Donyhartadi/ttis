<?php /* Flash handled by footer __ttis_flash__ bridge */ ?>

<main class="container-fluid px-4 py-4">

  <!-- Page Header -->
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
    <div>
      <small style="color:var(--cyber-cyan);font-family:var(--font-mono);letter-spacing:2px;font-size:0.72rem;">// MANAJEMEN KEGIATAN</small>
      <h4 style="font-family:var(--font-display);color:var(--cyber-text);margin:0.2rem 0 0;">Daftar Kegiatan</h4>
    </div>
    <a href="<?= site_url('kegiatan/tambah') ?>" class="btn btn-cyber">
      <i class="bi bi-plus-lg me-1"></i>Tambah Kegiatan
    </a>
  </div>

  <!-- Stats bar -->
  <?php
    $total_kegiatan = count($kegiatan);
    $total_open = 0;
    foreach ($kegiatan as $item) {
      if (!empty($item->is_absensi_open) && $item->is_absensi_open == 1) $total_open++;
    }
    $total_closed = $total_kegiatan - $total_open;
  ?>
  <div class="row g-3 mb-4">
    <div class="col-sm-4 col-lg-2">
      <div style="background:rgba(0,212,255,0.05);border:1px solid var(--cyber-border);border-left:3px solid var(--cyber-cyan);padding:.85rem 1rem;border-radius:2px;">
        <div style="font-family:var(--font-display);font-size:1.5rem;color:var(--cyber-cyan);"><?= $total_kegiatan ?></div>
        <small style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:.68rem;letter-spacing:1px;">TOTAL</small>
      </div>
    </div>
    <div class="col-sm-4 col-lg-2">
      <div style="background:rgba(0,255,136,0.05);border:1px solid var(--cyber-border2);border-left:3px solid var(--cyber-green);padding:.85rem 1rem;border-radius:2px;">
        <div style="font-family:var(--font-display);font-size:1.5rem;color:var(--cyber-green);"><?= $total_open ?></div>
        <small style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:.68rem;letter-spacing:1px;">ABSENSI BUKA</small>
      </div>
    </div>
    <div class="col-sm-4 col-lg-2">
      <div style="background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.08);border-left:3px solid rgba(255,255,255,0.2);padding:.85rem 1rem;border-radius:2px;">
        <div style="font-family:var(--font-display);font-size:1.5rem;color:var(--cyber-text-dim);"><?= $total_closed ?></div>
        <small style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:.68rem;letter-spacing:1px;">DITUTUP</small>
      </div>
    </div>
  </div>

  <!-- Search + Filter Tabs -->
  <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <!-- Search -->
    <form method="get" action="<?= site_url('kegiatan') ?>" class="d-flex gap-2">
      <div class="input-group" style="max-width:380px;">
        <span class="input-group-text" style="background:rgba(0,212,255,.05);border:1px solid var(--cyber-border);border-right:none;color:var(--cyber-cyan);">
          <i class="bi bi-search" style="font-size:.85rem;"></i>
        </span>
        <input type="text" name="q" class="form-control cyber-input" style="border-left:none;"
               placeholder="Cari nama kegiatan..."
               value="<?= htmlspecialchars($keyword ?? '') ?>">
        <button type="submit" class="btn btn-cyber px-3" style="font-size:.82rem;">Cari</button>
        <?php if (!empty($keyword)): ?>
          <a href="<?= site_url('kegiatan') ?>" class="btn btn-cyber" style="border-color:rgba(255,59,92,.5);color:var(--cyber-red);padding:0 .65rem;" title="Reset">
            <i class="bi bi-x-lg"></i>
          </a>
        <?php endif; ?>
      </div>
    </form>

    <!-- Filter Tabs (JS) -->
    <div class="d-flex gap-2 flex-wrap" id="kegiatan-filter-tabs">
      <button onclick="filterKegiatan('all')" id="tab-all" class="kegiatan-tab kegiatan-tab-active">
        Semua <span class="tab-count"><?= $total_kegiatan ?></span>
      </button>
      <button onclick="filterKegiatan('open')" id="tab-open" class="kegiatan-tab">
        <span style="display:inline-block;width:7px;height:7px;background:var(--cyber-green);border-radius:50%;margin-right:4px;animation:blink 1s step-end infinite;"></span>
        Absensi Buka <span class="tab-count"><?= $total_open ?></span>
      </button>
      <button onclick="filterKegiatan('closed')" id="tab-closed" class="kegiatan-tab">
        Ditutup <span class="tab-count"><?= $total_closed ?></span>
      </button>
    </div>
  </div>

  <!-- Grid Kegiatan -->
  <?php if (!empty($kegiatan)): ?>
  <div class="row g-4" id="kegiatan-grid">
    <?php foreach ($kegiatan as $item):
      $is_open = !empty($item->is_absensi_open) && $item->is_absensi_open == 1;
    ?>
    <div class="col-sm-6 col-lg-4 col-xl-3 kegiatan-card-col" data-absensi="<?= $is_open ? 'open' : 'closed' ?>">
      <div class="cyber-card h-100 p-0 overflow-hidden" style="display:flex;flex-direction:column;">

        <!-- Thumbnail -->
        <div style="position:relative;height:170px;overflow:hidden;flex-shrink:0;">
          <?php if (!empty($item->gambar)): ?>
            <img src="<?= base_url('assets/uploads/kegiatan/' . $item->gambar) ?>"
                 alt="<?= htmlspecialchars($item->nama_kegiatan) ?>"
                 style="width:100%;height:100%;object-fit:cover;display:block;filter:brightness(0.75) saturate(0.8);">
          <?php else: ?>
            <div style="width:100%;height:100%;background:linear-gradient(135deg,rgba(0,212,255,0.06),rgba(0,0,0,0.6));display:flex;align-items:center;justify-content:center;">
              <i class="bi bi-calendar-event" style="font-size:3rem;color:rgba(0,212,255,0.25);"></i>
            </div>
          <?php endif; ?>

          <!-- Overlay gradient -->
          <div style="position:absolute;bottom:0;left:0;right:0;height:60px;background:linear-gradient(transparent,rgba(5,11,20,0.85));pointer-events:none;"></div>

          <!-- Status badge -->
          <div style="position:absolute;top:.65rem;right:.65rem;">
            <?php if ($is_open): ?>
              <span style="display:inline-flex;align-items:center;gap:4px;background:rgba(0,0,0,0.8);border:1px solid var(--cyber-green);color:var(--cyber-green);font-family:var(--font-mono);font-size:0.62rem;padding:3px 9px;letter-spacing:1px;">
                <span style="width:5px;height:5px;background:var(--cyber-green);border-radius:50%;animation:blink 1s step-end infinite;"></span>BUKA
              </span>
            <?php else: ?>
              <span style="background:rgba(0,0,0,0.72);border:1px solid rgba(255,255,255,0.12);color:rgba(255,255,255,0.38);font-family:var(--font-mono);font-size:0.62rem;padding:3px 9px;letter-spacing:1px;">TUTUP</span>
            <?php endif; ?>
          </div>

          <!-- Tanggal -->
          <div style="position:absolute;bottom:.65rem;left:.75rem;font-family:var(--font-mono);font-size:0.67rem;color:rgba(255,255,255,0.7);">
            <i class="bi bi-calendar3 me-1"></i><?= date('d M Y', strtotime($item->waktu_kegiatan)) ?>
            <span style="color:var(--cyber-cyan);margin-left:.35rem;"><?= date('H:i', strtotime($item->waktu_kegiatan)) ?></span>
          </div>
        </div>

        <!-- Body -->
        <div style="padding:1rem 1.1rem;flex:1;display:flex;flex-direction:column;">
          <div style="font-family:var(--font-display);font-size:0.88rem;color:var(--cyber-text);font-weight:600;line-height:1.35;margin-bottom:.5rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
            <?= htmlspecialchars($item->nama_kegiatan) ?>
          </div>
          <p style="font-size:0.8rem;color:var(--cyber-text-dim);line-height:1.5;flex:1;margin:0;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
            <?= htmlspecialchars(strip_tags(character_limiter($item->keterangan ?? '', 80))) ?>
          </p>
        </div>

        <!-- Footer Actions -->
        <div style="padding:.7rem 1rem;border-top:1px solid var(--cyber-border);display:flex;gap:.4rem;background:rgba(0,0,0,0.2);">
          <a href="<?= site_url('kegiatan/detail/' . $item->id) ?>"
             class="btn btn-cyber btn-sm flex-fill" style="font-size:0.78rem;">
            <i class="bi bi-eye me-1"></i>Detail
          </a>
          <a href="<?= site_url('kegiatan/edit/' . $item->id) ?>"
             class="btn btn-cyber btn-sm px-2" title="Edit"
             style="border-color:rgba(255,176,32,0.5);color:var(--cyber-amber);">
            <i class="bi bi-pencil-square"></i>
          </a>
          <a href="<?= site_url('kegiatan/toggle_absensi/' . $item->id) ?>"
             class="btn btn-cyber btn-sm px-2"
             title="<?= $is_open ? 'Tutup Absensi' : 'Buka Absensi' ?>"
             style="<?= $is_open ? 'border-color:rgba(255,59,92,.4);color:var(--cyber-red);' : 'border-color:rgba(0,255,136,.4);color:var(--cyber-green);' ?>">
            <i class="bi <?= $is_open ? 'bi-lock' : 'bi-unlock' ?>"></i>
          </a>
          <a href="<?= site_url('kegiatan/hapus/' . $item->id) ?>"
             class="btn btn-cyber btn-sm px-2" title="Hapus"
             style="border-color:rgba(255,59,92,0.5);color:var(--cyber-red);"
             data-confirm="Hapus kegiatan &quot;<?= htmlspecialchars(addslashes($item->nama_kegiatan)) ?>&quot;? Tindakan ini tidak dapat dibatalkan."
             data-confirm-title="HAPUS KEGIATAN">
            <i class="bi bi-trash"></i>
          </a>
        </div>

      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <!-- Pagination -->
  <div class="d-flex justify-content-center mt-5"><?= $pagination ?></div>

  <?php else: ?>
  <div class="cyber-card p-5 text-center">
    <div style="font-size:3rem;color:var(--cyber-text-dim);margin-bottom:1rem;"><i class="bi bi-calendar-x"></i></div>
    <p style="font-family:var(--font-mono);font-size:0.85rem;color:var(--cyber-text-dim);margin:0;">
      <?= !empty($keyword) ? 'Tidak ada kegiatan yang cocok dengan pencarian.' : 'Belum ada kegiatan. Klik Tambah Kegiatan untuk memulai.' ?>
    </p>
    <?php if (!empty($keyword)): ?>
    <a href="<?= site_url('kegiatan') ?>" class="btn btn-cyber btn-sm mt-3">Lihat Semua Kegiatan</a>
    <?php endif; ?>
  </div>
  <?php endif; ?>

</main>

<style>
.kegiatan-tab {
  padding: .32rem .9rem;
  border: 1px solid var(--cyber-border);
  background: transparent;
  color: var(--cyber-text-dim);
  border-radius: 2px;
  cursor: pointer;
  font-family: 'Rajdhani', sans-serif;
  font-weight: 600;
  font-size: .78rem;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  transition: all .2s ease;
  white-space: nowrap;
}
.kegiatan-tab:hover { border-color: var(--cyber-cyan); color: var(--cyber-cyan); }
.kegiatan-tab-active { border-color: var(--cyber-cyan); color: var(--cyber-cyan); background: rgba(0,212,255,0.06); }
.tab-count {
  display: inline-block;
  margin-left: 4px;
  padding: 0 5px;
  background: rgba(0,212,255,0.12);
  border-radius: 2px;
  font-size: .72rem;
}
.kegiatan-card-col { transition: opacity .2s ease, transform .2s ease; }
.kegiatan-card-col.hidden { display: none; }
</style>

<script>
function filterKegiatan(type) {
  document.querySelectorAll('.kegiatan-tab').forEach(t => t.classList.remove('kegiatan-tab-active'));
  document.getElementById('tab-' + type).classList.add('kegiatan-tab-active');
  document.querySelectorAll('.kegiatan-card-col').forEach(col => {
    if (type === 'all' || col.dataset.absensi === type) {
      col.classList.remove('hidden');
    } else {
      col.classList.add('hidden');
    }
  });
}
</script>
