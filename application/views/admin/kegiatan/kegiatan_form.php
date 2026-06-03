<main class="container-fluid px-4 py-4">

  <!-- Header -->
  <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
    <div>
      <div style="font-family:var(--font-mono);color:var(--cyber-cyan);font-size:0.75rem;letter-spacing:2px;">// <?= isset($kegiatan) ? 'EDIT' : 'TAMBAH' ?> KEGIATAN</div>
      <h2 class="mb-0" style="font-family:var(--font-display);color:var(--cyber-text);"><?= isset($kegiatan) ? 'Edit' : 'Tambah' ?> Kegiatan</h2>
    </div>
    <a href="<?= base_url('kegiatan') ?>" class="btn btn-cyber" style="background:transparent;border-color:var(--cyber-border);color:var(--cyber-text-dim);">
      <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
  </div>

  <form method="post" enctype="multipart/form-data">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">

    <!-- Baris 1: Nama + Waktu sejajar -->
    <div class="row g-3 mb-4">
      <div class="col-lg-8">
        <label class="cyber-label">Nama Kegiatan</label>
        <input type="text" name="nama_kegiatan" class="cyber-input"
               placeholder="Masukkan nama kegiatan..." required
               value="<?= isset($kegiatan) ? htmlspecialchars($kegiatan->nama_kegiatan) : '' ?>">
      </div>
      <div class="col-lg-4">
        <label class="cyber-label">Waktu Kegiatan</label>
        <input type="datetime-local" name="waktu_kegiatan" class="cyber-input" required
               value="<?= isset($kegiatan) ? date('Y-m-d\TH:i', strtotime($kegiatan->waktu_kegiatan)) : '' ?>">
      </div>
    </div>

    <!-- Baris 2: Keterangan + Sidebar -->
    <div class="row g-4">

      <!-- Kiri: Keterangan -->
      <div class="col-lg-8">
        <div class="cyber-card">
          <label class="cyber-label mb-2">
            <i class="bi bi-file-text me-1" style="color:var(--cyber-cyan);"></i>Keterangan / Deskripsi
          </label>
          <textarea name="keterangan" class="cyber-input w-100" rows="16" style="resize:vertical;"
                    placeholder="Tulis keterangan lengkap kegiatan..." required><?= isset($kegiatan) ? $kegiatan->keterangan : '' ?></textarea>
        </div>
      </div>

      <!-- Kanan: Sidebar sticky -->
      <div class="col-lg-4">
        <div style="position:sticky;top:1rem;" class="d-flex flex-column gap-3">

          <!-- Gambar -->
          <div class="cyber-card">
            <div class="mb-3" style="font-family:var(--font-display);color:var(--cyber-cyan);font-size:0.78rem;letter-spacing:2px;">
              <i class="bi bi-image me-1"></i>GAMBAR
            </div>
            <?php if (isset($kegiatan) && $kegiatan->gambar): ?>
              <img src="<?= base_url('assets/uploads/kegiatan/' . $kegiatan->gambar) ?>"
                   alt="Gambar" class="rounded w-100 mb-2"
                   style="object-fit:cover;max-height:200px;border:1px solid var(--cyber-border);">
            <?php endif; ?>
            <input type="file" name="gambar" class="cyber-input" accept="image/*" onchange="previewImg(this)">
            <div id="imgPreview" style="display:none;" class="mt-2 text-center">
              <img id="previewSrc" class="rounded w-100" style="object-fit:cover;max-height:160px;border:1px solid var(--cyber-border);">
              <small class="d-block mt-1" style="color:var(--cyber-cyan);font-size:0.72rem;">Preview gambar baru</small>
            </div>
          </div>

          <!-- Lampiran -->
          <div class="cyber-card">
            <div class="mb-3" style="font-family:var(--font-display);color:var(--cyber-cyan);font-size:0.78rem;letter-spacing:2px;">
              <i class="bi bi-paperclip me-1"></i>LAMPIRAN
            </div>
            <input type="file" name="lampiran[]" class="cyber-input" multiple
                   accept=".pdf,.doc,.docx,.xls,.xlsx,.zip,.rar,.jpg,.jpeg,.png">
            <small class="d-block mt-1" style="color:var(--cyber-text-dim);font-size:0.75rem;">PDF, DOC, XLS, ZIP, gambar — maks. 5MB/file</small>

            <?php if (isset($kegiatan) && $kegiatan->lampiran): ?>
              <?php
                $lampiran_list = json_decode($kegiatan->lampiran, true);
                if (!is_array($lampiran_list)) $lampiran_list = [$kegiatan->lampiran];
              ?>
              <div class="mt-3" style="border-top:1px solid var(--cyber-border);padding-top:0.75rem;">
                <small class="d-block mb-2" style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:0.68rem;">FILE SAAT INI</small>
                <?php foreach ($lampiran_list as $idx => $lmp): ?>
                  <div class="d-flex align-items-center gap-2 mb-1 p-2" style="background:var(--cyber-bg);border:1px solid var(--cyber-border);border-radius:4px;">
                    <i class="bi bi-file-earmark-text" style="color:var(--cyber-cyan);font-size:0.85rem;"></i>
                    <a href="<?= base_url('assets/uploads/lampiran/' . $lmp) ?>" target="_blank"
                       style="color:var(--cyber-cyan);text-decoration:none;font-size:0.82rem;flex:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                      Lampiran <?= count($lampiran_list) > 1 ? ($idx + 1) : '' ?>
                    </a>
                  </div>
                <?php endforeach; ?>
                <div class="form-check mt-2">
                  <input class="form-check-input" type="checkbox" name="hapus_lampiran" value="1" id="hapusLampiran">
                  <label class="form-check-label" for="hapusLampiran" style="color:var(--cyber-red);font-size:0.82rem;">
                    <i class="bi bi-trash me-1"></i>Hapus semua lampiran
                  </label>
                </div>
              </div>
            <?php endif; ?>
          </div>

          <!-- Sertifikat -->
          <div class="cyber-card">
            <div class="mb-3" style="font-family:var(--font-display);color:var(--cyber-amber);font-size:0.78rem;letter-spacing:2px;">
              <i class="bi bi-award me-1"></i>SERTIFIKAT
            </div>
            <input type="url" name="sertifikat_link" class="cyber-input"
                   placeholder="https://drive.google.com/..."
                   value="<?= isset($kegiatan) ? htmlspecialchars($kegiatan->sertifikat_link) : '' ?>">
            <small class="d-block mt-1 mb-2" style="color:var(--cyber-text-dim);font-size:0.75rem;">Link Google Drive (opsional)</small>
            <?php if (isset($kegiatan) && !empty($kegiatan->sertifikat_link)): ?>
              <a href="<?= html_escape($kegiatan->sertifikat_link) ?>" target="_blank"
                 class="btn btn-cyber btn-sm w-100" style="background:rgba(255,176,32,0.08);border-color:var(--cyber-amber);color:var(--cyber-amber);">
                <i class="bi bi-box-arrow-up-right me-1"></i>Lihat Sertifikat
              </a>
            <?php endif; ?>
          </div>

          <!-- Aksi -->
          <div class="cyber-card">
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-cyber" style="padding:.75rem;font-size:1rem;">
                <i class="bi bi-save me-2"></i><?= isset($kegiatan) ? 'Update Kegiatan' : 'Simpan Kegiatan' ?>
              </button>
              <a href="<?= base_url('kegiatan') ?>" class="btn btn-cyber text-center"
                 style="background:transparent;border-color:var(--cyber-border);color:var(--cyber-text-dim);padding:.65rem;">
                <i class="bi bi-x-lg me-1"></i>Batal
              </a>
            </div>
          </div>

        </div><!-- end sticky -->
      </div>

    </div>
  </form>
</main>

<script>
function previewImg(input) {
  const preview = document.getElementById('imgPreview');
  const src = document.getElementById('previewSrc');
  if (input.files && input.files[0]) {
    src.src = URL.createObjectURL(input.files[0]);
    preview.style.display = 'block';
  }
}
</script>


