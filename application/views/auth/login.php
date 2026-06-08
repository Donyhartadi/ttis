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
    /* Canvas particle background */
    #particle-canvas {
      position: fixed;
      inset: 0;
      z-index: 0;
      pointer-events: none;
    }

    .auth-wrapper {
      position: relative;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem 1rem;
      z-index: 1;
    }

    .auth-card {
      width: 100%;
      max-width: 440px;
      background: rgba(10, 25, 41, 0.92);
      border: 1px solid var(--cyber-border);
      border-radius: 6px;
      padding: 2.5rem 2.2rem;
      box-shadow:
        0 0 60px rgba(0,0,0,.7),
        0 0 100px rgba(0,212,255,.05),
        inset 0 1px 0 rgba(0,212,255,.1);
      animation: fade-in-up .7s cubic-bezier(.22,1,.36,1);
      position: relative;
      overflow: hidden;
      backdrop-filter: blur(12px);
    }

    /* Top glow line */
    .auth-card::before {
      content: '';
      position: absolute;
      top: 0; left: 10%; right: 10%;
      height: 2px;
      background: linear-gradient(90deg, transparent, var(--cyber-cyan), var(--cyber-green), transparent);
      animation: shimmer 3s linear infinite;
      background-size: 200% 100%;
    }

    /* Corner brackets */
    .auth-card::after {
      content: '';
      position: absolute;
      bottom: 0; right: 0;
      width: 20px; height: 20px;
      border-right: 2px solid var(--cyber-cyan);
      border-bottom: 2px solid var(--cyber-cyan);
      opacity: .4;
    }

    .corner-tl-abs {
      position: absolute;
      top: 0; left: 0;
      width: 20px; height: 20px;
      border-top: 2px solid var(--cyber-cyan);
      border-left: 2px solid var(--cyber-cyan);
      opacity: .4;
    }

    .logo-ring {
      width: 72px; height: 72px;
      border-radius: 50%;
      border: 2px solid var(--cyber-cyan);
      background: rgba(0,212,255,.06);
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 1.25rem;
      box-shadow: 0 0 30px rgba(0,212,255,.25), inset 0 0 20px rgba(0,212,255,.05);
      animation: pulse-glow 3s ease-in-out infinite;
    }

    /* Form enhancements */
    .form-group-cyber { margin-bottom: 1.25rem; position: relative; }

    .input-icon-wrap {
      position: relative;
    }
    .input-icon-wrap .icon {
      position: absolute;
      left: .85rem;
      top: 50%;
      transform: translateY(-50%);
      color: var(--cyber-text-dim);
      font-size: .95rem;
      pointer-events: none;
      transition: color .2s;
      z-index: 2;
    }
    .input-icon-wrap input {
      padding-left: 2.5rem !important;
    }
    .input-icon-wrap input:focus + .icon-overlay ~ .icon,
    .input-icon-wrap input:focus ~ .icon {
      color: var(--cyber-cyan);
    }

    .show-pass-btn {
      position: absolute;
      right: .85rem;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: var(--cyber-text-dim);
      cursor: pointer;
      padding: 0;
      font-size: 1rem;
      transition: color .2s;
      z-index: 2;
    }
    .show-pass-btn:hover { color: var(--cyber-cyan); }

    .btn-login-cyber {
      position: relative;
      overflow: hidden;
      background: rgba(0,212,255,.1);
      border: 1px solid var(--cyber-cyan);
      color: var(--cyber-cyan);
      font-family: var(--font-display);
      font-size: .82rem;
      letter-spacing: 3px;
      text-transform: uppercase;
      width: 100%;
      padding: .75rem;
      border-radius: 3px;
      transition: all .3s ease;
      cursor: pointer;
    }
    .btn-login-cyber::before {
      content: '';
      position: absolute;
      top: 0; left: -100%;
      width: 100%; height: 100%;
      background: linear-gradient(90deg, transparent, rgba(0,212,255,.2), transparent);
      transition: left .5s ease;
    }
    .btn-login-cyber:hover {
      background: var(--cyber-cyan);
      color: var(--cyber-bg);
      box-shadow: 0 0 20px rgba(0,212,255,.5);
    }
    .btn-login-cyber:hover::before { left: 100%; }
    .btn-login-cyber:disabled {
      opacity: .7;
      cursor: not-allowed;
    }

    /* Scan line on card */
    @keyframes cardScan {
      0%   { top: 0%; }
      100% { top: 105%; }
    }
    .scan-line {
      position: absolute;
      left: 0; right: 0; height: 1px;
      background: linear-gradient(90deg, transparent, rgba(0,212,255,.15), transparent);
      pointer-events: none;
      animation: cardScan 4s linear infinite;
      z-index: 0;
    }
  </style>
</head>
<body style="background-color:var(--cyber-bg);overflow-x:hidden;">

<!-- Particle Canvas -->
<canvas id="particle-canvas"></canvas>

<div class="auth-wrapper">
  <div class="auth-card">
    <div class="corner-tl-abs"></div>
    <div class="scan-line"></div>

    <!-- Logo & Title -->
    <div class="text-center mb-4 position-relative" style="z-index:1;">
      <div class="logo-ring">
        <i class="bi bi-shield-lock-fill" style="font-size:1.8rem;color:var(--cyber-cyan);text-shadow:var(--cyber-glow-c);"></i>
      </div>
      <div style="font-family:var(--font-display);font-size:1.1rem;color:var(--cyber-cyan);letter-spacing:4px;text-shadow:var(--cyber-glow-c);">TTIS</div>
      <div style="font-family:var(--font-mono);font-size:.68rem;color:var(--cyber-text-dim);letter-spacing:2px;margin-top:3px;">KAB. MUARA ENIM <span style="color:var(--cyber-border);">//</span> SECURE ACCESS</div>
    </div>

    <?php if ($this->session->flashdata('error')): ?>
      <div style="background:rgba(255,59,92,.08);border:1px solid rgba(255,59,92,.35);border-left:3px solid var(--cyber-red);color:var(--cyber-red);padding:.7rem 1rem;border-radius:3px;margin-bottom:1.25rem;font-size:.88rem;animation:fade-in-up .4s ease;" role="alert">
        <i class="bi bi-exclamation-octagon me-2"></i><?= $this->session->flashdata('error') ?>
      </div>
    <?php endif; ?>

    <form id="login-form" action="<?= base_url('auth/login') ?>" method="post" data-loading-form data-loading-text="AUTHENTICATING...">
      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

      <!-- Username -->
      <div class="form-group-cyber">
        <label class="cyber-label" for="username"><i class="bi bi-terminal me-1" style="color:var(--cyber-cyan);font-size:.75rem;"></i>Username</label>
        <div class="input-icon-wrap">
          <input type="text"
                 id="username"
                 name="username"
                 class="form-control cyber-input"
                 placeholder="username"
                 required autofocus autocomplete="username"
                 style="font-family:var(--font-mono);">
          <i class="bi bi-person icon"></i>
        </div>
      </div>

      <!-- Password -->
      <div class="form-group-cyber">
        <label class="cyber-label" for="password"><i class="bi bi-key me-1" style="color:var(--cyber-cyan);font-size:.75rem;"></i>Kata Sandi</label>
        <div class="input-icon-wrap" style="position:relative;">
          <input type="password"
                 id="password"
                 name="password"
                 class="form-control cyber-input"
                 placeholder="••••••••"
                 required autocomplete="current-password"
                 style="font-family:var(--font-mono);padding-right:2.5rem !important;">
          <i class="bi bi-lock icon"></i>
          <button type="button" class="show-pass-btn" id="toggle-pass" title="Tampilkan sandi" aria-label="Tampilkan sandi">
            <i class="bi bi-eye-slash" id="toggle-pass-icon"></i>
          </button>
        </div>
      </div>

      <!-- Submit -->
      <button type="submit" class="btn-login-cyber mt-2" id="login-btn">
        <span id="login-btn-text"><i class="bi bi-box-arrow-in-right me-2"></i>MASUK</span>
      </button>
    </form>

    <div class="text-center mt-4" style="position:relative;z-index:1;">
      <a href="<?= base_url('auth/register') ?>" style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:.78rem;text-decoration:none;transition:color .2s;">
        Belum punya akun? <span style="color:var(--cyber-cyan);">Daftar &rarr;</span>
      </a>
    </div>

    <div class="text-center mt-2" style="position:relative;z-index:1;">
      <a href="<?= base_url() ?>" style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:.72rem;text-decoration:none;transition:color .2s;">
        <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
      </a>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/react@18/umd/react.production.min.js" crossorigin></script>
<script src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js" crossorigin></script>
<script src="<?= base_url('assets/js/app.js') ?>?v=2"></script>

<script>
/* ===== PARTICLE BACKGROUND ===== */
(function() {
  const canvas = document.getElementById('particle-canvas');
  if (!canvas) return;
  const ctx = canvas.getContext('2d');

  let W, H, particles = [], animId;
  const COUNT = Math.min(60, Math.floor(window.innerWidth / 24));

  function resize() {
    W = canvas.width  = window.innerWidth;
    H = canvas.height = window.innerHeight;
  }

  function rand(min, max) { return Math.random() * (max - min) + min; }

  function createParticle() {
    return {
      x: rand(0, W), y: rand(0, H),
      vx: rand(-0.3, 0.3), vy: rand(-0.3, 0.3),
      r: rand(1, 2.5),
      opacity: rand(0.15, 0.5),
      color: Math.random() > 0.6 ? '#00d4ff' : Math.random() > 0.5 ? '#00ff88' : '#5a7a8a'
    };
  }

  function init() {
    resize();
    particles = Array.from({ length: COUNT }, createParticle);
  }

  function draw() {
    ctx.clearRect(0, 0, W, H);

    // Draw connections
    for (let i = 0; i < particles.length; i++) {
      for (let j = i + 1; j < particles.length; j++) {
        const dx = particles[i].x - particles[j].x;
        const dy = particles[i].y - particles[j].y;
        const dist = Math.sqrt(dx * dx + dy * dy);
        if (dist < 140) {
          ctx.beginPath();
          ctx.moveTo(particles[i].x, particles[i].y);
          ctx.lineTo(particles[j].x, particles[j].y);
          ctx.strokeStyle = `rgba(0,212,255,${(1 - dist / 140) * 0.1})`;
          ctx.lineWidth = .6;
          ctx.stroke();
        }
      }
    }

    // Draw particles
    particles.forEach(p => {
      p.x += p.vx;
      p.y += p.vy;
      if (p.x < 0) p.x = W;
      if (p.x > W) p.x = 0;
      if (p.y < 0) p.y = H;
      if (p.y > H) p.y = 0;

      ctx.beginPath();
      ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
      ctx.fillStyle = p.color.replace(')', `,${p.opacity})`).replace('rgb', 'rgba');
      // Use hex color with alpha
      ctx.fillStyle = hexWithAlpha(p.color, p.opacity);
      ctx.fill();
    });

    animId = requestAnimationFrame(draw);
  }

  function hexWithAlpha(hex, alpha) {
    if (hex.startsWith('#')) {
      const r = parseInt(hex.slice(1, 3), 16);
      const g = parseInt(hex.slice(3, 5), 16);
      const b = parseInt(hex.slice(5, 7), 16);
      return `rgba(${r},${g},${b},${alpha})`;
    }
    return hex;
  }

  window.addEventListener('resize', () => { resize(); });
  init();
  draw();
})();

/* ===== SHOW/HIDE PASSWORD ===== */
document.getElementById('toggle-pass').addEventListener('click', function() {
  const input = document.getElementById('password');
  const icon  = document.getElementById('toggle-pass-icon');
  const isPass = input.type === 'password';
  input.type = isPass ? 'text' : 'password';
  icon.className = isPass ? 'bi bi-eye' : 'bi bi-eye-slash';
});

/* ===== INPUT FOCUS ICON COLOR ===== */
document.querySelectorAll('.input-icon-wrap input').forEach(input => {
  input.addEventListener('focus', () => {
    const icon = input.parentElement.querySelector('.icon');
    if (icon) icon.style.color = 'var(--cyber-cyan)';
  });
  input.addEventListener('blur', () => {
    const icon = input.parentElement.querySelector('.icon');
    if (icon) icon.style.color = 'var(--cyber-text-dim)';
  });
});
</script>
</body>
</html>
