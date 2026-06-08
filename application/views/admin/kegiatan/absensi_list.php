<?php
// Hitung statistik kepuasan berdasarkan nilai DB: 'Ya' = Puas, 'Tidak' = Kurang Puas
$total   = count($absensi);
$puas    = 0;
$kurang  = 0;

foreach ($absensi as $a) {
    $k = strtolower(trim($a->kepuasan ?? ''));
    if ($k === 'ya') {
        $puas++;
    } else {
        $kurang++;
    }
}

$pct_puas   = $total > 0 ? round($puas   / $total * 100) : 0;
$pct_kurang = $total > 0 ? round($kurang / $total * 100) : 0;
?>

<main class="container-fluid px-4 py-4">

  <!-- Page Header -->
  <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
    <div>
      <small style="color:var(--cyber-cyan);font-family:var(--font-mono);letter-spacing:2px;font-size:.72rem;">// KEGIATAN &rsaquo; DATA ABSENSI</small>
      <h4 style="font-family:var(--font-display);color:var(--cyber-text);margin:.25rem 0 0;">
        <?= htmlspecialchars($kegiatan->nama_kegiatan) ?>
      </h4>
      <div style="font-family:var(--font-mono);font-size:.76rem;color:var(--cyber-text-dim);margin-top:4px;">
        <i class="bi bi-calendar-event me-1" style="color:var(--cyber-cyan);"></i>
        <?= date('d M Y, H:i', strtotime($kegiatan->waktu_kegiatan)) ?>
        <span class="ms-3">
          <?php if (!empty($kegiatan->is_absensi_open) && $kegiatan->is_absensi_open == 1): ?>
            <span class="badge badge-cyber-green" style="font-size:.65rem;">
              <span class="status-dot online" style="width:6px;height:6px;vertical-align:middle;margin-right:3px;"></span>ABSENSI DIBUKA
            </span>
          <?php else: ?>
            <span class="badge badge-cyber-red" style="font-size:.65rem;">ABSENSI DITUTUP</span>
          <?php endif; ?>
        </span>
      </div>
    </div>
    <div class="d-flex gap-2 flex-wrap">
      <a href="<?= site_url('kegiatan/detail/' . $kegiatan->id) ?>"
         class="btn btn-cyber btn-sm" style="border-color:rgba(168,85,247,.5);color:var(--cyber-purple);">
        <i class="bi bi-arrow-left me-1"></i>Kembali
      </a>
      <?php if (!empty($absensi)): ?>
      <a href="<?= site_url('kegiatan/export_excel/' . $kegiatan->id) ?>"
         class="btn btn-cyber btn-sm" style="border-color:rgba(0,255,136,.5);color:var(--cyber-green);">
        <i class="bi bi-file-earmark-excel me-1"></i>Export Excel
      </a>
      <?php endif; ?>
    </div>
  </div>

  <!-- Summary Cards — sesuai field DB: kepuasan = 'Ya' | 'Tidak' -->
  <div class="row g-3 mb-4">

    <!-- Total Peserta -->
    <div class="col-6 col-md-4 scroll-reveal">
      <div class="stat-card stat-cyan text-center">
        <div style="font-size:1.5rem;color:var(--cyber-cyan);margin-bottom:.4rem;"><i class="bi bi-people-fill"></i></div>
        <div class="stat-number">
          <span data-counter data-target="<?= $total ?>" data-color="var(--cyber-cyan)"></span>
        </div>
        <div class="stat-label">Total Peserta</div>
      </div>
    </div>

    <!-- Puas (kepuasan = 'Ya') -->
    <div class="col-6 col-md-4 scroll-reveal">
      <div class="stat-card stat-green text-center">
        <div style="font-size:1.5rem;color:var(--cyber-green);margin-bottom:.4rem;"><i class="bi bi-emoji-smile-fill"></i></div>
        <div class="stat-number">
          <span data-counter data-target="<?= $puas ?>" data-color="var(--cyber-green)"></span>
        </div>
        <div class="stat-label">Puas</div>
        <?php if ($total > 0): ?>
        <div style="margin-top:.5rem;">
          <div class="cyber-progress">
            <div class="cyber-progress-bar" style="width:<?= $pct_puas ?>%;background:var(--cyber-green);box-shadow:0 0 8px var(--cyber-green);"></div>
          </div>
          <small style="font-family:var(--font-mono);font-size:.62rem;color:var(--cyber-green);"><?= $pct_puas ?>%</small>
        </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Kurang Puas (kepuasan = 'Tidak') -->
    <div class="col-6 col-md-4 scroll-reveal">
      <div class="stat-card stat-red text-center">
        <div style="font-size:1.5rem;color:var(--cyber-red);margin-bottom:.4rem;"><i class="bi bi-emoji-frown-fill"></i></div>
        <div class="stat-number">
          <span data-counter data-target="<?= $kurang ?>" data-color="var(--cyber-red)"></span>
        </div>
        <div class="stat-label">Kurang Puas</div>
        <?php if ($total > 0): ?>
        <div style="margin-top:.5rem;">
          <div class="cyber-progress">
            <div class="cyber-progress-bar" style="width:<?= $pct_kurang ?>%;background:var(--cyber-red);box-shadow:0 0 8px var(--cyber-red);"></div>
          </div>
          <small style="font-family:var(--font-mono);font-size:.62rem;color:var(--cyber-red);"><?= $pct_kurang ?>%</small>
        </div>
        <?php endif; ?>
      </div>
    </div>

  </div>

  <!-- React Live Search + Filter Kepuasan -->
  <?php if (!empty($absensi)): ?>
  <div class="d-flex flex-wrap gap-3 align-items-center mb-3" style="min-height:38px;">
    <div data-live-search
         data-table="absensi-table"
         data-cols="1,2,3"
         data-placeholder="Cari nama, OPD, atau email..."></div>

    <!-- Filter kepuasan (custom, bukan StatusTabs) -->
    <div id="kepuasan-tabs" style="display:flex;gap:.4rem;flex-wrap:wrap;">
      <button class="kep-tab active"
              data-val="all"
              style="padding:.3rem .9rem;border:1px solid var(--cyber-cyan);background:rgba(0,212,255,.08);color:var(--cyber-cyan);border-radius:2px;cursor:pointer;font-family:'Rajdhani',sans-serif;font-weight:600;font-size:.78rem;letter-spacing:1.5px;text-transform:uppercase;transition:all .2s;">
        Semua
      </button>
      <button class="kep-tab"
              data-val="Ya"
              style="padding:.3rem .9rem;border:1px solid var(--cyber-border);background:transparent;color:var(--cyber-text-dim);border-radius:2px;cursor:pointer;font-family:'Rajdhani',sans-serif;font-weight:600;font-size:.78rem;letter-spacing:1.5px;text-transform:uppercase;transition:all .2s;">
        Puas
      </button>
      <button class="kep-tab"
              data-val="Tidak"
              style="padding:.3rem .9rem;border:1px solid var(--cyber-border);background:transparent;color:var(--cyber-text-dim);border-radius:2px;cursor:pointer;font-family:'Rajdhani',sans-serif;font-weight:600;font-size:.78rem;letter-spacing:1.5px;text-transform:uppercase;transition:all .2s;">
        Kurang Puas
      </button>
    </div>
  </div>

  <!-- Tabel Absensi -->
  <div class="cyber-card p-0 overflow-hidden">
    <div class="table-responsive">
      <table class="table cyber-table mb-0" id="absensi-table" style="min-width:720px;">
        <thead>
          <tr>
            <th style="width:44px;text-align:center;">#</th>
            <th style="min-width:160px;">Nama Peserta</th>
            <th style="min-width:160px;">Unit Kerja / OPD</th>
            <th style="min-width:160px;">Email</th>
            <th style="min-width:180px;">Saran &amp; Masukan</th>
            <th style="width:115px;">Waktu Absen</th>
            <th style="width:120px;text-align:center;">Kepuasan</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($absensi as $row): ?>
          <?php
            $kep_raw = trim($row->kepuasan ?? '');
            $kep_lower = strtolower($kep_raw);
            // Badge sesuai nilai DB: 'Ya' = Puas (green), lainnya = Kurang Puas (red)
            if ($kep_lower === 'ya') {
              $badge = '<span class="badge badge-cyber-green"><i class="bi bi-emoji-smile me-1"></i>Puas</span>';
            } elseif ($kep_lower === 'tidak') {
              $badge = '<span class="badge badge-cyber-red"><i class="bi bi-emoji-frown me-1"></i>Kurang Puas</span>';
            } elseif ($kep_raw !== '') {
              $badge = '<span class="badge badge-cyber-amber">' . htmlspecialchars($kep_raw) . '</span>';
            } else {
              $badge = '<span style="color:var(--cyber-text-dim);font-size:.8rem;">—</span>';
            }
          ?>
          <tr data-kepuasan="<?= htmlspecialchars($kep_raw) ?>">
            <td class="text-center">
              <span style="font-family:var(--font-mono);font-size:.72rem;color:var(--cyber-text-dim);"><?= $no++ ?></span>
            </td>
            <!-- nama_peserta -->
            <td>
              <div style="font-size:.88rem;color:var(--cyber-text);font-weight:600;line-height:1.3;">
                <?= htmlspecialchars($row->nama_peserta) ?>
              </div>
            </td>
            <!-- asal_opd -->
            <td>
              <div style="font-size:.84rem;color:var(--cyber-text-dim);">
                <?= $row->asal_opd ? htmlspecialchars($row->asal_opd) : '<span style="opacity:.4;">—</span>' ?>
              </div>
            </td>
            <!-- email -->
            <td>
              <div style="font-family:var(--font-mono);font-size:.76rem;color:var(--cyber-cyan);">
                <?= $row->email ? htmlspecialchars($row->email) : '<span style="opacity:.4;">—</span>' ?>
              </div>
            </td>
            <!-- saran_masukan -->
            <td>
              <div style="font-size:.82rem;color:var(--cyber-text-dim);line-height:1.4;
                          display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;
                          overflow:hidden;max-width:200px;"
                   title="<?= htmlspecialchars($row->saran_masukan ?? '') ?>">
                <?= $row->saran_masukan
                    ? htmlspecialchars($row->saran_masukan)
                    : '<span style="opacity:.4;">—</span>' ?>
              </div>
            </td>
            <!-- waktu_absen -->
            <td>
              <div style="font-family:var(--font-mono);font-size:.72rem;color:var(--cyber-text-dim);line-height:1.5;">
                <?= $row->waktu_absen ? date('d M Y', strtotime($row->waktu_absen)) : '—' ?>
                <?php if ($row->waktu_absen): ?>
                <br><span style="color:var(--cyber-cyan);"><?= date('H:i', strtotime($row->waktu_absen)) ?></span>
                <?php endif; ?>
              </div>
            </td>
            <!-- kepuasan -->
            <td class="text-center">
              <?= $badge ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <?php else: ?>
  <div class="cyber-card p-5 text-center scroll-reveal">
    <div style="font-size:3rem;color:var(--cyber-text-dim);margin-bottom:1rem;"><i class="bi bi-people"></i></div>
    <p style="font-family:var(--font-mono);font-size:.85rem;color:var(--cyber-text-dim);margin:0;">
      Belum ada peserta yang mengisi absensi untuk kegiatan ini.
    </p>
  </div>
  <?php endif; ?>

</main>

<script>
// Filter kepuasan tabs (berdasarkan data-kepuasan="Ya"/"Tidak" pada row)
(function() {
  var tabs = document.querySelectorAll('.kep-tab');
  if (!tabs.length) return;

  function setActive(btn) {
    tabs.forEach(function(t) {
      var isActive = t === btn;
      t.style.border     = '1px solid ' + (isActive ? (t.dataset.val === 'all' ? 'var(--cyber-cyan)' : t.dataset.val === 'Ya' ? 'var(--cyber-green)' : 'var(--cyber-red)') : 'var(--cyber-border)');
      t.style.background = isActive ? (t.dataset.val === 'all' ? 'rgba(0,212,255,.08)' : t.dataset.val === 'Ya' ? 'rgba(0,255,136,.08)' : 'rgba(255,59,92,.08)') : 'transparent';
      t.style.color      = isActive ? (t.dataset.val === 'all' ? 'var(--cyber-cyan)' : t.dataset.val === 'Ya' ? 'var(--cyber-green)' : 'var(--cyber-red)') : 'var(--cyber-text-dim)';
    });
  }

  tabs.forEach(function(btn) {
    btn.addEventListener('click', function() {
      setActive(this);
      var val = this.dataset.val;
      var rows = document.querySelectorAll('#absensi-table tbody tr');
      rows.forEach(function(row) {
        if (val === 'all') {
          row.style.display = '';
        } else {
          row.style.display = row.dataset.kepuasan === val ? '' : 'none';
        }
      });
    });
  });
})();
</script>
