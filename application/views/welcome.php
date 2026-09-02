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
            <button class="btn btn-cyber-outline btn-cyber btn-lg" data-bs-toggle="modal" data-bs-target="#kontakModal">
              <i class="bi bi-headset me-2"></i>Kontak Tim
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
    <div class="row g-3 mt-4">
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

<!-- Cara Melapor Section -->
<section class="py-4" style="background:var(--cyber-bg2);">
  <div class="container">
    <div class="text-center mb-4 scroll-reveal">
      <small style="color:var(--cyber-cyan);font-family:var(--font-mono);letter-spacing:3px;">// PANDUAN PELAPORAN</small>
      <h2 style="font-family:var(--font-display);color:var(--cyber-text);margin-top:0.5rem;font-size:1.5rem;">Cara Melapor Insiden</h2>
      <div class="cyber-divider mx-auto" style="margin-top:.6rem;"></div>
    </div>

    <div class="row g-4 justify-content-center">
      <div class="col-6 col-md-3 text-center scroll-reveal cyber-step-wrap">
        <div class="cyber-step-num">01</div>
        <h6 style="font-family:var(--font-display);font-size:.76rem;color:var(--cyber-cyan);letter-spacing:2px;margin-bottom:.6rem;">IDENTIFIKASI</h6>
        <p style="color:var(--cyber-text-dim);font-size:.87rem;line-height:1.65;margin:0;">Identifikasi jenis insiden — website, server, email, aplikasi, atau konten berbahaya.</p>
      </div>
      <div class="col-6 col-md-3 text-center scroll-reveal cyber-step-wrap">
        <div class="cyber-step-num">02</div>
        <h6 style="font-family:var(--font-display);font-size:.76rem;color:var(--cyber-cyan);letter-spacing:2px;margin-bottom:.6rem;">DOKUMENTASI</h6>
        <p style="color:var(--cyber-text-dim);font-size:.87rem;line-height:1.65;margin:0;">Ambil screenshot atau rekam bukti kejadian sebagai eviden yang akan dilampirkan.</p>
      </div>
      <div class="col-6 col-md-3 text-center scroll-reveal cyber-step-wrap">
        <div class="cyber-step-num">03</div>
        <h6 style="font-family:var(--font-display);font-size:.76rem;color:var(--cyber-cyan);letter-spacing:2px;margin-bottom:.6rem;">LAPORAN</h6>
        <p style="color:var(--cyber-text-dim);font-size:.87rem;line-height:1.65;margin:0;">Isi formulir laporan melalui Lapor Insiden dan unggah eviden yang telah disiapkan.</p>
      </div>
      <div class="col-6 col-md-3 text-center scroll-reveal cyber-step-wrap">
        <div class="cyber-step-num green">04</div>
        <h6 style="font-family:var(--font-display);font-size:.76rem;color:var(--cyber-green);letter-spacing:2px;margin-bottom:.6rem;">PANTAU</h6>
        <p style="color:var(--cyber-text-dim);font-size:.87rem;line-height:1.65;margin:0;">Simpan kode resi dan pantau status penanganan laporan Anda secara real-time.</p>
      </div>
    </div>
  </div>
</section>

<!-- Informasi Terkini -->
<section class="home-updates py-4">
  <div class="container">
    <div class="updates-heading scroll-reveal">
      <div>
        <small>// PUSAT INFORMASI</small>
        <h2>Berita dan Dokumen</h2>
      </div>
      <a href="<?= base_url('berita') ?>" class="updates-all-link">Lihat semua berita <i class="bi bi-arrow-up-right"></i></a>
    </div>

    <div class="row g-4 align-items-stretch">
      <div class="col-lg-7 scroll-reveal">
        <?php if(!empty($berita)): ?>
        <div id="beritaCarousel" class="carousel slide news-carousel" data-bs-ride="carousel" data-bs-interval="6000">
          <div class="carousel-inner">
            <?php foreach($berita as $key => $item): ?>
            <div class="carousel-item <?php echo ($key === 0) ? 'active' : ''; ?>">
              <a class="news-slide" href="<?= base_url('welcome/detail/'.$item->slug) ?>" aria-label="Baca berita: <?= htmlspecialchars($item->judul) ?>">
                <?php if(!empty($item->gambar)): ?>
                <img src="<?= base_url('assets/uploads/berita/'.$item->gambar) ?>" alt="<?= htmlspecialchars($item->judul) ?>">
                <?php else: ?>
                <div class="news-slide-placeholder"><i class="bi bi-newspaper"></i></div>
                <?php endif; ?>
                <div class="news-overlay-copy">
                  <div class="news-meta"><span><?= htmlspecialchars($item->kategori) ?></span><time><?= date('d.m.Y', strtotime($item->tanggal)) ?></time></div>
                  <h3 class="news-overlay-title"><?= htmlspecialchars($item->judul) ?></h3>
                  <p class="news-summary"><?= htmlspecialchars(character_limiter(strip_tags($item->ringkasan ?: $item->isi), 145)) ?></p>
                </div>
              </a>
            </div>
            <?php endforeach; ?>
          </div>
          <button class="carousel-control-prev news-carousel-control" type="button" data-bs-target="#beritaCarousel" data-bs-slide="prev" aria-label="Berita sebelumnya"><i class="bi bi-arrow-left"></i></button>
          <button class="carousel-control-next news-carousel-control" type="button" data-bs-target="#beritaCarousel" data-bs-slide="next" aria-label="Berita berikutnya"><i class="bi bi-arrow-right"></i></button>
          <?php if(count($berita) > 1): ?>
          <div class="carousel-indicators news-carousel-indicators">
            <?php foreach($berita as $key => $item): ?>
            <button type="button" data-bs-target="#beritaCarousel" data-bs-slide-to="<?= $key ?>" class="<?php echo ($key === 0) ? 'active' : ''; ?>" aria-current="<?php echo ($key === 0) ? 'true' : 'false'; ?>" aria-label="Berita <?= $key + 1 ?>"></button>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
        <?php else: ?>
        <div class="updates-empty"><i class="bi bi-newspaper"></i><span>Belum ada berita yang dipublikasikan.</span></div>
        <?php endif; ?>
      </div>

      <aside class="col-lg-5 scroll-reveal">
        <div class="document-panel h-100">
          <div class="document-panel-header"><span><i class="bi bi-folder2-open"></i> Dokumen PDF</span><i class="bi bi-file-earmark-pdf"></i></div>
          <?php if(!empty($dokumen)): ?>
          <div class="document-list">
            <?php foreach($dokumen as $item): ?>
            <a class="document-item" href="<?= base_url('assets/uploads/kontak/'.$item->nama_file) ?>" target="_blank" rel="noopener noreferrer">
              <span class="document-file-icon"><i class="bi bi-file-earmark-pdf"></i></span>
              <span class="document-copy"><strong><?= htmlspecialchars($item->judul) ?></strong><small><?= date('d M Y', strtotime($item->tanggal_upload)) ?></small></span>
              <i class="bi bi-download document-download"></i>
            </a>
            <?php endforeach; ?>
          </div>
          <?php else: ?>
          <div class="updates-empty"><i class="bi bi-file-earmark-x"></i><span>Belum ada dokumen tersedia.</span></div>
          <?php endif; ?>
        </div>
      </aside>
    </div>
  </div>
</section>
