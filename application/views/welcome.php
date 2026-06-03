<!-- Cyber Hero -->
<section class="cyber-hero position-relative" style="min-height:88vh;display:flex;align-items:center;">
  <!-- Animated grid overlay already in CSS via .cyber-hero::before -->
  
  <!-- Scanline effect -->
  <div style="position:absolute;top:0;left:0;right:0;bottom:0;background:linear-gradient(180deg,transparent 0,rgba(0,212,255,0.03) 50%,transparent 100%);background-size:100% 4px;pointer-events:none;z-index:2;animation:scanline 4s linear infinite;opacity:0.3;"></div>

  <div class="container position-relative" style="z-index:3;">
    <div class="row align-items-center g-5">
      <div class="col-lg-7">
        <div style="animation:slide-in-left 0.8s ease;">
          <div style="font-family:var(--font-mono);color:var(--cyber-green);font-size:0.8rem;letter-spacing:3px;margin-bottom:1rem;">
            <span style="animation:blink 1s step-end infinite;">&#9646;</span> SISTEM AKTIF &mdash; MUARA ENIM CISRT
          </div>
          <h1 class="hero-title">
            Tim Tanggap<br><span style="color:var(--cyber-cyan);text-shadow:var(--cyber-glow-c);">Insiden Siber</span><br>Kab. Muara Enim
          </h1>
          <p class="hero-subtitle">
            Melindungi infrastruktur digital pemerintah daerah dari ancaman siber. Laporkan insiden, pantau status, dan hubungi tim respons kami 24/7.
          </p>
          <div class="d-flex flex-wrap gap-3 mt-4">
            <button class="btn btn-cyber btn-lg" data-bs-toggle="modal" data-bs-target="#laporModal">
              <i class="bi bi-exclamation-triangle me-2"></i>Lapor Insiden
            </button>
            <button class="btn btn-cyber-outline btn-cyber btn-lg" data-bs-toggle="modal" data-bs-target="#cekResiModal">
              <i class="bi bi-search me-2"></i>Cek Status
            </button>
          </div>
        </div>
      </div>

      <div class="col-lg-5 text-center d-none d-lg-block">
        <div style="position:relative;display:inline-block;">

          <!-- SVG Hex Frame + Logo PNG Muara Enim -->
          <svg viewBox="0 0 300 360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
               style="width:300px;filter:drop-shadow(0 0 28px rgba(0,212,255,0.45));animation:pulse-glow 3s ease-in-out infinite;">
            <defs>
              <clipPath id="hexClip">
                <polygon points="150,16 274,82 274,268 150,334 26,268 26,82"/>
              </clipPath>
              <radialGradient id="emblemBg" cx="50%" cy="45%" r="55%">
                <stop offset="0%" stop-color="rgba(0,212,255,0.1)"/>
                <stop offset="100%" stop-color="rgba(0,0,0,0)"/>
              </radialGradient>
              <filter id="glow"><feGaussianBlur stdDeviation="2" result="b"/><feMerge><feMergeNode in="b"/><feMergeNode in="SourceGraphic"/></feMerge></filter>
            </defs>

            <!-- Background dalam hex -->
            <polygon points="150,16 274,82 274,268 150,334 26,268 26,82" fill="rgba(5,11,20,0.9)" clip-path="url(#hexClip)"/>
            <polygon points="150,16 274,82 274,268 150,334 26,268 26,82" fill="url(#emblemBg)" clip-path="url(#hexClip)"/>

            <!-- Border hex berlapis -->
            <polygon points="150,10 280,79 280,271 150,340 20,271 20,79" fill="none" stroke="rgba(0,212,255,0.65)" stroke-width="1.5" filter="url(#glow)"/>
            <polygon points="150,26 264,90 264,260 150,324 36,260 36,90" fill="none" stroke="rgba(0,212,255,0.2)" stroke-width="0.8"/>
            <polygon points="150,44 250,102 250,248 150,310 50,248 50,102" fill="none" stroke="rgba(0,212,255,0.08)" stroke-width="0.6" stroke-dasharray="5,8"/>

            <!-- Corner ticks -->
            <line x1="150" y1="10" x2="150" y2="24" stroke="#00d4ff" stroke-width="2.5" filter="url(#glow)"/>
            <line x1="280" y1="79" x2="267" y2="86" stroke="#00d4ff" stroke-width="2.5" filter="url(#glow)"/>
            <line x1="280" y1="271" x2="267" y2="264" stroke="#00d4ff" stroke-width="2.5" filter="url(#glow)"/>
            <line x1="150" y1="340" x2="150" y2="326" stroke="#00d4ff" stroke-width="2.5" filter="url(#glow)"/>
            <line x1="20" y1="271" x2="33" y2="264" stroke="#00d4ff" stroke-width="2.5" filter="url(#glow)"/>
            <line x1="20" y1="79" x2="33" y2="86" stroke="#00d4ff" stroke-width="2.5" filter="url(#glow)"/>

            <!-- Logo PNG di-clip ke dalam hex -->
            <image href="<?= base_url('assets/logo/muaraenim.png') ?>"
                   x="60" y="68" width="180" height="180"
                   clip-path="url(#hexClip)"
                   preserveAspectRatio="xMidYMid meet"/>

            <!-- Scan line accent kiri-kanan -->
            <line x1="20" y1="175" x2="34" y2="175" stroke="rgba(0,212,255,0.5)" stroke-width="1"/>
            <line x1="266" y1="175" x2="280" y2="175" stroke="rgba(0,212,255,0.5)" stroke-width="1"/>

            <!-- Teks bawah -->
            <line x1="60" y1="292" x2="116" y2="292" stroke="rgba(0,212,255,0.3)" stroke-width="0.5"/>
            <line x1="184" y1="292" x2="240" y2="292" stroke="rgba(0,212,255,0.3)" stroke-width="0.5"/>
            <text x="150" y="298" text-anchor="middle" font-family="'Orbitron',monospace" font-size="12" font-weight="700" fill="#00d4ff" letter-spacing="2" filter="url(#glow)">MUARA ENIM</text>
          </svg>

          <!-- Titik orbit berputar -->
          <div style="position:absolute;top:50%;left:50%;width:7px;height:7px;margin:-3px;background:var(--cyber-cyan);border-radius:50%;box-shadow:0 0 10px var(--cyber-cyan);animation:rotate-hex 7s linear infinite;transform-origin:-155px 0;"></div>
          <div style="position:absolute;top:50%;left:50%;width:5px;height:5px;margin:-2px;background:var(--cyber-green);border-radius:50%;box-shadow:0 0 8px var(--cyber-green);animation:rotate-hex 4.5s linear infinite reverse;transform-origin:157px 0;"></div>
        </div>
      </div>
    </div>

    <!-- Stats bar -->
    <div class="row g-3 mt-5">
      <div class="col-6 col-md-3">
        <div style="background:rgba(0,212,255,0.05);border:1px solid var(--cyber-border);border-left:3px solid var(--cyber-cyan);padding:1rem;border-radius:2px;text-align:center;">
          <div style="font-family:var(--font-display);font-size:1.6rem;color:var(--cyber-cyan);">24/7</div>
          <small style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:0.7rem;">MONITORING</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div style="background:rgba(0,255,136,0.05);border:1px solid var(--cyber-border2);border-left:3px solid var(--cyber-green);padding:1rem;border-radius:2px;text-align:center;">
          <div style="font-family:var(--font-display);font-size:1.6rem;color:var(--cyber-green);">&lt;2h</div>
          <small style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:0.7rem;">RESPONSE TIME</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div style="background:rgba(168,85,247,0.05);border:1px solid rgba(168,85,247,0.2);border-left:3px solid var(--cyber-purple);padding:1rem;border-radius:2px;text-align:center;">
          <div style="font-family:var(--font-display);font-size:1.6rem;color:var(--cyber-purple);">100%</div>
          <small style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:0.7rem;">CONFIDENTIAL</small>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div style="background:rgba(255,176,32,0.05);border:1px solid rgba(255,176,32,0.2);border-left:3px solid var(--cyber-amber);padding:1rem;border-radius:2px;text-align:center;">
          <div style="font-family:var(--font-display);font-size:1.6rem;color:var(--cyber-amber);">OPD+</div>
          <small style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:0.7rem;">INSTANSI TERLAYANI</small>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Layanan Section -->
<section class="py-5" style="background:var(--cyber-bg2);">
  <div class="container">
    <div class="text-center mb-5">
      <small style="color:var(--cyber-cyan);font-family:var(--font-mono);letter-spacing:3px;">// LAYANAN KAMI</small>
      <h2 style="font-family:var(--font-display);color:var(--cyber-text);margin-top:0.5rem;">Respons Cepat, Perlindungan Nyata</h2>
    </div>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="cyber-card h-100 p-4 text-center" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#laporModal">
          <div style="font-size:2.5rem;color:var(--cyber-red);margin-bottom:1rem;text-shadow:var(--cyber-glow-r);"><i class="bi bi-exclamation-octagon"></i></div>
          <div class="card-title">Lapor Insiden</div>
          <p class="card-text small mt-2">Laporkan insiden siber seperti website down, server error, konten ilegal, atau peretasan sistem.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="cyber-card h-100 p-4 text-center" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#cekResiModal">
          <div style="font-size:2.5rem;color:var(--cyber-cyan);margin-bottom:1rem;text-shadow:var(--cyber-glow-c);"><i class="bi bi-clipboard-pulse"></i></div>
          <div class="card-title">Pantau Status</div>
          <p class="card-text small mt-2">Masukkan kode resi untuk memantau status penanganan laporan Anda secara real-time.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="cyber-card h-100 p-4 text-center" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#kontakModal">
          <div style="font-size:2.5rem;color:var(--cyber-green);margin-bottom:1rem;text-shadow:var(--cyber-glow-g);"><i class="bi bi-headset"></i></div>
          <div class="card-title">Kontak Tim</div>
          <p class="card-text small mt-2">Hubungi langsung anggota Tim TTIS via WhatsApp untuk penanganan insiden darurat.</p>
        </div>
      </div>
    </div>
  </div>
</section>
