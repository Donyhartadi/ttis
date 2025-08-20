<div class="container my-5">
  <div class="card shadow rounded-4">
    <div class="card-body">
      <h4 class="fw-bold mb-3"><i class="bi bi-printer-fill"></i> Cetak Laporan</h4>

      <!-- Form Filter -->
      <form method="post" action="<?= base_url('laporan/cetak_filter') ?>" class="row g-3 mb-4">
        <div class="col-md-5">
          <label for="tanggal_awal" class="form-label">Dari Tanggal</label>
          <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control"
                 value="<?= isset($tgl_awal) ? $tgl_awal : '' ?>" required>
        </div>
        <div class="col-md-5">
          <label for="tanggal_akhir" class="form-label">Sampai Tanggal</label>
          <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control"
                 value="<?= isset($tgl_akhir) ? $tgl_akhir : '' ?>" required>
        </div>
        <div class="col-md-2 d-flex align-items-end">
          <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Tampilkan</button>
        </div>
      </form>

      <!-- Tabel Data -->
      <?php if (!empty($laporan)) : ?>
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead class="table-light">
              <tr class="text-center">
                <th>No</th>
                <th>Nama Pelapor</th>
                <th>Judul</th>
                <th>Waktu</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($laporan as $i => $row) : ?>
                <tr>
                  <td class="text-center"><?= $i + 1 ?></td>
                  <td><?= $row->nama_pelapor ?></td>
                  <td><?= $row->judul_laporan ?></td>
                  <td><?= date('d-m-Y H:i', strtotime($row->waktu_laporan)) ?></td>
                  <td class="text-center">
                  <?php if ($row->status == 'Menunggu') : ?>
                    <span class="badge bg-warning-subtle text-warning fw-semibold">Menunggu</span>
                  <?php elseif ($row->status == 'Diproses') : ?>
                    <span class="badge bg-primary-subtle text-primary fw-semibold">Diproses</span>
                  <?php else : ?>
                    <span class="badge bg-success-subtle text-success fw-semibold">Selesai</span>
                  <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <!-- Tombol Cetak -->
        <div class="mt-3 text-end">
          <button onclick="window.print()" class="btn btn-outline-secondary"><i class="bi bi-printer"></i> Cetak</button>
        </div>

      <?php elseif (isset($tgl_awal)) : ?>
        <div class="alert alert-warning mt-3">
          Tidak ada data laporan dari <strong><?= $tgl_awal ?></strong> sampai <strong><?= $tgl_akhir ?></strong>.
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
