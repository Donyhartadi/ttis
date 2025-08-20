<!-- Main Content -->
<main class="container my-5">
  <div class="p-5 bg-white shadow rounded-4">
    <!-- Selamat Datang -->
    <p class="text-muted mb-4">Halo <strong><?= $this->session->userdata('username'); ?></strong>, selamat datang di sistem manajemen insiden siber.</p>


    <!-- Grafik & Status -->
    <div class="row mt-5 align-items-stretch g-4">
      <!-- Chart -->
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 h-100">
          <div class="card-body">
            <h5 class="fw-semibold text-center mb-3">
              <i class="bi bi-bar-chart-line-fill me-1"></i> Grafik Laporan per Bulan
            </h5>
            <div style="height: 300px;">
              <canvas id="laporanBulananChart"></canvas>
            </div>
          </div>
        </div>
      </div>




      <!-- Status Card -->
      <div class="col-lg-4">
        <div class="row g-4">
          <!-- Belum Diproses -->
          <div class="col-12">
            <div class="card shadow-sm border-0 bg-warning-subtle text-dark rounded-4 h-100">
              <div class="card-body text-center">
                <i class="bi bi-hourglass-split display-6 text-warning"></i>
                <h5 class="mt-2 fw-bold"><?= $total_menunggu ?? 0 ?></h5>
                <p class="mb-0 small">Belum Diproses</p>
              </div>
            </div>
          </div>

          <!-- Sudah Diproses -->
          <div class="col-12">
            <div class="card shadow-sm border-0 bg-primary-subtle text-dark rounded-4 h-100">
              <div class="card-body text-center">
                <i class="bi bi-check-circle-fill display-6 text-success"></i>
                <h5 class="mt-2 fw-bold"><?= $total_diproses ?? 0 ?></h5>
                <p class="mb-0 small">Sedang Diproses</p>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card shadow-sm border-0 bg-success-subtle text-dark rounded-4 h-100">
              <div class="card-body text-center">
                <i class="bi bi-check-circle-fill display-6 text-success"></i>
                <h5 class="mt-2 fw-bold"><?= $total_selesai ?? 0 ?></h5>
                <p class="mb-0 small">Selesai ditangani</p>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="card shadow-sm border-0 bg-dark-subtle text-dark rounded-4 h-100">
              <div class="card-body text-center">
                <i class="bi bi-check-circle-fill display-6 text-success"></i>
                <h5 class="mt-2 fw-bold"><?= $total_selesai+$total_menunggu+$total_diproses ?? 0 ?></h5>
                <p class="mb-0 small">Total masuk</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Grafik Jumlah Berita -->
<div class="mt-5">
  <div class="card border-0 shadow-sm rounded-4">
    <div class="card-body">
      <h5 class="fw-semibold text-center mb-3">
        <i class="bi bi-bar-chart-fill me-1"></i> Grafik Jumlah Berita per Bulan
      </h5>
      <div style="height: 300px;">
        <canvas id="beritaBulananChart"></canvas>
      </div>
    </div>
  </div>
</div>


  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('laporanBulananChart').getContext('2d');
  const laporanBulananChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?= json_encode($labels) ?>,
      datasets: [{
        label: 'Jumlah Laporan',
        data: <?= json_encode($jumlah) ?>,
        fill: true,
        backgroundColor: 'rgba(13, 110, 253, 0.1)',
        borderColor: 'rgba(13, 110, 253, 1)',
        borderWidth: 2,
        tension: 0.4,
        pointRadius: 4,
        pointHoverRadius: 6,
        pointBackgroundColor: 'rgba(13, 110, 253, 1)'
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: true },
        tooltip: {
          callbacks: {
            label: context => ` ${context.raw} laporan`
          }
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            precision: 0,
            stepSize: 1
          },
          title: {
            display: true,
            text: 'Jumlah Laporan',
            color: '#6c757d'
          }
        },
        x: {
          title: {
            display: true,
            text: 'Bulan',
            color: '#6c757d'
          }
        }
      }
    }
  });
</script>

<script>
    const beritaCtx = document.getElementById('beritaBulananChart').getContext('2d');

    const chartBerita = new Chart(beritaCtx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($label_berita) ?>,
            datasets: [{
                label: 'Jumlah Berita per Bulan',
                data: <?= json_encode($jumlah_berita) ?>,
                backgroundColor: 'rgba(59, 130, 246, 0.6)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });
</script>


