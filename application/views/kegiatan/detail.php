<div class="container my-4">
  <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="row g-0 flex-md-row flex-column-reverse">

      <!-- Kolom Konten -->
      <div class="<?= !empty($kegiatan->gambar) ? 'col-md-7' : 'col-12' ?>">
        <div class="card-body p-2">
          
          <!-- Judul -->
          <h3 class="fw-bold text-primary mb-3">
            <?= html_escape($kegiatan->nama_kegiatan) ?>
          </h3>

          <!-- Tanggal -->
          <?php if (!empty($kegiatan->waktu_kegiatan)): ?>
            <p>
              <span class="badge bg-light text-dark border px-3 py-2 rounded-pill shadow-sm">
                📅 <?= date('d M Y H:i', strtotime($kegiatan->waktu_kegiatan)) ?>
              </span>
            </p>
          <?php endif; ?>

          <!-- Deskripsi -->
          <p class="text-muted lh-lg mb-4">
            <?= nl2br(html_escape($kegiatan->keterangan)) ?>
          </p>

          <!-- Lampiran + Sertifikat -->
          <?php 
            $lampiran_list = [];
            if (!empty($kegiatan->lampiran)) {
              $decoded = json_decode($kegiatan->lampiran, true);
              $lampiran_list = is_array($decoded) ? $decoded : [$kegiatan->lampiran];
            }
          ?>
          <?php if (!empty($lampiran_list) || !empty($kegiatan->sertifikat_link)): ?>
            <div class="mb-4">
              <p class="fw-bold mb-2 text-dark">📎 Lampiran & Materi:</p>
              <div class="d-flex flex-wrap gap-2">

                <!-- Tombol Lampiran -->
                <?php foreach ($lampiran_list as $idx => $lampiran): ?>
                  <a href="<?= base_url('assets/uploads/lampiran/' . $lampiran) ?>" 
                     class="btn btn-outline-primary btn-sm rounded-pill shadow-sm px-3 py-2"
                     target="_blank" download>
                    ⬇ Background Zoom <?= count($lampiran_list) > 1 ? ($idx+1) : '' ?>
                  </a>
                <?php endforeach; ?>

                <!-- Tombol Sertifikat -->
                <?php if (!empty($kegiatan->sertifikat_link)): ?>
                  <a href="<?= html_escape($kegiatan->sertifikat_link) ?>" 
                     class="btn btn-outline-success btn-sm rounded-pill shadow-sm px-3 py-2"
                     target="_blank">
                    🎖 Materi & Sertifikat
                  </a>
                <?php endif; ?>

              </div>
            </div>
          <?php endif; ?>

          <!-- Tombol Navigasi -->
          <div class="mt-3 d-flex flex-wrap gap-2">
            <a href="<?= base_url('welcome/kegiatan') ?>" 
               class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold shadow-sm">
              ⬅ Kembali
            </a>

            <?php if (!empty($kegiatan->is_absensi_open) && $kegiatan->is_absensi_open): ?>
              <a href="<?= base_url('welcome/absen/'.$kegiatan->id) ?>" 
                 class="btn btn-success rounded-pill px-4 py-2 fw-semibold shadow-sm">
                ✅ Isi Absensi
              </a>
            <?php else: ?>
              <button class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold shadow-sm" disabled>
                🚫 Absensi Ditutup
              </button>
            <?php endif; ?>
          </div>

        </div>
      </div>

      <!-- Kolom Gambar -->
      <?php if (!empty($kegiatan->gambar)): ?>
        <div class="col-md-5 d-flex align-items-center justify-content-center bg-light">
          <img src="<?= base_url('assets/uploads/kegiatan/'.$kegiatan->gambar) ?>" 
               alt="<?= html_escape($kegiatan->nama_kegiatan) ?>" 
               class="img-fluid rounded-0"
               style="object-fit:contain; max-height:500px; width:100%; background-color:#f8f9fa;">
        </div>
      <?php endif; ?>

    </div>
  </div>
</div>
