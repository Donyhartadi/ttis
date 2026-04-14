<main class="container-fluid px-4 py-4">

  <!-- Page Header -->
  <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
    <div>
      <small style="color:var(--cyber-cyan);font-family:var(--font-mono);letter-spacing:2px;font-size:0.72rem;">// KEGIATAN &rsaquo; ABSENSI</small>
      <h4 style="font-family:var(--font-display);color:var(--cyber-text);margin:0.25rem 0 0;">
        <?= htmlspecialchars($kegiatan->nama_kegiatan) ?>
      </h4>
      <div style="font-family:var(--font-mono);font-size:0.78rem;color:var(--cyber-text-dim);margin-top:4px;">
        <i class="bi bi-calendar-event me-1" style="color:var(--cyber-cyan);"></i>
        <?= date('d M Y, H:i', strtotime($kegiatan->waktu_kegiatan)) ?>
      </div>
    </div>
    <div class="d-flex gap-2 flex-wrap">
      <a href="<?= site_url('kegiatan/detail/' . $kegiatan->id) ?>"
         class="btn btn-cyber btn-sm" style="border-color:rgba(168,85,247,0.5);color:var(--cyber-purple);">
        <i class="bi bi-arrow-left me-1"></i>Kembali
      </a>
      <?php if (!empty($absensi)): ?>
      <a href="<?= site_url('kegiatan/export_excel/' . $kegiatan->id) ?>"
         class="btn btn-cyber btn-sm" style="border-color:rgba(0,255,136,0.5);color:var(--cyber-green);">
        <i class="bi bi-file-earmark-excel me-1"></i>Export Excel
      </a>
      <?php endif; ?>
    </div>
  </div>

  <!-- Summary & Status Cards -->
  <div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
      <div class="cyber-card p-3 text-center">
        <div style="font-family:var(--font-display);font-size:2rem;color:var(--cyber-cyan);"><?= count($absensi) ?></div>
        <div style="font-family:var(--font-mono);font-size:0.65rem;color:var(--cyber-text-dim);letter-spacing:2px;">TOTAL PESERTA</div>
      </div>
    </div>
    <?php
      $puas = 0; $cukup = 0; $kurang = 0;
      foreach ($absensi as $a) {
        $k = strtolower($a->kepuasan ?? '');
        if (str_contains($k, 'puas') && !str_contains($k, 'tidak') && !str_contains($k, 'kurang')) $puas++;
        elseif (str_contains($k, 'cukup') || str_contains($k, 'biasa')) $cukup++;
        else $kurang++;
      }
    ?>
    <div class="col-6 col-md-3">
      <div class="cyber-card p-3 text-center">
        <div style="font-family:var(--font-display);font-size:2rem;color:var(--cyber-green);"><?= $puas ?></div>
        <div style="font-family:var(--font-mono);font-size:0.65rem;color:var(--cyber-text-dim);letter-spacing:2px;">PUAS</div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="cyber-card p-3 text-center">
        <div style="font-family:var(--font-display);font-size:2rem;color:var(--cyber-amber);"><?= $cukup ?></div>
        <div style="font-family:var(--font-mono);font-size:0.65rem;color:var(--cyber-text-dim);letter-spacing:2px;">CUKUP PUAS</div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="cyber-card p-3 text-center">
        <div style="font-family:var(--font-display);font-size:2rem;color:var(--cyber-red);"><?= $kurang ?></div>
        <div style="font-family:var(--font-mono);font-size:0.65rem;color:var(--cyber-text-dim);letter-spacing:2px;">KURANG PUAS</div>
      </div>
    </div>
  </div>

  <!-- Table -->
  <?php if (!empty($absensi)): ?>
  <div class="cyber-card p-0 overflow-hidden">
    <div class="table-responsive">
      <table class="table cyber-table mb-0" style="min-width:700px;">
        <thead>
          <tr>
            <th style="width:44px;text-align:center;">#</th>
            <th style="min-width:160px;">Nama Peserta</th>
            <th style="min-width:150px;">Unit Kerja / OPD</th>
            <th style="min-width:160px;">Email</th>
            <th style="min-width:200px;">Saran &amp; Masukan</th>
            <th style="width:115px;">Waktu Absen</th>
            <th style="width:110px;">Kepuasan</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($absensi as $row): ?>
          <tr>
            <td class="text-center">
              <span style="font-family:var(--font-mono);font-size:0.72rem;color:var(--cyber-text-dim);"><?= $no++ ?></span>
            </td>
            <td>
              <div style="font-size:0.88rem;color:var(--cyber-text);font-weight:600;"><?= htmlspecialchars($row->nama_peserta) ?></div>
            </td>
            <td>
              <div style="font-size:0.85rem;color:var(--cyber-text-dim);"><?= htmlspecialchars($row->asal_opd) ?></div>
            </td>
            <td>
              <div style="font-family:var(--font-mono);font-size:0.78rem;color:var(--cyber-cyan);">
                <?= htmlspecialchars($row->email) ?>
              </div>
            </td>
            <td>
              <div style="font-size:0.82rem;color:var(--cyber-text-dim);line-height:1.4;
                          display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;
                          overflow:hidden;max-width:200px;"
                   title="<?= htmlspecialchars($row->saran_masukan) ?>">
                <?= $row->saran_masukan ? htmlspecialchars($row->saran_masukan) : '<span style="opacity:.4;">—</span>' ?>
              </div>
            </td>
            <td>
              <div style="font-family:var(--font-mono);font-size:0.72rem;color:var(--cyber-text-dim);line-height:1.5;">
                <?= date('d M Y', strtotime($row->waktu_absen)) ?>
                <br><span style="color:var(--cyber-cyan);"><?= date('H:i', strtotime($row->waktu_absen)) ?></span>
              </div>
            </td>
            <td>
              <?php
                $k = strtolower($row->kepuasan ?? '');
                if (str_contains($k, 'puas') && !str_contains($k, 'tidak') && !str_contains($k, 'kurang'))
                  echo '<span class="badge badge-cyber-green">' . htmlspecialchars($row->kepuasan) . '</span>';
                elseif (str_contains($k, 'cukup') || str_contains($k, 'biasa'))
                  echo '<span class="badge badge-cyber-amber">' . htmlspecialchars($row->kepuasan) . '</span>';
                elseif ($row->kepuasan)
                  echo '<span class="badge badge-cyber-red">' . htmlspecialchars($row->kepuasan) . '</span>';
                else
                  echo '<span style="color:var(--cyber-text-dim);font-size:0.8rem;">—</span>';
              ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <?php else: ?>
  <div class="cyber-card p-5 text-center">
    <div style="font-size:3rem;color:var(--cyber-text-dim);margin-bottom:1rem;"><i class="bi bi-people"></i></div>
    <p style="font-family:var(--font-mono);font-size:0.85rem;color:var(--cyber-text-dim);margin:0;">
      Belum ada peserta yang mengisi absensi.
    </p>
  </div>
  <?php endif; ?>

</main>
