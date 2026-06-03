<!-- Admin Cyber Navbar -->
<?php
$segment1 = $this->uri->segment(1);
$segment2 = $this->uri->segment(2);
?>

<nav class="cyber-navbar navbar navbar-expand-lg">
  <div class="container-fluid px-4">
    <a class="navbar-brand" href="<?= base_url('admin') ?>">
      <div class="brand-icon">
        <i class="bi bi-shield-shaded" style="color:var(--cyber-cyan);font-size:1rem;"></i>
      </div>
      <span>TTIS</span>
      <small style="font-size:0.5rem;letter-spacing:1px;color:var(--cyber-text-dim);font-family:var(--font-mono);margin-left:4px;align-self:flex-end;padding-bottom:2px;">ADMIN PANEL</small>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin"
            aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarAdmin">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">

        <li class="nav-item">
          <a class="nav-link <?= $segment1 == 'admin' ? 'active' : '' ?>" href="<?= base_url('admin') ?>">
            <i class="bi bi-speedometer2 me-1"></i>Dashboard
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= ($segment1 == 'laporan' && $segment2 == '') ? 'active' : '' ?>" href="<?= base_url('laporan') ?>">
            <i class="bi bi-clipboard-data me-1"></i>Laporan
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= $segment1 == 'berita' ? 'active' : '' ?>" href="<?= base_url('berita') ?>">
            <i class="bi bi-newspaper me-1"></i>Berita
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= $segment1 == 'kegiatan' ? 'active' : '' ?>" href="<?= base_url('kegiatan') ?>">
            <i class="bi bi-calendar-check me-1"></i>Kegiatan
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= ($segment1 == 'laporan' && $segment2 == 'cetak') ? 'active' : '' ?>" href="<?= base_url('laporan/cetak') ?>">
            <i class="bi bi-printer me-1"></i>Cetak
          </a>
        </li>

        <li class="nav-item dropdown ms-lg-2">
          <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="adminDropdown"
             role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span style="display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;background:rgba(0,212,255,0.15);border:1px solid var(--cyber-border);border-radius:50%;font-size:0.8rem;">
              <i class="bi bi-person-fill" style="color:var(--cyber-cyan);"></i>
            </span>
            <?= htmlspecialchars($this->session->userdata('username') ?: 'Admin') ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
            <li>
              <a class="dropdown-item" href="<?= base_url('auth/logout') ?>" style="color:var(--cyber-red);">
                <i class="bi bi-box-arrow-right me-2"></i>Logout
              </a>
            </li>
          </ul>
        </li>

      </ul>
    </div>
  </div>
</nav>
