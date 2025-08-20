  <!-- Header -->
  <header class="py-4">
    <div class="container px-lg-5">
      <div class="p-4 p-lg-4 bg-light rounded-3 text-center">
        <div class="m-2 m-lg-3">
          <h1 class="display-6 fw-bold">Laporkan Insiden Siber!</h1>
          <p class="fs-4">Menemui masalah seperti slot gacor, down server, atau keluhan website Pemkab Muara Enim?</p>
          <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#laporModal">
            Laporkan!
          </button>
        </div>
      </div>
    </div>
  </header>

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

