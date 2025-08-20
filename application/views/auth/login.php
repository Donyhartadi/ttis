<!-- application/views/auth/login.php -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - TTIS</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
  body {
    min-height: 100vh;
    display: flex;
    align-items: flex-start; /* biar mulai dari atas */
    justify-content: center;
    background-color: #0d6efd; /* warna biru primary */
    padding-top: 40px; /* naikkan jarak dari atas */
  }

  .login-card {
    max-width: 400px;
    width: 100%;
    background-color: #ffffff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  }
</style>

</head>
<body>

<div class="card login-card shadow">
  <div class="card-body">
    <!-- LOGO -->
    <div class="text-center mb-3">
      <img src="<?= base_url('assets/logo/muaraenim.png') ?>" alt="Logo" width="120">
    </div>

    <h5 class="text-center mb-4">TIM TANGGAP INSIDEN SIBER KABUPATEN MUARA ENIM</h5>

    <?php if ($this->session->flashdata('error')): ?>
      <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
    <?php endif; ?>

 <form action="<?= base_url('auth/login') ?>" method="post">
  <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
         value="<?= $this->security->get_csrf_hash(); ?>">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username" class="form-control" required autofocus>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Kata Sandi</label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">Masuk</button>
     
    </form>
  </div> <a href="<?= base_url('auth/register'); ?>" class="btn btn-outline-dark w-100 mt-2">Daftar Akun</a>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
