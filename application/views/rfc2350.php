<?php
// Ambil dokumen RFC yang aktif dari data yang di-pass dari controller
$pdf_url = '';
$pdf_exists = false;

// Debug file
file_put_contents(FCPATH . 'rfc_debug_log.txt', "\n=== RFC2350 View Debug ===\n", FILE_APPEND);
file_put_contents(FCPATH . 'rfc_debug_log.txt', 'isset($rfc): ' . (isset($rfc) ? 'YES' : 'NO') . "\n", FILE_APPEND);
file_put_contents(FCPATH . 'rfc_debug_log.txt', 'empty($rfc): ' . (empty($rfc) ? 'YES' : 'NO') . "\n", FILE_APPEND);

// Gunakan variable rfc yang di-pass dari controller
if (!empty($rfc) && !empty($rfc->nama_file)) {
    $pdf_url = base_url('assets/files/rfc2350/' . urlencode($rfc->nama_file));
    $pdf_path = FCPATH . 'assets' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'rfc2350' . DIRECTORY_SEPARATOR . $rfc->nama_file;
    $pdf_exists = file_exists($pdf_path);
    file_put_contents(FCPATH . 'rfc_debug_log.txt', 'Using DB file: ' . $rfc->nama_file . "\n", FILE_APPEND);
} else {
    file_put_contents(FCPATH . 'rfc_debug_log.txt', 'Using fallback (DB file empty or not available)\n', FILE_APPEND);
}

// Fallback jika tidak ada file dari database atau $rfc kosong
if ((!$pdf_exists || empty($pdf_url)) && file_exists(FCPATH . 'assets' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'rfc2350.pdf')) {
    $pdf_url = base_url('assets/files/rfc2350.pdf');
    $pdf_exists = true;
    file_put_contents(FCPATH . 'rfc_debug_log.txt', 'Applied fallback to: rfc2350.pdf\n', FILE_APPEND);
}

// Sangat terakhir, kalau sama sekali tidak ada
if (empty($pdf_url)) {
    $pdf_exists = false;
}

file_put_contents(FCPATH . 'rfc_debug_log.txt', 'Final pdf_url: ' . $pdf_url . "\n", FILE_APPEND);
?>

<!-- Page Header -->
<div style="background:var(--cyber-bg2);border-bottom:1px solid var(--cyber-border);padding:1rem 0;">
  <div class="container px-lg-4">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">

      <!-- Breadcrumb + Title -->
      <div>
        <small style="font-family:var(--font-mono);font-size:.7rem;color:var(--cyber-text-dim);letter-spacing:1px;">
          <a href="<?= base_url() ?>" style="color:var(--cyber-text-dim);text-decoration:none;">Beranda</a>
          <span style="margin:0 .5rem;opacity:.4;">/</span>
          <span style="color:var(--cyber-cyan);">RFC 2350</span>
        </small>
        <div class="d-flex align-items-center gap-2 mt-1">
          <i class="bi bi-file-earmark-lock2-fill" style="color:var(--cyber-cyan);font-size:1.1rem;text-shadow:var(--cyber-glow-c);"></i>
          <h1 style="font-family:var(--font-display);font-size:clamp(.9rem,2vw,1.1rem);color:var(--cyber-cyan);letter-spacing:2px;margin:0;text-shadow:var(--cyber-glow-c);">
            <?= !empty($rfc) && !empty($rfc->judul) ? htmlspecialchars($rfc->judul) : 'RFC 2350 — MuaraEnimKab-CSIRT' ?>
          </h1>
        </div>
        <p style="font-family:var(--font-mono);font-size:.68rem;color:var(--cyber-text-dim);margin:.3rem 0 0;letter-spacing:1px;">
          <?php 
          $desc = !empty($rfc) && !empty($rfc->deskripsi) ? htmlspecialchars($rfc->deskripsi) : 'Deskripsi Tim Tanggap Insiden Siber Kabupaten Muara Enim';
          $versi = !empty($rfc) && !empty($rfc->versi) ? htmlspecialchars($rfc->versi) : '-';
          $tgl = !empty($rfc) && !empty($rfc->tanggal_publikasi) ? date('d F Y', strtotime($rfc->tanggal_publikasi)) : '-';
          echo $desc . ' &bull; Versi ' . $versi . ' &bull; ' . $tgl;
          ?>
        </p>
      </div>

      <!-- Actions (hanya tampil jika PDF ada) -->
      <?php if ($pdf_exists): ?>
      <div class="d-flex gap-2 align-items-center flex-wrap">
        <button id="btn-fullscreen" onclick="toggleFullscreen()"
                class="btn btn-cyber btn-sm"
                style="border-color:rgba(168,85,247,.5);color:var(--cyber-purple);"
                title="Layar penuh">
          <i class="bi bi-fullscreen" id="fs-icon"></i>
          <span class="d-none d-md-inline ms-1">Layar Penuh</span>
        </button>
        <a href="<?= $pdf_url ?>" download="<?= !empty($rfc) && !empty($rfc->nama_file) ? htmlspecialchars($rfc->nama_file) : 'RFC2350-MuaraEnimKab-CSIRT.pdf' ?>"
           class="btn btn-cyber btn-sm" style="border-color:rgba(0,255,136,.5);color:var(--cyber-green);">
          <i class="bi bi-download me-1"></i>
          <span class="d-none d-md-inline">Unduh PDF</span>
          <span class="d-md-none">Unduh</span>
        </a>
        <a href="<?= $pdf_url ?>" target="_blank" rel="noopener noreferrer"
           class="btn btn-cyber btn-sm" title="Buka di tab baru">
          <i class="bi bi-box-arrow-up-right me-1"></i>
          <span class="d-none d-md-inline">Tab Baru</span>
        </a>
      </div>
      <?php endif; ?>

    </div>
  </div>
</div>

<!-- Info strip -->
<div style="background:rgba(0,212,255,.04);border-bottom:1px solid var(--cyber-border);padding:.35rem 1.5rem;display:flex;align-items:center;gap:1.5rem;flex-wrap:wrap;">
  <span style="font-family:var(--font-mono);font-size:.65rem;color:var(--cyber-text-dim);letter-spacing:1px;">
    <span class="status-dot <?= $pdf_exists ? 'online' : 'offline' ?>" style="width:6px;height:6px;"></span>
    <?= $pdf_exists ? 'DOKUMEN PUBLIK' : 'DOKUMEN BELUM TERSEDIA' ?>
  </span>
  <span style="font-family:var(--font-mono);font-size:.65rem;color:var(--cyber-text-dim);">
    <i class="bi bi-building me-1" style="color:var(--cyber-cyan);"></i>Diskominfo Kab. Muara Enim
  </span>
  <span style="font-family:var(--font-mono);font-size:.65rem;color:var(--cyber-text-dim);">
    <i class="bi bi-shield-check me-1" style="color:var(--cyber-green);"></i>Ditanda-tangani PGP
  </span>
  <span style="font-family:var(--font-mono);font-size:.65rem;color:var(--cyber-text-dim);">
    <i class="bi bi-globe me-1" style="color:var(--cyber-cyan);"></i>GMT+07:00
  </span>
</div>

<?php if ($pdf_exists): ?>
<!-- ====================== PDF VIEWER ====================== -->
<div id="pdf-container" style="flex:1;display:flex;flex-direction:column;background:#525659;min-height:82vh;">

  <!-- Loading spinner -->
  <div id="pdf-loading"
       style="position:fixed;inset:0;top:auto;z-index:5;
              display:flex;align-items:center;justify-content:center;
              background:rgba(5,11,20,.85);backdrop-filter:blur(4px);
              padding:2rem;pointer-events:none;">
    <div style="text-align:center;">
      <div class="spinner-cyber" style="width:28px;height:28px;border-width:3px;margin:0 auto 1rem;"></div>
      <p style="font-family:var(--font-mono);font-size:.72rem;color:var(--cyber-text-dim);margin:0;letter-spacing:1px;">[ MEMUAT DOKUMEN... ]</p>
    </div>
  </div>

  <iframe id="pdf-iframe"
          src="<?= $pdf_url ?>"
          style="width:100%;flex:1;border:none;min-height:82vh;display:block;"
          title="RFC 2350 MuaraEnimKab-CSIRT"
          onload="hidePdfLoading()">
  </iframe>

</div>

<script>
function hidePdfLoading() {
  var el = document.getElementById('pdf-loading');
  if (el) el.style.display = 'none';
}

// Fallback: sembunyikan loading setelah 3 detik
setTimeout(function() {
  var el = document.getElementById('pdf-loading');
  if (el) el.style.display = 'none';
}, 3000);

/* ===== Fullscreen ===== */
function toggleFullscreen() {
  var container = document.getElementById('pdf-container');
  var icon = document.getElementById('fs-icon');

  if (!document.fullscreenElement) {
    container.requestFullscreen().catch(function() {});
    icon.className = 'bi bi-fullscreen-exit';
    document.getElementById('pdf-iframe').style.minHeight = '100vh';
  } else {
    document.exitFullscreen().catch(function() {});
    icon.className = 'bi bi-fullscreen';
    document.getElementById('pdf-iframe').style.minHeight = '82vh';
  }
}

document.addEventListener('fullscreenchange', function() {
  if (!document.fullscreenElement) {
    var icon = document.getElementById('fs-icon');
    if (icon) icon.className = 'bi bi-fullscreen';
    var iframe = document.getElementById('pdf-iframe');
    if (iframe) iframe.style.minHeight = '82vh';
  }
});
</script>

<?php else: ?>
<!-- ====================== FILE BELUM ADA ====================== -->
<div style="flex:1;display:flex;align-items:center;justify-content:center;padding:4rem 1rem;min-height:60vh;">
  <div class="cyber-card p-4 p-md-5 text-center scroll-reveal" style="max-width:520px;width:100%;">

    <!-- Icon -->
    <div style="font-size:4rem;color:var(--cyber-amber);margin-bottom:1.5rem;text-shadow:0 0 20px rgba(255,176,32,.4);">
      <i class="bi bi-file-earmark-pdf"></i>
    </div>

    <h5 style="font-family:var(--font-display);color:var(--cyber-amber);letter-spacing:2px;margin-bottom:.75rem;font-size:.9rem;">
      DOKUMEN BELUM TERSEDIA
    </h5>
    <p style="color:var(--cyber-text-dim);font-size:.88rem;line-height:1.7;margin-bottom:2rem;">
      File PDF <span style="color:var(--cyber-cyan);font-family:var(--font-mono);">rfc2350.pdf</span> belum diunggah ke server.
      Silakan taruh file PDF di lokasi berikut:
    </p>

    <!-- Path box -->
    <div style="background:rgba(0,0,0,.4);border:1px solid var(--cyber-border);border-left:3px solid var(--cyber-cyan);
                border-radius:3px;padding:.75rem 1rem;margin-bottom:2rem;text-align:left;">
      <div style="font-family:var(--font-mono);font-size:.68rem;color:var(--cyber-text-dim);letter-spacing:1px;margin-bottom:.3rem;">LOKASI FILE</div>
      <code style="font-family:var(--font-mono);font-size:.8rem;color:var(--cyber-cyan);word-break:break-all;">
        <?= str_replace('/', DIRECTORY_SEPARATOR, FCPATH . 'assets/files/rfc2350.pdf') ?>
      </code>
    </div>

    <!-- Steps -->
    <div style="text-align:left;margin-bottom:2rem;">
      <div style="font-family:var(--font-mono);font-size:.65rem;color:var(--cyber-text-dim);letter-spacing:2px;margin-bottom:.75rem;">LANGKAH-LANGKAH</div>
      <?php foreach ([
        ['bi-1-circle', 'Buka folder <code style="color:var(--cyber-cyan)">assets/files/</code> di direktori TTIS'],
        ['bi-2-circle', 'Taruh file PDF dengan nama persis <code style="color:var(--cyber-cyan)">rfc2350.pdf</code>'],
        ['bi-3-circle', 'Refresh halaman ini — dokumen akan tampil otomatis'],
      ] as $step): ?>
      <div style="display:flex;align-items:flex-start;gap:.75rem;margin-bottom:.6rem;">
        <i class="bi <?= $step[0] ?>" style="color:var(--cyber-cyan);flex-shrink:0;margin-top:.1rem;"></i>
        <span style="color:var(--cyber-text);font-size:.85rem;line-height:1.5;"><?= $step[1] ?></span>
      </div>
      <?php endforeach; ?>
    </div>

    <a href="<?= base_url() ?>" class="btn btn-cyber btn-sm">
      <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
    </a>
  </div>
</div>
<?php endif; ?>
