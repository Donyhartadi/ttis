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
    </div>
  </div>

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
            <?php else: ?>
              <img src="https://via.placeholder.com/400x200?text=No+Image" 
                   class="card-img-top" 
                   alt="No Image">
            <?php endif; ?>

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
      </div>
    <?php endif; ?>
  </div>

  <!-- Pagination -->
  <div class="mt-3 d-flex justify-content-center">
    <?= $pagination ?>
  </div>
</div>
