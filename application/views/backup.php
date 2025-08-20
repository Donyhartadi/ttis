<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Lapor Insiden Siber</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="<?= base_url(); ?>assets/favicon.ico" />
  <link href="<?= base_url(); ?>assets/css/styles.css" rel="stylesheet" />
</head>

<body class="d-flex flex-column min-vh-100">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container px-lg-5">
      <a class="navbar-brand d-flex align-items-center" href="#!">
        <img src="<?= base_url('assets/logo/diskominfo.png') ?>" alt="Logo" width="40" height="40" class="me-2" />
        TTIS
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
              aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
  <li class="nav-item"><a class="nav-link active" href="<?= base_url('auth'); ?>">Login</a></li>
  <li class="nav-item"><a class="nav-link" href="#!">Tentang</a></li>

  <!-- Dropdown Menu -->
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="laporDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Layanan
    </a>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="laporDropdown">
    <li>
              <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#laporModal">Lapor</a>
            </li>
      <li>
        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#cekResiModal">Cek Resi</a>
      </li>
    </ul>
  </li>

  <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#kontakModal">Kontak Kami</a></li>
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

  <!-- Modal Kontak WhatsApp -->
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

  <!-- Modal Lapor Insiden -->
  <div class="modal fade" id="laporModal" tabindex="-1" aria-labelledby="laporModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" action="<?= base_url('laporan/simpan') ?>" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="laporModalLabel">Formulir Laporan Insiden</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Pelapor</label>
              <input type="text" class="form-control" id="nama" name="nama_pelapor" placeholder="Nama OPD / Nama Pribadi" required>
            </div>
            <div class="mb-3">
              <label for="no_hp" class="form-label">Kontak WhatsApp</label>
              <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan No WA" required>
            </div>
            <div class="mb-3">
              <label for="judul_laporan" class="form-label">Jenis Laporan</label>
              <select class="form-select" id="judul_laporan" name="judul_laporan" required>
                <option value="" disabled selected hidden>Pilih Jenis Laporan</option>
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

  <!-- Modal Sukses -->
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
          <span class="text-primary fw-bold"><?= $this->session->flashdata('kode_resi'); ?></span>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-success" data-bs-dismiss="modal">Oke</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="py-2 bg-primary mt-auto">
    <div class="container">
      <p class="m-0 text-center text-white">
        &copy; <?= date('Y') ?> TIM TANGGAP INSIDEN SIBER KABUPATEN MUARA ENIM
      </p>
    </div>
  </footer>

  <!-- Script -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/scripts.js"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

  <?php if ($this->session->flashdata('success')): ?>
    <script>
      const suksesModal = new bootstrap.Modal(document.getElementById('suksesModal'));
      suksesModal.show();
    </script>
  <?php endif; ?>

  <script>
  document.getElementById('formCekResi').addEventListener('submit', function(e) {
    e.preventDefault();

    const kodeResi = this.kode_resi.value;
    const hasilResi = document.getElementById('hasilResi');

    hasilResi.innerHTML = '<div class="text-center">Sedang mencari data...</div>';

    fetch("<?= base_url('laporan/cek_resi_ajax') ?>", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded"
      },
      body: "kode_resi=" + encodeURIComponent(kodeResi)
    })
    .then(res => res.json())
    .then(data => {
      if (data.status === 'ok') {
        const status = data.data.status.toLowerCase();
        const badgeClass =
          status === 'menunggu' ? 'bg-warning text-dark' :
          status === 'diproses' ? 'bg-primary' :
          status === 'selesai'  ? 'bg-success' :
          'bg-secondary';

        const pesan =
          status === 'menunggu' ? '⏳ Laporan Anda sedang menunggu diproses.' :
          status === 'diproses' ? '🔧 Laporan sedang dalam penanganan oleh tim kami.' :
          status === 'selesai'  ? '✅ Terima kasih telah melaporkan. Insiden telah ditindaklanjuti.' :
          'Status tidak dikenali.';

        hasilResi.innerHTML = `
          <div class="alert alert-success">
            <strong>📌 Kode Resi:</strong> ${data.data.kode_resi}<br>
            <strong>👤 Nama Pelapor:</strong> ${data.data.nama_pelapor}<br>
            <strong>📝 Jenis Laporan:</strong> ${data.data.judul_laporan}<br>
            <strong>⏰ Tanggal Lapor:</strong> ${data.data.waktu_laporan}<br>
            <strong>📊 Status:</strong>
            <span class="badge ${badgeClass}">${data.data.status}</span><br>
            <small class="text-muted d-block mt-1">${pesan}</small>
          </div>
        `;
      } else {
        hasilResi.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
      }
    })
    .catch(() => {
      hasilResi.innerHTML = `<div class="alert alert-danger">Terjadi kesalahan saat memproses data.</div>`;
    });
  });
</script>


</body>
</html>
