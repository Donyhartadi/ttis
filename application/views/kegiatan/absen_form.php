<div class="container py-5" style="max-width:680px;">

  <!-- Breadcrumb -->
  <nav style="margin-bottom:1.5rem;">
    <small style="font-family:var(--font-mono);font-size:.72rem;color:var(--cyber-text-dim);">
      <a href="<?= base_url('welcome/kegiatan') ?>" style="color:var(--cyber-text-dim);text-decoration:none;">Kegiatan</a>
      <span style="margin:0 .5rem;opacity:.4;">/</span>
      <a href="<?= base_url('welcome/detail_kegiatan/'.$kegiatan->id) ?>" style="color:var(--cyber-text-dim);text-decoration:none;">
        <?php
          $nm = $kegiatan->nama_kegiatan;
          echo htmlspecialchars(mb_strlen($nm) > 42 ? mb_substr($nm, 0, 40) . '…' : $nm);
        ?>
      </a>
      <span style="margin:0 .5rem;opacity:.4;">/</span>
      <span style="color:var(--cyber-cyan);">Absensi</span>
    </small>
  </nav>

  <div class="cyber-card p-4 p-md-5 scroll-reveal">

    <!-- Header -->
    <div class="text-center mb-4">
      <div style="width:64px;height:64px;border:2px solid var(--cyber-cyan);border-radius:50%;background:rgba(0,212,255,.06);display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;box-shadow:0 0 24px rgba(0,212,255,.2);animation:pulse-glow 3s ease-in-out infinite;">
        <i class="bi bi-person-check-fill" style="font-size:1.8rem;color:var(--cyber-cyan);text-shadow:var(--cyber-glow-c);"></i>
      </div>
      <h4 style="font-family:var(--font-display);color:var(--cyber-cyan);letter-spacing:2px;margin-bottom:.4rem;font-size:1rem;">FORM ABSENSI</h4>
      <p style="color:var(--cyber-text);font-family:var(--font-body);font-size:.92rem;margin-bottom:.25rem;font-weight:600;">
        <?= htmlspecialchars($kegiatan->nama_kegiatan) ?>
      </p>
      <p style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:.72rem;margin:0;">
        <i class="bi bi-calendar3 me-1" style="color:var(--cyber-cyan);"></i>
        <?= date('d M Y, H:i', strtotime($kegiatan->waktu_kegiatan)) ?>
      </p>
    </div>

    <!-- Alerts -->
    <?php if ($this->session->flashdata('error')): ?>
      <div style="background:rgba(255,59,92,.08);border:1px solid rgba(255,59,92,.4);border-left:3px solid var(--cyber-red);color:var(--cyber-red);padding:.75rem 1rem;border-radius:3px;margin-bottom:1.25rem;font-size:.88rem;">
        <i class="bi bi-exclamation-octagon me-2"></i><?= $this->session->flashdata('error') ?>
      </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('successAbsen')): ?>
      <div style="background:rgba(0,255,136,.08);border:1px solid var(--cyber-border2);border-left:3px solid var(--cyber-green);color:var(--cyber-green);padding:.75rem 1rem;border-radius:3px;margin-bottom:1.25rem;font-size:.88rem;">
        <i class="bi bi-check-circle me-2"></i><?= $this->session->flashdata('successAbsen') ?>
      </div>
    <?php endif; ?>

    <?php if (validation_errors()): ?>
      <div style="background:rgba(255,59,92,.08);border:1px solid rgba(255,59,92,.4);border-left:3px solid var(--cyber-red);color:var(--cyber-red);padding:.75rem 1rem;border-radius:3px;margin-bottom:1.25rem;font-size:.88rem;">
        <?= validation_errors() ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($captcha_error)): ?>
      <div style="background:rgba(255,176,32,.08);border:1px solid rgba(255,176,32,.4);border-left:3px solid var(--cyber-amber);color:var(--cyber-amber);padding:.75rem 1rem;border-radius:3px;margin-bottom:1.25rem;font-size:.88rem;">
        <i class="bi bi-exclamation-triangle me-2"></i><?= $captcha_error ?>
      </div>
    <?php endif; ?>

    <form id="form-absensi"
          method="post"
          action="<?= base_url('welcome/absen/'.$kegiatan->id) ?>"
          data-loading-form
          data-loading-text="Menyimpan Absensi...">

      <input type="hidden"
             name="<?= $this->security->get_csrf_token_name() ?>"
             value="<?= $this->security->get_csrf_hash() ?>">

      <!-- nama_peserta -->
      <div class="mb-3">
        <label class="cyber-label" for="nama_peserta">
          <i class="bi bi-person me-1" style="color:var(--cyber-cyan);font-size:.75rem;"></i>
          Nama Lengkap <span style="color:var(--cyber-red);">*</span>
        </label>
        <input type="text"
               id="nama_peserta"
               name="nama_peserta"
               class="form-control cyber-input"
               placeholder="Masukkan nama lengkap Anda"
               required
               maxlength="100"
               value="<?= set_value('nama_peserta') ?>">
      </div>

      <!-- email -->
      <div class="mb-3">
        <label class="cyber-label" for="email_peserta">
          <i class="bi bi-envelope me-1" style="color:var(--cyber-cyan);font-size:.75rem;"></i>
          Email
        </label>
        <input type="email"
               id="email_peserta"
               name="email"
               class="form-control cyber-input"
               placeholder="contoh@email.com (opsional)"
               maxlength="100"
               value="<?= set_value('email') ?>">
      </div>

      <!-- asal_opd -->
      <div class="mb-3">
        <label class="cyber-label" for="asal_opd">
          <i class="bi bi-building me-1" style="color:var(--cyber-cyan);font-size:.75rem;"></i>
          Asal Unit Kerja / OPD <span style="color:var(--cyber-red);">*</span>
        </label>
        <input type="text"
               id="asal_opd"
               name="asal_opd"
               class="form-control cyber-input"
               placeholder="Contoh: Diskominfo Muara Enim"
               required
               maxlength="255"
               value="<?= set_value('asal_opd') ?>">
      </div>

      <!-- kepuasan — field DB: varchar(10), nilai: 'Ya' atau 'Tidak' -->
      <div class="mb-3">
        <label class="cyber-label">
          <i class="bi bi-star me-1" style="color:var(--cyber-amber);font-size:.75rem;"></i>
          Tingkat Kepuasan <span style="color:var(--cyber-red);">*</span>
        </label>
        <div class="d-flex gap-3 mt-1 flex-wrap">

          <!-- Ya = Puas -->
          <label for="kepuasan_ya" style="
            display:flex;align-items:center;gap:.6rem;
            padding:.65rem 1.1rem;
            border:1px solid <?= set_value('kepuasan') === 'Ya' ? 'var(--cyber-green)' : 'var(--cyber-border)' ?>;
            background:<?= set_value('kepuasan') === 'Ya' ? 'rgba(0,255,136,.08)' : 'transparent' ?>;
            border-radius:3px;cursor:pointer;
            transition:all .2s;
            font-family:var(--font-body);font-weight:600;font-size:.9rem;
          " id="label-kepuasan-ya">
            <input class="form-check-input"
                   type="radio"
                   name="kepuasan"
                   id="kepuasan_ya"
                   value="Ya"
                   required
                   <?= set_value('kepuasan') === 'Ya' ? 'checked' : '' ?>
                   style="accent-color:var(--cyber-green);width:16px;height:16px;">
            <span style="color:var(--cyber-green);">
              <i class="bi bi-emoji-smile-fill me-1"></i>Ya, Puas
            </span>
          </label>

          <!-- Tidak = Kurang Puas -->
          <label for="kepuasan_tidak" style="
            display:flex;align-items:center;gap:.6rem;
            padding:.65rem 1.1rem;
            border:1px solid <?= set_value('kepuasan') === 'Tidak' ? 'var(--cyber-red)' : 'var(--cyber-border)' ?>;
            background:<?= set_value('kepuasan') === 'Tidak' ? 'rgba(255,59,92,.08)' : 'transparent' ?>;
            border-radius:3px;cursor:pointer;
            transition:all .2s;
            font-family:var(--font-body);font-weight:600;font-size:.9rem;
          " id="label-kepuasan-tidak">
            <input class="form-check-input"
                   type="radio"
                   name="kepuasan"
                   id="kepuasan_tidak"
                   value="Tidak"
                   <?= set_value('kepuasan') === 'Tidak' ? 'checked' : '' ?>
                   style="accent-color:var(--cyber-red);width:16px;height:16px;">
            <span style="color:var(--cyber-red);">
              <i class="bi bi-emoji-frown-fill me-1"></i>Kurang Puas
            </span>
          </label>

        </div>
      </div>

      <!-- saran_masukan -->
      <div class="mb-4">
        <label class="cyber-label" for="saran_masukan">
          <i class="bi bi-chat-text me-1" style="color:var(--cyber-cyan);font-size:.75rem;"></i>
          Saran &amp; Masukan
        </label>
        <textarea id="saran_masukan"
                  name="saran_masukan"
                  class="form-control cyber-input"
                  rows="3"
                  placeholder="Tuliskan saran atau masukan Anda... (opsional)"><?= set_value('saran_masukan') ?></textarea>
      </div>

      <!-- reCAPTCHA -->
      <div class="mb-4 text-center">
        <div class="g-recaptcha d-inline-block"
             data-sitekey="6LcCUoMrAAAAAAambAuMAy2Vsh8gItXl3yqJVHhA"></div>
      </div>

      <button type="submit" class="btn btn-cyber w-100 py-2" id="btn-submit-absen">
        <i class="bi bi-send me-2"></i>KIRIM ABSENSI
      </button>

    </form>

    <div class="text-center mt-3">
      <a href="<?= base_url('welcome/detail_kegiatan/'.$kegiatan->id) ?>"
         style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:.78rem;text-decoration:none;">
        <i class="bi bi-arrow-left me-1"></i>Kembali ke Detail Kegiatan
      </a>
    </div>
  </div>
</div>

<script>
// Kepuasan radio — highlight label yang dipilih
(function() {
  var radios = document.querySelectorAll('input[name="kepuasan"]');
  var labelYa     = document.getElementById('label-kepuasan-ya');
  var labelTidak  = document.getElementById('label-kepuasan-tidak');

  function updateLabels() {
    var val = document.querySelector('input[name="kepuasan"]:checked')?.value || '';

    if (labelYa) {
      labelYa.style.borderColor  = val === 'Ya' ? 'var(--cyber-green)' : 'var(--cyber-border)';
      labelYa.style.background   = val === 'Ya' ? 'rgba(0,255,136,.08)'  : 'transparent';
    }
    if (labelTidak) {
      labelTidak.style.borderColor = val === 'Tidak' ? 'var(--cyber-red)' : 'var(--cyber-border)';
      labelTidak.style.background  = val === 'Tidak' ? 'rgba(255,59,92,.08)' : 'transparent';
    }
  }

  radios.forEach(function(r) {
    r.addEventListener('change', updateLabels);
    // Hover effect
    r.closest('label')?.addEventListener('mouseenter', function() {
      if (!r.checked) {
        this.style.borderColor = r.value === 'Ya' ? 'rgba(0,255,136,.4)' : 'rgba(255,59,92,.4)';
      }
    });
    r.closest('label')?.addEventListener('mouseleave', function() {
      updateLabels();
    });
  });

  updateLabels();
})();
</script>
