<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
/**
 * View: auth/login.php
 * Halaman Login Fasilitas Kesehatan — RSUD Sehat Medika
 * Versi paling sederhana: satu kolom, tanpa panel brand
 */
?>

<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  body.login-page,
  .wrapper.login-page {
    background: #E8EFF7 !important;
    min-height: 100vh;
    font-family: 'Segoe UI', Arial, sans-serif;
  }

  .hc-login-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    width: 100%;
    padding: 24px;
  }

  .hc-form-card {
    background: #fff;
    border-radius: 20px;
    padding: 44px 40px;
    width: 100%;
    max-width: 400px;
    box-shadow: 0 4px 20px rgba(15,32,64,.08);
  }

  .hc-form-title {
    color: #0F2040;
    font-size: 1.6rem;
    font-weight: 700;
    margin-bottom: 6px;
  }

  .hc-form-subtitle {
    color: #6B7A99;
    font-size: .85rem;
    margin-bottom: 26px;
  }

  .hc-alert {
    border-radius: 8px;
    padding: 12px 14px;
    font-size: .84rem;
    margin-bottom: 18px;
    border-left: 4px solid;
  }

  .hc-alert-error   { background: #FFF0F0; color: #C53030; border-color: #E53E3E; }
  .hc-alert-success { background: #F0FFF8; color: #276749; border-color: #38A169; }

  .hc-field-wrap { margin-bottom: 18px; }

  .hc-label {
    display: block;
    color: #374766;
    font-size: .82rem;
    font-weight: 600;
    margin-bottom: 6px;
  }

  .hc-input-group { position: relative; }

  .hc-input {
    width: 100%;
    height: 48px;
    padding: 0 42px;
    border: 1.5px solid #DDE4EF;
    border-radius: 10px;
    background: #F8FAFF;
    font-size: .9rem;
    outline: none;
  }

  .hc-input:focus {
    border-color: #00A896;
    box-shadow: 0 0 0 3px rgba(0,168,150,.12);
  }

  .hc-input.is-error { border-color: #E53E3E; background: #FFF8F8; }

  .hc-input-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #9BAAC4;
    font-size: .85rem;
  }

  .hc-pwd-toggle {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #9BAAC4;
    cursor: pointer;
  }

  .hc-field-error {
    color: #C53030;
    font-size: .76rem;
    margin-top: 5px;
  }

  .hc-meta-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
    font-size: .83rem;
  }

  .hc-checkbox-wrap { display: flex; align-items: center; gap: 6px; color: #6B7A99; cursor: pointer; }
  .hc-forgot { color: #00A896; font-weight: 600; text-decoration: none; }
  .hc-forgot:hover { text-decoration: underline; }

  .hc-btn-submit {
    width: 100%;
    height: 50px;
    background: #00A896;
    color: #fff;
    border: none;
    border-radius: 10px;
    font-size: .95rem;
    font-weight: 700;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-bottom: 16px;
  }

  .hc-btn-submit:hover:not(:disabled) { background: #007A6E; }
  .hc-btn-submit:disabled { opacity: .6; cursor: not-allowed; }

  .hc-spinner {
    width: 16px; height: 16px;
    border: 2px solid rgba(255,255,255,.4);
    border-top-color: #fff;
    border-radius: 50%;
    animation: spin .7s linear infinite;
    display: none;
  }

  @keyframes spin { to { transform: rotate(360deg); } }

  .hc-divider {
    text-align: center;
    color: #B0BCCD;
    font-size: .76rem;
    margin: 8px 0 16px;
    text-transform: uppercase;
  }

  .hc-btn-sso {
    width: 100%;
    height: 48px;
    border: 1.5px solid #DDE4EF;
    border-radius: 10px;
    background: #F8FAFF;
    color: #374766;
    font-size: .88rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    text-decoration: none;
  }

  .hc-btn-sso:hover { border-color: #00A896; color: #007A6E; text-decoration: none; }

  .hc-form-footer {
    margin-top: 24px;
    padding-top: 20px;
    border-top: 1px solid #EEF2F8;
    text-align: center;
    font-size: .76rem;
    color: #9BAAC4;
  }

  .hc-form-footer a { color: #00A896; font-weight: 600; text-decoration: none; }
  .hc-form-footer a:hover { text-decoration: underline; }

  body { background: #F0F5FB !important; }
  .content-wrapper { background: transparent !important; padding: 0 !important; margin: 0 !important; }
  .main-footer { display: none !important; }
</style>

<div class="hc-login-wrapper">
  <div class="hc-form-card">

    <h1 class="hc-form-title">Selamat Datang</h1>
    <p class="hc-form-subtitle">Masuk menggunakan email dan kata sandi akun Anda.</p>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="hc-alert hc-alert-error">
        <?= esc(session()->getFlashdata('error')) ?>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
      <div class="hc-alert hc-alert-success">
        <?= esc(session()->getFlashdata('success')) ?>
      </div>
    <?php endif; ?>

    <?= form_open('login', ['id' => 'hcLoginForm', 'method' => 'POST', 'novalidate' => true]) ?>

      <div class="hc-field-wrap">
        <label class="hc-label" for="email">Alamat Email</label>
        <div class="hc-input-group">
          <i class="fas fa-envelope hc-input-icon"></i>
          <input
            type="email"
            id="email"
            name="email"
            class="hc-input <?= isset($errors['email']) ? 'is-error' : '' ?>"
            placeholder="nama@rsudsehatmedika.id"
            value="<?= esc(old('email')) ?>"
            autocomplete="email"
            autofocus
          >
        </div>
        <?php if (isset($errors['email'])): ?>
          <div class="hc-field-error"><?= esc($errors['email']) ?></div>
        <?php endif; ?>
      </div>

      <div class="hc-field-wrap">
        <label class="hc-label" for="password">Kata Sandi</label>
        <div class="hc-input-group">
          <i class="fas fa-lock hc-input-icon"></i>
          <input
            type="password"
            id="password"
            name="password"
            class="hc-input <?= isset($errors['password']) ? 'is-error' : '' ?>"
            placeholder="Masukkan kata sandi"
            autocomplete="current-password"
            style="padding-right: 42px;"
          >
          <button type="button" class="hc-pwd-toggle" id="togglePwd" title="Tampilkan kata sandi">
            <i class="fas fa-eye" id="eyeIcon"></i>
          </button>
        </div>
        <?php if (isset($errors['password'])): ?>
          <div class="hc-field-error"><?= esc($errors['password']) ?></div>
        <?php endif; ?>
      </div>

      <div class="hc-meta-row">
        <label class="hc-checkbox-wrap">
          <input type="checkbox" name="remember" value="1" id="rememberMe">
          Ingat saya
        </label>
        <a href="<?= site_url('lupa-password') ?>" class="hc-forgot">Lupa kata sandi?</a>
      </div>

      <button type="submit" id="btnSubmit" class="hc-btn-submit">
        <div class="hc-spinner" id="btnSpinner"></div>
        <span id="btnText"><i class="fas fa-sign-in-alt"></i> Masuk ke Sistem</span>
      </button>

    <?= form_close() ?>

    <div class="hc-divider">atau</div>

    <a href="<?= base_url() ?>" class="hc-btn-sso">
      <i class="fas fa-arrow-left fa-xs"></i>
      Kembali Ke Halaman Home
    </a>

    <div class="hc-form-footer">
      Belum punya akses? Hubungi
      <a href="mailto:admin@rsudsehatmedika.id">Administrator IT</a>
      &nbsp;|&nbsp; Ext. <strong>101</strong>
      <br>
      &copy; <?= date('Y') ?> RSUD Sehat Medika — v2.0
    </div>

  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
(function () {
  'use strict';

  const toggleBtn = document.getElementById('togglePwd');
  const pwdInput  = document.getElementById('password');
  const eyeIcon   = document.getElementById('eyeIcon');

  if (toggleBtn) {
    toggleBtn.addEventListener('click', function () {
      const isHidden = pwdInput.type === 'password';
      pwdInput.type  = isHidden ? 'text' : 'password';
      eyeIcon.className = isHidden ? 'fas fa-eye-slash' : 'fas fa-eye';
    });
  }

  document.querySelectorAll('.hc-input').forEach(function (input) {
    input.addEventListener('input', function () {
      this.classList.remove('is-error');
      const err = this.closest('.hc-field-wrap')?.querySelector('.hc-field-error');
      if (err) err.style.display = 'none';
    });
  });

  const form       = document.getElementById('hcLoginForm');
  const btnSubmit  = document.getElementById('btnSubmit');
  const btnText    = document.getElementById('btnText');
  const spinner    = document.getElementById('btnSpinner');
  const emailInput = document.getElementById('email');

  if (form) {
    form.addEventListener('submit', function (e) {
      const email    = emailInput.value.trim();
      const password = pwdInput.value;
      let valid = true;

      if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        emailInput.classList.add('is-error');
        valid = false;
      }

      if (password.length < 6) {
        pwdInput.classList.add('is-error');
        valid = false;
      }

      if (!valid) {
        e.preventDefault();
        return;
      }

      btnText.style.display = 'none';
      spinner.style.display = 'block';
      btnSubmit.disabled = true;
    });
  }

  setTimeout(function () {
    document.querySelectorAll('.hc-alert').forEach(function (el) {
      el.style.transition = 'opacity .4s';
      el.style.opacity = '0';
      setTimeout(function () { el.remove(); }, 400);
    });
  }, 5000);

})();
</script>
<?= $this->endSection() ?>