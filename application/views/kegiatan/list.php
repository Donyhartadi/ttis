<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold mb-0">Daftar Kegiatan</h3>

    <!-- Kolom Pencarian Kecil -->
    <form method="get" action="<?= base_url('welcome/kegiatan') ?>" class="d-flex">
      <input type="text" name="q" 
             class="form-control form-control-sm me-2" 
             placeholder="Cari..." 
             value="<?= $this->input->get('q') ?>" 
             style="max-width: 180px;">
      <button class="btn btn-sm btn-primary" type="submit">🔍</button>
    </form>
  </div>

  <div class="row g-4">
    <?php if (!empty($kegiatan)): ?>
      <?php foreach ($kegiatan as $item): ?>
        <div class="col-md-4">
          <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
            
            <!-- Gambar -->
            <?php if ($item->gambar): ?>
              <div class="position-relative">
                <img src="<?= base_url('assets/uploads/kegiatan/'.$item->gambar) ?>" 
                     class="card-img-top" alt="<?= $item->nama_kegiatan ?>" 
                     style="height:200px; object-fit:cover; transition: transform .3s;">
                <div class="position-absolute top-0 start-0 m-2">
                  <?php if (!empty($item->waktu_kegiatan)): ?>
                    <span class="badge bg-primary shadow-sm">
                      📅 <?= date('d M Y', strtotime($item->waktu_kegiatan)) ?>
                    </span>
                  <?php endif; ?>
                </div>
              </div>
            <?php endif; ?>

            <!-- Konten -->
            <div class="card-body d-flex flex-column">
              <h5 class="card-title"><?= $item->nama_kegiatan ?></h5>
              <p class="card-text text-muted flex-grow-1"><?= character_limiter(strip_tags($item->keterangan), 100) ?></p>
              <a href="<?= base_url('welcome/detail_kegiatan/'.$item->id) ?>" 
                 class="btn btn-info btn-sm mt-2 rounded-pill shadow-sm">
                 🔍 Detail
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12">
        <div class="alert alert-info text-center">Belum ada kegiatan.</div>
      </div>
    <?php endif; ?>
  </div>
</div>

<style>
.card-img-top:hover {
    transform: scale(1.05);
}
</style>
