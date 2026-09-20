<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
  .stat-card-btn {
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .stat-card-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
  }
  .stat-card-active {
    box-shadow: inset 0 0 0 3px #1a73e8, 0 4px 12px rgba(0,0,0,0.15) !important;
  }
</style>

<div class="row pt-2">
  
  <!-- ======================================================== -->
  <!-- STAT CARDS (SEBAGAI TOMBOL FILTER JAVASCRIPT)            -->
  <!-- ======================================================== -->
  <div class="col-12 mb-3">
    <div class="row g-3">
      <!-- Card Total Faskes -->
      <div class="col-md-3 col-6">
        <div class="card h-100 stat-card-btn stat-card-active btn-filter-faskes" data-kategori="ALL" style="border-left: 4px solid #1a73e8; background: linear-gradient(135deg, #e8f0fe, #fff);">
          <div class="card-body py-3">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <div class="text-muted small fw-semibold">Total Faskes</div>
                <div class="fw-bold" style="font-size:1.8rem; color:#1a73e8;"><?= $total_faskes ?></div>
              </div>
              <div style="background:#1a73e8; border-radius:12px; padding:10px;">
                <i class="fas fa-map-marker-alt text-white" style="font-size:1.4rem;"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Card Rumah Sakit -->
      <div class="col-md-3 col-6">
        <div class="card h-100 stat-card-btn btn-filter-faskes" data-kategori="RUMAH SAKIT" style="border-left: 4px solid #dc3545; background: linear-gradient(135deg, #fdecea, #fff);">
          <div class="card-body py-3">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <div class="text-muted small fw-semibold">Rumah Sakit</div>
                <div class="fw-bold" style="font-size:1.8rem; color:#dc3545;"><?= $total_rs ?></div>
              </div>
              <div style="background:#dc3545; border-radius:12px; padding:10px;">
                <i class="fas fa-hospital text-white" style="font-size:1.4rem;"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Card Puskesmas -->
      <div class="col-md-3 col-6">
        <div class="card h-100 stat-card-btn btn-filter-faskes" data-kategori="PUSKESMAS" style="border-left: 4px solid #28a745; background: linear-gradient(135deg, #e9f7ef, #fff);">
          <div class="card-body py-3">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <div class="text-muted small fw-semibold">Puskesmas</div>
                <div class="fw-bold" style="font-size:1.8rem; color:#28a745;"><?= $total_puskesmas ?></div>
              </div>
              <div style="background:#28a745; border-radius:12px; padding:10px;">
                <i class="fas fa-clinic-medical text-white" style="font-size:1.4rem;"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Card Klinik -->
      <div class="col-md-3 col-6">
        <div class="card h-100 stat-card-btn btn-filter-faskes" data-kategori="KLINIK" style="border-left: 4px solid #17a2b8; background: linear-gradient(135deg, #e3f8fc, #fff);">
          <div class="card-body py-3">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <div class="text-muted small fw-semibold">Klinik</div>
                <div class="fw-bold" style="font-size:1.8rem; color:#17a2b8;"><?= $total_klinik ?></div>
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

  <!-- ======================================================== -->
  <!-- REVISI LAYOUT: LAPORAN DATA TABEL DI ATAS                -->
  <!-- ======================================================== -->
  <div class="col-12 mb-4">
    <div class="card shadow-sm" style="border-top: 3px solid #1a73e8;">
      <div class="card-header d-flex align-items-center py-2 bg-light">
        <i class="fas fa-table text-primary me-2"></i>
        <h6 class="mb-0 fw-bold text-dark m-0">
          Laporan Data Fasilitas Kesehatan | 
          <span id="status-filter-aktif" class="badge bg-warning text-dark ms-2" style="display:none; font-size:11px;"></span>
        </h6>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-striped table-hover mb-0 align-middle">
            <thead class="table-dark">
              <tr>
                <th width="50">No.</th>
                <th>Nama Objek</th>
                <th>Kategori</th>
                <th>Koordinat</th>
                <th>Foto</th>
              </tr>
            </thead>
            <tbody id="body-tabel-faskes">
              <?php if (empty($faskes_list)): ?>
                <tr>
                  <td colspan="5" class="text-center py-4 text-muted">Tidak ada data faskes ditemukan di database.</td>
                </tr>
              <?php else: ?>
                <?php $no = 1; foreach ($faskes_list as $faskes): 
                  $namaJenis = strtoupper(trim($faskes['jenis'] ?? ''));
                ?>
                  <tr class="item-faskes-row" data-kategori="<?= $namaJenis ?>">
                    <td class="kolom-nomer"><?= $no++ ?>.</td>
                    <td class="fw-bold text-primary"><?= $faskes['nama_faskes'] ?></td>
                    <td>
                      <?php if ($faskes['jenis'] == 'rumah sakit'): ?>
                        <span class="badge bg-danger"><i class="fas fa-hospital me-1"></i> Rumah Sakit</span>
                      <?php elseif ($faskes['jenis'] == 'puskesmas'): ?>
                        <span class="badge bg-success"><i class="fas fa-clinic-medical me-1"></i> Puskesmas</span>
                      <?php else: ?>
                        <span class="badge bg-info text-dark"><i class="fas fa-stethoscope me-1"></i> Klinik</span>
                      <?php endif; ?>
                    </td>
                    <td class="small font-monospace text-secondary"><i class="fas fa-map-marker-alt text-danger me-1"></i> <?= $faskes['koordinat'] ?></td>
                    <td>
                      <?php if (!empty($faskes['foto'])): ?>
                        <a href="<?= base_url('foto/' . $faskes['foto']) ?>" target="_blank" class="btn btn-xs btn-outline-secondary py-0 px-2 small">
                          <i class="fas fa-image"></i> Lihat
                        </a>
                      <?php else: ?>
                        <span class="text-muted small">-</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- ======================================================== -->
  <!-- REVISI LAYOUT: GRAFIK DI SEBELAH KIRI (col-md-6)        -->
  <!-- ======================================================== -->
  <div class="col-md-6 mb-4 d-flex align-items-stretch">
    <div class="card w-100" style="border-top: 3px solid #1a73e8;">
      <div class="card-header d-flex align-items-center py-2 bg-light">
        <i class="fas fa-chart-bar text-primary me-2"></i>
        <h6 class="mb-0 fw-bold text-dark">Grafik Sebaran Faskes</h6>
      </div>
      <div class="card-body p-3 d-flex align-items-center justify-content-center" style="background: #fff;">
        <div style="position: relative; height:360px; width:100%;">
           <canvas id="chartFaskes"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- ======================================================== -->
  <!-- REVISI LAYOUT: PETA DI SEBELAH KANAN (col-md-6)          -->
  <!-- ======================================================== -->
  <div class="col-md-6 mb-4 d-flex align-items-stretch">
    <div class="card w-100" style="border-top: 3px solid #28a745;">
      <div class="card-header d-flex align-items-center py-2 bg-light">
        <i class="fas fa-map-marked-alt text-success me-2"></i>
        <h6 class="mb-0 fw-bold text-dark">Peta Sebaran Lokasi</h6>
      </div>
      <div class="card-body p-0" style="background: #fff;">
        <div id="mapDashboard" style="height: 400px; width: 100%;"></div>
      </div>
    </div>
  </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // 1. DATA PARSING DARI BACKEND PHP
    // Pastikan variabel $data_chart berisi array kategori & total, dan $faskes_list berisi array data koordinat map
    const dataChartBackend = <?= json_encode($data_chart) ?>;
    const dataMap          = <?= json_encode($faskes_list) ?>;
    
    const labelKategori = dataChartBackend.map(item => item.kategori ? item.kategori.toUpperCase() : 'BELUM DIATUR');
    const totalData     = dataChartBackend.map(item => item.total);
    
    let listMarkers = [];

    // ==========================================
    // 2. RENDER CHART.JS (BAR CHART)
    // ==========================================
    const ctx = document.getElementById('chartFaskes').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar', 
        data: {
            labels: labelKategori,
            datasets: [{
                label: 'Jumlah Fasilitas Kesehatan',
                data: totalData,
                backgroundColor: [
                    'rgba(220, 53, 69, 0.6)',   // Rumah Sakit (Merah)
                    'rgba(40, 167, 69, 0.6)',   // Puskesmas (Hijau)
                    'rgba(23, 162, 184, 0.6)'    // Klinik (Cyan)
                ],
                borderColor: [
                    '#dc3545', '#28a745', '#17a2b8'
                ],
                borderWidth: 1.5,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });

    // ==========================================
    // 3. RENDER LEAFLET MAP
    // ==========================================
    // Koordinat pusat peta (Default: Atur ke wilayah faskes Anda jika $web belum diatur)
    const centerCoordinates = [<?= $web['Koordinat_Wilayah'] ?? '-7.4243, 109.2301' ?>]; 
    const zoomView = <?= $web['Zoom_View'] ?? '12' ?>;
    const map = L.map('mapDashboard').setView(centerCoordinates, zoomView);

    L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution: 'Google Maps'
    }).addTo(map);

    // Fungsi Sinkronisasi Marker Peta Mengikuti Filter
    function updateMapMarkers(filterKey) {
        // Hapus marker lama yang sedang aktif
        listMarkers.forEach(m => map.removeLayer(m));
        listMarkers = [];

        // Looping data map faskes
        dataMap.forEach(function(item) {
            const itemKategori = item.jenis ? item.jenis.toUpperCase().trim() : '';
            
            if (filterKey === 'ALL' || itemKategori === filterKey) {
                if (item.koordinat) {
                    const parsingLoc = item.koordinat.split(',');
                    if (parsingLoc.length === 2) {
                        const lat = parseFloat(parsingLoc[0].trim());
                        const lng = parseFloat(parsingLoc[1].trim());

                        const marker = L.marker([lat, lng]).addTo(map)
                            .bindPopup('<b>' + item.nama_faskes + '</b><br>Kategori: ' + item.jenis.toUpperCase());
                        listMarkers.push(marker);
                    }
                }
            }
        });
    }

    // Jalankan sebaran seluruh marker saat pertama kali dimuat
    updateMapMarkers('ALL');

    // ==========================================
    // 4. LOGIKA JAVASCRIPT FILTER KLIK (TANPA RELOAD)
    // ==========================================
    const tombolFilter = document.querySelectorAll('.btn-filter-faskes');
    const barisTabel   = document.querySelectorAll('.item-faskes-row');
    const badgeStatus  = document.getElementById('status-filter-aktif');

    tombolFilter.forEach(function(cardTombol) {
        cardTombol.addEventListener('click', function() {
            const kategoriTarget = this.getAttribute('data-kategori').toUpperCase().trim();

            // A. Kelola Efek Desain Tombol Aktif
            tombolFilter.forEach(c => c.classList.remove('stat-card-active'));
            this.classList.add('stat-card-active');

            // B. Atur Badge Text Status Filter di Header Tabel
            if (kategoriTarget === 'ALL') {
                badgeStatus.style.display = 'none';
            } else {
                badgeStatus.innerText = 'Filter Aktif: ' + kategoriTarget;
                badgeStatus.style.display = 'inline-block';
            }

            // C. Filter Baris Tabel & Atur Ulang Nomor Urut (.kolom-nomer)
            let nomorBaru = 1;
            barisTabel.forEach(function(row) {
                const kategoriRow = row.getAttribute('data-kategori').toUpperCase().trim();
                if (kategoriTarget === 'ALL' || kategoriRow === kategoriTarget) {
                    row.style.display = '';
                    row.querySelector('.kolom-nomer').innerText = nomorBaru++ + '.';
                } else {
                    row.style.display = 'none';
                }
            });

            // D. Filter Marker Lokasi di Peta
            updateMapMarkers(kategoriTarget);

            // E. Ubah Sorotan Grafik Bar Chart Berdasarkan Klik
            if (kategoriTarget === 'ALL') {
                myChart.data.datasets[0].backgroundColor = [
                    'rgba(220, 53, 69, 0.6)', 
                    'rgba(40, 167, 69, 0.6)', 
                    'rgba(23, 162, 184, 0.6)'
                ];
            } else {
                myChart.data.datasets[0].backgroundColor = labelKategori.map(lbl => 
                    lbl.toUpperCase().trim() === kategoriTarget ? 'rgba(26, 115, 232, 0.9)' : 'rgba(220, 220, 220, 0.2)'
                );
            }
            myChart.update();
        });
    });
});
</script>