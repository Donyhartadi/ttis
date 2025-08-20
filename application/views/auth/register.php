<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Akun</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-primary d-flex align-items-center justify-content-center" style="min-height: 100vh;">

<div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
  <h4 class="text-center mb-3">Daftar Akun</h4>

  <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
  <?php endif; ?>
  <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
  <?php endif; ?>

  <form action="<?= base_url('auth/register') ?>" method="post">
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" name="username" class="form-control" required autofocus>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Kata Sandi</label>
      <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="password2" class="form-label">Ulangi Kata Sandi</label>
      <input type="password" name="password2" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success w-100">Daftar</button>
    <a href="<?= base_url('auth/login') ?>" class="d-block text-center mt-2 text-decoration-none">Sudah punya akun? Masuk</a>
  </form>
</div>

</body>
</html>
