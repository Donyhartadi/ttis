<div class="container my-4">

  <!-- ✅ Alert Flashdata -->
  <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
      <i class="bi bi-check-circle-fill me-2"></i>
      <?= $this->session->flashdata('success') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php elseif ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-3" role="alert">
      <i class="bi bi-exclamation-triangle-fill me-2"></i>
      <?= $this->session->flashdata('error') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <!-- ✅ Card Utama -->
  <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
    <div class="row g-0 flex-md-row flex-column-reverse">

      <!-- 🧾 Kolom Konten -->
      <div class="<?= !empty($kegiatan->gambar) ? 'col-md-7' : 'col-12' ?>">
        <div class="card-body p-2">

          <!-- Judul -->
          <h3 class="fw-bold text-primary mb-3">
            <?= html_escape($kegiatan->nama_kegiatan) ?>
          </h3>

          <!-- Waktu Kegiatan -->
          <?php if (!empty($kegiatan->waktu_kegiatan)): ?>
            <p class="mb-4">
              <span class="badge bg-light text-dark border px-3 py-2 rounded-pill shadow-sm">
                <i class="bi bi-calendar-event me-1"></i>
                <?= date('d M Y H:i', strtotime($kegiatan->waktu_kegiatan)) ?>
              </span>
            </p>
          <?php endif; ?>

          <!-- Deskripsi -->
          <p class="text-secondary lh-lg mb-4">
            <?= nl2br(html_escape($kegiatan->keterangan)) ?>
          </p>

          <!-- 📎 Lampiran & Sertifikat -->
          <?php 
            $lampiran_list = [];
            if (!empty($kegiatan->lampiran)) {
              $decoded = json_decode($kegiatan->lampiran, true);
              $lampiran_list = is_array($decoded) ? $decoded : [$kegiatan->lampiran];
            }
          ?>
          <?php if (!empty($lampiran_list) || !empty($kegiatan->sertifikat_link)): ?>
            <div class="mb-4">
              <p class="fw-bold mb-2 text-dark">
                <i class="bi bi-paperclip me-1"></i> Lampiran & Materi:
              </p>
              <div class="d-flex flex-wrap gap-2">
                <!-- Tombol Lampiran -->
                <?php foreach ($lampiran_list as $idx => $lampiran): ?>
                  <a href="<?= base_url('assets/uploads/lampiran/' . $lampiran) ?>"
                     class="btn btn-outline-primary btn-sm rounded-pill shadow-sm px-3 py-2"
                     target="_blank" download>
                    ⬇ Background Zoom <?= count($lampiran_list) > 1 ? ($idx + 1) : '' ?>
                  </a>
                <?php endforeach; ?>

                <!-- Tombol Materi & Sertifikat -->
                <?php if (!empty($kegiatan->sertifikat_link)): ?>
                  <a href="<?= html_escape($kegiatan->sertifikat_link) ?>"
                     class="btn btn-outline-success btn-sm rounded-pill shadow-sm px-3 py-2"
                     target="_blank" rel="noopener noreferrer">
                    🎖 Materi & Sertifikat
                  </a>
                <?php endif; ?>
              </div>
            </div>
          <?php endif; ?>

          <!-- ⚙ Tombol Aksi -->
          <div class="d-flex flex-wrap gap-2 mt-4 align-items-center">
            
            <!-- Tombol Kembali -->
            <a href="<?= base_url('kegiatan') ?>"
               class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold shadow-sm">
              ⬅ Kembali
            </a>

            <!-- Dropdown Aksi -->
            <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle rounded-pill px-4 py-2 fw-semibold shadow-sm" 
                      type="button" id="aksiDropdown" 
                      data-bs-toggle="dropdown" aria-expanded="false">
                ⚙ Kelola Kegiatan
              </button>

              <ul class="dropdown-menu shadow border-0 rounded-4 mt-1" aria-labelledby="aksiDropdown">
                <li>
                  <a class="dropdown-item" href="<?= base_url('kegiatan/edit/' . $kegiatan->id) ?>">
                    ✏ Edit Kegiatan
                  </a>
                </li>
                <li>
                  <a class="dropdown-item text-danger" 
                     href="<?= base_url('kegiatan/hapus/' . $kegiatan->id) ?>"
                     onclick="return confirm('Yakin ingin menghapus kegiatan ini?')">
                    🗑 Hapus Kegiatan
                  </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <a class="dropdown-item" href="<?= base_url('kegiatan/absensi/' . $kegiatan->id) ?>">
                    👥 Lihat Daftar Absensi
                  </a>
                </li>
                <li>
                  <a class="dropdown-item <?= $kegiatan->is_absensi_open ? 'text-danger' : 'text-success' ?>"
                     href="<?= base_url('kegiatan/toggle_absensi/' . $kegiatan->id) ?>">
                    <?= $kegiatan->is_absensi_open ? '🚫 Tutup Absensi' : '✅ Buka Absensi' ?>
                  </a>
                </li>
              </ul>
            </div>

          </div>

        </div>
      </div>

      <!-- 🖼 Kolom Gambar -->
      <?php if (!empty($kegiatan->gambar)): ?>
        <div class="col-md-5 bg-light d-flex align-items-center justify-content-center">
          <img src="<?= base_url('assets/uploads/kegiatan/' . $kegiatan->gambar) ?>"
               alt="<?= html_escape($kegiatan->nama_kegiatan) ?>"
               class="img-fluid rounded-0 shadow-sm"
               style="object-fit:contain; max-height:500px; width:100%;">
        </div>
      <?php endif; ?>

    </div>
  </div>
</div>
