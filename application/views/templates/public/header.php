<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Tim Tanggap Insiden Siber Kabupaten Muara Enim" />
  <meta name="author" content="TTIS Muara Enim" />
  <title><?= isset($title) ? $title : ucfirst($this->router->fetch_method()); ?> | TTIS Kab. Muara Enim</title>

  <!-- Bootstrap 5 & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="<?= base_url(); ?>assets/favicon.ico" />

  <!-- Cybersecurity Theme -->
  <link href="<?= base_url(); ?>assets/css/cyber.css" rel="stylesheet" />
</head>