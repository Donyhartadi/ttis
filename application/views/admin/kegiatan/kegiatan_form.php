<div class="container mt-4">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0">
        <?= isset($kegiatan) ? '✏ Edit Kegiatan' : '➕ Tambah Kegiatan' ?>
      </h5>
    </div>
    <div class="card-body">
      <form method="post" enctype="multipart/form-data">

        <!-- CSRF Token -->
        <input type="hidden" 
               name="<?= $this->security->get_csrf_token_name(); ?>" 
               value="<?= $this->security->get_csrf_hash(); ?>" />

        <!-- Nama Kegiatan -->
        <div class="mb-3">
          <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
          <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan"
                 value="<?= isset($kegiatan) ? $kegiatan->nama_kegiatan : '' ?>" required>
        </div>

        <div class="mb-3">
        <label for="waktu_kegiatan" class="form-label">Waktu Kegiatan</label>
        <input type="datetime-local" name="waktu_kegiatan" id="waktu_kegiatan" 
                class="form-control" required 
                value="<?= isset($kegiatan) ? date('Y-m-d\TH:i', strtotime($kegiatan->waktu_kegiatan)) : '' ?>">
        </div>

        <!-- Keterangan -->
        <div class="mb-3">
          <label for="keterangan" class="form-label">Keterangan</label>
          <textarea class="form-control" id="keterangan" name="keterangan" rows="5" required><?= isset($kegiatan) ? $kegiatan->keterangan : '' ?></textarea>
        </div>

        <!-- Gambar -->
        <div class="mb-3">
          <label for="gambar" class="form-label">Gambar</label>
          <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
          <?php if (isset($kegiatan) && $kegiatan->gambar): ?>
            <div class="mt-2">
              <p>Gambar Saat Ini:</p>
              <img src="<?= base_url('assets/uploads/kegiatan/' . $kegiatan->gambar) ?>" 
                   alt="<?= $kegiatan->nama_kegiatan ?>" class="img-thumbnail" width="200">
            </div>
          <?php endif; ?>
        </div>
        
        <div class="mb-3">
        <label for="lampiran" class="form-label">Lampiran (PDF/DOC/ZIP)</label>
        <input type="file" name="lampiran" id="lampiran" class="form-control">
        </div>


        <!-- Tombol Aksi -->
        <div class="d-flex justify-content-between">
          <a href="<?= base_url('kegiatan') ?>" class="btn btn-secondary">⬅ Kembali</a>
          <button type="submit" class="btn btn-success">
            <?= isset($kegiatan) ? '💾 Update' : '✅ Simpan' ?>
          </button>
        </div>

      </form>
    </div>
  </div>
</div>
