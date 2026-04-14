<div class="container py-5" style="max-width:680px;">
  <div class="cyber-card p-4 p-md-5">
    <!-- Header -->
    <div class="text-center mb-4">
      <i class="bi bi-person-check-fill" style="font-size:2.5rem;color:var(--cyber-cyan);text-shadow:var(--cyber-glow-c);"></i>
      <h4 style="font-family:var(--font-display);color:var(--cyber-cyan);letter-spacing:2px;margin-top:0.75rem;">FORM ABSENSI</h4>
      <p style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:0.8rem;"><?= htmlspecialchars($kegiatan->nama_kegiatan) ?></p>
    </div>

    <!-- Alerts -->
    <?php if ($this->session->flashdata('error')): ?>
      <div style="background:rgba(255,59,92,0.08);border:1px solid rgba(255,59,92,0.4);border-left:3px solid var(--cyber-red);color:var(--cyber-red);padding:.75rem 1rem;border-radius:2px;margin-bottom:1rem;">
        <i class="bi bi-exclamation-octagon me-2"></i><?= $this->session->flashdata('error') ?>
      </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('successAbsen')): ?>
      <div style="background:rgba(0,255,136,0.08);border:1px solid var(--cyber-border2);border-left:3px solid var(--cyber-green);color:var(--cyber-green);padding:.75rem 1rem;border-radius:2px;margin-bottom:1rem;">
        <i class="bi bi-check-circle me-2"></i><?= $this->session->flashdata('successAbsen') ?>
      </div>
    <?php endif; ?>
    <?php if (validation_errors()): ?>
      <div style="background:rgba(255,59,92,0.08);border:1px solid rgba(255,59,92,0.4);border-left:3px solid var(--cyber-red);color:var(--cyber-red);padding:.75rem 1rem;border-radius:2px;margin-bottom:1rem;">
        <?= validation_errors() ?>
      </div>
    <?php endif; ?>
    <?php if (!empty($captcha_error)): ?>
      <div style="background:rgba(255,59,92,0.08);border:1px solid rgba(255,59,92,0.4);border-left:3px solid var(--cyber-red);color:var(--cyber-red);padding:.75rem 1rem;border-radius:2px;margin-bottom:1rem;">
        <?= $captcha_error ?>
      </div>
    <?php endif; ?>

    <form id="form-absensi" method="post" action="<?= base_url('welcome/absen/'.$kegiatan->id) ?>">
      <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">

      <div class="mb-3">
        <label class="cyber-label"><i class="bi bi-person me-1"></i>Nama Lengkap</label>
        <input type="text" name="nama_peserta" class="form-control cyber-input" placeholder="Masukkan nama lengkap Anda" required value="<?= set_value('nama_peserta') ?>">
      </div>

      <div class="mb-3">
        <label class="cyber-label"><i class="bi bi-envelope me-1"></i>Email</label>
        <input type="email" name="email" class="form-control cyber-input" placeholder="Masukkan email aktif" required value="<?= set_value('email') ?>">
      </div>

      <div class="mb-3">
        <label class="cyber-label"><i class="bi bi-building me-1"></i>Asal Unit Kerja</label>
        <input type="text" name="asal_opd" class="form-control cyber-input" placeholder="Contoh: Diskominfo Muara Enim" required value="<?= set_value('asal_opd') ?>">
      </div>

      <div class="mb-3">
        <label class="cyber-label">Tingkat Kepuasan</label>
        <div class="d-flex gap-4 mt-1">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="kepuasan" id="puasYa" value="Ya" required <?= set_value('kepuasan') == 'Ya' ? 'checked' : '' ?>>
            <label class="form-check-label" for="puasYa" style="color:var(--cyber-green);">Ya, Puas</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="kepuasan" id="puasTidak" value="Tidak" <?= set_value('kepuasan') == 'Tidak' ? 'checked' : '' ?>>
            <label class="form-check-label" for="puasTidak" style="color:var(--cyber-amber);">Kurang Puas</label>
          </div>
        </div>
      </div>

      <div class="mb-4">
        <label class="cyber-label"><i class="bi bi-chat-text me-1"></i>Saran &amp; Masukan</label>
        <textarea name="saran_masukan" class="form-control cyber-input" rows="3" placeholder="Tuliskan saran atau masukan Anda..."><?= set_value('saran_masukan') ?></textarea>
      </div>

      <div class="mb-4 text-center">
        <div class="g-recaptcha d-inline-block" data-sitekey="6LcCUoMrAAAAAAambAuMAy2Vsh8gItXl3yqJVHhA"></div>
      </div>

      <button type="submit" class="btn btn-cyber w-100 py-2">
        <i class="bi bi-send me-2"></i>KIRIM ABSENSI
      </button>
    </form>

    <div class="text-center mt-3">
      <a href="<?= base_url('welcome/detail_kegiatan/'.$kegiatan->id) ?>" style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:0.8rem;text-decoration:none;">
        <i class="bi bi-arrow-left me-1"></i>Kembali ke Detail Kegiatan
      </a>
    </div>
  </div>
</div>