<!-- Navbar -->
<?php
$segment1 = $this->uri->segment(1);
$segment2 = $this->uri->segment(2);
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= base_url('admin') ?>">TTIS - Muara Enim</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin" aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarAdmin">
      <ul class="navbar-nav ms-auto">

        <li class="nav-item">
          <a class="nav-link <?= $segment1 == 'admin' ? 'active' : '' ?>" href="<?= base_url('admin') ?>">Dashboard</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= $segment1 == 'laporan' && $segment2 == '' ? 'active' : '' ?>" href="<?= base_url('laporan') ?>">Laporan</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= $segment1 == 'berita' ? 'active' : '' ?>" href="<?= base_url('berita') ?>">Berita</a>
        </li>

        <!-- ✅ Menu baru Kegiatan -->
        <li class="nav-item">
          <a class="nav-link <?= $segment1 == 'kegiatan' ? 'active' : '' ?>" href="<?= base_url('kegiatan') ?>">Kegiatan</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= $segment1 == 'laporan' && $segment2 == 'cetak' ? 'active' : '' ?>" href="<?= base_url('laporan/cetak') ?>">
            <i class="bi bi-printer-fill"></i> Cetak Laporan
          </a>
        </li>

        <!-- Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            👤 Admin
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
            <li><a class="dropdown-item text-danger" href="<?= base_url('auth/logout') ?>">🚪 Logout</a></li>
          </ul>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
