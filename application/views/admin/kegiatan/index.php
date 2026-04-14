<<<<<<< HEAD
<div class="container mt-4">
  <!-- Header + Search + Button -->
  <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
    <h3 class="fw-bold mb-2">📅 Daftar Kegiatan</h3>

    <div class="d-flex align-items-center">
      <!-- Form Pencarian -->
      <form method="get" action="<?= base_url('kegiatan') ?>" class="d-flex me-3">
        <div class="input-group">
          <span class="input-group-text bg-light border-end-0">🔍</span>
          <input type="text" 
                 name="q" 
                 class="form-control border-start-0" 
                 placeholder="Cari kegiatan..." 
                 value="<?= htmlspecialchars($keyword) ?>">
          <button class="btn btn-outline-primary" type="submit">Cari</button>
        </div>
      </form>

      <!-- Tombol Tambah -->
      <a href="<?= base_url('kegiatan/tambah') ?>" class="btn btn-success px-4 py-2 rounded-pill shadow-sm">
        ➕ Tambah Kegiatan
      </a>
=======
<?php if ($this->session->flashdata('success')): ?>
<script>document.addEventListener('DOMContentLoaded',()=>{
  const t=document.createElement('div');
  t.style.cssText='position:fixed;top:1.2rem;right:1.2rem;z-index:9999;background:rgba(0,255,136,0.1);border:1px solid rgba(0,255,136,0.4);color:#00ff88;padding:.75rem 1.5rem;border-radius:4px;font-family:monospace;font-size:.85rem;display:flex;align-items:center;gap:.5rem;';
  t.innerHTML='<i class="bi bi-check-circle-fill"></i><?= addslashes($this->session->flashdata('success')) ?>';
  document.body.appendChild(t);setTimeout(()=>t.remove(),4000);
});</script>
<?php endif; ?>

<main class="container-fluid px-4 py-4">

  <!-- Page Header -->
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
    <div>
      <small style="color:var(--cyber-cyan);font-family:var(--font-mono);letter-spacing:2px;font-size:0.72rem;">// MANAJEMEN KEGIATAN</small>
      <h4 style="font-family:var(--font-display);color:var(--cyber-text);margin:0.2rem 0 0;">Daftar Kegiatan</h4>
>>>>>>> 36c20e2 (revisi besar besaran)
    </div>
    <a href="<?= site_url('kegiatan/tambah') ?>" class="btn btn-cyber">
      <i class="bi bi-plus-lg me-1"></i>Tambah Kegiatan
    </a>
  </div>

<<<<<<< HEAD
  <!-- Daftar Kegiatan -->
  <div class="row">
    <?php if (!empty($kegiatan)): ?>
      <?php foreach ($kegiatan as $item): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-lg border-0 rounded-4 overflow-hidden">
            
            <!-- Gambar -->
            <?php if ($item->gambar): ?>
              <img src="<?= base_url('assets/uploads/kegiatan/' . $item->gambar) ?>" 
                   class="card-img-top" 
                   alt="<?= $item->nama_kegiatan ?>" 
                   style="height:200px;object-fit:cover;">
=======
  <!-- Search Bar -->
  <form method="get" action="<?= site_url('kegiatan') ?>" class="mb-4">
    <div class="row g-2">
      <div class="col-12 col-md-7 col-lg-5">
        <div class="input-group">
          <span class="input-group-text"
                style="background:rgba(0,212,255,0.05);border:1px solid var(--cyber-border);border-right:none;color:var(--cyber-cyan);">
            <i class="bi bi-search"></i>
          </span>
          <input type="text" name="q" class="form-control cyber-input" style="border-left:none;"
                 placeholder="Cari nama kegiatan..."
                 value="<?= htmlspecialchars($keyword ?? '') ?>">
          <button type="submit" class="btn btn-cyber px-4">Cari</button>
          <?php if (!empty($keyword)): ?>
          <a href="<?= site_url('kegiatan') ?>" class="btn btn-cyber"
             style="border-color:rgba(255,59,92,0.5);color:var(--cyber-red);" title="Hapus filter">
            <i class="bi bi-x-lg"></i>
          </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </form>

  <!-- Grid Kegiatan -->
  <?php if (!empty($kegiatan)): ?>
  <div class="row g-4">
    <?php foreach ($kegiatan as $item):
      $is_open = !empty($item->is_absensi_open) && $item->is_absensi_open == 1;
    ?>
    <div class="col-sm-6 col-lg-4 col-xl-3">
      <div class="cyber-card h-100 p-0 overflow-hidden" style="display:flex;flex-direction:column;">

        <!-- Thumbnail -->
        <div style="position:relative;height:170px;overflow:hidden;flex-shrink:0;">
          <?php if (!empty($item->gambar)): ?>
            <img src="<?= base_url('assets/uploads/kegiatan/' . $item->gambar) ?>"
                 alt="<?= htmlspecialchars($item->nama_kegiatan) ?>"
                 style="width:100%;height:100%;object-fit:cover;display:block;
                        filter:brightness(0.75) saturate(0.8);">
          <?php else: ?>
            <div style="width:100%;height:100%;background:linear-gradient(135deg,rgba(0,212,255,0.08),rgba(0,0,0,0.6));
                        display:flex;align-items:center;justify-content:center;">
              <i class="bi bi-calendar-event" style="font-size:3rem;color:rgba(0,212,255,0.3);"></i>
            </div>
          <?php endif; ?>

          <!-- Overlay gradient -->
          <div style="position:absolute;bottom:0;left:0;right:0;height:60px;
                      background:linear-gradient(transparent,rgba(5,11,20,0.85));"></div>

          <!-- Status badge -->
          <div style="position:absolute;top:.6rem;right:.6rem;">
            <?php if ($is_open): ?>
              <span class="badge badge-cyber-green" style="font-size:0.65rem;">
                <i class="bi bi-circle-fill me-1" style="font-size:.45rem;vertical-align:middle;animation:blink 1s step-end infinite;"></i>ABSENSI BUKA
              </span>
>>>>>>> 36c20e2 (revisi besar besaran)
            <?php else: ?>
              <span class="badge" style="background:rgba(0,0,0,0.6);border:1px solid rgba(255,255,255,0.15);color:rgba(255,255,255,0.4);font-size:0.65rem;">TUTUP</span>
            <?php endif; ?>
          </div>

<<<<<<< HEAD
            <!-- Body -->
            <div class="card-body">
              <!-- Tanggal kegiatan -->
              <div class="mb-2 text-muted small">
                <i class="bi bi-calendar-event"></i> <?= $item->waktu_kegiatan ?>
              </div>

              <h5 class="card-title fw-bold text-dark mb-2">
                <?= $item->nama_kegiatan ?>
              </h5>
              <p class="card-text text-secondary small mb-0">
                <?= character_limiter(strip_tags($item->keterangan), 100) ?>
              </p>
            </div>

            <!-- Footer -->
            <div class="card-footer bg-light border-0">
              <a href="<?= base_url('kegiatan/detail/' . $item->id) ?>" 
                class="btn btn-info w-100 py-2 rounded-pill shadow-sm">
                <i class="bi bi-eye"></i> Lihat Detail
              </a>
            </div>

          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12 text-center text-muted">
        <p>Tidak ada kegiatan.</p>
=======
          <!-- Tanggal di atas gambar -->
          <div style="position:absolute;bottom:.6rem;left:.75rem;font-family:var(--font-mono);font-size:0.68rem;color:rgba(255,255,255,0.7);">
            <i class="bi bi-calendar3 me-1"></i><?= date('d M Y', strtotime($item->waktu_kegiatan)) ?>
            <span style="color:var(--cyber-cyan);margin-left:.4rem;"><?= date('H:i', strtotime($item->waktu_kegiatan)) ?></span>
          </div>
        </div>

        <!-- Body -->
        <div style="padding:1rem 1.1rem;flex:1;display:flex;flex-direction:column;">
          <div style="font-family:var(--font-display);font-size:0.88rem;color:var(--cyber-text);
                      font-weight:600;line-height:1.35;margin-bottom:.5rem;
                      display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
            <?= htmlspecialchars($item->nama_kegiatan) ?>
          </div>
          <p style="font-size:0.8rem;color:var(--cyber-text-dim);line-height:1.5;flex:1;margin:0;
                    display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
            <?= htmlspecialchars(strip_tags(character_limiter($item->keterangan ?? '', 80))) ?>
          </p>
        </div>

        <!-- Footer Actions -->
        <div style="padding:.75rem 1rem;border-top:1px solid var(--cyber-border);
                    display:flex;gap:.5rem;background:rgba(0,0,0,0.2);">
          <a href="<?= site_url('kegiatan/detail/' . $item->id) ?>"
             class="btn btn-cyber btn-sm flex-fill" style="font-size:0.78rem;">
            <i class="bi bi-eye me-1"></i>Detail
          </a>
          <a href="<?= site_url('kegiatan/edit/' . $item->id) ?>"
             class="btn btn-cyber btn-sm px-2" title="Edit"
             style="border-color:rgba(255,176,32,0.5);color:var(--cyber-amber);">
            <i class="bi bi-pencil-square"></i>
          </a>
          <a href="<?= site_url('kegiatan/hapus/' . $item->id) ?>"
             class="btn btn-cyber btn-sm px-2" title="Hapus"
             style="border-color:rgba(255,59,92,0.5);color:var(--cyber-red);"
             onclick="return confirm('Hapus kegiatan ini?')">
            <i class="bi bi-trash"></i>
          </a>
        </div>

>>>>>>> 36c20e2 (revisi besar besaran)
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

