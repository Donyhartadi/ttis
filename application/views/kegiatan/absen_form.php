<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-7">
      <div class="card shadow-lg border-0">
        <div class="card-header bg-info text-white text-center">
          <h4 class="mb-0">Form Absensi</h4>
          <small><?= html_escape($kegiatan->nama_kegiatan) ?></small>
        </div>
        <div class="card-body p-4">

          <!-- 🔔 Flash message dari server -->
          <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?= $this->session->flashdata('error'); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

          <?php if ($this->session->flashdata('successAbsen')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <?= $this->session->flashdata('successAbsen'); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>
                  <?php if (validation_errors()): ?>
          <div class="alert alert-danger"><?= validation_errors(); ?></div>
        <?php endif; ?>
        <?php if (!empty($captcha_error)): ?>
        <div class="alert alert-danger"><?= $captcha_error ?></div>
        <?php endif; ?>

          <form id="form-absensi" method="post" action="<?= base_url('welcome/absen/'.$kegiatan->id) ?>">
  <!-- CSRF -->
  <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" 
         value="<?= $this->security->get_csrf_hash() ?>">

  <!-- Nama -->
  <div class="mb-3">
    <label class="form-label fw-bold">Nama Lengkap</label>
    <input type="text" name="nama_peserta" class="form-control" 
           placeholder="Masukkan nama lengkap Anda" required
           value="<?= set_value('nama_peserta') ?>">
  </div>

  <!-- Email -->
  <div class="mb-3">
    <label class="form-label fw-bold">Email</label>
    <input type="email" name="email" class="form-control" 
           placeholder="Masukkan email aktif" required
           value="<?= set_value('email') ?>">
  </div>

  <!-- Asal Perusahaan/OPD -->
  <div class="mb-3">
    <label class="form-label fw-bold">Asal Unit Kerja</label>
    <input type="text" name="asal_opd" class="form-control" 
           placeholder="Contoh: Diskominfo Kota Semarang / Kec. Belimbing" required
           value="<?= set_value('asal_opd') ?>">
  </div>

  <!-- Kepuasan -->
  <div class="mb-3">
    <label class="form-label fw-bold">Apakah Anda puas dengan webinar ini?</label>
    <div class="d-flex gap-3 mt-2">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="kepuasan" id="puasYa" value="Ya" required
               <?= set_value('kepuasan') == 'Ya' ? 'checked' : '' ?>>
        <label class="form-check-label text-success fw-semibold" for="puasYa">😃 Ya</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="kepuasan" id="puasTidak" value="Tidak" required
               <?= set_value('kepuasan') == 'Tidak' ? 'checked' : '' ?>>
        <label class="form-check-label text-danger fw-semibold" for="puasTidak">😐 Tidak</label>
      </div>
    </div>
  </div>

  <!-- Saran & Masukan -->
  <div class="mb-3">
    <label class="form-label fw-bold">Saran & Masukan</label>
    <textarea name="saran_masukan" class="form-control" rows="3" 
              placeholder="Tulis saran atau masukan Anda..."><?= set_value('saran_masukan') ?></textarea>
  </div>

  <!-- Captcha -->
  <div class="mb-3 text-center">
    <div class="g-recaptcha d-inline-block" data-sitekey="6LcCUoMrAAAAAAambAuMAy2Vsh8gItXl3yqJVHhA"></div>
  </div>

  <!-- Tombol -->
  <div class="d-grid">
    <button type="submit" class="btn btn-success btn-lg">
      Kirim Absensi
    </button>
  </div>
</form>


        </div>
        <div class="card-footer text-center bg-light">
          <a href="<?= base_url('welcome/detail_kegiatan/'.$kegiatan->id) ?>" class="btn btn-link">⬅ Kembali ke Detail</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Tambahkan script reCAPTCHA -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>