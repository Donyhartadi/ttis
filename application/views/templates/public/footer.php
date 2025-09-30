<!-- ✅ Footer -->

<!-- ✅ Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<!-- 🔧 Validasi client-side untuk captcha -->
<script>
document.addEventListener("DOMContentLoaded", function() {
  const form = document.getElementById("form-absensi");
  if (!form) return;

  form.addEventListener("submit", function(e) {
    const response = grecaptcha.getResponse(); // cek token recaptcha
    if (response.length === 0) {
      e.preventDefault(); // stop submit
      alert("⚠️ Silakan centang reCAPTCHA dulu sebelum mengirim form.");
      return false;
    }
  });
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