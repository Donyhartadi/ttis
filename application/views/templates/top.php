<!-- Admin Cyber Navbar -->
<?php
$segment1 = $this->uri->segment(1);
$segment2 = $this->uri->segment(2);
?>

<nav class="cyber-navbar navbar navbar-expand-lg">
  <div class="container-fluid px-4">
    <a class="navbar-brand" href="<?= base_url('admin') ?>">
      <div class="brand-icon" style="background:transparent;border:none;padding:0;">
        <img src="<?= base_url('assets/logo/muaraenim.png') ?>" alt="Logo Muara Enim" style="height:30px;width:30px;object-fit:contain;">
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

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?= $segment1 == 'kontak' ? 'active' : '' ?>" href="#" id="kontakDropdown"
             role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-telephone me-1"></i>Kontak
          </a>
          <ul class="dropdown-menu" aria-labelledby="kontakDropdown">
            <li>
              <a class="dropdown-item" href="<?= base_url('kontak/admin_setting') ?>">
                <i class="bi bi-gear me-2"></i>Pengaturan
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="<?= base_url('kontak/admin_operator') ?>">
                <i class="bi bi-people me-2"></i>Operator
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="<?= base_url('kontak/admin_publickey') ?>">
                <i class="bi bi-key me-2"></i>Public Key
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="<?= base_url('kontak/admin_dokumen') ?>">
                <i class="bi bi-file-earmark-text me-2"></i>Dokumen
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= $segment1 == 'rfc2350' ? 'active' : '' ?>" href="<?= base_url('rfc2350/admin') ?>">
            <i class="bi bi-file-earmark-pdf me-1"></i>RFC 2350
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
