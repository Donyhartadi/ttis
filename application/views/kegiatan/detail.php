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
        <div class="card-body p-4">
          <!-- Judul -->
          <h3 class="fw-bold text-info mb-3"><?= html_escape($kegiatan->nama_kegiatan) ?></h3>

          <!-- Tanggal -->
          <?php if (!empty($kegiatan->waktu_kegiatan)): ?>
            <p>
              <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                📅 <?= date('d M Y H:i', strtotime($kegiatan->waktu_kegiatan)) ?>
              </span>
            </p>
          <?php endif; ?>

          <!-- Deskripsi -->
          <p class="text-muted"><?= nl2br(html_escape($kegiatan->keterangan)) ?></p>

          <!-- Lampiran (bisa banyak file) -->
          <?php if (!empty($kegiatan->lampiran)): ?>
            <?php 
              $lampiran_list = json_decode($kegiatan->lampiran, true); 
              if (!is_array($lampiran_list)) $lampiran_list = [$kegiatan->lampiran];
            ?>
            <div class="mt-3">
              <p class="fw-bold mb-2">📎 Lampiran:</p>
              <ul class="list-unstyled">
                <?php foreach ($lampiran_list as $idx => $lampiran): ?>
                  <li class="mb-2">
                    <a href="<?= base_url('assets/uploads/lampiran/' . $lampiran) ?>" 
                       class="btn btn-outline-primary btn-sm px-3 py-1 rounded-pill"
                       target="_blank" download>
                      ⬇ Lampiran <?= count($lampiran_list) > 1 ? ($idx+1) : '' ?>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <!-- Tombol Sertifikat -->
          <?php if (!empty($kegiatan->sertifikat_link)): ?>
            <div class="mt-3">
              <a href="<?= html_escape($kegiatan->sertifikat_link) ?>" 
                 class="btn btn-success btn-sm px-3 py-2 rounded-pill"
                 target="_blank">
                🎖 Lihat Sertifikat
              </a>
            </div>
          <?php endif; ?>

          <!-- Tombol Absensi -->
          <div class="mt-3 d-flex gap-2">
            <a href="<?= base_url('welcome/kegiatan') ?>" class="btn btn-secondary">⬅ Kembali</a>
            <?php if (!empty($kegiatan->is_absensi_open) && $kegiatan->is_absensi_open): ?>
              <a href="<?= base_url('welcome/absen/'.$kegiatan->id) ?>" class="btn btn-success">
                ✅ Isi Absensi
              </a>
            <?php else: ?>
              <button class="btn btn-outline-secondary" disabled>
                🚫 Absensi Ditutup
              </button>
            <?php endif; ?>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
