<!-- Cyber Public Footer -->
<footer class="cyber-public-footer">
  <div class="container">
    <div class="row g-4 g-lg-5">

      <!-- Brand column -->
      <div class="col-lg-4 col-md-12">
        <div class="fp-brand mb-2"><i class="bi bi-shield-lock-fill me-2"></i>TTIS</div>
        <p style="color:var(--cyber-text-dim);font-size:.87rem;line-height:1.75;margin:0;">
          Tim Tanggap Insiden Siber Kabupaten Muara Enim — Melindungi infrastruktur digital pemerintah daerah dari ancaman siber secara profesional dan responsif.
        </p>
        <div style="margin-top:1rem;font-family:var(--font-mono);font-size:.68rem;color:var(--cyber-text-dim);">
          <span class="status-dot online"></span>SISTEM AKTIF &mdash; <span data-clock></span>
        </div>
      </div>

      <!-- Navigasi -->
      <div class="col-lg-2 col-6">
        <div class="fp-heading">Navigasi</div>
        <a href="<?= base_url() ?>" class="fp-link"><i class="bi bi-house me-1" style="opacity:.45;"></i>Beranda</a>
        <a href="<?= base_url('welcome/berita') ?>" class="fp-link"><i class="bi bi-newspaper me-1" style="opacity:.45;"></i>Berita</a>
        <a href="<?= base_url('welcome/kegiatan') ?>" class="fp-link"><i class="bi bi-calendar-event me-1" style="opacity:.45;"></i>Kegiatan</a>
        <a href="<?= base_url('rfc2350') ?>" class="fp-link"><i class="bi bi-file-earmark-lock2 me-1" style="opacity:.45;"></i>RFC 2350</a>
        <a href="<?= base_url('auth') ?>" class="fp-link"><i class="bi bi-lock me-1" style="opacity:.45;"></i>Login Admin</a>
      </div>

      <!-- Layanan -->
      <div class="col-lg-2 col-6">
        <div class="fp-heading">Layanan</div>
        <a href="#" class="fp-link" data-bs-toggle="modal" data-bs-target="#laporModal">
          <i class="bi bi-exclamation-triangle me-1" style="opacity:.45;"></i>Lapor Insiden
        </a>
        <a href="#" class="fp-link" data-bs-toggle="modal" data-bs-target="#cekResiModal">
          <i class="bi bi-search me-1" style="opacity:.45;"></i>Cek Resi
        </a>
        <a href="#" class="fp-link" data-bs-toggle="modal" data-bs-target="#kontakModal">
          <i class="bi bi-headset me-1" style="opacity:.45;"></i>Kontak Tim
        </a>
      </div>

      <!-- Kontak -->
      <div class="col-lg-4 col-md-12">
        <div class="fp-heading">Kontak</div>
        <div style="font-size:.86rem;color:var(--cyber-text-dim);display:flex;flex-direction:column;gap:.6rem;">
          <div><i class="bi bi-building me-2" style="color:var(--cyber-cyan);flex-shrink:0;"></i>Dinas Komunikasi dan Informatika Kab. Muara Enim</div>
          <div><i class="bi bi-geo-alt me-2" style="color:var(--cyber-cyan);"></i>Jl. Jend. Ahmad Yani No. 1, Muara Enim, Sumatera Selatan</div>
          <div><i class="bi bi-envelope me-2" style="color:var(--cyber-cyan);"></i>diskominfo@muaraenimkab.go.id</div>
          <div><i class="bi bi-clock me-2" style="color:var(--cyber-cyan);"></i>Senin – Jumat, 08.00 – 16.00 WIB</div>
        </div>
      </div>

    </div>

    <!-- Bottom bar -->
    <div class="fp-bottom d-flex flex-wrap align-items-center justify-content-between gap-2">
      <span>&copy; <?= date('Y') ?> TTIS Kabupaten Muara Enim. All rights reserved.</span>
      <span style="color:rgba(0,212,255,0.25);">Diskominfo &mdash; Kab. Muara Enim</span>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://unpkg.com/react@18/umd/react.production.min.js" crossorigin></script>
<script src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js" crossorigin></script>
<script src="<?= base_url('assets/js/app.js') ?>?v=2"></script>

<?php if ($this->session->flashdata('error')): ?>
<div id="__ttis_flash__" data-msg="<?= htmlspecialchars($this->session->flashdata('error')) ?>" data-type="error" style="display:none;"></div>
<?php endif; ?>

<?php if ($this->session->flashdata('success')): ?>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const suksesModal = new bootstrap.Modal(document.getElementById('suksesModal'));
    suksesModal.show();
  });
</script>
<?php endif; ?>
<?php if ($this->session->flashdata('successAbsen')): ?>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const suksesModal = new bootstrap.Modal(document.getElementById('suksesAbsen'));
    suksesModal.show();
  });
</script>
<?php endif; ?>
<script>
  const _formCekResi = document.getElementById('formCekResi');
  if (_formCekResi) {
    _formCekResi.addEventListener('submit', function(e) {
      e.preventDefault();
      const kodeResi = this.kode_resi.value;
      const hasilResi = document.getElementById('hasilResi');
      hasilResi.innerHTML = '<div class="text-center" style="color:var(--cyber-text-dim);font-family:var(--font-mono);">[ MENCARI DATA... ]</div>';
      fetch("<?= base_url('laporan/cek_resi_ajax') ?>", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "kode_resi=" + encodeURIComponent(kodeResi)
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'ok') {
          const esc = s => String(s ?? '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
          const status = (data.data.status || '').toLowerCase();
          const colorMap = { menunggu: 'var(--cyber-amber)', diproses: 'var(--cyber-cyan)', selesai: 'var(--cyber-green)' };
          const msgMap = {
            menunggu: 'Laporan Anda sedang menunggu diproses.',
            diproses: 'Laporan sedang dalam penanganan oleh tim kami.',
            selesai:  'Insiden telah ditindaklanjuti.'
          };
          const c = colorMap[status] || 'var(--cyber-text)';
          hasilResi.innerHTML = `
            <div style="background:rgba(0,212,255,0.05);border:1px solid var(--cyber-border);padding:1rem;border-radius:4px;">
              <div class="mb-1"><small style="color:var(--cyber-text-dim);font-family:var(--font-mono);">KODE RESI</small><br><strong style="color:var(--cyber-cyan)">${esc(data.data.kode_resi)}</strong></div>
              <div class="mb-1"><small style="color:var(--cyber-text-dim);">Pelapor:</small> <span style="color:var(--cyber-text)">${esc(data.data.nama_pelapor)}</span></div>
              <div class="mb-1"><small style="color:var(--cyber-text-dim);">Jenis:</small> <span style="color:var(--cyber-text)">${esc(data.data.judul_laporan)}</span></div>
              <div class="mb-1"><small style="color:var(--cyber-text-dim);">Tanggal:</small> <span style="color:var(--cyber-text)">${esc(data.data.waktu_laporan)}</span></div>
              <div class="mt-2"><span style="color:${c};font-family:var(--font-display);font-size:0.85rem;letter-spacing:1px;">[${esc(data.data.status).toUpperCase()}]</span> <small style="color:var(--cyber-text-dim)">${msgMap[status]||''}</small></div>
            </div>`;
        } else {
          hasilResi.innerHTML = `<div style="background:rgba(255,59,92,0.08);border:1px solid rgba(255,59,92,0.3);padding:1rem;border-radius:4px;color:var(--cyber-red)"><i class="bi bi-x-octagon me-2"></i>Kode resi tidak ditemukan.</div>`;
        }
      })
      .catch(() => {
        hasilResi.innerHTML = `<div style="color:var(--cyber-red)"><i class="bi bi-wifi-off me-2"></i>Gagal menghubungi server.</div>`;
      });
    });
  }
</script>
</body>
</html>
