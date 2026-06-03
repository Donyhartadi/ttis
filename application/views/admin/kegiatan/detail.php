<div class="container my-4">

  <!-- ✅ Alert Flashdata -->
  <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= $this->session->flashdata('success') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php elseif ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?= $this->session->flashdata('error') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <div class="card shadow-sm">
    <div class="row g-0 align-items-start">

      <!-- Kolom Gambar -->
      <?php if (!empty($kegiatan->gambar)): ?>
        <div class="col-md-5">
          <img
            src="<?= base_url('assets/uploads/kegiatan/' . $kegiatan->gambar) ?>"
            alt="<?= html_escape($kegiatan->nama_kegiatan) ?>"
            class="img-fluid rounded-start d-block w-100"
            style="height:auto; display:block;"
          >
        </div>
      <?php endif; ?>

      <!-- Kolom Konten -->
      <div class="<?= !empty($kegiatan->gambar) ? 'col-md-7' : 'col-12' ?>">
        <div class="card-body">
          <h4 class="card-title fw-bold text-info mb-3">
            <?= html_escape($kegiatan->nama_kegiatan) ?>
          </h4>

          <?php if (!empty($kegiatan->waktu_kegiatan)): ?>
            <p class="mb-2">
              <span class="badge bg-light text-dark border">
                📅 <?= date('d M Y H:i', strtotime($kegiatan->waktu_kegiatan)) ?>
              </span>
            </p>
          <?php endif; ?>

          <p class="card-text text-justify">
            <?= nl2br(html_escape($kegiatan->keterangan)) ?>
          </p>

          <?php if (!empty($kegiatan->lampiran)): ?>
            <div class="mt-3">
              <p class="fw-bold mb-1">📎 Lampiran:</p>
              <a href="<?= base_url('assets/uploads/lampiran/' . $kegiatan->lampiran) ?>"
                 class="btn btn-outline-primary btn-sm"
                 target="_blank"
                 download>
                 ⬇ Download Lampiran
              </a>
            </div>
          <?php endif; ?>

          <!-- Tombol Aksi -->
          <div class="mt-4 d-grid gap-2 d-md-flex justify-content-md-start">
            <a href="<?= base_url('kegiatan') ?>" class="btn btn-secondary">⬅ Kembali</a>
            <a href="<?= base_url('kegiatan/edit/'.$kegiatan->id) ?>" class="btn btn-warning">✏ Edit</a>
            <a href="<?= base_url('kegiatan/hapus/'.$kegiatan->id) ?>" onclick="return confirm('Yakin ingin menghapus kegiatan ini?')" class="btn btn-danger">🗑 Hapus</a>
            
            <!-- 🔥 Tombol Lihat Absensi -->
            <a href="<?= base_url('kegiatan/absensi/'.$kegiatan->id) ?>" class="btn btn-info">
              👥 Lihat Absensi
            </a>

            <!-- 🔥 Tombol Kontrol Absensi -->
            <a href="<?= base_url('kegiatan/toggle_absensi/'.$kegiatan->id) ?>" 
               class="btn <?= $kegiatan->is_absensi_open ? 'btn-danger' : 'btn-success' ?>">
               <?= $kegiatan->is_absensi_open ? '🚫 Tutup Absensi' : '✅ Buka Absensi' ?>
            </a>
          </div>
        </div>
      </div><!-- /.col konten -->

    </div><!-- /.row -->
  </div><!-- /.card -->
</div><!-- /.container -->
</main>

