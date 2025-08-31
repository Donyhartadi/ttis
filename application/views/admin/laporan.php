<?php if($this->session->flashdata('success')): ?>
  <script>
    alert("<?= $this->session->flashdata('success'); ?>");
  </script>
<?php endif; ?>

<!-- Konten -->
<main class="container my-2">
  <h3 class="mb-2 fw-semibold text-center">📋 Daftar Laporan Insiden Siber</h3>

  <!-- Form Pencarian -->
  <form method="get" class="row justify-content-center mb-1">
    <div class="col-md-8 col-lg-6">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Cari judul / pelapor / deskripsi..." value="<?= $this->input->get('q'); ?>">
        <button type="submit" class="btn btn-primary">🔍</button>
      </div>
    </div>
  </form>

  <!-- Pagination Atas -->
  <div class="d-flex mb-1"><?= $pagination ?></div>

  <!-- List Laporan -->
  <div class="row g-3">
    <?php $no = 1; foreach ($laporan as $row): ?>
      <div class="col-12">
        <div class="card laporan-item bg-primary bg-opacity-10 border-0 shadow-sm rounded-4 p-3">

          <!-- Judul & Waktu -->
          <div class="d-flex justify-content-between align-items-start mb-2">
            <h5 class="text-primary fw-bold mb-1"><?= htmlspecialchars($row->judul_laporan); ?></h5>
            <small class="text-muted"><?= $row->waktu_laporan ? date('d M Y H:i', strtotime($row->waktu_laporan)) : '-' ?></small>
          </div>

          <!-- Tombol Aksi -->
          <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
            <?php
              $no_hp = preg_replace('/[^0-9]/', '', $row->no_hp);
              $wa = (strpos($no_hp, '0') === 0) ? '62' . substr($no_hp, 1) : $no_hp;
            ?>
            <a href="https://wa.me/<?= $wa ?>" target="_blank" class="btn btn-sm btn-success">💬 WA</a>

            <?php if (!empty($row->link)): ?>
              <?php $link = preg_match('#^https?://#', $row->link) ? $row->link : 'https://' . $row->link; ?>
              <a href="<?= $link ?>" target="_blank" class="btn btn-sm btn-outline-success">🌐 Link</a>
            <?php endif; ?>

            <?php if (!empty($row->eviden)): ?>
              <a href="<?= base_url('eviden/view/' . $row->eviden); ?>" target="_blank" class="btn btn-sm btn-outline-primary">📎 Eviden</a>
            <?php else: ?>
              <span class="text-muted small">❌ Tidak ada eviden</span>
            <?php endif; ?>

            <?php if (!empty($row->status)): ?>
              <span class="badge <?= $row->status == 'Menunggu' ? 'bg-warning' : ($row->status == 'Diproses' ? 'bg-primary' : 'bg-success') ?>">
                <?= $row->status ?>
              </span>
            <?php endif; ?>
          </div>

          <!-- Pelapor -->
          <div class="mb-2">
            <strong>👤 <?= htmlspecialchars($row->nama_pelapor); ?> <h7 class="text-success fw-bold mb-1"><?= htmlspecialchars($row->kode_resi); ?></h7></strong>
          </div>
          
          <!-- Deskripsi -->
          <p class="mb-2"><?= nl2br(htmlspecialchars($row->deskripsi)); ?></p>

          <!-- Aksi Status -->
          <div class="d-flex flex-wrap gap-2">

            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#statusModal<?= $row->id_laporan ?>">
              🛠 Update Status
            </button>
          </div>

          <!-- Nomor urut -->
          <div class="text-end text-muted small mt-2 fst-italic">#<?= $no++; ?></div>
        </div>
      </div>

      <!-- Modal Update Status -->
      <div class="modal fade" id="statusModal<?= $row->id_laporan ?>" tabindex="-1" aria-labelledby="statusModalLabel<?= $row->id_laporan ?>" aria-hidden="true">
        <div class="modal-dialog">
          <form method="post" action="<?= base_url('laporan/update_status_lanjutan/' . $row->id_laporan) ?>">
          <input type="hidden" 
            name="<?= $this->security->get_csrf_token_name(); ?>" 
            value="<?= $this->security->get_csrf_hash(); ?>" />
            <div class="modal-content">
              <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="statusModalLabel<?= $row->id_laporan ?>">Update Status Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <select name="status" class="form-select" required>
                  <option value="">-- Pilih Status --</option>
                  <option value="Menunggu" <?= $row->status == 'Menunggu' ? 'selected' : '' ?>>Menunggu</option>
                  <option value="Diproses" <?= $row->status == 'Diproses' ? 'selected' : '' ?>>Diproses</option>
                  <option value="Selesai" <?= $row->status == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                </select>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-info">Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Pagination Bawah -->
  <div class="d-flex mt-4"><?= $pagination ?></div>
</main>

<!-- CSS tambahan -->
<style>
  .laporan-item .btn,
  .laporan-item .badge {
    font-size: 0.8rem;
    padding: 4px 8px;
  }
  .laporan-item {
    transition: all 0.2s ease-in-out;
  }
  .laporan-item:hover {
    background-color: #f8f9fa;
    transform: scale(1.01);
  }
</style>

