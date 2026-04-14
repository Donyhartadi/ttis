<!-- Cyber Footer -->
<footer class="mt-auto" style="background:var(--cyber-bg2);border-top:1px solid var(--cyber-border);">
  <div class="container py-4">
    <div class="row align-items-center g-3">
      <div class="col-md-6">
        <div style="font-family:var(--font-display);color:var(--cyber-cyan);font-size:0.85rem;letter-spacing:2px;">TTIS KAB. MUARA ENIM</div>
        <small style="color:var(--cyber-text-dim);font-family:var(--font-mono);">Tim Tanggap Insiden Siber &mdash; Diskominfo Kabupaten Muara Enim</small>
      </div>
      <div class="col-md-6 text-md-end">
        <small style="color:var(--cyber-text-dim);font-family:var(--font-mono);">&copy; <?= date('Y') ?> All rights reserved.</small>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const form = document.getElementById("form-absensi");
  if (form) {
    form.addEventListener("submit", function(e) {
      const response = grecaptcha.getResponse();
      if (response.length === 0) {
        e.preventDefault();
        alert("Silakan centang reCAPTCHA dulu sebelum mengirim form.");
        return false;
      }
    });
  }
});
</script>
<?php if ($this->session->flashdata('success')): ?>
<script>
  const suksesModal = new bootstrap.Modal(document.getElementById('suksesModal'));
  suksesModal.show();
</script>
<?php endif; ?>
<?php if ($this->session->flashdata('successAbsen')): ?>
<script>
  const suksesModal = new bootstrap.Modal(document.getElementById('suksesAbsen'));
  suksesModal.show();
</script>
<?php endif; ?>
<script>
  document.getElementById('formCekResi').addEventListener('submit', function(e) {
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
        const status = data.data.status.toLowerCase();
        const colorMap = { menunggu: 'var(--cyber-amber)', diproses: 'var(--cyber-cyan)', selesai: 'var(--cyber-green)' };
        const msgMap = {
          menunggu: 'Laporan Anda sedang menunggu diproses.',
          diproses: 'Laporan sedang dalam penanganan oleh tim kami.',
          selesai:  'Insiden telah ditindaklanjuti.'
        };
        const c = colorMap[status] || 'var(--cyber-text)';
        hasilResi.innerHTML = `
          <div style="background:rgba(0,212,255,0.05);border:1px solid var(--cyber-border);padding:1rem;border-radius:4px;">
            <div class="mb-1"><small style="color:var(--cyber-text-dim);font-family:var(--font-mono);">KODE RESI</small><br><strong style="color:var(--cyber-cyan)">${data.data.kode_resi}</strong></div>
            <div class="mb-1"><small style="color:var(--cyber-text-dim);">Pelapor:</small> <span style="color:var(--cyber-text)">${data.data.nama_pelapor}</span></div>
            <div class="mb-1"><small style="color:var(--cyber-text-dim);">Jenis:</small> <span style="color:var(--cyber-text)">${data.data.judul_laporan}</span></div>
            <div class="mb-1"><small style="color:var(--cyber-text-dim);">Tanggal:</small> <span style="color:var(--cyber-text)">${data.data.waktu_laporan}</span></div>
            <div class="mt-2"><span style="color:${c};font-family:var(--font-display);font-size:0.85rem;letter-spacing:1px;">[${data.data.status.toUpperCase()}]</span> <small style="color:var(--cyber-text-dim)">${msgMap[status]||''}</small></div>
          </div>`;
      } else {
        hasilResi.innerHTML = `<div style="background:rgba(255,59,92,0.08);border:1px solid rgba(255,59,92,0.3);padding:1rem;border-radius:4px;color:var(--cyber-red)"><i class="bi bi-x-octagon me-2"></i>Kode resi tidak ditemukan.</div>`;
      }
    })
    .catch(() => {
      hasilResi.innerHTML = `<div style="color:var(--cyber-red)"><i class="bi bi-wifi-off me-2"></i>Gagal menghubungi server.</div>`;
    });
  });
</script>
</body>
</html>

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