<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Akun &mdash; TTIS Muara Enim</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url('assets/css/cyber.css') ?>" rel="stylesheet">
  <style>
    #particle-canvas { position: fixed; inset: 0; z-index: 0; pointer-events: none; }

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
      width: 100%; max-width: 440px;
      background: rgba(10,25,41,.92);
      border: 1px solid var(--cyber-border);
      border-radius: 6px;
      padding: 2.5rem 2.2rem;
      box-shadow: 0 0 60px rgba(0,0,0,.7), 0 0 100px rgba(0,255,136,.04);
      animation: fade-in-up .7s cubic-bezier(.22,1,.36,1);
      position: relative;
      overflow: hidden;
      backdrop-filter: blur(12px);
    }

    .auth-card::before {
      content: '';
      position: absolute;
      top: 0; left: 10%; right: 10%;
      height: 2px;
      background: linear-gradient(90deg, transparent, var(--cyber-green), var(--cyber-cyan), transparent);
    }
    .auth-card::after {
      content: '';
      position: absolute;
      bottom: 0; right: 0;
      width: 20px; height: 20px;
      border-right: 2px solid var(--cyber-green);
      border-bottom: 2px solid var(--cyber-green);
      opacity: .4;
    }
    .corner-tl-abs {
      position: absolute; top: 0; left: 0;
      width: 20px; height: 20px;
      border-top: 2px solid var(--cyber-green);
      border-left: 2px solid var(--cyber-green);
      opacity: .4;
    }

    .logo-ring {
      width: 72px; height: 72px;
      border-radius: 50%;
      border: 2px solid var(--cyber-green);
      background: rgba(0,255,136,.06);
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 1.25rem;
      box-shadow: 0 0 30px rgba(0,255,136,.2), inset 0 0 20px rgba(0,255,136,.04);
      animation: pulse-glow 3s ease-in-out infinite;
    }

    .form-group-cyber { margin-bottom: 1.2rem; }

    .strength-bar { height: 3px; border-radius: 2px; transition: width .4s ease, background .4s ease; margin-top: .4rem; }

    .btn-register-cyber {
      position: relative; overflow: hidden;
      background: rgba(0,255,136,.1);
      border: 1px solid var(--cyber-green);
      color: var(--cyber-green);
      font-family: var(--font-display);
      font-size: .82rem; letter-spacing: 3px; text-transform: uppercase;
      width: 100%; padding: .75rem;
      border-radius: 3px;
      transition: all .3s ease;
      cursor: pointer;
    }
    .btn-register-cyber:hover {
      background: var(--cyber-green);
      color: var(--cyber-bg);
      box-shadow: 0 0 20px rgba(0,255,136,.4);
    }
    .btn-register-cyber:disabled { opacity: .7; cursor: not-allowed; }

    .scan-line { position: absolute; left: 0; right: 0; height: 1px;
      background: linear-gradient(90deg, transparent, rgba(0,255,136,.1), transparent);
      pointer-events: none; animation: cardScan 4s linear infinite; z-index: 0; }
    @keyframes cardScan { 0% { top: 0%; } 100% { top: 105%; } }
  </style>
</head>
<body style="background-color:var(--cyber-bg);overflow-x:hidden;">

<canvas id="particle-canvas"></canvas>

<div class="auth-wrapper">
  <div class="auth-card">
    <div class="corner-tl-abs"></div>
    <div class="scan-line"></div>

    <!-- Logo & Title -->
    <div class="text-center mb-4 position-relative" style="z-index:1;">
      <div class="logo-ring">
        <i class="bi bi-person-plus-fill" style="font-size:1.8rem;color:var(--cyber-green);text-shadow:var(--cyber-glow-g);"></i>
      </div>
      <div style="font-family:var(--font-display);font-size:1rem;color:var(--cyber-green);letter-spacing:4px;text-shadow:var(--cyber-glow-g);">DAFTAR AKUN</div>
      <div style="font-family:var(--font-mono);font-size:.68rem;color:var(--cyber-text-dim);letter-spacing:2px;margin-top:3px;">TTIS <span style="color:var(--cyber-border);">//</span> MUARA ENIM</div>
    </div>

    <?php if ($this->session->flashdata('error')): ?>
      <div style="background:rgba(255,59,92,.08);border:1px solid rgba(255,59,92,.35);border-left:3px solid var(--cyber-red);color:var(--cyber-red);padding:.7rem 1rem;border-radius:3px;margin-bottom:1.2rem;font-size:.88rem;">
        <i class="bi bi-exclamation-octagon me-2"></i><?= $this->session->flashdata('error') ?>
      </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('success')): ?>
      <div style="background:rgba(0,255,136,.08);border:1px solid rgba(0,255,136,.35);border-left:3px solid var(--cyber-green);color:var(--cyber-green);padding:.7rem 1rem;border-radius:3px;margin-bottom:1.2rem;font-size:.88rem;">
        <i class="bi bi-check-circle me-2"></i><?= $this->session->flashdata('success') ?>
      </div>
    <?php endif; ?>

    <form id="register-form" action="<?= base_url('auth/register') ?>" method="post" data-loading-form data-loading-text="MENDAFTAR...">
      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

      <div class="form-group-cyber">
        <label class="cyber-label" for="reg-username"><i class="bi bi-terminal me-1" style="color:var(--cyber-green);font-size:.75rem;"></i>Username</label>
        <input type="text" id="reg-username" name="username" class="form-control cyber-input"
               placeholder="Buat username unik" required autofocus autocomplete="username"
               style="font-family:var(--font-mono);">
      </div>

      <div class="form-group-cyber">
        <label class="cyber-label" for="reg-pass"><i class="bi bi-key me-1" style="color:var(--cyber-green);font-size:.75rem;"></i>Kata Sandi</label>
        <input type="password" id="reg-pass" name="password" class="form-control cyber-input"
               placeholder="Min. 8 karakter" required autocomplete="new-password"
               style="font-family:var(--font-mono);">
        <!-- Strength bar -->
        <div id="strength-bar" class="strength-bar mt-1" style="width:0%;background:var(--cyber-red);"></div>
        <small id="strength-label" style="font-family:var(--font-mono);font-size:.65rem;color:var(--cyber-text-dim);"></small>
      </div>

      <div class="form-group-cyber">
        <label class="cyber-label" for="reg-pass2"><i class="bi bi-key-fill me-1" style="color:var(--cyber-green);font-size:.75rem;"></i>Ulangi Kata Sandi</label>
        <input type="password" id="reg-pass2" name="password2" class="form-control cyber-input"
               placeholder="Masukkan ulang kata sandi" required autocomplete="new-password"
               style="font-family:var(--font-mono);">
        <small id="match-label" style="font-family:var(--font-mono);font-size:.65rem;"></small>
      </div>

      <button type="submit" class="btn-register-cyber mt-1" id="register-btn">
        <i class="bi bi-person-check me-2"></i>DAFTAR
      </button>
    </form>

    <div class="text-center mt-4" style="position:relative;z-index:1;">
      <a href="<?= base_url('auth/login') ?>" style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:.78rem;text-decoration:none;">
        Sudah punya akun? <span style="color:var(--cyber-cyan);">Login &rarr;</span>
      </a>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/react@18/umd/react.production.min.js" crossorigin></script>
<script src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js" crossorigin></script>
<script src="<?= base_url('assets/js/app.js') ?>?v=2"></script>

<script>
/* ===== PARTICLE BACKGROUND (reuse login particle logic) ===== */
(function() {
  const canvas = document.getElementById('particle-canvas');
  if (!canvas) return;
  const ctx = canvas.getContext('2d');
  let W, H, particles = [];
  const COUNT = Math.min(55, Math.floor(window.innerWidth / 26));

  function rand(a, b) { return Math.random() * (b - a) + a; }
  function resize() { W = canvas.width = window.innerWidth; H = canvas.height = window.innerHeight; }
  function hexAlpha(hex, a) {
    const r = parseInt(hex.slice(1,3),16), g = parseInt(hex.slice(3,5),16), b = parseInt(hex.slice(5,7),16);
    return `rgba(${r},${g},${b},${a})`;
  }

  function init() {
    resize();
    particles = Array.from({length: COUNT}, () => ({
      x: rand(0,W), y: rand(0,H),
      vx: rand(-.25,.25), vy: rand(-.25,.25),
      r: rand(1,2.2),
      opacity: rand(.1,.4),
      color: Math.random() > .5 ? '#00ff88' : Math.random() > .5 ? '#00d4ff' : '#5a7a8a'
    }));
  }

  function draw() {
    ctx.clearRect(0,0,W,H);
    for (let i = 0; i < particles.length; i++) {
      for (let j = i+1; j < particles.length; j++) {
        const dx = particles[i].x - particles[j].x, dy = particles[i].y - particles[j].y;
        const d = Math.sqrt(dx*dx + dy*dy);
        if (d < 130) {
          ctx.beginPath();
          ctx.moveTo(particles[i].x, particles[i].y);
          ctx.lineTo(particles[j].x, particles[j].y);
          ctx.strokeStyle = `rgba(0,255,136,${(1-d/130)*.08})`;
          ctx.lineWidth = .5;
          ctx.stroke();
        }
      }
    }
    particles.forEach(p => {
      p.x += p.vx; p.y += p.vy;
      if (p.x < 0) p.x = W; if (p.x > W) p.x = 0;
      if (p.y < 0) p.y = H; if (p.y > H) p.y = 0;
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.r, 0, Math.PI*2);
      ctx.fillStyle = hexAlpha(p.color, p.opacity);
      ctx.fill();
    });
    requestAnimationFrame(draw);
  }

  window.addEventListener('resize', resize);
  init(); draw();
})();

/* ===== PASSWORD STRENGTH METER ===== */
document.getElementById('reg-pass').addEventListener('input', function() {
  const v = this.value;
  const bar = document.getElementById('strength-bar');
  const lbl = document.getElementById('strength-label');
  let score = 0;
  if (v.length >= 8) score++;
  if (/[A-Z]/.test(v)) score++;
  if (/[0-9]/.test(v)) score++;
  if (/[^A-Za-z0-9]/.test(v)) score++;

  const cfg = [
    { w: '0%', c: 'var(--cyber-red)', t: '' },
    { w: '25%', c: 'var(--cyber-red)', t: '[ LEMAH ]' },
    { w: '50%', c: 'var(--cyber-amber)', t: '[ SEDANG ]' },
    { w: '75%', c: 'var(--cyber-cyan)', t: '[ KUAT ]' },
    { w: '100%', c: 'var(--cyber-green)', t: '[ SANGAT KUAT ]' }
  ];
  const s = cfg[score] || cfg[0];
  bar.style.width = v.length ? s.w : '0%';
  bar.style.background = s.c;
  lbl.textContent = v.length ? s.t : '';
  lbl.style.color = s.c;
});

/* ===== PASSWORD MATCH INDICATOR ===== */
document.getElementById('reg-pass2').addEventListener('input', function() {
  const pass = document.getElementById('reg-pass').value;
  const lbl  = document.getElementById('match-label');
  if (!this.value) { lbl.textContent = ''; return; }
  const match = pass === this.value;
  lbl.textContent = match ? '[ KATA SANDI COCOK ✓ ]' : '[ KATA SANDI TIDAK COCOK ]';
  lbl.style.color  = match ? 'var(--cyber-green)' : 'var(--cyber-red)';
  this.style.borderColor = match ? 'var(--cyber-green)' : 'rgba(255,59,92,.5)';
});
</script>
</body>
</html>
