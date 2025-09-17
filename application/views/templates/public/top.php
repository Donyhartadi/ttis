<body class="d-flex flex-column min-vh-100">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container px-lg-5">
    <a class="navbar-brand d-flex align-items-center" href="<?= base_url(); ?>">
      <img src="<?= base_url('assets/logo/diskominfo.png') ?>" alt="Logo" width="40" height="40" class="me-2" />
      <strong>TTIS</strong>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= $this->uri->segment(1) == 'auth' ? 'active' : '' ?>" href="<?= base_url('auth'); ?>">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $this->uri->segment(2) == 'berita' ? 'active' : '' ?>" href="<?= base_url('welcome/berita'); ?>">Berita</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $this->uri->segment(2) == 'kegiatan' ? 'active' : '' ?>" href="<?= base_url('welcome/kegiatan'); ?>">Kegiatan</a>
        </li>
        <!-- Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="laporDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Layanan
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="laporDropdown">
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#laporModal">Lapor</a></li>
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#cekResiModal">Cek Resi</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#kontakModal">Kontak Kami</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Modal Cek Resi -->
<div class="modal fade" id="cekResiModal" tabindex="-1" aria-labelledby="cekResiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <form id="formCekResi"  method="post" action="<?= base_url('laporan/cek_resi') ?>">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="cekResiModalLabel"><i class="bi bi-search me-2"></i>Cek Status Laporan Anda</h5>
          <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <input type="text" name="kode_resi" class="form-control form-control-lg mb-3" placeholder="Masukkan Kode Resi Anda..." required>
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
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-search"></i> Cek Resi
          </button>
        </div>
      </form>
    </div>
  </div>
</div>



<!-- ✅ Modal: Kontak WhatsApp -->
<div class="modal fade" id="kontakModal" tabindex="-1" aria-labelledby="kontakModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kontakModalLabel">Kontak WhatsApp</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Septa Putra Anggara <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success btn-sm">Chat</a>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Ruslim Anwar <a href="https://wa.me/6282234567890" target="_blank" class="btn btn-success btn-sm">Chat</a>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Dony Hartadi <a href="https://wa.me/6283234567890" target="_blank" class="btn btn-success btn-sm">Chat</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- ✅ Modal: Lapor Insiden -->
<div class="modal fade" id="laporModal" tabindex="-1" aria-labelledby="laporModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="<?= base_url('laporan/simpan') ?>" enctype="multipart/form-data">
      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
         value="<?= $this->security->get_csrf_hash(); ?>">
        <div class="modal-header">
          <h5 class="modal-title" id="laporModalLabel">Formulir Laporan Insiden</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Pelapor</label>
            <input type="text" class="form-control" id="nama" name="nama_pelapor" required>
          </div>
          <div class="mb-3">
            <label for="no_hp" class="form-label">Kontak WhatsApp</label>
            <input type="number" class="form-control" id="no_hp" name="no_hp" required>
          </div>
          <div class="mb-3">
            <label for="judul_laporan" class="form-label">Jenis Laporan</label>
            <select class="form-select" id="judul_laporan" name="judul_laporan" required>
              <option disabled selected hidden>Pilih Jenis Laporan</option>
              <option value="Website tidak bisa diakses">Website tidak bisa diakses</option>
              <option value="Server down">Server down</option>
              <option value="Email tidak terkirim">Email tidak terkirim</option>
              <option value="Aplikasi error">Aplikasi error</option>
              <option value="Slot Ilegal / Judi Online">Slot Ilegal / Judi Online</option>
              <option value="Lainnya">Lainnya</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="link" class="form-label">Link</label>
            <input type="text" class="form-control" id="link" name="link" required>
          </div>
          <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
          </div>
          <div class="mb-3">
            <label for="eviden" class="form-label">Unggah Eviden</label>
            <input type="file" class="form-control" id="eviden" name="eviden" accept=".jpg,.png,.pdf" required>
          </div>
          <div class="mb-3 text-center">
            <div class="g-recaptcha d-inline-block" data-sitekey="6LcCUoMrAAAAAAambAuMAy2Vsh8gItXl3yqJVHhA"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Kirim Laporan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ✅ Modal: Sukses Kirim -->
<div class="modal fade" id="suksesModal" tabindex="-1" aria-labelledby="suksesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title w-100" id="suksesModalLabel">Laporan Berhasil!</h5>
        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        Terima kasih, laporan insiden Anda telah berhasil dikirim.<br><br>
        <strong>Kode Resi Anda:</strong><br>
        <span class="text-primary fw-bold">
          <?= $this->session->flashdata('kode_resi') ?: '—'; ?>
        </span>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Oke</button>
      </div>
    </div>
  </div>
</div>
<!-- ✅ Modal: Sukses Kirim -->
<div class="modal fade" id="suksesAbsen" tabindex="-1" aria-labelledby="suksesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title w-100" id="suksesAbsenLabel">Absen Berhasil!</h5>
        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        Anda telah mengisi absen<br>Terimakasih telah hadir!<br>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Oke</button>
      </div>
    </div>
  </div>
</div>