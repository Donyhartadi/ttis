<!-- Admin Dashboard -->
<main class="container-fluid px-4 py-4">

  <!-- Header Bar -->
  <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
      <small style="color:var(--cyber-cyan);font-family:var(--font-mono);letter-spacing:2px;font-size:.72rem;">// CONTROL CENTER</small>
      <h4 class="glitch" data-text="Dashboard" style="font-family:var(--font-display);color:var(--cyber-text);margin:0;">Dashboard</h4>
    </div>
    <div class="d-flex align-items-center gap-3">
      <!-- Live clock (React) -->
      <span data-clock></span>
      <div style="font-family:var(--font-mono);font-size:.75rem;color:var(--cyber-text-dim);">
        <span class="status-dot online"></span>
        <i class="bi bi-person-circle me-1" style="color:var(--cyber-cyan);"></i>
        <?= htmlspecialchars($this->session->userdata('username')) ?>
      </div>
    </div>
  </div>

  <!-- Stat Cards (React animated counters) -->
  <div class="row g-3 mb-4">
    <div class="col-6 col-lg-3 scroll-reveal">
      <div class="stat-card stat-amber cyber-card-shine">
        <div style="font-size:1.8rem;color:var(--cyber-amber);margin-bottom:.5rem;"><i class="bi bi-hourglass-split"></i></div>
        <div class="stat-number">
          <span data-counter data-target="<?= (int)($total_menunggu ?? 0) ?>" data-color="var(--cyber-amber)"></span>
        </div>
        <div class="stat-label">Menunggu</div>
      </div>
    </div>
    <div class="col-6 col-lg-3 scroll-reveal">
      <div class="stat-card stat-cyan cyber-card-shine">
        <div style="font-size:1.8rem;color:var(--cyber-cyan);margin-bottom:.5rem;"><i class="bi bi-gear-wide-connected"></i></div>
        <div class="stat-number">
          <span data-counter data-target="<?= (int)($total_diproses ?? 0) ?>" data-color="var(--cyber-cyan)"></span>
        </div>
        <div class="stat-label">Diproses</div>
      </div>
    </div>
    <div class="col-6 col-lg-3 scroll-reveal">
      <div class="stat-card stat-green cyber-card-shine">
        <div style="font-size:1.8rem;color:var(--cyber-green);margin-bottom:.5rem;"><i class="bi bi-shield-check"></i></div>
        <div class="stat-number">
          <span data-counter data-target="<?= (int)($total_selesai ?? 0) ?>" data-color="var(--cyber-green)"></span>
        </div>
        <div class="stat-label">Selesai</div>
      </div>
    </div>
    <div class="col-6 col-lg-3 scroll-reveal">
      <?php $total_all = (int)($total_selesai ?? 0) + (int)($total_menunggu ?? 0) + (int)($total_diproses ?? 0); ?>
      <div class="stat-card stat-red cyber-card-shine">
        <div style="font-size:1.8rem;color:var(--cyber-red);margin-bottom:.5rem;"><i class="bi bi-inboxes"></i></div>
        <div class="stat-number">
          <span data-counter data-target="<?= $total_all ?>" data-color="var(--cyber-red)"></span>
        </div>
        <div class="stat-label">Total Masuk</div>
      </div>
    </div>
  </div>

  <!-- Charts Row -->
  <div class="row g-4 mb-4">
    <!-- Line Chart: Laporan per Bulan -->
    <div class="col-lg-8 scroll-reveal">
      <div class="cyber-card p-4 h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
          <div class="d-flex align-items-center">
            <i class="bi bi-graph-up-arrow me-2" style="color:var(--cyber-cyan);"></i>
            <span style="font-family:var(--font-display);font-size:.8rem;color:var(--cyber-cyan);letter-spacing:1px;">LAPORAN PER BULAN</span>
          </div>
          <div style="font-family:var(--font-mono);font-size:.68rem;color:var(--cyber-text-dim);">
            <?= date('Y') ?>
          </div>
        </div>
        <div style="height:280px;position:relative;">
          <canvas id="laporanBulananChart"></canvas>
        </div>
      </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4 scroll-reveal">
      <div class="cyber-card p-4 h-100">
        <div class="d-flex align-items-center mb-3">
          <i class="bi bi-lightning-charge me-2" style="color:var(--cyber-amber);"></i>
          <span style="font-family:var(--font-display);font-size:.8rem;color:var(--cyber-amber);letter-spacing:1px;">AKSI CEPAT</span>
        </div>
        <div class="d-flex flex-column gap-2">
          <a href="<?= base_url('laporan') ?>" class="btn btn-cyber w-100 text-start" style="letter-spacing:1px;">
            <i class="bi bi-clipboard-data me-2"></i>Kelola Laporan
          </a>
          <a href="<?= base_url('berita') ?>" class="btn btn-cyber-green btn-cyber w-100 text-start" style="letter-spacing:1px;">
            <i class="bi bi-pencil-square me-2"></i>Kelola Berita
          </a>
          <a href="<?= base_url('kegiatan') ?>" class="btn btn-cyber w-100 text-start" style="border-color:var(--cyber-purple);color:var(--cyber-purple);background:rgba(168,85,247,.08);letter-spacing:1px;">
            <i class="bi bi-calendar-plus me-2"></i>Kelola Kegiatan
          </a>
          <a href="<?= base_url('laporan/cetak') ?>" class="btn btn-cyber-red btn-cyber w-100 text-start" style="letter-spacing:1px;">
            <i class="bi bi-printer me-2"></i>Cetak Laporan
          </a>
        </div>

        <!-- Mini status summary -->
        <div class="mt-4 pt-3" style="border-top:1px solid var(--cyber-border);">
          <div style="font-family:var(--font-mono);font-size:.66rem;color:var(--cyber-text-dim);letter-spacing:1px;margin-bottom:.75rem;">STATUS LAPORAN</div>
          <?php
            $pct_selesai  = $total_all > 0 ? round(($total_selesai  ?? 0) / $total_all * 100) : 0;
            $pct_diproses = $total_all > 0 ? round(($total_diproses ?? 0) / $total_all * 100) : 0;
            $pct_menunggu = $total_all > 0 ? round(($total_menunggu ?? 0) / $total_all * 100) : 0;
          ?>
          <div class="mb-2">
            <div class="d-flex justify-content-between mb-1">
              <small style="color:var(--cyber-green);font-family:var(--font-mono);font-size:.68rem;">SELESAI</small>
              <small style="color:var(--cyber-green);font-family:var(--font-mono);font-size:.68rem;"><?= $pct_selesai ?>%</small>
            </div>
            <div class="cyber-progress"><div class="cyber-progress-bar" style="width:<?= $pct_selesai ?>%;background:var(--cyber-green);box-shadow:0 0 8px var(--cyber-green);"></div></div>
          </div>
          <div class="mb-2">
            <div class="d-flex justify-content-between mb-1">
              <small style="color:var(--cyber-cyan);font-family:var(--font-mono);font-size:.68rem;">DIPROSES</small>
              <small style="color:var(--cyber-cyan);font-family:var(--font-mono);font-size:.68rem;"><?= $pct_diproses ?>%</small>
            </div>
            <div class="cyber-progress"><div class="cyber-progress-bar" style="width:<?= $pct_diproses ?>%;"></div></div>
          </div>
          <div>
            <div class="d-flex justify-content-between mb-1">
              <small style="color:var(--cyber-amber);font-family:var(--font-mono);font-size:.68rem;">MENUNGGU</small>
              <small style="color:var(--cyber-amber);font-family:var(--font-mono);font-size:.68rem;"><?= $pct_menunggu ?>%</small>
            </div>
            <div class="cyber-progress"><div class="cyber-progress-bar" style="width:<?= $pct_menunggu ?>%;background:var(--cyber-amber);box-shadow:0 0 8px var(--cyber-amber);"></div></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bar Chart: Berita per Bulan -->
  <div class="row g-4 scroll-reveal">
    <div class="col-12">
      <div class="cyber-card p-4">
        <div class="d-flex align-items-center mb-3">
          <i class="bi bi-bar-chart-fill me-2" style="color:var(--cyber-green);"></i>
          <span style="font-family:var(--font-display);font-size:.8rem;color:var(--cyber-green);letter-spacing:1px;">BERITA TERBIT PER BULAN</span>
        </div>
        <div style="height:240px;">
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
  Chart.defaults.borderColor = 'rgba(0,212,255,0.07)';
  Chart.defaults.font.family = "'Rajdhani', sans-serif";

  // Animate chart in after short delay
  setTimeout(() => {
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
          backgroundColor: (ctx) => {
            const g = ctx.chart.ctx.createLinearGradient(0, 0, 0, 280);
            g.addColorStop(0, 'rgba(0,212,255,0.18)');
            g.addColorStop(1, 'rgba(0,212,255,0.01)');
            return g;
          },
          borderColor: '#00d4ff',
          borderWidth: 2.5,
          tension: 0.45,
          pointRadius: 5,
          pointHoverRadius: 8,
          pointBackgroundColor: '#050b14',
          pointBorderColor: '#00d4ff',
          pointBorderWidth: 2.5
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: { duration: 1200, easing: 'easeOutQuart' },
        plugins: {
          legend: { display: false },
          tooltip: {
            backgroundColor: 'rgba(8,15,28,0.97)',
            borderColor: 'rgba(0,212,255,0.4)',
            borderWidth: 1,
            titleColor: '#00d4ff',
            bodyColor: '#c8d8e8',
            padding: 12,
            callbacks: { label: c => `  ${c.raw} laporan` }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: { color: 'rgba(0,212,255,0.06)' },
            ticks: { precision: 0, stepSize: 1, color: '#5a7a8a', font: { size: 11 } }
          },
          x: {
            grid: { color: 'rgba(0,212,255,0.04)' },
            ticks: { color: '#5a7a8a', font: { size: 11 } }
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
          backgroundColor: (ctx) => {
            const g = ctx.chart.ctx.createLinearGradient(0, 0, 0, 240);
            g.addColorStop(0, 'rgba(0,255,136,0.3)');
            g.addColorStop(1, 'rgba(0,255,136,0.05)');
            return g;
          },
          borderColor: '#00ff88',
          borderWidth: 2,
          borderRadius: 3,
          borderSkipped: false
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: { duration: 1000, easing: 'easeOutQuart' },
        plugins: {
          legend: { display: false },
          tooltip: {
            backgroundColor: 'rgba(8,15,28,0.97)',
            borderColor: 'rgba(0,255,136,0.4)',
            borderWidth: 1,
            titleColor: '#00ff88',
            bodyColor: '#c8d8e8',
            padding: 12
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: { color: 'rgba(0,212,255,0.06)' },
            ticks: { precision: 0, color: '#5a7a8a', font: { size: 11 } }
          },
          x: {
            grid: { color: 'rgba(0,212,255,0.04)' },
            ticks: { color: '#5a7a8a', font: { size: 11 } }
          }
        }
      }
    });
  }, 200);
</script>
