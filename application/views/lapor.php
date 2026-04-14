<!-- Laporan Hero -->
<section class="py-5" style="background:var(--cyber-bg2);border-bottom:1px solid var(--cyber-border);">
  <div class="container text-center py-3">
    <div class="mb-3" style="font-family:var(--font-mono);color:var(--cyber-green);font-size:0.8rem;letter-spacing:3px;">
      // PUSAT PENGADUAN INSIDEN SIBER
    </div>
    <h1 class="mb-3" style="font-family:var(--font-display);font-size:clamp(1.6rem,4vw,3rem);color:var(--cyber-text);">
      Laporkan <span style="color:var(--cyber-red);text-shadow:0 0 20px rgba(255,59,92,0.6);">Insiden</span> Siber
    </h1>
    <p class="mb-4" style="color:var(--cyber-text-dim);font-size:1.1rem;max-width:620px;margin:0 auto;">
      Temukan masalah seperti website down, server error, konten judi online, atau ancaman siber lainnya pada sistem pemerintah Kabupaten Muara Enim?
    </p>
    <div class="d-flex flex-wrap justify-content-center gap-3">
      <button class="btn btn-cyber btn-lg" style="background:var(--cyber-red);border-color:var(--cyber-red);color:#fff;" data-bs-toggle="modal" data-bs-target="#laporModal">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>Lapor Sekarang
      </button>
      <button class="btn btn-cyber btn-lg" data-bs-toggle="modal" data-bs-target="#cekResiModal">
        <i class="bi bi-search me-2"></i>Cek Status Laporan
      </button>
    </div>
  </div>
</section>

<!-- Info Cards -->
<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <!-- Jenis Laporan -->
      <div class="col-md-4 fade-in-up">
        <div class="cyber-card h-100">
          <div class="mb-3" style="font-size:2.5rem;color:var(--cyber-cyan);text-shadow:0 0 15px rgba(0,212,255,0.5);">
            <i class="bi bi-shield-exclamation"></i>
          </div>
          <h5 class="mb-3" style="font-family:var(--font-display);color:var(--cyber-cyan);font-size:1rem;letter-spacing:2px;">JENIS LAPORAN</h5>
          <ul class="list-unstyled mb-0" style="color:var(--cyber-text-dim);font-size:0.95rem;">
            <li class="mb-2"><i class="bi bi-chevron-right me-1" style="color:var(--cyber-green);"></i>Website tidak bisa diakses</li>
            <li class="mb-2"><i class="bi bi-chevron-right me-1" style="color:var(--cyber-green);"></i>Server down / error</li>
            <li class="mb-2"><i class="bi bi-chevron-right me-1" style="color:var(--cyber-green);"></i>Konten judi online / slot ilegal</li>
            <li class="mb-2"><i class="bi bi-chevron-right me-1" style="color:var(--cyber-green);"></i>Aplikasi tidak berfungsi</li>
            <li><i class="bi bi-chevron-right me-1" style="color:var(--cyber-green);"></i>Insiden siber lainnya</li>
          </ul>
        </div>
      </div>
      <!-- Waktu Respons -->
      <div class="col-md-4 fade-in-up" style="animation-delay:.1s;">
        <div class="cyber-card h-100">
          <div class="mb-3" style="font-size:2.5rem;color:var(--cyber-green);text-shadow:0 0 15px rgba(0,255,136,0.5);">
            <i class="bi bi-clock-history"></i>
          </div>
          <h5 class="mb-3" style="font-family:var(--font-display);color:var(--cyber-green);font-size:1rem;letter-spacing:2px;">WAKTU RESPONS</h5>
          <div class="mb-3" style="color:var(--cyber-text-dim);font-size:0.95rem;">
            Tim kami berkomitmen memberikan respons cepat pada setiap laporan yang masuk.
          </div>
          <div class="d-flex gap-3 text-center">
            <div class="flex-fill p-2" style="background:rgba(0,255,136,0.05);border:1px solid rgba(0,255,136,0.2);border-radius:8px;">
              <div style="font-family:var(--font-display);font-size:1.4rem;color:var(--cyber-green);">&lt;2j</div>
              <div style="font-size:0.75rem;color:var(--cyber-text-dim);">Respons Awal</div>
            </div>
            <div class="flex-fill p-2" style="background:rgba(0,255,136,0.05);border:1px solid rgba(0,255,136,0.2);border-radius:8px;">
              <div style="font-family:var(--font-display);font-size:1.4rem;color:var(--cyber-green);">24/7</div>
              <div style="font-size:0.75rem;color:var(--cyber-text-dim);">Siaga Aktif</div>
            </div>
          </div>
        </div>
      </div>
      <!-- Kerahasiaan -->
      <div class="col-md-4 fade-in-up" style="animation-delay:.2s;">
        <div class="cyber-card h-100">
          <div class="mb-3" style="font-size:2.5rem;color:var(--cyber-purple);text-shadow:0 0 15px rgba(168,85,247,0.5);">
            <i class="bi bi-lock-fill"></i>
          </div>
          <h5 class="mb-3" style="font-family:var(--font-display);color:var(--cyber-purple);font-size:1rem;letter-spacing:2px;">KERAHASIAAN</h5>
          <p style="color:var(--cyber-text-dim);font-size:0.95rem;margin-bottom:1rem;">
            Identitas pelapor dijamin kerahasiaannya. Anda dapat melaporkan insiden dengan aman tanpa khawatir informasi pribadi Anda tersebar.
          </p>
          <div class="d-flex align-items-center gap-2 p-2" style="background:rgba(168,85,247,0.05);border:1px solid rgba(168,85,247,0.2);border-radius:8px;">
            <i class="bi bi-shield-check" style="color:var(--cyber-purple);font-size:1.2rem;"></i>
            <span style="color:var(--cyber-text-dim);font-size:0.85rem;">Data dilindungi & terenkripsi</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
