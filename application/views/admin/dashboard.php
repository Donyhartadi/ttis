<!-- Admin Dashboard -->
<main class="container-fluid px-4 py-4">

  <!-- Header Bar -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <small style="color:var(--cyber-cyan);font-family:var(--font-mono);letter-spacing:2px;">// CONTROL CENTER</small>
      <h4 style="font-family:var(--font-display);color:var(--cyber-text);margin:0;">Dashboard</h4>
    </div>
    <div style="font-family:var(--font-mono);font-size:0.75rem;color:var(--cyber-text-dim);">
      <i class="bi bi-person-circle me-1" style="color:var(--cyber-cyan);"></i>
      <?= htmlspecialchars($this->session->userdata('username')) ?>
    </div>
  </div>

  <!-- Stat Cards -->
  <div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
      <div class="stat-card stat-amber">
        <div style="font-size:1.8rem;color:var(--cyber-amber);margin-bottom:0.5rem;"><i class="bi bi-hourglass-split"></i></div>
        <div class="stat-number" style="color:var(--cyber-amber);"><?= $total_menunggu ?? 0 ?></div>
        <div class="stat-label">Menunggu</div>
      </div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="stat-card stat-cyan">
        <div style="font-size:1.8rem;color:var(--cyber-cyan);margin-bottom:0.5rem;"><i class="bi bi-gear-wide-connected"></i></div>
        <div class="stat-number" style="color:var(--cyber-cyan);"><?= $total_diproses ?? 0 ?></div>
        <div class="stat-label">Diproses</div>
      </div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="stat-card stat-green">
        <div style="font-size:1.8rem;color:var(--cyber-green);margin-bottom:0.5rem;"><i class="bi bi-shield-check"></i></div>
        <div class="stat-number" style="color:var(--cyber-green);"><?= $total_selesai ?? 0 ?></div>
        <div class="stat-label">Selesai</div>
      </div>
    </div>
    <div class="col-6 col-lg-3">
      <div class="stat-card stat-red">
        <div style="font-size:1.8rem;color:var(--cyber-red);margin-bottom:0.5rem;"><i class="bi bi-inboxes"></i></div>
        <div class="stat-number" style="color:var(--cyber-red);"><?= ($total_selesai + $total_menunggu + $total_diproses) ?? 0 ?></div>
        <div class="stat-label">Total Masuk</div>
      </div>
    </div>
  </div>

  <!-- Charts Row -->
  <div class="row g-4 mb-4">
    <!-- Line Chart: Laporan per Bulan -->
    <div class="col-lg-8">
      <div class="cyber-card p-4 h-100">
        <div class="d-flex align-items-center mb-3">
          <i class="bi bi-graph-up-arrow me-2" style="color:var(--cyber-cyan);"></i>
          <span style="font-family:var(--font-display);font-size:0.8rem;color:var(--cyber-cyan);letter-spacing:1px;">LAPORAN PER BULAN</span>
        </div>
        <div style="height:280px;">
          <canvas id="laporanBulananChart"></canvas>
        </div>
      </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4">
      <div class="cyber-card p-4 h-100">
        <div class="d-flex align-items-center mb-3">
          <i class="bi bi-lightning-charge me-2" style="color:var(--cyber-amber);"></i>
          <span style="font-family:var(--font-display);font-size:0.8rem;color:var(--cyber-amber);letter-spacing:1px;">AKSI CEPAT</span>
        </div>
        <div class="d-flex flex-column gap-2">
          <a href="<?= base_url('laporan') ?>" class="btn btn-cyber w-100 text-start">
            <i class="bi bi-clipboard-data me-2"></i>Kelola Laporan
          </a>
          <a href="<?= base_url('berita') ?>" class="btn btn-cyber-green btn-cyber w-100 text-start">
            <i class="bi bi-pencil-square me-2"></i>Kelola Berita
          </a>
          <a href="<?= base_url('kegiatan') ?>" class="btn btn-cyber w-100 text-start" style="border-color:var(--cyber-purple);color:var(--cyber-purple);background:rgba(168,85,247,0.08);">
            <i class="bi bi-calendar-plus me-2"></i>Kelola Kegiatan
          </a>
          <a href="<?= base_url('laporan/cetak') ?>" class="btn btn-cyber-red btn-cyber w-100 text-start">
            <i class="bi bi-printer me-2"></i>Cetak Laporan
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bar Chart: Berita per Bulan -->
  <div class="row g-4">
    <div class="col-12">
      <div class="cyber-card p-4">
        <div class="d-flex align-items-center mb-3">
          <i class="bi bi-bar-chart-fill me-2" style="color:var(--cyber-green);"></i>
          <span style="font-family:var(--font-display);font-size:0.8rem;color:var(--cyber-green);letter-spacing:1px;">BERITA PER BULAN</span>
        </div>
        <div style="height:250px;">
          <canvas id="beritaBulananChart"></canvas>
        </div>
      </div>
    </div>
  </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Chart defaults for dark theme
  Chart.defaults.color = '#5a7a8a';
  Chart.defaults.borderColor = 'rgba(0,212,255,0.1)';

  // Laporan Chart
  const ctx = document.getElementById('laporanBulananChart').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?= json_encode($labels) ?>,
      datasets: [{
        label: 'Jumlah Laporan',
        data: <?= json_encode($jumlah) ?>,
        fill: true,
        backgroundColor: 'rgba(0,212,255,0.07)',
        borderColor: '#00d4ff',
        borderWidth: 2,
        tension: 0.4,
        pointRadius: 4,
        pointHoverRadius: 7,
        pointBackgroundColor: '#00d4ff',
        pointBorderColor: 'rgba(0,212,255,0.3)',
        pointBorderWidth: 3
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false },
        tooltip: {
          backgroundColor: 'rgba(13,31,45,0.95)',
          borderColor: 'rgba(0,212,255,0.4)',
          borderWidth: 1,
          titleColor: '#00d4ff',
          bodyColor: '#c8d8e8',
          callbacks: { label: ctx => ` ${ctx.raw} laporan` }
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          grid: { color: 'rgba(0,212,255,0.06)' },
          ticks: { precision: 0, stepSize: 1, color: '#5a7a8a' }
        },
        x: {
          grid: { color: 'rgba(0,212,255,0.06)' },
          ticks: { color: '#5a7a8a' }
        }
      }
    }
  });

  // Berita Chart
  const beritaCtx = document.getElementById('beritaBulananChart').getContext('2d');
  new Chart(beritaCtx, {
    type: 'bar',
    data: {
      labels: <?= json_encode($label_berita) ?>,
      datasets: [{
        label: 'Jumlah Berita',
        data: <?= json_encode($jumlah_berita) ?>,
        backgroundColor: 'rgba(0,255,136,0.15)',
        borderColor: '#00ff88',
        borderWidth: 1.5,
        borderRadius: 2
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false },
        tooltip: {
          backgroundColor: 'rgba(13,31,45,0.95)',
          borderColor: 'rgba(0,255,136,0.4)',
          borderWidth: 1,
          titleColor: '#00ff88',
          bodyColor: '#c8d8e8'
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          grid: { color: 'rgba(0,212,255,0.06)' },
          ticks: { precision: 0, color: '#5a7a8a' }
        },
        x: {
          grid: { color: 'rgba(0,212,255,0.06)' },
          ticks: { color: '#5a7a8a' }
        }
      }
    }
  });
</script>