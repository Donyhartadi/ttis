<body class="d-flex flex-column min-vh-100 cyber-grid-bg">

<!-- Cyber Navbar -->
<nav class="cyber-navbar navbar navbar-expand-lg">
  <div class="container px-lg-4">
    <a class="navbar-brand" href="<?= base_url(); ?>">
      <div class="brand-icon">
        <i class="bi bi-shield-lock-fill" style="color:var(--cyber-cyan);font-size:1.1rem;"></i>
      </div>
      <span>TTIS</span>
      <small style="font-size:0.55rem;letter-spacing:1px;color:var(--cyber-text-dim);font-family:var(--font-mono);margin-left:4px;align-self:flex-end;padding-bottom:2px;">KAB. MUARA ENIM</small>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarMain" aria-controls="navbarMain"
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMain">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-1">
        <li class="nav-item">
          <a class="nav-link <?= ($this->uri->segment(1)=='' && $this->uri->segment(2)=='') ? 'active' : '' ?>" href="<?= base_url(); ?>"><i class="bi bi-house-door me-1"></i>Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $this->uri->segment(2)=='berita' ? 'active' : '' ?>" href="<?= base_url('welcome/berita'); ?>"><i class="bi bi-newspaper me-1"></i>Berita</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $this->uri->segment(2)=='kegiatan' ? 'active' : '' ?>" href="<?= base_url('welcome/kegiatan'); ?>"><i class="bi bi-calendar-event me-1"></i>Kegiatan</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="laporDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-grid me-1"></i>Layanan
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="laporDropdown">
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#laporModal"><i class="bi bi-exclamation-triangle me-2"></i>Lapor Insiden</a></li>
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#cekResiModal"><i class="bi bi-search me-2"></i>Cek Resi</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#kontakModal"><i class="bi bi-headset me-1"></i>Kontak</a>
        </li>
        <li class="nav-item ms-lg-2">
          <a class="btn btn-cyber btn-sm px-3" href="<?= base_url('auth'); ?>"><i class="bi bi-lock me-1"></i>Login</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Modal Cek Resi -->
<div class="modal fade" id="cekResiModal" tabindex="-1" aria-labelledby="cekResiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content cyber-modal">
    <form id="formCekResi" method="post" action="<?= base_url('laporan/cek_resi') ?>">
        <div class="modal-header cyber-modal-header">
          <h5 class="modal-title"><i class="bi bi-search me-2" style="color:var(--cyber-cyan)"></i>Cek Status Laporan</h5>
          <button type="button" class="btn-close btn-close-cyber" data-bs-dismiss="modal" aria-label="Tutup"></button>
          <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
         value="<?= $this->security->get_csrf_hash(); ?>">
        </div>
        
        <div class="modal-body cyber-modal-body">
          <input type="text" name="kode_resi" class="form-control cyber-input form-control-lg mb-3" placeholder="Masukkan Kode Resi Anda..." required>
          <div id="hasilResi"></div>
          <?php if (isset($hasil)): ?>
<?php if ($hasil): ?>
  <div class="alert alert-success">
    <strong>📌 Kode Resi:</strong> <?= $hasil['kode_resi'] ?><br>
    <strong>👤 Nama Pelapor:</strong> <?= $hasil['nama_pelapor'] ?><br>
    <strong>📝 Jenis Laporan:</strong> <?= $hasil['judul_laporan'] ?><br>
    <strong>⏰ Tanggal Lapor:</strong> <?= date('d-m-Y H:i', strtotime($hasil['waktu_laporan'])) ?><br>
    <strong>📊 Status:</strong>
    <?php
      $status = strtolower($hasil['status']);
      $badgeClass = match ($status) {
        'menunggu' => 'bg-warning text-dark',
        'diproses' => 'bg-primary',
        'selesai'  => 'bg-success',
        default    => 'bg-secondary'
      };
    ?>
<span class="badge <?= $badgeClass ?>"><?= ucfirst($status) ?></span><br>
<small class="text-muted d-block mt-1">
<?php
  echo match ($status) {
    'menunggu' => '⏳ Laporan Anda sedang menunggu diproses.',
    'diproses' => '🔧 Laporan sedang dalam penanganan oleh tim kami.',
    'selesai' => '✅ Terima kasih telah melaporkan. Insiden telah ditindaklanjuti.',
    default => 'Status tidak dikenali.'
  };
?>
</small>

  </div>
<?php else: ?>
  <div class="alert alert-danger">
    <i class="bi bi-x-circle-fill me-2"></i>Kode resi tidak ditemukan. Periksa kembali atau hubungi admin.
  </div>
<?php endif; ?>
<?php endif; ?>

        </div>
        <div class="modal-footer cyber-modal-footer">
          <button type="submit" class="btn btn-cyber w-100">
            <i class="bi bi-search me-1"></i> Cek Resi
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal: Kontak WhatsApp -->
<div class="modal fade" id="kontakModal" tabindex="-1" aria-labelledby="kontakModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content cyber-modal">
      <div class="modal-header cyber-modal-header">
        <h5 class="modal-title"><i class="bi bi-headset me-2" style="color:var(--cyber-green)"></i>Kontak Tim TTIS</h5>
        <button type="button" class="btn-close btn-close-cyber" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body cyber-modal-body p-0">
        <div class="cyber-contact-item d-flex justify-content-between align-items-center px-4 py-3">
          <div>
            <div style="color:var(--cyber-cyan);font-family:var(--font-mono);font-size:0.75rem;">OPERATOR_01</div>
            <div style="color:var(--cyber-text);font-weight:600;">Septa Putra Anggara</div>
          </div>
          <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer" class="btn btn-cyber-green btn-cyber btn-sm">
            <i class="bi bi-whatsapp me-1"></i>Chat
          </a>
        </div>
        <div class="cyber-contact-item d-flex justify-content-between align-items-center px-4 py-3">
          <div>
            <div style="color:var(--cyber-cyan);font-family:var(--font-mono);font-size:0.75rem;">OPERATOR_02</div>
            <div style="color:var(--cyber-text);font-weight:600;">Ruslim Anwar</div>
          </div>
          <a href="https://wa.me/6282234567890" target="_blank" rel="noopener noreferrer" class="btn btn-cyber-green btn-cyber btn-sm">
            <i class="bi bi-whatsapp me-1"></i>Chat
          </a>
        </div>
        <div class="cyber-contact-item d-flex justify-content-between align-items-center px-4 py-3">
          <div>
            <div style="color:var(--cyber-cyan);font-family:var(--font-mono);font-size:0.75rem;">OPERATOR_03</div>
            <div style="color:var(--cyber-text);font-weight:600;">Dony Hartadi</div>
          </div>
          <a href="https://wa.me/6283234567890" target="_blank" rel="noopener noreferrer" class="btn btn-cyber-green btn-cyber btn-sm">
            <i class="bi bi-whatsapp me-1"></i>Chat
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal: Lapor Insiden -->
<div class="modal fade" id="laporModal" tabindex="-1" aria-labelledby="laporModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content cyber-modal">
      <form method="post" action="<?= base_url('laporan/simpan') ?>" enctype="multipart/form-data">
      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
         value="<?= $this->security->get_csrf_hash(); ?>">
        <div class="modal-header cyber-modal-header">
          <h5 class="modal-title"><i class="bi bi-exclamation-triangle me-2" style="color:var(--cyber-red)"></i>Lapor Insiden Siber</h5>
          <button type="button" class="btn-close btn-close-cyber" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body cyber-modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="cyber-label">Nama Pelapor</label>
              <input type="text" class="form-control cyber-input" name="nama_pelapor" placeholder="Nama OPD / Nama Pribadi" required>
            </div>
            <div class="col-md-6">
              <label class="cyber-label">Kontak WhatsApp</label>
              <input type="number" class="form-control cyber-input" name="no_hp" placeholder="08xxxxxxxxxx" required>
            </div>
            <div class="col-md-6">
              <label class="cyber-label">Jenis Laporan</label>
              <select class="form-select cyber-input" name="judul_laporan" required>
                <option value="" disabled selected hidden>Pilih Jenis Laporan</option>
                <option value="Website tidak bisa diakses">Website tidak bisa diakses</option>
                <option value="Server down">Server down</option>
                <option value="Email tidak terkirim">Email tidak terkirim</option>
                <option value="Aplikasi error">Aplikasi error</option>
                <option value="Slot Ilegal / Judi Online">Slot Ilegal / Judi Online</option>
                <option value="Lainnya">Lainnya</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="cyber-label">URL / Link Terkait</label>
              <input type="text" class="form-control cyber-input" name="link" placeholder="https://..." required>
            </div>
            <div class="col-12">
              <label class="cyber-label">Deskripsi Insiden</label>
              <textarea class="form-control cyber-input" name="deskripsi" rows="3" placeholder="Jelaskan insiden secara singkat..." required></textarea>
            </div>
            <div class="col-12">
              <label class="cyber-label">Unggah Eviden <small style="color:var(--cyber-text-dim)">(JPG/PNG/PDF)</small></label>
              <input type="file" class="form-control cyber-input" name="eviden" accept=".jpg,.png,.pdf" required>
            </div>
            <div class="col-12 text-center">
              <div class="g-recaptcha d-inline-block" data-sitekey="6LcCUoMrAAAAAAambAuMAy2Vsh8gItXl3yqJVHhA"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer cyber-modal-footer">
          <button type="button" class="btn btn-cyber-red btn-cyber" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-cyber"><i class="bi bi-send me-1"></i>Kirim Laporan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal: Sukses Kirim -->
<div class="modal fade" id="suksesModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content cyber-modal text-center">
      <div class="modal-header cyber-modal-header justify-content-center border-0">
        <div style="font-size:3rem;color:var(--cyber-green);text-shadow:var(--cyber-glow-g);">
          <i class="bi bi-shield-check"></i>
        </div>
      </div>
      <div class="modal-body cyber-modal-body">
        <h5 style="color:var(--cyber-green);font-family:var(--font-display);">LAPORAN DITERIMA</h5>
        <p style="color:var(--cyber-text);">Terima kasih, insiden Anda telah berhasil dilaporkan dan sedang diproses oleh tim kami.</p>
        <div style="background:rgba(0,255,136,0.05);border:1px solid var(--cyber-border2);padding:1rem;border-radius:4px;margin-top:1rem;">
          <small style="color:var(--cyber-text-dim);font-family:var(--font-mono);">KODE RESI</small>
          <div style="color:var(--cyber-green);font-family:var(--font-display);font-size:1.3rem;letter-spacing:3px;">
            <?= $this->session->flashdata('kode_resi') ?: '—'; ?>
          </div>
        </div>
      </div>
      <div class="modal-footer cyber-modal-footer justify-content-center">
        <button type="button" class="btn btn-cyber-green btn-cyber" data-bs-dismiss="modal">Oke, Mengerti</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal: Sukses Absen -->
<div class="modal fade" id="suksesAbsen" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content cyber-modal text-center">
      <div class="modal-body cyber-modal-body">
        <div style="font-size:3rem;color:var(--cyber-cyan);text-shadow:var(--cyber-glow-c);margin-bottom:1rem;">
          <i class="bi bi-person-check"></i>
        </div>
        <h5 style="color:var(--cyber-cyan);font-family:var(--font-display);">ABSEN BERHASIL</h5>
        <p style="color:var(--cyber-text);">Anda telah mengisi absen. Terima kasih telah hadir!</p>
      </div>
      <div class="modal-footer cyber-modal-footer justify-content-center">
        <button type="button" class="btn btn-cyber" data-bs-dismiss="modal">Oke</button>
      </div>
    </div>
  </div>
</div>