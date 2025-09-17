<div class="container my-4">
  <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
    <div class="row g-0">
      
      <!-- Kolom Gambar -->
      <?php if (!empty($kegiatan->gambar)): ?>
        <div class="col-md-5">
          <img src="<?= base_url('assets/uploads/kegiatan/'.$kegiatan->gambar) ?>" 
               alt="<?= html_escape($kegiatan->nama_kegiatan) ?>" 
               class="img-fluid w-100 h-100" 
               style="object-fit:cover; max-height:500px;">
        </div>
      <?php endif; ?>

      <!-- Kolom Konten -->
      <div class="<?= !empty($kegiatan->gambar) ? 'col-md-7' : 'col-12' ?>">
        <div class="card-body">
          <h3 class="fw-bold text-info mb-3"><?= html_escape($kegiatan->nama_kegiatan) ?></h3>

          <?php if (!empty($kegiatan->waktu_kegiatan)): ?>
            <p>
              <span class="badge bg-light text-dark border px-3 py-2">
                📅 <?= date('d M Y H:i', strtotime($kegiatan->waktu_kegiatan)) ?>
              </span>
            </p>
          <?php endif; ?>

          <p class="text-muted"><?= nl2br(html_escape($kegiatan->keterangan)) ?></p>

          <!-- ✅ Tombol Absensi (kontrol dari admin) -->
          <div class="mt-3 d-flex gap-2">
            <?php if (!empty($kegiatan->is_absensi_open) && $kegiatan->is_absensi_open): ?>
              <a href="<?= base_url('welcome/absen/'.$kegiatan->id) ?>" class="btn btn-success">
                ✅ Isi Absensi
              </a>
            <?php else: ?>
              <button class="btn btn-outline-secondary" disabled>
                🚫 Absensi Ditutup
              </button>
            <?php endif; ?>

            <a href="<?= base_url('welcome/kegiatan') ?>" class="btn btn-secondary">⬅ Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
