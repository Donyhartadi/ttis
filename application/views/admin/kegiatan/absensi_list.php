<div class="container my-4">
  <div class="card shadow-sm">
    <div class="card-body">
      <h4 class="fw-bold text-info mb-3">
        👥 Daftar Absensi - <?= html_escape($kegiatan->nama_kegiatan) ?>
      </h4>

      <!-- Info Kegiatan -->
      <p class="mb-2">
        <span class="badge bg-light text-dark border">
          📅 <?= date('d M Y H:i', strtotime($kegiatan->waktu_kegiatan)) ?>
        </span>
      </p>

      <!-- Tombol Kembali -->
      <div class="mb-3">
        <a href="<?= base_url('kegiatan/detail/'.$kegiatan->id) ?>" class="btn btn-secondary btn-sm">
          ⬅ Kembali ke Detail
        </a>
      </div>

      <!-- Tabel Absensi -->
      <?php if (!empty($absensi)): ?>
        <div class="table-responsive">
          <table class="table table-striped table-bordered align-middle">
            <thead class="table-light">
              <tr>
                <th style="width:50px;">#</th>
                <th>Nama Peserta</th>
                <th>Unit Kerja</th>
                <th>Email</th>
                <th>Saran & Masukan</th>
                <th>Waktu Absen</th>
                <th>Kepuasan</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; foreach ($absensi as $row): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= html_escape($row->nama_peserta) ?></td>
                  <td><?= html_escape($row->asal_opd) ?></td>
                  <td><?= html_escape($row->email) ?></td>
                  <td><?= nl2br(html_escape($row->saran_masukan)) ?></td>
                  <td><?= date('d M Y H:i', strtotime($row->waktu_absen)) ?></td>
                  <td><?= html_escape($row->kepuasan) ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <div class="alert alert-info text-center">
          Belum ada peserta yang mengisi absensi.
        </div>
      <?php endif; ?>
      <div class="mb-3 d-flex justify-content-end">
  <a href="<?= base_url('kegiatan/export_excel/'.$kegiatan->id) ?>" 
     class="btn btn-success btn-sm">
    📊 Export ke Excel
  </a>
</div>

    </div>
  </div>
  
</div>
