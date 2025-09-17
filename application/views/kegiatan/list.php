<div class="container mt-4">
  <h3 class="fw-bold mb-3">Daftar Kegiatan</h3>
  <div class="row">
    <?php if (!empty($kegiatan)): ?>
      <?php foreach ($kegiatan as $item): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <?php if ($item->gambar): ?>
              <img src="<?= base_url('assets/uploads/kegiatan/'.$item->gambar) ?>" 
                   class="card-img-top" alt="<?= $item->nama_kegiatan ?>" 
                   style="height:200px;object-fit:cover;">
            <?php endif; ?>
            <div class="card-body">
              <h5 class="card-title"><?= $item->nama_kegiatan ?></h5>
              <p class="card-text text-muted"><?= character_limiter(strip_tags($item->keterangan), 100) ?></p>
              <a href="<?= base_url('welcome/detail_kegiatan/'.$item->id) ?>" class="btn btn-info btn-sm">🔍 Detail</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12"><div class="alert alert-info text-center">Belum ada kegiatan.</div></div>
    <?php endif; ?>
  </div>
</div>
