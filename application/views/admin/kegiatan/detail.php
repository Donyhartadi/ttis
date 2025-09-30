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


  <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
    <div class="row g-0">

      <!-- Kolom Gambar -->
      <?php if (!empty($kegiatan->gambar)): ?>
        <div class="col-md-5">
          <img
            src="<?= base_url('assets/uploads/kegiatan/' . $kegiatan->gambar) ?>"
            alt="<?= html_escape($kegiatan->nama_kegiatan) ?>"
            class="img-fluid h-100 w-100 object-fit-cover"
          >
        </div>
      <?php endif; ?>

      <!-- Kolom Konten -->
      <div class="<?= !empty($kegiatan->gambar) ? 'col-md-7' : 'col-12' ?>">
        <div class="card-body p-4">

          <!-- Judul -->
          <h3 class="card-title fw-bold text-primary mb-3">
            <?= html_escape($kegiatan->nama_kegiatan) ?>
          </h3>

          <!-- Tanggal -->
          <?php if (!empty($kegiatan->waktu_kegiatan)): ?>
            <p class="mb-3">
              <span class="badge bg-light text-dark border px-3 py-2 rounded-pill shadow-sm">
                <i class="bi bi-calendar-event me-1"></i>
                <?= date('d M Y H:i', strtotime($kegiatan->waktu_kegiatan)) ?>
              </span>
            </p>
          <?php endif; ?>

          <!-- Deskripsi -->
          <p class="card-text lh-lg text-secondary">
            <?= nl2br(html_escape($kegiatan->keterangan)) ?>
          </p>

          <!-- Lampiran & Sertifikat -->
          <?php if (!empty($kegiatan->lampiran) || !empty($kegiatan->sertifikat_link)): ?>
            <div class="mt-4">
              <?php if (!empty($kegiatan->lampiran)): ?>
                <?php 
                  $lampiran_list = json_decode($kegiatan->lampiran, true); 
                  if (!is_array($lampiran_list)) $lampiran_list = [$kegiatan->lampiran];
                ?>
                <p class="fw-bold mb-2"><i class="bi bi-paperclip"></i> Lampiran:</p>
                <ul class="list-unstyled">
                  <?php foreach ($lampiran_list as $idx => $lampiran): ?>
                    <li class="mb-2">
                      <a href="<?= base_url('assets/uploads/lampiran/' . $lampiran) ?>"
                        class="btn btn-outline-primary btn-sm px-3 py-2 rounded-pill shadow-sm"
                        target="_blank" download>
                        ⬇ Download Lampiran <?= count($lampiran_list) > 1 ? ($idx+1) : '' ?>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>

              <?php if (!empty($kegiatan->sertifikat_link)): ?>
                <p class="fw-bold mb-2 mt-3"><i class="bi bi-award"></i> Sertifikat Kegiatan:</p>
                <a href="<?= html_escape($kegiatan->sertifikat_link) ?>"
                  class="btn btn-outline-success btn-sm px-3 py-2 rounded-pill shadow-sm"
                  target="_blank" rel="noopener noreferrer">
                  🏆 Lihat Sertifikat
                </a>
              <?php endif; ?>
            </div>
          <?php endif; ?>



          <!-- Tombol Aksi -->
          <div class="mt-4 d-flex flex-wrap gap-2">
            
            <!-- Tombol kembali -->
            <a href="<?= base_url('kegiatan') ?>" class="btn btn-secondary px-4 py-2 rounded-pill">
              ⬅ Kembali
            </a>

            <!-- Dropdown menu -->
            <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle px-4 py-2 rounded-pill shadow-sm" 
                      type="button" 
                      id="aksiDropdown" 
                      data-bs-toggle="dropdown" 
                      aria-expanded="false">
                ⚙ Aksi
              </button>
              <ul class="dropdown-menu shadow-sm border-0 rounded-3" aria-labelledby="aksiDropdown">
                <li>
                  <a class="dropdown-item" href="<?= base_url('kegiatan/edit/'.$kegiatan->id) ?>">
                    ✏ Edit
                  </a>
                </li>
                <li>
                  <a class="dropdown-item text-danger" 
                     href="<?= base_url('kegiatan/hapus/'.$kegiatan->id) ?>" 
                     onclick="return confirm('Yakin ingin menghapus kegiatan ini?')">
                    🗑 Hapus
                  </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <a class="dropdown-item" href="<?= base_url('kegiatan/absensi/'.$kegiatan->id) ?>">
                    👥 Lihat Absensi
                  </a>
                </li>
                <li>
                  <a class="dropdown-item <?= $kegiatan->is_absensi_open ? 'text-danger' : 'text-success' ?>" 
                     href="<?= base_url('kegiatan/toggle_absensi/'.$kegiatan->id) ?>">
                    <?= $kegiatan->is_absensi_open ? '🚫 Tutup Absensi' : '✅ Buka Absensi' ?>
                  </a>
                </li>
              </ul>
            </div>

          </div>

        </div>
      </div>

    </div>
  </div>
</div>
