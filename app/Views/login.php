<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
/**
 * View: auth/login.php
 * Template: Halaman Login Fasilitas Kesehatan — RSUD Sehat Medika
 * Redesigned for clarity, trust, and visual identity
 */
?>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

  /* ── RESET & BASE ─────────────────────────────── */
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  body.login-page,
  .wrapper.login-page {
    background: #E8EFF7 !important;
    min-height: 100vh;
    font-family: 'Inter', sans-serif;
  }

  /* ── LAYOUT WRAPPER ──────────────────────────── */
  .hc-login-wrapper {
    display: flex;
    min-height: 100vh;
    width: 100%;
  }

  /* ══════════════════════════════════════════════
     PANEL KIRI — HERO VISUAL
  ══════════════════════════════════════════════ */
  .hc-hero {
    flex: 0 0 52%;
    background: linear-gradient(155deg, #0B1E3D 0%, #0F2D5A 45%, #0A3D6B 100%);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 48px 52px;
    position: relative;
    overflow: hidden;
  }

  /* Subtle grid texture */
  .hc-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image:
      linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
      linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
    background-size: 48px 48px;
    pointer-events: none;
  }

  /* Glow accent top-right */
  .hc-hero::after {
    content: '';
    position: absolute;
    top: -120px;
    right: -80px;
    width: 420px;
    height: 420px;
    background: radial-gradient(circle, rgba(0,168,150,.22) 0%, transparent 70%);
    pointer-events: none;
  }

  /* ── Brand header ── */
  .hc-brand {
    display: flex;
    align-items: center;
    gap: 14px;
    position: relative;
    z-index: 1;
  }

  .hc-brand-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #00A896, #00C9A7);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 16px rgba(0,168,150,.4);
    flex-shrink: 0;
  }

  .hc-brand-icon svg { width: 26px; height: 26px; }

  .hc-brand-name {
    color: #fff;
    font-size: 1.05rem;
    font-weight: 700;
    line-height: 1.2;
    letter-spacing: -.01em;
  }

  .hc-brand-sub {
    color: rgba(255,255,255,.5);
    font-size: .68rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: .08em;
    margin-top: 2px;
  }

  /* ── Hero centre ── */
  .hc-hero-centre {
    position: relative;
    z-index: 1;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 40px 0 20px;
  }

  .hc-hero-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(0,168,150,.18);
    border: 1px solid rgba(0,168,150,.35);
    border-radius: 100px;
    padding: 5px 14px;
    color: #00C9A7;
    font-size: .72rem;
    font-weight: 600;
    letter-spacing: .04em;
    text-transform: uppercase;
    width: fit-content;
    margin-bottom: 22px;
  }

  .hc-hero-pill span.dot {
    width: 6px; height: 6px;
    background: #00C9A7;
    border-radius: 50%;
    animation: pulse-dot 2s infinite;
  }

  @keyframes pulse-dot {
    0%, 100% { opacity: 1; transform: scale(1); }
    50%       { opacity: .4; transform: scale(.7); }
  }

  .hc-hero-headline {
    color: #fff;
    font-size: 2.4rem;
    font-weight: 700;
    line-height: 1.2;
    letter-spacing: -.03em;
    margin-bottom: 18px;
  }

  .hc-hero-headline em {
    font-style: normal;
    background: linear-gradient(90deg, #00C9A7, #4DD9CC);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .hc-hero-desc {
    color: rgba(255,255,255,.6);
    font-size: .9rem;
    line-height: 1.7;
    max-width: 380px;
    margin-bottom: 36px;
  }

  /* ── SVG Illustration area ── */
  .hc-illustration {
    width: 100%;
    max-width: 440px;
    margin-bottom: 36px;
  }

  /* ── Stats strip ── */
  .hc-stats {
    display: flex;
    gap: 0;
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 16px;
    overflow: hidden;
    backdrop-filter: blur(8px);
    background: rgba(255,255,255,.04);
  }

  .hc-stat {
    flex: 1;
    padding: 18px 20px;
    text-align: center;
    border-right: 1px solid rgba(255,255,255,.1);
  }

  .hc-stat:last-child { border-right: none; }

  .hc-stat-num {
    display: block;
    color: #fff;
    font-size: 1.4rem;
    font-weight: 700;
    letter-spacing: -.02em;
    line-height: 1;
  }

  .hc-stat-label {
    display: block;
    color: rgba(255,255,255,.45);
    font-size: .67rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: .06em;
    margin-top: 4px;
  }

  /* ── Hero footer ── */
  .hc-hero-footer {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    gap: 8px;
    color: rgba(255,255,255,.35);
    font-size: .72rem;
  }

  .hc-hero-footer .badge-kars {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: rgba(245,166,35,.12);
    border: 1px solid rgba(245,166,35,.3);
    color: #F5A623;
    border-radius: 8px;
    padding: 4px 10px;
    font-size: .7rem;
    font-weight: 600;
  }

  /* ══════════════════════════════════════════════
     PANEL KANAN — FORM
  ══════════════════════════════════════════════ */
  .hc-form-panel {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 32px;
    background: #F0F5FB;
  }

  .hc-form-card {
    background: #fff;
    border-radius: 24px;
    padding: 44px 40px;
    width: 100%;
    max-width: 420px;
    box-shadow:
      0 2px 4px rgba(15,32,64,.04),
      0 8px 24px rgba(15,32,64,.08),
      0 32px 64px rgba(15,32,64,.06);
  }

  /* ── Form header ── */
  .hc-form-eyebrow {
    color: #00A896;
    font-size: .72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .1em;
    margin-bottom: 8px;
  }

  .hc-form-title {
    color: #0F2040;
    font-size: 1.7rem;
    font-weight: 700;
    letter-spacing: -.03em;
    line-height: 1.15;
    margin-bottom: 8px;
  }

  .hc-form-subtitle {
    color: #6B7A99;
    font-size: .87rem;
    line-height: 1.6;
    margin-bottom: 28px;
  }

  /* ── Alerts ── */
  .hc-alert {
    border-radius: 12px;
    padding: 12px 16px;
    font-size: .84rem;
    margin-bottom: 20px;
    display: flex;
    align-items: flex-start;
    gap: 10px;
    border: none;
  }

  .hc-alert-error {
    background: #FFF0F0;
    color: #C53030;
    border-left: 4px solid #E53E3E;
  }

  .hc-alert-success {
    background: #F0FFF8;
    color: #276749;
    border-left: 4px solid #38A169;
  }

  .hc-alert-icon { flex-shrink: 0; margin-top: 1px; }

  /* ── Form fields ── */
  .hc-field-wrap { margin-bottom: 20px; }

  .hc-label {
    display: block;
    color: #374766;
    font-size: .82rem;
    font-weight: 600;
    margin-bottom: 7px;
    letter-spacing: -.01em;
  }

  .hc-input-group {
    position: relative;
  }

  .hc-input-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #9BAAC4;
    font-size: .85rem;
    pointer-events: none;
    transition: color .2s;
  }

  .hc-input {
    width: 100%;
    height: 48px;
    padding: 0 44px 0 42px;
    border: 1.5px solid #DDE4EF;
    border-radius: 12px;
    background: #F8FAFF;
    color: #0F2040;
    font-family: 'Inter', sans-serif;
    font-size: .9rem;
    font-weight: 500;
    transition: border-color .2s, box-shadow .2s, background .2s;
    outline: none;
    -webkit-appearance: none;
  }

  .hc-input::placeholder { color: #B0BCCD; font-weight: 400; }

  .hc-input:focus {
    border-color: #00A896;
    background: #fff;
    box-shadow: 0 0 0 4px rgba(0,168,150,.1);
  }

  .hc-input:focus + .hc-input-icon,
  .hc-input-group:focus-within .hc-input-icon { color: #00A896; }

  .hc-input.is-error {
    border-color: #E53E3E;
    background: #FFF8F8;
  }

  .hc-input.is-error:focus { box-shadow: 0 0 0 4px rgba(229,62,62,.1); }

  .hc-field-error {
    color: #C53030;
    font-size: .76rem;
    font-weight: 500;
    margin-top: 6px;
    display: flex;
    align-items: center;
    gap: 4px;
  }

  /* password toggle */
  .hc-pwd-toggle {
    position: absolute;
    right: 13px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #9BAAC4;
    cursor: pointer;
    padding: 4px;
    line-height: 1;
    transition: color .2s;
  }

  .hc-pwd-toggle:hover { color: #0F2040; }

  /* ── Row: ingat saya + lupa ── */
  .hc-meta-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
  }

  .hc-checkbox-wrap {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    user-select: none;
  }

  .hc-checkbox-wrap input[type=checkbox] {
    width: 17px;
    height: 17px;
    accent-color: #00A896;
    cursor: pointer;
    border-radius: 4px;
  }

  .hc-checkbox-label {
    color: #6B7A99;
    font-size: .83rem;
    font-weight: 500;
  }

  .hc-forgot {
    color: #00A896;
    font-size: .83rem;
    font-weight: 600;
    text-decoration: none;
    transition: color .2s;
  }

  .hc-forgot:hover { color: #007A6E; text-decoration: underline; }

  /* ── Submit button ── */
  .hc-btn-submit {
    width: 100%;
    height: 50px;
    background: linear-gradient(135deg, #00A896 0%, #007A6E 100%);
    color: #fff;
    border: none;
    border-radius: 12px;
    font-family: 'Inter', sans-serif;
    font-size: .95rem;
    font-weight: 700;
    letter-spacing: -.01em;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: opacity .2s, transform .15s, box-shadow .2s;
    box-shadow: 0 4px 16px rgba(0,168,150,.35);
    margin-bottom: 16px;
  }

  .hc-btn-submit:hover:not(:disabled) {
    opacity: .92;
    transform: translateY(-1px);
    box-shadow: 0 8px 24px rgba(0,168,150,.4);
  }

  .hc-btn-submit:active:not(:disabled) { transform: translateY(0); }
  .hc-btn-submit:disabled { opacity: .65; cursor: not-allowed; }

  .hc-spinner {
    width: 18px; height: 18px;
    border: 2px solid rgba(255,255,255,.35);
    border-top-color: #fff;
    border-radius: 50%;
    animation: spin .7s linear infinite;
    display: none;
  }

  @keyframes spin { to { transform: rotate(360deg); } }

  /* ── Divider ── */
  .hc-divider {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 8px 0 16px;
    color: #B0BCCD;
    font-size: .76rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: .06em;
  }

  .hc-divider::before, .hc-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #DDE4EF;
  }

  /* ── SSO Button ── */
  .hc-btn-sso {
    width: 100%;
    height: 48px;
    border: 1.5px solid #DDE4EF;
    border-radius: 12px;
    background: #F8FAFF;
    color: #374766;
    font-family: 'Inter', sans-serif;
    font-size: .88rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    text-decoration: none;
    transition: border-color .2s, background .2s, box-shadow .2s;
  }

  .hc-btn-sso:hover {
    border-color: #00A896;
    background: #F0FEFC;
    color: #007A6E;
    text-decoration: none;
    box-shadow: 0 2px 8px rgba(0,168,150,.12);
  }

  .hc-btn-sso .sso-logo {
    width: 20px; height: 20px;
    background: linear-gradient(135deg, #00A896, #0F2D5A);
    border-radius: 5px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  /* ── Form footer ── */
  .hc-form-footer {
    margin-top: 24px;
    padding-top: 20px;
    border-top: 1px solid #EEF2F8;
    text-align: center;
  }

  .hc-form-footer p {
    color: #9BAAC4;
    font-size: .76rem;
    line-height: 1.6;
    margin-bottom: 4px;
  }

  .hc-form-footer a { color: #00A896; font-weight: 600; text-decoration: none; }
  .hc-form-footer a:hover { text-decoration: underline; }

  /* ══════════════════════════════════════════════
     RESPONSIVE
  ══════════════════════════════════════════════ */
  @media (max-width: 991px) {
    .hc-hero { display: none; }
    .hc-form-panel { background: linear-gradient(155deg, #0B1E3D, #0F2D5A); }
    .hc-form-card { max-width: 460px; }
  }

  @media (max-width: 480px) {
    .hc-form-panel { padding: 24px 16px; }
    .hc-form-card { padding: 32px 24px; border-radius: 20px; }
    .hc-form-title { font-size: 1.45rem; }
  }

  /* ── Fix AdminLTE body overrides ── */
  body { background: #F0F5FB !important; }
  .content-wrapper { background: transparent !important; padding: 0 !important; margin: 0 !important; }
  .main-footer { display: none !important; }
</style>

<div class="hc-login-wrapper">

  <!-- ══ PANEL KIRI: HERO ══ -->
  <div class="hc-hero">

    <!-- Brand -->
    <div class="hc-brand">
      <div class="hc-brand-icon">
        <svg viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect x="11" y="3" width="4" height="20" rx="2" fill="white"/>
          <rect x="3" y="11" width="20" height="4" rx="2" fill="white"/>
        </svg>
      </div>
      <div>
        <div class="hc-brand-name">RSUD Sehat Medika</div>
        <div class="hc-brand-sub">Sistem Informasi Fasilitas Kesehatan</div>
      </div>
    </div>

    <!-- Centre -->
    <div class="hc-hero-centre">
      <div class="hc-hero-pill">
        <span class="dot"></span>
        Sistem Aktif &amp; Terhubung
      </div>

      <h2 class="hc-hero-headline">
        Manajemen<br>Kesehatan yang<br><em>Cerdas &amp; Efisien</em>
      </h2>

      <p class="hc-hero-desc">
        Platform terintegrasi untuk mendukung seluruh tenaga medis
        dalam memberikan pelayanan yang cepat, aman, dan akurat
        bagi setiap pasien.
      </p>

      <!-- SVG Illustration: Hospital building + ECG line -->
      <div class="hc-illustration">
        <svg viewBox="0 0 440 220" fill="none" xmlns="http://www.w3.org/2000/svg">
          <!-- Sky gradient bg -->
          <defs>
            <linearGradient id="skyGrad" x1="0" y1="0" x2="0" y2="1">
              <stop offset="0%" stop-color="#0A3D6B"/>
              <stop offset="100%" stop-color="#0F2D5A" stop-opacity="0"/>
            </linearGradient>
            <linearGradient id="buildGrad" x1="0" y1="0" x2="0" y2="1">
              <stop offset="0%" stop-color="#1A4A7A"/>
              <stop offset="100%" stop-color="#102E58"/>
            </linearGradient>
            <linearGradient id="ecgGrad" x1="0" y1="0" x2="1" y2="0">
              <stop offset="0%" stop-color="#00A896" stop-opacity="0"/>
              <stop offset="30%" stop-color="#00C9A7"/>
              <stop offset="70%" stop-color="#00C9A7"/>
              <stop offset="100%" stop-color="#00A896" stop-opacity="0"/>
            </linearGradient>
            <filter id="glow">
              <feGaussianBlur stdDeviation="3" result="coloredBlur"/>
              <feMerge><feMergeNode in="coloredBlur"/><feMergeNode in="SourceGraphic"/></feMerge>
            </filter>
          </defs>

          <!-- Ground line -->
          <rect x="0" y="185" width="440" height="35" fill="rgba(0,0,0,.15)" rx="4"/>

          <!-- ── Main hospital building ── -->
          <rect x="140" y="70" width="160" height="115" fill="url(#buildGrad)" rx="4"/>
          <!-- Roof detail -->
          <rect x="155" y="58" width="130" height="16" fill="#1A4A7A" rx="3"/>
          <!-- Building top stripe -->
          <rect x="140" y="70" width="160" height="6" fill="#00A896" rx="1"/>

          <!-- Windows - row 1 -->
          <rect x="158" y="88" width="22" height="18" fill="rgba(0,200,180,.25)" rx="2"/>
          <rect x="192" y="88" width="22" height="18" fill="rgba(255,255,255,.18)" rx="2"/>
          <rect x="226" y="88" width="22" height="18" fill="rgba(0,200,180,.25)" rx="2"/>
          <rect x="260" y="88" width="22" height="18" fill="rgba(255,255,255,.18)" rx="2"/>

          <!-- Windows - row 2 -->
          <rect x="158" y="116" width="22" height="18" fill="rgba(255,255,255,.18)" rx="2"/>
          <rect x="192" y="116" width="22" height="18" fill="rgba(0,200,180,.3)" rx="2"/>
          <rect x="226" y="116" width="22" height="18" fill="rgba(255,255,255,.18)" rx="2"/>
          <rect x="260" y="116" width="22" height="18" fill="rgba(0,200,180,.25)" rx="2"/>

          <!-- Windows - row 3 -->
          <rect x="158" y="144" width="22" height="18" fill="rgba(0,200,180,.2)" rx="2"/>
          <rect x="192" y="144" width="22" height="18" fill="rgba(255,255,255,.15)" rx="2"/>
          <rect x="226" y="144" width="22" height="18" fill="rgba(0,200,180,.2)" rx="2"/>
          <rect x="260" y="144" width="22" height="18" fill="rgba(255,255,255,.15)" rx="2"/>

          <!-- Main entrance -->
          <rect x="198" y="152" width="44" height="33" fill="#0D2548" rx="3"/>
          <rect x="202" y="156" width="16" height="29" fill="rgba(0,168,150,.3)" rx="2"/>
          <rect x="222" y="156" width="16" height="29" fill="rgba(0,168,150,.2)" rx="2"/>

          <!-- Cross sign on building -->
          <rect x="213" y="36" width="8" height="26" fill="#00C9A7" rx="3"/>
          <rect x="206" y="43" width="22" height="8" fill="#00C9A7" rx="3"/>

          <!-- ── Left wing building ── -->
          <rect x="68" y="108" width="78" height="77" fill="url(#buildGrad)" rx="3"/>
          <rect x="68" y="108" width="78" height="5" fill="#007A6E" rx="1"/>
          <!-- Left wing windows -->
          <rect x="80" y="120" width="18" height="14" fill="rgba(255,255,255,.15)" rx="2"/>
          <rect x="108" y="120" width="18" height="14" fill="rgba(0,200,180,.2)" rx="2"/>
          <rect x="80" y="144" width="18" height="14" fill="rgba(0,200,180,.2)" rx="2"/>
          <rect x="108" y="144" width="18" height="14" fill="rgba(255,255,255,.15)" rx="2"/>

          <!-- ── Right wing building ── -->
          <rect x="294" y="100" width="80" height="85" fill="url(#buildGrad)" rx="3"/>
          <rect x="294" y="100" width="80" height="5" fill="#007A6E" rx="1"/>
          <!-- Right wing windows -->
          <rect x="306" y="114" width="18" height="14" fill="rgba(0,200,180,.2)" rx="2"/>
          <rect x="334" y="114" width="18" height="14" fill="rgba(255,255,255,.15)" rx="2"/>
          <rect x="306" y="138" width="18" height="14" fill="rgba(255,255,255,.15)" rx="2"/>
          <rect x="334" y="138" width="18" height="14" fill="rgba(0,200,180,.2)" rx="2"/>
          <rect x="306" y="162" width="18" height="14" fill="rgba(0,200,180,.15)" rx="2"/>
          <rect x="334" y="162" width="18" height="14" fill="rgba(255,255,255,.1)" rx="2"/>

          <!-- ── Trees ── -->
          <ellipse cx="44" cy="170" rx="22" ry="18" fill="rgba(0,120,100,.45)"/>
          <rect x="41" y="178" width="6" height="12" fill="rgba(0,80,60,.5)"/>
          <ellipse cx="400" cy="168" rx="20" ry="16" fill="rgba(0,120,100,.4)"/>
          <rect x="397" y="176" width="6" height="12" fill="rgba(0,80,60,.5)"/>

          <!-- ── Ambulance ── -->
          <rect x="356" y="168" width="50" height="22" fill="#E8EFF7" rx="4"/>
          <rect x="356" y="168" width="18" height="22" fill="#DDE4EF" rx="4"/>
          <circle cx="368" cy="192" r="5" fill="#374766"/>
          <circle cx="398" cy="192" r="5" fill="#374766"/>
          <rect x="366" y="171" width="5" height="9" fill="#00A896" rx="1"/>
          <rect x="363" y="174" width="11" height="3" fill="#00A896" rx="1"/>
          <!-- Lights -->
          <rect x="358" y="169" width="6" height="4" fill="#E53E3E" rx="1"/>

          <!-- ── ECG Line ── -->
          <polyline
            points="0,155 60,155 75,155 85,130 92,172 100,130 108,155 120,155 440,155"
            stroke="url(#ecgGrad)"
            stroke-width="2.5"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
            filter="url(#glow)"
          />

          <!-- Animated dot on ECG -->
          <circle cx="108" cy="155" r="4" fill="#00C9A7" filter="url(#glow)" opacity=".9">
            <animate attributeName="opacity" values="0.9;0.2;0.9" dur="2s" repeatCount="indefinite"/>
          </circle>
        </svg>
      </div>

      <!-- Stats -->
      <div class="hc-stats">
        <div class="hc-stat">
          <span class="hc-stat-num">12K+</span>
          <span class="hc-stat-label">Pasien / Bulan</span>
        </div>
        <div class="hc-stat">
          <span class="hc-stat-num">320</span>
          <span class="hc-stat-label">Tenaga Medis</span>
        </div>
        <div class="hc-stat">
          <span class="hc-stat-num">99.9%</span>
          <span class="hc-stat-label">Uptime Sistem</span>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <div class="hc-hero-footer">
      <span class="badge-kars">
        <i class="fas fa-certificate"></i>
        KARS Paripurna
      </span>
      <span>&copy; <?= date('Y') ?> RSUD Sehat Medika</span>
    </div>

  </div><!-- /hc-hero -->

  <!-- ══ PANEL KANAN: FORM ══ -->
  <div class="hc-form-panel">
    <div class="hc-form-card">

      <div class="hc-form-eyebrow">Portal Staf Medis</div>
      <h1 class="hc-form-title">Selamat Datang</h1>
      <p class="hc-form-subtitle">
        Masuk menggunakan email dan kata sandi akun Anda.
      </p>

      <!-- Flash: Error -->
      <?php if (session()->getFlashdata('error')): ?>
        <div class="hc-alert hc-alert-error" role="alert">
          <span class="hc-alert-icon">
            <i class="fas fa-exclamation-circle"></i>
          </span>
          <span><?= esc(session()->getFlashdata('error')) ?></span>
        </div>
      <?php endif; ?>

      <!-- Flash: Success -->
      <?php if (session()->getFlashdata('success')): ?>
        <div class="hc-alert hc-alert-success" role="alert">
          <span class="hc-alert-icon">
            <i class="fas fa-check-circle"></i>
          </span>
          <span><?= esc(session()->getFlashdata('success')) ?></span>
        </div>
      <?php endif; ?>

      <!-- ── FORM ── -->
      <?= form_open('login', [
          'id'         => 'hcLoginForm',
          'method'     => 'POST',
          'novalidate' => true,
      ]) ?>

        <!-- Email -->
        <div class="hc-field-wrap">
          <label class="hc-label" for="email">Alamat Email</label>
          <div class="hc-input-group">
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
            <i class="fas fa-envelope hc-input-icon"></i>
          </div>
          <?php if (isset($errors['email'])): ?>
            <div class="hc-field-error">
              <i class="fas fa-times-circle"></i>
              <?= esc($errors['email']) ?>
            </div>
          <?php endif; ?>
        </div>

        <!-- Password -->
        <div class="hc-field-wrap">
          <label class="hc-label" for="password">Kata Sandi</label>
          <div class="hc-input-group">
            <input
              type="password"
              id="password"
              name="password"
              class="hc-input <?= isset($errors['password']) ? 'is-error' : '' ?>"
              placeholder="Masukkan kata sandi"
              autocomplete="current-password"
              style="padding-right: 46px;"
            >
            <i class="fas fa-lock hc-input-icon"></i>
            <button type="button" class="hc-pwd-toggle" id="togglePwd" title="Tampilkan kata sandi">
              <i class="fas fa-eye" id="eyeIcon"></i>
            </button>
          </div>
          <?php if (isset($errors['password'])): ?>
            <div class="hc-field-error">
              <i class="fas fa-times-circle"></i>
              <?= esc($errors['password']) ?>
            </div>
          <?php endif; ?>
        </div>

        <!-- Ingat saya + Lupa kata sandi -->
        <div class="hc-meta-row">
          <label class="hc-checkbox-wrap">
            <input type="checkbox" name="remember" value="1" id="rememberMe">
            <span class="hc-checkbox-label">Ingat saya</span>
          </label>
          <a href="<?= site_url('lupa-password') ?>" class="hc-forgot">Lupa kata sandi?</a>
        </div>

        <!-- Submit -->
        <button type="submit" id="btnSubmit" class="hc-btn-submit">
          <div class="hc-spinner" id="btnSpinner"></div>
          <span id="btnText">
            <i class="fas fa-sign-in-alt"></i>
            Masuk ke Sistem
          </span>
        </button>

      <?= form_close() ?>

      <!-- Divider -->
      <div class="hc-divider">atau</div>

      <!-- SSO SatuSehat -->
      <a href="<?= site_url('sso/satusehat') ?>" class="hc-btn-sso">
        <span class="sso-logo">
          <i class="fas fa-shield-alt fa-xs" style="color:#fff;"></i>
        </span>
        SSO SatuSehat / BPJS Kesehatan
      </a>

      <!-- Footer -->
      <div class="hc-form-footer">
        <p>
          Belum punya akses? Hubungi
          <a href="mailto:admin@rsudsehatmedika.id">Administrator IT</a>
          &nbsp;|&nbsp; Ext. <strong>101</strong>
        </p>
        <p>&copy; <?= date('Y') ?> RSUD Sehat Medika — v2.0</p>
      </div>

    </div><!-- /hc-form-card -->
  </div><!-- /hc-form-panel -->

</div><!-- /hc-login-wrapper -->

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
(function () {
  'use strict';

  // ── Toggle Password ────────────────────────────
  const toggleBtn = document.getElementById('togglePwd');
  const pwdInput  = document.getElementById('password');
  const eyeIcon   = document.getElementById('eyeIcon');

  if (toggleBtn) {
    toggleBtn.addEventListener('click', function () {
      const isHidden = pwdInput.type === 'password';
      pwdInput.type  = isHidden ? 'text' : 'password';
      eyeIcon.className = isHidden ? 'fas fa-eye-slash' : 'fas fa-eye';
      this.title = isHidden ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi';
    });
  }

  // ── Clear error state on input ─────────────────
  document.querySelectorAll('.hc-input').forEach(function (input) {
    input.addEventListener('input', function () {
      this.classList.remove('is-error');
      const err = this.closest('.hc-field-wrap')?.querySelector('.hc-field-error');
      if (err) err.style.display = 'none';
    });
  });

  // ── Form submit with loading state ────────────
  const form      = document.getElementById('hcLoginForm');
  const btnSubmit = document.getElementById('btnSubmit');
  const btnText   = document.getElementById('btnText');
  const spinner   = document.getElementById('btnSpinner');
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

      // Loading state
      btnText.style.display    = 'none';
      spinner.style.display    = 'block';
      btnSubmit.disabled       = true;
    });
  }

  // ── Auto-dismiss flash alerts ──────────────────
  setTimeout(function () {
    document.querySelectorAll('.hc-alert').forEach(function (el) {
      el.style.transition = 'opacity .4s';
      el.style.opacity    = '0';
      setTimeout(function () { el.remove(); }, 400);
    });
  }, 5000);

})();
</script>
<?= $this->endSection() ?>