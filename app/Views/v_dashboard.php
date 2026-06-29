<!-- Stat Cards -->
<div class="col-12 mb-3">
  <div class="row g-3">
    <div class="col-md-3 col-6">
      <div class="card h-100" style="border-left: 4px solid #1a73e8; background: linear-gradient(135deg, #e8f0fe, #fff);">
        <div class="card-body py-3">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <div class="text-muted small fw-semibold">Total Faskes</div>
              <div class="fw-bold" style="font-size:1.8rem; color:#1a73e8;">24</div>
            </div>
            <div style="background:#1a73e8; border-radius:12px; padding:10px;">
              <i class="fas fa-map-marker-alt text-white" style="font-size:1.4rem;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-6">
      <div class="card h-100" style="border-left: 4px solid #dc3545; background: linear-gradient(135deg, #fdecea, #fff);">
        <div class="card-body py-3">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <div class="text-muted small fw-semibold">Rumah Sakit</div>
              <div class="fw-bold" style="font-size:1.8rem; color:#dc3545;">4</div>
            </div>
            <div style="background:#dc3545; border-radius:12px; padding:10px;">
              <i class="fas fa-hospital text-white" style="font-size:1.4rem;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-6">
      <div class="card h-100" style="border-left: 4px solid #28a745; background: linear-gradient(135deg, #e9f7ef, #fff);">
        <div class="card-body py-3">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <div class="text-muted small fw-semibold">Puskesmas</div>
              <div class="fw-bold" style="font-size:1.8rem; color:#28a745;">1</div>
            </div>
            <div style="background:#28a745; border-radius:12px; padding:10px;">
              <i class="fas fa-clinic-medical text-white" style="font-size:1.4rem;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-6">
      <div class="card h-100" style="border-left: 4px solid #17a2b8; background: linear-gradient(135deg, #e3f8fc, #fff);">
        <div class="card-body py-3">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <div class="text-muted small fw-semibold">Klinik</div>
              <div class="fw-bold" style="font-size:1.8rem; color:#17a2b8;">19</div>
            </div>
            <div style="background:#17a2b8; border-radius:12px; padding:10px;">
              <i class="fas fa-stethoscope text-white" style="font-size:1.4rem;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Filter Kategori -->
<div class="col-12 mb-3">
  <div class="card" style="border-top: 3px solid #1a73e8;">
    <div class="card-body py-2 px-3">
      <div class="d-flex align-items-center flex-wrap gap-2">
        <span class="fw-semibold text-muted small me-1">
          <i class="fas fa-filter"></i> Filter Kategori:
        </span>
        <a href="?kategori=" 
           class="btn btn-sm rounded-pill <?= (!isset($_GET['kategori']) || $_GET['kategori'] == '') ? 'btn-primary' : 'btn-outline-primary' ?>">
          <i class="fas fa-th me-1"></i> Semua
        </a>
        <a href="?kategori=rumahsakit" 
           class="btn btn-sm rounded-pill <?= (isset($_GET['kategori']) && $_GET['kategori'] == 'rumahsakit') ? 'btn-danger' : 'btn-outline-danger' ?>">
          <i class="fas fa-hospital me-1"></i> Rumah Sakit
        </a>
        <a href="?kategori=puskesmas" 
           class="btn btn-sm rounded-pill <?= (isset($_GET['kategori']) && $_GET['kategori'] == 'puskesmas') ? 'btn-success' : 'btn-outline-success' ?>">
          <i class="fas fa-clinic-medical me-1"></i> Puskesmas
        </a>
        <a href="?kategori=klinik" 
           class="btn btn-sm rounded-pill <?= (isset($_GET['kategori']) && $_GET['kategori'] == 'klinik') ? 'btn-info' : 'btn-outline-info' ?>">
          <i class="fas fa-stethoscope me-1"></i> Klinik
        </a>

        <!-- Tombol buka Looker Studio baru -->
        <a href="https://datastudio.google.com/reporting/8c8ac7c8-5380-453a-a00d-6c488f26b858" 
           target="_blank"
           class="btn btn-sm btn-outline-secondary rounded-pill ms-auto">
          <i class="fas fa-external-link-alt me-1"></i> Buka di Looker Studio
        </a>

        <!-- Tombol fullscreen iframe -->
        <button onclick="toggleFullscreen()" 
                class="btn btn-sm btn-outline-dark rounded-pill"
                id="btn-fullscreen">
          <i class="fas fa-expand me-1"></i> Fullscreen
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Laporan Looker Studio -->
<div class="col-12">
  <div class="card" id="looker-card" style="border-top: 3px solid #1a73e8;">
    <div class="card-header d-flex align-items-center py-2" 
         style="background: linear-gradient(135deg, #1a73e8, #0d47a1);">
      <i class="fas fa-chart-bar text-white me-2"></i>
      <h6 class="mb-0 fw-bold text-white">Laporan GIS Fasilitas Kesehatan</h6>
      <span class="badge ms-2" style="background:#fff; color:#1a73e8; font-size:10px;">
        <i class="fas fa-chart-pie me-1"></i> Looker Studio
      </span>
      <span class="ms-auto text-white-50 small">
        <i class="fas fa-circle text-success me-1" style="font-size:8px;"></i> Live Data
      </span>
    </div>
    <div class="card-body p-0">
      <iframe 
        id="looker-iframe"
        width="100%" 
        height="850"
        src="https://datastudio.google.com/embed/reporting/8c8ac7c8-5380-453a-a00d-6c488f26b858/page/UNhxF" 
        frameborder="0" 
        style="border:0; display:block; width:100%;" 
        allowfullscreen 
        sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox">
      </iframe>
    </div>
  </div>
</div>

<script>
function toggleFullscreen() {
  const card = document.getElementById('looker-card');
  const iframe = document.getElementById('looker-iframe');
  const btn = document.getElementById('btn-fullscreen');

  if (!card.classList.contains('fullscreen-mode')) {
    card.classList.add('fullscreen-mode');
    card.style.cssText = 'position:fixed; top:0; left:0; width:100vw; height:100vh; z-index:9999; border-radius:0; margin:0;';
    iframe.style.height = 'calc(100vh - 48px)';
    btn.innerHTML = '<i class="fas fa-compress me-1"></i> Keluar Fullscreen';
  } else {
    card.classList.remove('fullscreen-mode');
    card.style.cssText = 'border-top: 3px solid #1a73e8;';
    iframe.style.height = '850px';
    btn.innerHTML = '<i class="fas fa-expand me-1"></i> Fullscreen';
  }
}
</script>