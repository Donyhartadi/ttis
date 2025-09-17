<div class="container mt-4">
  <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
    <h3 class="fw-bold mb-2">📅 Daftar Kegiatan</h3>

    <div class="d-flex align-items-center">
      <!-- Form Pencarian -->
      <form method="get" action="<?= base_url('kegiatan') ?>" class="d-flex me-2">
        <input type="text" name="q" 
               class="form-control me-2" 
               placeholder="Cari kegiatan..." 
               value="<?= htmlspecialchars($keyword) ?>">
        <button class="btn btn-outline-secondary" type="submit">🔍 Cari</button>
      </form>

      <!-- Tombol Tambah -->
      <a href="<?= base_url('kegiatan/tambah') ?>" class="btn btn-primary">
        ➕ Tambah
      </a>
    </div>
  </div>

  <div class="row">
    <?php if (!empty($kegiatan)): ?>
      <?php foreach ($kegiatan as $item): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
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

            <div class="card-body">
              <h5 class="card-title fw-bold"><?= $item->nama_kegiatan ?></h5>
              <p class="card-text text-muted mb-0">
                <?= character_limiter(strip_tags($item->keterangan), 100) ?>
              </p>
            </div>

            <div class="card-footer bg-light d-flex justify-content-between">
              <a href="<?= base_url('kegiatan/detail/' . $item->id) ?>" 
                 class="btn btn-sm btn-info">🔍 Detail</a>
              <div>
                <a href="<?= base_url('kegiatan/edit/' . $item->id) ?>" 
                   class="btn btn-sm btn-warning">✏ Edit</a>
                <a href="<?= base_url('kegiatan/hapus/' . $item->id) ?>" 
                   class="btn btn-sm btn-danger" 
                   onclick="return confirm('Yakin ingin menghapus kegiatan ini?')">
                   🗑 Hapus
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12">
        <div class="alert alert-info text-center">Belum ada kegiatan yang ditambahkan.</div>
      </div>
    <?php endif; ?>
  </div>

  <!-- Pagination -->
  <div class="mt-3 d-flex justify-content-center">
    <?= $pagination ?>
  </div>
</div>
