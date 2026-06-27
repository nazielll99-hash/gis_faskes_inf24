<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
/**
 * View: auth/login.php
 * Template AdminLTE 3 — Halaman Login Fasilitas Kesehatan
 */
?>

<div class="faskes-login-wrapper">

  <!-- ── PANEL KIRI: BRAND ───────────────────────────── -->
  <div class="faskes-brand-panel d-none d-lg-flex">
    <div class="brand-inner">

      <!-- Logo & nama RS -->
      <div class="brand-logo-wrap mb-4">
        <div class="brand-icon">
          <i class="fas fa-hospital-alt fa-2x text-white"></i>
        </div>
        <div class="ml-3">
          <h4 class="brand-rs-name mb-0">RSUD Sehat Medika</h4>
          <small class="text-light opacity-75 text-uppercase letter-spacing-1">
            Sistem Informasi Fasilitas Kesehatan
          </small>
        </div>
      </div>

      <!-- Salib medis (signature) -->
      <div class="medical-cross-wrap my-4">
        <div class="cross-horizontal"></div>
        <div class="cross-vertical"></div>
        <div class="cross-dot"><i class="fas fa-heartbeat fa-xs"></i></div>
      </div>

      <h2 class="brand-tagline">
        Layanan Kesehatan<br>yang Cerdas &amp; Terpercaya
      </h2>
      <p class="brand-desc mt-3">
        Platform manajemen fasilitas kesehatan terintegrasi untuk mendukung
        pelayanan medis yang lebih cepat, aman, dan efisien bagi seluruh
        tenaga kesehatan.
      </p>

      <!-- Statistik -->
      <div class="brand-stats mt-5">
        <div class="stat-item">
          <span class="stat-num">12K+</span>
          <span class="stat-label">Pasien / Bulan</span>
        </div>
        <div class="stat-item">
          <span class="stat-num">320</span>
          <span class="stat-label">Tenaga Medis</span>
        </div>
        <div class="stat-item">
          <span class="stat-num">99.9%</span>
          <span class="stat-label">Uptime Sistem</span>
        </div>
      </div>

      <!-- Akreditasi -->
      <div class="brand-accredited mt-4">
        <i class="fas fa-certificate mr-1"></i>
        Terakreditasi KARS Paripurna
      </div>

    </div>
  </div>

  <!-- ── PANEL KANAN: FORM ────────────────────────────── -->
  <div class="faskes-form-panel">
    <div class="faskes-form-card">

      <!-- Logo mobile (tampil hanya di layar kecil) -->
      <div class="text-center mb-4 d-lg-none">
        <div class="brand-icon mx-auto mb-2" style="width:54px;height:54px;">
          <i class="fas fa-hospital-alt fa-lg text-white"></i>
        </div>
        <h5 class="text-dark font-weight-bold">RSUD Sehat Medika</h5>
        <small class="text-muted">Sistem Informasi Fasilitas Kesehatan</small>
      </div>

      <div class="form-header mb-4">
        <h3 class="form-title">Selamat Datang</h3>
        <p class="text-muted">
          Masuk ke akun Anda untuk mengakses sistem manajemen fasilitas kesehatan.
        </p>
      </div>

      <!-- ── FLASH MESSAGES ── -->
      <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="fas fa-exclamation-circle mr-2"></i>
          <?= esc(session()->getFlashdata('error')) ?>
          <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="fas fa-check-circle mr-2"></i>
          <?= esc(session()->getFlashdata('success')) ?>
          <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <!-- ── FORM LOGIN ── -->
      <?= form_open('login', [
          'id'         => 'loginForm',
          'class'      => '',
          'method'     => 'POST',
          'novalidate' => true,
      ]) ?>

        <!-- Input: Username / NIK -->
        <div class="form-group">
          <label for="username">
            <i class="fas fa-user-md mr-1 text-primary"></i>
            Username / NIK Pegawai
          </label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-white border-right-0">
                <i class="fas fa-id-card text-muted"></i>
              </span>
            </div>
            <input
              type="text"
              id="username"
              name="username"
              class="form-control border-left-0 <?= isset($errors['username']) ? 'is-invalid' : '' ?>"
              placeholder="Masukkan username atau NIK"
              value="<?= esc(old('username')) ?>"
              autocomplete="username"
              autofocus
            >
            <?php if (isset($errors['username'])): ?>
              <div class="invalid-feedback">
                <i class="fas fa-times-circle mr-1"></i>
                <?= esc($errors['username']) ?>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- Input: Kata Sandi -->
        <div class="form-group">
          <label for="password">
            <i class="fas fa-lock mr-1 text-primary"></i>
            Kata Sandi
          </label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-white border-right-0">
                <i class="fas fa-key text-muted"></i>
              </span>
            </div>
            <input
              type="password"
              id="password"
              name="password"
              class="form-control border-left-0 border-right-0 <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
              placeholder="Masukkan kata sandi"
              autocomplete="current-password"
            >
            <div class="input-group-append">
              <button type="button" class="btn btn-outline-secondary border-left-0"
                      id="togglePassword" title="Tampilkan/Sembunyikan kata sandi">
                <i class="fas fa-eye" id="eyeIcon"></i>
              </button>
            </div>
            <?php if (isset($errors['password'])): ?>
              <div class="invalid-feedback">
                <i class="fas fa-times-circle mr-1"></i>
                <?= esc($errors['password']) ?>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- Ingat Saya & Lupa Password -->
        <div class="row mb-3">
          <div class="col-7">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input"
                     id="rememberMe" name="remember" value="1">
              <label class="custom-control-label text-muted" for="rememberMe">
                Ingat saya
              </label>
            </div>
          </div>
          <div class="col-5 text-right">
            <a href="<?= site_url('lupa-password') ?>" class="text-primary small">
              Lupa kata sandi?
            </a>
          </div>
        </div>

        <!-- Tombol Submit -->
        <div class="form-group mt-2">
          <button type="submit" id="btnSubmit"
                  class="btn btn-primary btn-block btn-login font-weight-semibold">
            <span id="btnText">
              <i class="fas fa-sign-in-alt mr-2"></i>Masuk ke Sistem
            </span>
            <span id="btnLoading" class="d-none">
              <span class="spinner-border spinner-border-sm mr-2" role="status"></span>
              Memverifikasi...
            </span>
          </button>
        </div>

      <?= form_close() ?>

      <!-- Divider SSO -->
      <div class="divider-text my-3">
        <span>atau masuk melalui</span>
      </div>

      <!-- Tombol SSO SatuSehat -->
      <a href="<?= site_url('sso/satusehat') ?>"
         class="btn btn-outline-secondary btn-block btn-sso">
        <i class="fas fa-shield-alt mr-2 text-success"></i>
        SSO SatuSehat / BPJS Kesehatan
      </a>

      <!-- Footer form -->
      <div class="form-footer mt-4 pt-3 border-top text-center">
        <p class="text-muted small mb-1">
          Butuh akses? Hubungi
          <a href="mailto:admin@rsudsehatmedika.id" class="text-primary">Administrator IT</a>
          atau ext. <strong>101</strong>
        </p>
        <p class="text-muted" style="font-size:.7rem;">
          &copy; <?= date('Y') ?> RSUD Sehat Medika — v2.0
        </p>
      </div>

    </div><!-- /faskes-form-card -->
  </div><!-- /faskes-form-panel -->

</div><!-- /faskes-login-wrapper -->

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function () {

  // ── Toggle Password ────────────────────────────
  $('#togglePassword').on('click', function () {
    const $input   = $('#password');
    const $icon    = $('#eyeIcon');
    const isHidden = $input.attr('type') === 'password';

    $input.attr('type', isHidden ? 'text' : 'password');
    $icon.toggleClass('fa-eye', !isHidden)
         .toggleClass('fa-eye-slash', isHidden);
    $(this).attr('title', isHidden ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
  });

  // ── Hapus state error saat user mengetik ───────
  $('#username, #password').on('input', function () {
    $(this).removeClass('is-invalid');
    $(this).siblings('.invalid-feedback').hide();
  });

  // ── Loading state saat submit ──────────────────
  $('#loginForm').on('submit', function (e) {
    const username = $.trim($('#username').val());
    const password  = $('#password').val();
    let valid = true;

    // Validasi sisi klien (backup)
    if (username.length < 3) {
      $('#username').addClass('is-invalid');
      valid = false;
    }
    if (password.length < 6) {
      $('#password').addClass('is-invalid');
      valid = false;
    }

    if (!valid) {
      e.preventDefault();
      return;
    }

    // Tampilkan loading
    $('#btnText').addClass('d-none');
    $('#btnLoading').removeClass('d-none');
    $('#btnSubmit').prop('disabled', true);
  });

  // ── Auto-dismiss alert setelah 5 detik ─────────
  setTimeout(function () {
    $('.alert').alert('close');
  }, 5000);

});
</script>
<?= $this->endSection() ?>
