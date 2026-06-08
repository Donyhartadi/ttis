<!-- Admin Footer -->
<footer style="background:var(--cyber-bg2);border-top:1px solid var(--cyber-border);padding:1rem 0;margin-top:auto;">
  <div class="container-fluid px-4 d-flex align-items-center justify-content-between flex-wrap gap-2">
    <small style="color:var(--cyber-text-dim);font-family:var(--font-mono);">
      &copy; <?= date('Y') ?> TTIS Kab. Muara Enim &mdash; Admin Panel
    </small>
    <small style="color:var(--cyber-text-dim);font-family:var(--font-mono);font-size:.7rem;">
      <span class="status-dot online"></span>SISTEM AKTIF
    </small>
  </div>
</footer>

<!-- Flash toast bridge -->
<?php if ($this->session->flashdata('success')): ?>
<div id="__ttis_flash__" data-msg="<?= htmlspecialchars($this->session->flashdata('success')) ?>" data-type="success" style="display:none;"></div>
<?php elseif ($this->session->flashdata('error')): ?>
<div id="__ttis_flash__" data-msg="<?= htmlspecialchars($this->session->flashdata('error')) ?>" data-type="error" style="display:none;"></div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/react@18/umd/react.production.min.js" crossorigin></script>
<script src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js" crossorigin></script>
<script src="<?= base_url('assets/js/app.js') ?>?v=2"></script>
</body>
</html>