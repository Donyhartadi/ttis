<style>
/* ---- Print Styles ---- */
@media print {
  .cyber-navbar, nav, .no-print { display: none !important; }
  body, html {
    background: #fff !important;
    color: #111 !important;
    font-family: 'Segoe UI', Arial, sans-serif !important;
  }
  .print-header { display: block !important; }
  .cyber-card {
    background: #fff !important;
    border: 1px solid #ccc !important;
    box-shadow: none !important;
    padding: 0 !important;
  }
  .table { color: #111 !important; }
  .table th { background: #f0f4f8 !important; color: #111 !important; border-bottom: 2px solid #333 !important; }
  .table td { color: #111 !important; border-color: #ddd !important; }
  .badge { color: #111 !important; background: #eee !important; border: 1px solid #aaa !important; }
  .print-sum { display: flex !important; }
}
@media screen {
  .print-header { display: none; }
}
</style>

<main class="container-fluid px-4 py-4">

  <!-- Page Header (screen only) -->
  <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2 no-print">
    <div>
      <small style="color:var(--cyber-cyan);font-family:var(--font-mono);letter-spacing:2px;font-size:0.75rem;">// LAPORAN INSIDEN</small>
      <h4 style="font-family:var(--font-display);color:var(--cyber-text);margin:0;">Cetak Laporan</h4>
    </div>
    <a href="<?= site_url('laporan') ?>" class="btn btn-cyber btn-sm" style="border-color:rgba(168,85,247,0.5);color:var(--cyber-purple);">
      <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
  </div>

  <!-- Filter Form -->
  <div class="cyber-card mb-4 no-print">
    <form method="post" action="<?= base_url('laporan/cetak_filter') ?>">
      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
      <div class="row g-3 align-items-end">
        <div class="col-12 col-md-4">
          <label class="cyber-label d-block mb-1">Dari Tanggal</label>
          <input type="date" name="tanggal_awal" class="form-control cyber-input w-100"
                 value="<?= isset($tgl_awal) ? htmlspecialchars($tgl_awal) : '' ?>" required>
        </div>
        <div class="col-12 col-md-4">
          <label class="cyber-label d-block mb-1">Sampai Tanggal</label>
          <input type="date" name="tanggal_akhir" class="form-control cyber-input w-100"
                 value="<?= isset($tgl_akhir) ? htmlspecialchars($tgl_akhir) : '' ?>" required>
        </div>
        <div class="col-12 col-md-4">
          <button type="submit" class="btn btn-cyber w-100" style="padding:.6rem 1rem;">
            <i class="bi bi-search me-2"></i>Tampilkan Data
          </button>
        </div>
      </div>
    </form>
  </div>

  <?php if (!empty($laporan)): ?>

    <!-- Print Header (print only) -->
    <div class="print-header mb-4" style="text-align:center;border-bottom:2px solid #333;padding-bottom:12px;">
      <div style="font-size:1.1rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;">
        Tim Tanggap Insiden Siber (TTIS)
      </div>
      <div style="font-size:0.9rem;">Kabupaten Muara Enim</div>
      <div style="font-size:0.8rem;margin-top:4px;color:#555;">
        Periode: <?= date('d M Y', strtotime($tgl_awal)) ?> &mdash; <?= date('d M Y', strtotime($tgl_akhir)) ?>
        &nbsp;|&nbsp; Dicetak: <?= date('d M Y H:i') ?>
      </div>
    </div>

    <!-- Info Bar -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
      <div class="d-flex align-items-center gap-3">
        <div style="font-family:var(--font-mono);font-size:0.8rem;color:var(--cyber-text-dim);">
          <i class="bi bi-calendar-range me-1" style="color:var(--cyber-cyan);"></i>
          <?= date('d M Y', strtotime($tgl_awal)) ?> &mdash; <?= date('d M Y', strtotime($tgl_akhir)) ?>
        </div>
        <span style="font-family:var(--font-mono);font-size:0.7rem;background:rgba(0,212,255,0.1);border:1px solid rgba(0,212,255,0.3);color:var(--cyber-cyan);padding:2px 10px;border-radius:3px;">
          <?= count($laporan) ?> Laporan
        </span>
      </div>
      <button onclick="window.print()" class="btn btn-cyber btn-sm no-print">
        <i class="bi bi-printer me-1"></i>Cetak / Simpan PDF
      </button>
    </div>

    <!-- Summary Cards (screen only) -->
    <?php
      $jml_menunggu = 0; $jml_diproses = 0; $jml_selesai = 0;
      foreach ($laporan as $r) {
        $s = strtolower($r->status ?? '');
        if ($s === 'menunggu') $jml_menunggu++;
        elseif ($s === 'diproses') $jml_diproses++;
        elseif ($s === 'selesai') $jml_selesai++;
      }
    ?>
    <div class="row g-3 mb-4 no-print">
      <div class="col-4">
        <div class="cyber-card p-3 text-center">
          <div style="font-family:var(--font-display);font-size:1.8rem;color:var(--cyber-amber);"><?= $jml_menunggu ?></div>
          <div style="font-family:var(--font-mono);font-size:0.68rem;color:var(--cyber-text-dim);letter-spacing:2px;">MENUNGGU</div>
        </div>
      </div>
      <div class="col-4">
        <div class="cyber-card p-3 text-center">
          <div style="font-family:var(--font-display);font-size:1.8rem;color:var(--cyber-cyan);"><?= $jml_diproses ?></div>
          <div style="font-family:var(--font-mono);font-size:0.68rem;color:var(--cyber-text-dim);letter-spacing:2px;">DIPROSES</div>
        </div>
      </div>
      <div class="col-4">
        <div class="cyber-card p-3 text-center">
          <div style="font-family:var(--font-display);font-size:1.8rem;color:var(--cyber-green);"><?= $jml_selesai ?></div>
          <div style="font-family:var(--font-mono);font-size:0.68rem;color:var(--cyber-text-dim);letter-spacing:2px;">SELESAI</div>
        </div>
      </div>
    </div>

    <!-- Table -->
    <div class="cyber-card p-0 overflow-hidden">
      <div class="table-responsive">
        <table class="table cyber-table mb-0" style="min-width:600px;">
          <thead>
            <tr>
              <th style="width:44px;text-align:center;">#</th>
              <th style="min-width:150px;">Nama Pelapor</th>
              <th style="min-width:160px;">Kode Resi</th>
              <th style="min-width:180px;">Jenis Laporan</th>
              <th style="min-width:120px;">Waktu Laporan</th>
              <th style="width:100px;">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($laporan as $i => $row):
              $s = strtolower($row->status ?? '');
              $sc = $s === 'selesai' ? 'badge-cyber-green' : ($s === 'diproses' ? 'badge-cyber-cyan' : 'badge-cyber-amber');
            ?>
            <tr>
              <td class="text-center">
                <span style="font-family:var(--font-mono);font-size:0.72rem;color:var(--cyber-text-dim);"><?= $i + 1 ?></span>
              </td>
              <td>
                <div style="font-size:0.88rem;color:var(--cyber-text);"><?= htmlspecialchars($row->nama_pelapor) ?></div>
                <?php if (!empty($row->no_hp)): ?>
                <div style="font-family:var(--font-mono);font-size:0.68rem;color:var(--cyber-text-dim);margin-top:2px;">
                  <i class="bi bi-telephone me-1"></i><?= htmlspecialchars($row->no_hp) ?>
                </div>
                <?php endif; ?>
              </td>
              <td>
                <span style="font-family:var(--font-mono);font-size:0.78rem;color:var(--cyber-cyan);">
                  <?= htmlspecialchars($row->kode_resi ?? '-') ?>
                </span>
              </td>
              <td style="font-size:0.88rem;"><?= htmlspecialchars($row->judul_laporan) ?></td>
              <td>
                <div style="font-family:var(--font-mono);font-size:0.72rem;color:var(--cyber-text-dim);line-height:1.5;">
                  <?= date('d M Y', strtotime($row->waktu_laporan)) ?>
                  <br><span style="color:var(--cyber-cyan);"><?= date('H:i', strtotime($row->waktu_laporan)) ?></span>
                </div>
              </td>
              <td><span class="badge <?= $sc ?>"><?= htmlspecialchars($row->status ?? 'Menunggu') ?></span></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Print Summary Footer -->
    <div class="print-sum mt-4" style="display:none;justify-content:flex-end;gap:2rem;font-size:0.85rem;color:#555;">
      <span>Menunggu: <strong><?= $jml_menunggu ?></strong></span>
      <span>Diproses: <strong><?= $jml_diproses ?></strong></span>
      <span>Selesai: <strong><?= $jml_selesai ?></strong></span>
      <span>Total: <strong><?= count($laporan) ?></strong></span>
    </div>

  <?php elseif (isset($tgl_awal)): ?>
    <div class="cyber-card p-4 text-center">
      <div style="font-size:2.5rem;color:var(--cyber-text-dim);margin-bottom:.75rem;"><i class="bi bi-inbox"></i></div>
      <p style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:0.85rem;margin:0;">
        Tidak ada data laporan dari <span style="color:var(--cyber-cyan);"><?= htmlspecialchars($tgl_awal) ?></span>
        sampai <span style="color:var(--cyber-cyan);"><?= htmlspecialchars($tgl_akhir) ?></span>.
      </p>
    </div>

  <?php else: ?>
    <div class="cyber-card p-4 text-center">
      <div style="font-size:2.5rem;color:var(--cyber-text-dim);margin-bottom:.75rem;"><i class="bi bi-calendar-range"></i></div>
      <p style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:0.85rem;margin:0;">
        Pilih periode tanggal dan klik <span style="color:var(--cyber-cyan);">Tampilkan</span> untuk melihat data laporan.
      </p>
    </div>
  <?php endif; ?>

</main>
