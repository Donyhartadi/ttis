<div class="container mt-4">
  <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
    <!-- Header -->
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0">
        <?= isset($kegiatan) ? '✏ Edit Kegiatan' : '➕ Tambah Kegiatan' ?>
      </h5>
    </div>

    <!-- Body -->
    <div class="card-body p-4">
      <form method="post" enctype="multipart/form-data">

        <!-- CSRF Token -->
        <input type="hidden"
               name="<?= $this->security->get_csrf_token_name(); ?>"
               value="<?= $this->security->get_csrf_hash(); ?>" />

        <div class="row g-4">
          <!-- Kiri: Data Utama -->
          <div class="col-md-6">
            <!-- Nama Kegiatan -->
            <div class="mb-3">
              <label for="nama_kegiatan" class="form-label fw-bold">Nama Kegiatan</label>
              <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan"
                     value="<?= isset($kegiatan) ? $kegiatan->nama_kegiatan : '' ?>" required>
            </div>

            <!-- Waktu -->
            <div class="mb-3">
              <label for="waktu_kegiatan" class="form-label fw-bold">Waktu Kegiatan</label>
              <input type="datetime-local" name="waktu_kegiatan" id="waktu_kegiatan"
                     class="form-control" required
                     value="<?= isset($kegiatan) ? date('Y-m-d\TH:i', strtotime($kegiatan->waktu_kegiatan)) : '' ?>">
            </div>

            <!-- Keterangan -->
            <div class="mb-3">
              <label for="keterangan" class="form-label fw-bold">Keterangan</label>
              <textarea class="form-control" id="keterangan" name="keterangan" rows="13" required><?= isset($kegiatan) ? $kegiatan->keterangan : '' ?></textarea>
            </div>
          </div>

          <!-- Kanan: Upload -->
          <div class="col-md-6">
            <!-- Gambar -->
            <div class="mb-3">
              <label for="gambar" class="form-label fw-bold">Gambar</label>
              <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">

              <?php if (isset($kegiatan) && $kegiatan->gambar): ?>
                <div class="mt-3">
                  <p class="mb-1 text-muted">Gambar Saat Ini:</p>
                  <img src="<?= base_url('assets/uploads/kegiatan/' . $kegiatan->gambar) ?>"
                       alt="<?= $kegiatan->nama_kegiatan ?>"
                       class="img-thumbnail shadow-sm"
                       width="250">
                </div>
              <?php endif; ?>
            </div>

            <!-- Lampiran -->
            <div class="mb-3">
              <label for="lampiran" class="form-label fw-bold">Lampiran (PDF/DOC/ZIP)</label>
              <input type="file" name="lampiran[]" id="lampiran" class="form-control" multiple>

              <?php if (isset($kegiatan) && $kegiatan->lampiran): ?>
                <?php 
                  $lampiran_list = json_decode($kegiatan->lampiran, true); 
                  if (!is_array($lampiran_list)) $lampiran_list = [$kegiatan->lampiran];
                ?>
                <div class="mt-3">
                  <p class="mb-1 text-muted fw-bold">Lampiran Saat Ini:</p>
                  <ul class="list-unstyled">
                    <?php foreach ($lampiran_list as $idx => $lampiran): ?>
                      <li class="mb-1 d-flex align-items-center gap-2">
                        <i class="bi bi-file-earmark-text text-primary"></i>
                        <a href="<?= base_url('assets/uploads/lampiran/' . $lampiran) ?>" 
                           target="_blank" class="btn btn-outline-primary btn-sm px-3 py-1 rounded-pill">
                          📂 Lampiran <?= count($lampiran_list) > 1 ? ($idx+1) : '' ?>
                        </a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>

                <!-- Checkbox hapus lampiran -->
                <div class="form-check mt-2">
                  <input class="form-check-input" type="checkbox" name="hapus_lampiran" value="1" id="hapusLampiran">
                  <label class="form-check-label text-danger fw-bold" for="hapusLampiran">
                    🗑 Hapus semua lampiran
                  </label>
                </div>
              <?php endif; ?>
            </div>

            <!-- Sertifikat (Google Drive) -->
            <div class="mb-3 mt-4">
              <label for="sertifikat_link" class="form-label fw-bold">Link Sertifikat (Google Drive)</label>
              <input type="url" class="form-control" id="sertifikat_link" name="sertifikat_link"
                     placeholder="https://drive.google.com/..."
                     value="<?= isset($kegiatan) ? $kegiatan->sertifikat_link : '' ?>">

              <?php if (isset($kegiatan) && !empty($kegiatan->sertifikat_link)): ?>
                <div class="mt-2">
                  <a href="<?= html_escape($kegiatan->sertifikat_link) ?>" target="_blank"
                     class="btn btn-outline-success btn-sm px-3 py-1 rounded-pill">
                     🏆 Lihat Sertifikat Saat Ini
                  </a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-4 d-flex justify-content-between">
          <a href="<?= base_url('kegiatan') ?>" class="btn btn-secondary px-4 py-2 rounded-pill">⬅ Kembali</a>
          <button type="submit" class="btn btn-success px-4 py-2 rounded-pill">
            <?= isset($kegiatan) ? '💾 Update' : '✅ Simpan' ?>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
