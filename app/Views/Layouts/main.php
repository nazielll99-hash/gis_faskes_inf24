<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="<?= csrf_hash() ?>">
  <title><?= esc($title ?? 'SIFASKES') ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap">
  <!-- Font Awesome 6 -->
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- AdminLTE 3 -->
  <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <!-- Custom override -->
  <link rel="stylesheet" href="<?= base_url('css/faskes.css') ?>">
</head>
<body class="<?= $bodyClass ?? '' ?>">

<?= $this->renderSection('content') ?>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<?= $this->renderSection('scripts') ?>
</body>
</html>
