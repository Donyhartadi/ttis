<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login &mdash; TTIS Muara Enim</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url('assets/css/cyber.css') ?>" rel="stylesheet">
  <style>
    .auth-wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem 1rem;
      background:
        linear-gradient(rgba(0,212,255,0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,212,255,0.04) 1px, transparent 1px);
      background-size: 50px 50px;
      background-color: var(--cyber-bg);
    }
    .auth-card {
      width: 100%;
      max-width: 420px;
      background: var(--cyber-card);
      border: 1px solid var(--cyber-border);
      border-radius: 4px;
      padding: 2.5rem 2rem;
      box-shadow: 0 0 40px rgba(0,0,0,0.6), 0 0 80px rgba(0,212,255,0.05);
      animation: fade-in-up 0.6s ease;
      position: relative;
      overflow: hidden;
    }
    .auth-card::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 2px;
      background: linear-gradient(90deg, transparent, var(--cyber-cyan), transparent);
    }
  </style>
</head>
<body style="background-color:var(--cyber-bg);">

<div class="auth-wrapper">
  <div class="auth-card">
    <!-- Logo & Title -->
    <div class="text-center mb-4">
      <div style="display:inline-flex;align-items:center;justify-content:center;width:64px;height:64px;background:rgba(0,212,255,0.1);border:1px solid var(--cyber-border);border-radius:8px;margin-bottom:1rem;">
        <i class="bi bi-shield-lock-fill" style="font-size:2rem;color:var(--cyber-cyan);text-shadow:var(--cyber-glow-c);"></i>
      </div>
      <div style="font-family:var(--font-display);font-size:1.2rem;color:var(--cyber-cyan);letter-spacing:3px;">TTIS</div>
      <div style="font-family:var(--font-mono);font-size:0.7rem;color:var(--cyber-text-dim);letter-spacing:2px;margin-top:2px;">KAB. MUARA ENIM // SECURE ACCESS</div>
    </div>

    <?php if ($this->session->flashdata('error')): ?>
      <div style="background:rgba(255,59,92,0.1);border:1px solid rgba(255,59,92,0.4);color:var(--cyber-red);padding:0.75rem 1rem;border-radius:2px;margin-bottom:1.5rem;font-size:0.9rem;">
        <i class="bi bi-exclamation-octagon me-2"></i><?= $this->session->flashdata('error') ?>
      </div>
    <?php endif; ?>

    <form action="<?= base_url('auth/login') ?>" method="post">
      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

      <div class="mb-3">
        <label class="cyber-label"><i class="bi bi-person me-1"></i>Username</label>
        <input type="text" name="username" class="form-control cyber-input" placeholder="Masukkan username" required autofocus autocomplete="username">
      </div>

      <div class="mb-4">
        <label class="cyber-label"><i class="bi bi-key me-1"></i>Kata Sandi</label>
        <input type="password" name="password" class="form-control cyber-input" placeholder="••••••••" required autocomplete="current-password">
      </div>

      <button type="submit" class="btn btn-cyber w-100 py-2">
        <i class="bi bi-box-arrow-in-right me-2"></i>MASUK
      </button>
    </form>

    <div class="text-center mt-4">
      <a href="<?= base_url('auth/register') ?>" style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:0.8rem;text-decoration:none;">
        Belum punya akun? <span style="color:var(--cyber-cyan);">Daftar</span>
      </a>
    </div>

    <div class="text-center mt-3">
      <a href="<?= base_url() ?>" style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:0.75rem;text-decoration:none;">
        <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
      </a>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
