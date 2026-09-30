<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gis Faskes| <?= isset($judul) ? $judul : 'Peta' ?></title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style (AdminLTE base, akan dioverride di bawah) -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/adminlte.min.css">

  <!-- Tipografi: Sora untuk display/brand, Inter untuk body & UI -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Leaflet CSS & JS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

  <!-- ============================================================= -->
  <!-- TEMA: TEAL & CLEAN MINT                                        -->
  <!-- ============================================================= -->
  <style>
    :root {
      --teal-900: #0B4F4A;
      --teal-700: #0F766E;
      --teal-600: #12897F;
      --teal-500: #14B8A6;
      --mint-200: #99F6E4;
      --mint-100: #CCFBF1;
      --mint-50:  #F0FDFA;
      --ink-muted: #4B6B67;
    }

    body {
      font-family: 'Inter', -apple-system, sans-serif;
      background: var(--mint-50);
      color: var(--teal-900);
    }

    /* ── NAVBAR ─────────────────────────────────────────────────── */
    .main-header.navbar {
      background: #FFFFFF !important;
      border-bottom: none;
      box-shadow: 0 2px 18px rgba(15, 118, 110, 0.08);
      padding: 0.4rem 0;
    }

    .navbar-brand .brand-text {
      font-family: 'Sora', sans-serif;
      font-weight: 700;
      color: var(--teal-700) !important;
      letter-spacing: -0.01em;
    }

    .navbar-brand .brand-image {
      border: 2px solid var(--mint-200);
    }

    .navbar-nav .nav-link {
      color: var(--teal-900) !important;
      font-weight: 500;
      font-size: 0.94rem;
      padding: 0.6rem 0.9rem !important;
      border-radius: 8px;
      position: relative;
      transition: color 0.2s ease, background-color 0.2s ease;
    }

    .navbar-nav .nav-link:hover {
      color: var(--teal-700) !important;
      background: var(--mint-50);
    }

    /* Garis aksen tipis yang muncul di bawah nav-link saat hover */
    .navbar-nav > .nav-item > .nav-link::after {
      content: '';
      position: absolute;
      left: 0.9rem;
      right: 0.9rem;
      bottom: 0.15rem;
      height: 2px;
      background: var(--teal-500);
      border-radius: 2px;
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.25s ease;
    }

    .navbar-nav > .nav-item > .nav-link:hover::after {
      transform: scaleX(1);
    }

    /* Titik indikator "filter aktif" — signature element */
    .nav-item.dropdown .filter-dot {
      display: none;
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background: var(--teal-500);
      margin-left: 6px;
      box-shadow: 0 0 0 0 rgba(20, 184, 166, 0.6);
      animation: pulseDot 1.8s infinite;
    }

    .nav-item.dropdown.filter-active .filter-dot {
      display: inline-block;
    }

    @keyframes pulseDot {
      0%   { box-shadow: 0 0 0 0 rgba(20, 184, 166, 0.55); }
      70%  { box-shadow: 0 0 0 6px rgba(20, 184, 166, 0); }
      100% { box-shadow: 0 0 0 0 rgba(20, 184, 166, 0); }
    }

    /* ── DROPDOWN MENUS ─────────────────────────────────────────── */
    .dropdown-menu {
      border: none;
      border-radius: 12px;
      box-shadow: 0 12px 32px rgba(11, 79, 74, 0.14);
      padding: 0.5rem;
      margin-top: 0.5rem;
      animation: dropIn 0.16s ease;
    }

    @keyframes dropIn {
      from { opacity: 0; transform: translateY(-6px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .dropdown-item {
      border-radius: 8px;
      font-size: 0.9rem;
      color: var(--teal-900);
      transition: background-color 0.15s ease, color 0.15s ease, padding-left 0.15s ease;
    }

    .dropdown-item:hover,
    .dropdown-item:focus {
      background: var(--mint-100);
      color: var(--teal-700);
      padding-left: 1.1rem;
    }

    .dropdown-item.active,
    .dropdown-item:active {
      background: var(--teal-500) !important;
      color: #fff !important;
    }

    .dropdown-divider {
      border-top: 1px solid var(--mint-100);
      margin: 0.3rem 0;
    }

    #text-filter-aktif {
      color: var(--teal-500);
      font-weight: 600;
      font-size: 0.82rem;
    }

    /* ── SIDEBAR ────────────────────────────────────────────────── */
    .main-sidebar {
      background: linear-gradient(180deg, var(--teal-900) 0%, var(--teal-700) 100%) !important;
    }

    .brand-link {
      border-bottom: 1px solid rgba(255,255,255,0.12) !important;
    }

    .brand-link .brand-text {
      font-family: 'Sora', sans-serif;
      color: var(--mint-100) !important;
    }

    .user-panel .info a {
      color: #fff !important;
      font-weight: 600;
      font-size: 0.92rem;
    }

    .user-panel .image img {
      border: 2px solid var(--mint-200);
    }

    .nav-sidebar > .nav-item > .nav-link {
      border-radius: 8px;
      margin: 2px 8px;
      color: var(--mint-100) !important;
      transition: background-color 0.2s ease;
    }

    .nav-sidebar > .nav-item > .nav-link:hover,
    .nav-sidebar > .nav-item > .nav-link.active {
      background: rgba(153, 246, 228, 0.15) !important;
      color: #fff !important;
    }

    .nav-sidebar > .nav-item > .nav-link .nav-icon {
      color: var(--mint-200);
    }

    /* ── CONTENT AREA ───────────────────────────────────────────── */
    .content-wrapper {
      background: var(--mint-50) !important;
    }

    .alert-warning,
    .alert-danger {
      border-radius: 10px;
      border: none;
    }

    /* ── FOOTER ─────────────────────────────────────────────────── */
    .main-footer {
      background: #fff;
      border-top: 3px solid var(--teal-500);
      color: var(--ink-muted);
      font-size: 0.85rem;
    }

    .main-footer a {
      color: var(--teal-700);
      font-weight: 600;
    }

    /* ── LOGIN LINK (kanan navbar) ──────────────────────────────── */
    .navbar-nav.ml-auto .nav-link {
      background: var(--teal-500);
      color: #fff !important;
      border-radius: 8px;
      padding: 0.5rem 1.1rem !important;
      font-weight: 600;
      transition: background-color 0.2s ease, transform 0.15s ease;
    }

    .navbar-nav.ml-auto .nav-link:hover {
      background: var(--teal-700);
      transform: translateY(-1px);
    }
  </style>
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

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">

          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url() ?>" class="nav-link">Home</a>
            </li>

            <!-- Dropdown 1: Tentang Kami -->
           <!-- Dropdown 1: Tentang Kami -->
            <li class="nav-item dropdown">
              <a id="dropdownTentang" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                <i class="fas fa-info-circle mr-1"></i> Tentang Kami
              </a>
              <ul aria-labelledby="dropdownTentang" class="dropdown-menu border-0 shadow p-2" style="min-width: 280px;">
                <li>
                  <a href="#" class="dropdown-item py-2">
                    <span class="d-block font-weight-bold" style="color: var(--teal-700);"><i class="fas fa-map-marker-alt mr-1"></i> GIS Faskes</span>
                    <small class="text-wrap d-block" style="line-height: 1.4; color: var(--ink-muted);">Berisi informasi lokasi Fasilitas Kesehatan.</small>
                  </a>
                </li>
                <li class="dropdown-divider"></li>
                <li>
                  <a href="#" class="dropdown-item py-2">
                    <span class="d-block font-weight-bold" style="color: var(--teal-700);"><i class="fas fa-users mr-1"></i> Tim Kami</span>
                    <small class="text-wrap d-block" style="line-height: 1.4; color: var(--ink-muted);">Terdiri dari 3 Mahasiswa Informatika.</small>
                  </a>
                </li>
                <li class="dropdown-divider"></li>
                <li>
                  <a href="#" class="dropdown-item py-2" id="btnBukaFeedback" data-toggle="modal" data-target="#modalFeedback">
                    <span class="d-block font-weight-bold" style="color: var(--teal-700);"><i class="fas fa-comments mr-1"></i> Feedback</span>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Dropdown 2: Semua Wilayah -->
            <li class="nav-item dropdown">
              <a id="dropdownWilayah" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                <i class="fas fa-map-marked-alt mr-1"></i> Semua Wilayah <span class="filter-dot"></span>
              </a>
              <ul aria-labelledby="dropdownWilayah" class="dropdown-menu border-0 shadow" style="min-width: 220px;">
                <li><a href="#" class="dropdown-item filter-kecamatan" data-kecamatan="all"><i class="fas fa-globe mr-2" style="color: var(--teal-500);"></i>Tampilkan Semua</a></li>
                <li class="dropdown-divider"></li>
                <li><a href="#" class="dropdown-item filter-kecamatan" data-kecamatan="Bumiayu"><i class="fas fa-map-pin mr-2" style="color: var(--ink-muted);"></i>Kecamatan Bumiayu</a></li>
                <li><a href="#" class="dropdown-item filter-kecamatan" data-kecamatan="Paguyangan"><i class="fas fa-map-pin mr-2" style="color: var(--ink-muted);"></i>Kecamatan Paguyangan</a></li>
                <li><a href="#" class="dropdown-item filter-kecamatan" data-kecamatan="Sirampog"><i class="fas fa-map-pin mr-2" style="color: var(--ink-muted);"></i>Kecamatan Sirampog</a></li>
                <li><a href="#" class="dropdown-item filter-kecamatan" data-kecamatan="Tonjong"><i class="fas fa-map-pin mr-2" style="color: var(--ink-muted);"></i>Kecamatan Tonjong</a></li>
                <li><a href="#" class="dropdown-item filter-kecamatan" data-kecamatan="Bantarkawung"><i class="fas fa-map-pin mr-2" style="color: var(--ink-muted);"></i>Kecamatan Bantarkawung</a></li>
              </ul>
            </li>

            <!-- Dropdown Filter Jenis Faskes -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownFaskes" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-filter mr-1"></i> Jenis Faskes <span class="filter-dot"></span> <span id="text-filter-aktif"></span>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownFaskes">
                <a class="dropdown-item btn-filter-jenis" href="#" data-jenis="ALL"><i class="fas fa-th-large mr-2" style="color: var(--teal-500);"></i>Semua Faskes</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item btn-filter-jenis" href="#" data-jenis="RUMAH SAKIT"><i class="fas fa-hospital mr-2" style="color: var(--ink-muted);"></i>Rumah Sakit</a>
                <a class="dropdown-item btn-filter-jenis" href="#" data-jenis="PUSKESMAS"><i class="fas fa-clinic-medical mr-2" style="color: var(--ink-muted);"></i>Puskesmas</a>
                <a class="dropdown-item btn-filter-jenis" href="#" data-jenis="KLINIK"><i class="fas fa-briefcase-medical mr-2" style="color: var(--ink-muted);"></i>Klinik</a>
              </div>
            </li>
          </ul>

          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('auth/login') ?>">
                <i class="fas fa-sign-in-alt"></i> Login
              </a>
            </li>
          </ul>

        </div>
      </div>
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

  <!-- Modal Feedback -->
  <div class="modal fade" id="modalFeedback" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border:none; border-radius:14px;">
        <form id="formFeedback" novalidate>
          <?= csrf_field() ?>
          <div class="modal-header" style="border-bottom:1px solid var(--mint-100);">
            <h5 class="modal-title" style="font-family:'Sora',sans-serif; color:var(--teal-700);">
              <i class="fas fa-comments mr-2"></i>Kirim Feedback
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span>&times;</span></button>
          </div>

          <div class="modal-body">
            <div id="feedbackAlert"></div>

            <div class="form-group">
              <label for="fbNama">Nama <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="fbNama" name="nama" required>
              <div class="invalid-feedback"></div>
            </div>

            <div class="form-group">
              <label for="fbEmail">Email <small class="text-muted">(opsional)</small></label>
              <input type="email" class="form-control" id="fbEmail" name="email">
              <div class="invalid-feedback"></div>
            </div>

            <div class="form-group">
              <label for="fbRating">Penilaian <small class="text-muted">(opsional)</small></label>
              <select class="form-control" id="fbRating" name="rating">
                <option value="">- Pilih -</option>
                <option value="5">5 - Sangat baik</option>
                <option value="4">4 - Baik</option>
                <option value="3">3 - Cukup</option>
                <option value="2">2 - Kurang</option>
                <option value="1">1 - Buruk</option>
              </select>
            </div>

            <div class="form-group mb-0">
              <label for="fbPesan">Pesan <span class="text-danger">*</span></label>
              <textarea class="form-control" id="fbPesan" name="pesan" rows="4" required></textarea>
              <div class="invalid-feedback"></div>
            </div>
          </div>

          <div class="modal-footer" style="border-top:1px solid var(--mint-100);">
            <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn" id="btnKirimFeedback" style="background:var(--teal-500); color:#fff; font-weight:600;">
              <i class="fas fa-paper-plane mr-1"></i> Kirim
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- REQUIRED SCRIPTS -->
  <script src="<?= base_url('AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/dist/js/adminlte.min.js"></script>

  <!--
    PENTING:
    Engine filter kecamatan & jenis faskes TETAP sepenuhnya ditangani
    di file view "home" (window.geojsonLayers, window.faskesMarkers, dll).
    Script di bawah ini HANYA menangani 2 hal visual di navbar:
    1. Toggle buka/tutup dropdown (sudah ada sebelumnya)
    2. Titik indikator "filter aktif" (.filter-dot) — murni tampilan,
       tidak menyentuh logic filter peta sama sekali.
  -->
  <script>
    $(document).ready(function() {
      $('.navbar .dropdown-toggle').on('click', function(e) {
        e.preventDefault();
        let $el = $(this).next('.dropdown-menu');
        $('.dropdown-menu').not($el).hide();
        $el.toggle();
      });

      $(document).on('click', function(e) {
        if (!$(e.target).closest('.nav-item.dropdown').length) {
          $('.dropdown-menu').hide();
        }
      });
    });

    // Indikator titik "filter aktif" di sebelah label dropdown
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.filter-kecamatan, .btn-filter-jenis').forEach(function(el) {
        el.addEventListener('click', function() {
          var parentDropdown = el.closest('.nav-item.dropdown');
          if (!parentDropdown) return;

          var isSemua = (el.dataset.kecamatan === 'all') || (el.dataset.jenis === 'ALL');
          parentDropdown.classList.toggle('filter-active', !isSemua);
        });
      });
    });

    // ===== FEEDBACK =====
    $(function () {
      $('#btnBukaFeedback').on('click', function () {
        $('.dropdown-menu').hide();
      });

      function updateCsrf(token) {
        if (token) $('#formFeedback input[name="<?= csrf_token() ?>"]').val(token);
      }

      $('#formFeedback').on('submit', function (e) {
        e.preventDefault();

        var $form = $(this);
        var $btn  = $('#btnKirimFeedback');

        $form.find('.form-control').removeClass('is-invalid');
        $('#feedbackAlert').empty();
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Mengirim...');

        $.ajax({
          url: '<?= base_url('feedback/simpan') ?>',
          type: 'POST',
          data: $form.serialize(),
          dataType: 'json',
          headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .done(function (res) {
          $('#feedbackAlert').html('<div class="alert alert-success">' + res.message + '</div>');
          $form[0].reset();
          updateCsrf(res.token);
          setTimeout(function () {
            $('#modalFeedback').modal('hide');
            $('#feedbackAlert').empty();
          }, 1500);
        })
        .fail(function (xhr) {
          var res = xhr.responseJSON || {};
          if (res.errors) {
            $.each(res.errors, function (field, msg) {
              var $input = $form.find('[name="' + field + '"]');
              $input.addClass('is-invalid');
              $input.siblings('.invalid-feedback').text(msg);
            });
          } else {
            $('#feedbackAlert').html('<div class="alert alert-danger">Gagal mengirim feedback. Coba lagi.</div>');
          }
          if (res.token) updateCsrf(res.token);
        })
        .always(function () {
          $btn.prop('disabled', false).html('<i class="fas fa-paper-plane mr-1"></i> Kirim');
        });
      });
    });
  </script>
</body>

</html>