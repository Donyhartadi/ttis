<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Lapor Insiden Siber</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="<?= base_url(); ?>assets/favicon.ico" />
  <link href="<?= base_url(); ?>assets/css/styles.css" rel="stylesheet" />

  <style>
.hero-img {
  height: 90vh;
  object-fit: cover;
  object-position: center;
}

.custom-caption {
  background: rgba(0, 0, 0, 0.5);
  border-radius: 2px;
  padding: 10px;
  max-width: 700px;
  margin: auto;
}

.custom-caption h2 {
  font-size: 2.5rem;
  font-weight: 700;
}

.custom-caption p {
  font-size: 1.25rem;
}

.btn-cta {
  font-size: 1rem;
  padding: 10px 20px;
  border-radius: 8px;
}

/* Mobile Responsive */
@media (max-width: 768px) {
  .hero-img {
    height: 85vh;
  }

  .custom-caption {
    padding: 20px;
  }

  .custom-caption h2 {
    font-size: 1.5rem;
  }

  .custom-caption p {
    font-size: 1rem;
  }

  .btn-cta {
    font-size: 0.9rem;
    padding: 8px 16px;
  }
}


</style>

</head>