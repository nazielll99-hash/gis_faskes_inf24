<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gis Faskes| <?= isset($judul) ? $judul : 'Peta' ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/adminlte.min.css">

  <!-- Leaflet CSS & JS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>

<body class="hold-transition sidebar-collapse layout-top-nav">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container-fluid">
        <a href="<?= base_url() ?>" class="navbar-brand d-flex align-items-center">
          <img src="<?= base_url('AdminLTE') ?>/dist/img/AdminLTELogo.png" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-bold ml-2">GIS Fasilitas Kesehatan</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Pembungkus Utama Collapse -->
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">

          <!-- 1. Menu Sebelah Kiri (Left navbar links) -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url() ?>" class="nav-link">Home</a>
            </li>

            <!-- Dropdown 1: Tentang Kami -->
            <li class="nav-item dropdown">
              <a id="dropdownTentang" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                <i class="fas fa-info-circle mr-1"></i> Tentang Kami
              </a>
              <ul aria-labelledby="dropdownTentang" class="dropdown-menu border-0 shadow p-2" style="min-width: 280px;">
                <li>
                  <a href="#" class="dropdown-item py-2">
                    <span class="d-block font-weight-bold text-primary"><i class="fas fa-map-marker-alt mr-1"></i> GIS Faskes</span>
                    <small class="text-wrap text-muted d-block" style="line-height: 1.4;">Berisi informasi lokasi Fasilitas Kesehatan.</small>
                  </a>
                </li>
                <li class="dropdown-divider"></li>
                <li>
                  <a href="#" class="dropdown-item py-2">
                    <span class="d-block font-weight-bold text-success"><i class="fas fa-users mr-1"></i> Tim Kami</span>
                    <small class="text-wrap text-muted d-block" style="line-height: 1.4;">Terdiri dari 3 Mahasiswa Informatika.</small>
                  </a>
                </li>
                <li class="dropdown-divider"></li>
                <li>
                  <a href="#" class="dropdown-item py-2">
                    <span class="d-block font-weight-bold text-warning"><i class="fas fa-comments mr-1"></i> Feedback</span>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Dropdown 2: Semua Wilayah -->
            <li class="nav-item dropdown">
              <a id="dropdownWilayah" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-muted">
                <i class="fas fa-map-marked-alt mr-1"></i> Semua Wilayah
              </a>
              <ul aria-labelledby="dropdownWilayah" class="dropdown-menu border-0 shadow" style="min-width: 220px;">
                <li><a href="#" class="dropdown-item filter-kecamatan" data-kecamatan="all"><i class="fas fa-globe mr-2 text-primary"></i>Tampilkan Semua</a></li>
                <li class="dropdown-divider"></li>
                <li><a href="#" class="dropdown-item filter-kecamatan" data-kecamatan="Bumiayu"><i class="fas fa-map-pin text-secondary mr-2"></i>Kecamatan Bumiayu</a></li>
                <li><a href="#" class="dropdown-item filter-kecamatan" data-kecamatan="Paguyangan"><i class="fas fa-map-pin text-secondary mr-2"></i>Kecamatan Paguyangan</a></li>
                <li><a href="#" class="dropdown-item filter-kecamatan" data-kecamatan="Sirampog"><i class="fas fa-map-pin text-secondary mr-2"></i>Kecamatan Sirampog</a></li>
                <li><a href="#" class="dropdown-item filter-kecamatan" data-kecamatan="Tonjong"><i class="fas fa-map-pin text-secondary mr-2"></i>Kecamatan Tonjong</a></li>
                <li><a href="#" class="dropdown-item filter-kecamatan" data-kecamatan="Bantarkawung"><i class="fas fa-map-pin text-secondary mr-2"></i>Kecamatan Bantarkawung</a></li>
              </ul>
            </li>
          </ul>

          <!-- 2. Menu Sebelah Kanan (Right navbar links) -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('auth/login') ?>">
                <i class="fas fa-sign-in-alt"></i> Login
              </a>
            </li>
          </ul>

        </div> <!-- Penutup #navbarCollapse -->
      </div> <!-- Penutup container-fluid -->
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="<?= base_url() ?>" class="brand-link">
        <img src="<?= base_url('AdminLTE') ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?= base_url('AdminLTE') ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
          </div>
        </div>

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
      <div class="content pt-3">
        <div class="container-fluid">
          <div class="row">

            <!-- PHP GUARD ANTI CRASH JIKA $PAGE KOSONG / ERROR -->
            <?php if (isset($page) && !empty($page)): ?>
              <?php
                try {
                  echo view($page);
                } catch (\Exception $e) {
                  echo '<div class="alert alert-danger w-100"><i class="fas fa-exclamation-triangle"></i> Gagal memuat file view: <b>' . esc($page) . '</b>. Pastikan file tersebut ada di folder app/Views/.</div>';
                }
              ?>
            <?php else: ?>
              <div class="alert alert-warning w-100">
                <i class="fas fa-info-circle"></i> Variabel <code>$page</code> belum dikirim dari Controller Anda.
              </div>
            <?php endif; ?>

          </div>
        </div>
      </div>
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <div class="float-right d-none d-sm-inline">Anything you want</div>
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="<?= base_url('AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 Bundle -->
  <script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('AdminLTE') ?>/dist/js/adminlte.min.js"></script>

  <!-- SCRIPT UI NAVBAR SAJA (bukan filter peta) -->
  <!--
    PENTING:
    Engine filter kecamatan (yang dulunya di sini, mencari
    window.geojsonLayer / window.geojson / feature.properties.nama_kecamatan)
    SUDAH DIHAPUS dari file layout ini.

    Alasan:
    1. Nama variabel global yang dicari ("geojsonLayer" tunggal) tidak pernah
       cocok dengan yang benar-benar dibuat di file view "home"
       (yaitu window.geojsonLayers, bentuk ARRAY jamak).
    2. File ini konflik/duplikat dengan handler ".filter-kecamatan" yang sudah
       ada dan sudah benar di file view "home".

    Filter kecamatan sekarang SEPENUHNYA ditangani di file view "home"
    (menggunakan Vanilla JS + window.geojsonLayers), jadi tidak perlu
    ditangani lagi di sini.
  -->
  <script>
    $(document).ready(function() {
      // Perbaikan Toggle Dropdown agar terhindar dari konflik AdminLTE vs Bootstrap 4
      $('.navbar .dropdown-toggle').on('click', function(e) {
        e.preventDefault();
        let $el = $(this).next('.dropdown-menu');
        $('.dropdown-menu').not($el).hide(); // Sembunyikan dropdown lain yang terbuka
        $el.toggle();
      });

      $(document).on('click', function(e) {
        if (!$(e.target).closest('.nav-item.dropdown').length) {
          $('.dropdown-menu').hide();
        }
      });
    });
  </script>
</body>

</html>