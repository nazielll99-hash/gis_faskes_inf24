<div id="map" style="width: 100%; height: 800px;"></div>

<script>
    var peta1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    });
    var peta2 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri'
    });

    var peta3 = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; OpenStreetMap & CartoDB'
    });

    var peta4 = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; OpenStreetMap & CartoDB'
    });

    // Inisialisasi map global
    window.map = L.map('map', {
        center: [<?= $web['coordinat_wilayah'] ?>],
        zoom: <?= $web['zoom_view'] ?>,
        layers: [peta1]
    });

    var baseMaps = {
        "OSM": peta1,
        "Satellite": peta2,
        "Light": peta3,
        "Dark": peta4
    };

    L.control.layers(baseMaps).addTo(window.map);

    // Simpan pusat & zoom default untuk tombol "Tampilkan Semua"
    window.defaultCenter = [<?= $web['coordinat_wilayah'] ?>];
    window.defaultZoom = <?= $web['zoom_view'] ?>;

    // Wadah penampung layer global
    window.geojsonLayers = [];

    <?php foreach ($wilayah as $key => $value) { ?>
        try {
            // PERBAIKAN: pakai json_encode(json_decode(...)) supaya PHP yang menangani
            // escaping (kutip, backslash, newline) alih-alih regex + JSON.parse manual.
            var geojsonData = <?= json_encode(json_decode($value['geojson'])) ?: 'null' ?>;

            if (!geojsonData) {
                throw new Error("Data GeoJSON kosong / tidak valid dari database");
            }

            var layerWilayah = L.geoJSON(geojsonData, {
                style: function(feature) {
                    return {
                        fillColor: <?= json_encode($value['warna']) ?>,
                        fillOpacity: 0.4,
                        color: 'white',
                        weight: 1
                    };
                },
                onEachFeature: function(feature, layer) {
                    // Simpan data warna asli database langsung ke properti options layer
                    layer.options.originalColor = <?= json_encode($value['warna']) ?>;

                    // Ikat popup teks dengan format standar
                    layer.bindPopup("<b>Kecamatan: <?= esc($value['nama_wilayah']) ?></b>");
                }
            }).addTo(window.map);

            // TENTUKAN IDENTITAS: Simpan nama wilayah ke dalam object layer
            layerWilayah.nama_wilayah = <?= json_encode($value['nama_wilayah']) ?>;

            // Daftarkan layer ke array global
            window.geojsonLayers.push(layerWilayah);

        } catch (error) {
            console.error("Gagal memuat GeoJSON untuk wilayah: <?= esc($value['nama_wilayah']) ?>. Error:", error);
        }
    <?php } ?>

    // =========================================================================
    // CODE FILTER DROPDOWN
    // PENTING: pakai Vanilla JS (bukan jQuery/$), karena script ini dirender
    // SEBELUM jquery.min.js selesai di-load di layout (posisi script home ada
    // di atas, jquery di-load di bawah dekat </body>). Kalau pakai $(...) di
    // sini akan error "$ is not defined" dan click handler tidak terpasang.
    // =========================================================================
    document.addEventListener('DOMContentLoaded', function() {

        // Style untuk kecamatan yang TIDAK dipilih (tidak berwarna)
        var styleNonAktif = {
            fillColor: '#cccccc',
            fillOpacity: 0,   // 0 = transparan total. Ganti mis. 0.08 kalau mau samar-samar abu
            color: '#999999',
            weight: 1
        };

        // Normalisasi nama: hapus kata "kecamatan", spasi berlebih, lowercase.
        // Supaya "Kecamatan Bumiayu" (di database) tetap cocok dengan
        // "Bumiayu" (di dropdown), walau formatnya sedikit beda.
        function normalisasiNama(nama) {
            return String(nama || '')
                .toLowerCase()
                .replace(/kecamatan/g, '')
                .replace(/\s+/g, ' ')
                .trim();
        }

        var tombolFilter = document.querySelectorAll('.filter-kecamatan');

        tombolFilter.forEach(function(tombol) {
            tombol.addEventListener('click', function(e) {
                e.preventDefault();

                let rawPilihan = String(tombol.dataset.kecamatan || '').trim().toLowerCase();
                let kecamatanDipilih = normalisasiNama(rawPilihan);

                let matchedBounds = null;

                window.geojsonLayers.forEach(function(layer) {
                    let namaLayer = normalisasiNama(layer.nama_wilayah);

                    if (rawPilihan === 'all') {
                        // Tampilkan Semua -> kembalikan semua layer ke warna aslinya
                        layer.eachLayer(function(l) {
                            l.setStyle({
                                fillColor: l.options.originalColor,
                                fillOpacity: 0.4,
                                color: 'white',
                                weight: 1
                            });
                        });

                    } else if (namaLayer === kecamatanDipilih) {
                        // Kecamatan yang dipilih -> nyalakan warna aslinya
                        layer.eachLayer(function(l) {
                            l.setStyle({
                                fillColor: l.options.originalColor,
                                fillOpacity: 0.4,
                                color: 'white',
                                weight: 1
                            });
                        });
                        matchedBounds = matchedBounds
                            ? matchedBounds.extend(layer.getBounds())
                            : layer.getBounds();

                    } else {
                        // Kecamatan lain -> matikan warnanya, TETAP tampil di peta
                        layer.eachLayer(function(l) {
                            l.setStyle(styleNonAktif);
                        });
                    }
                });

                if (rawPilihan === 'all') {
                    window.map.setView(window.defaultCenter, window.defaultZoom);
                } else if (matchedBounds && matchedBounds.isValid()) {
                    window.map.fitBounds(matchedBounds);
                } else {
                    console.warn(
                        'Tidak ada layer yang cocok dengan kecamatan: "' + rawPilihan + '". ' +
                        'Nama yang tersedia di database: ' +
                        window.geojsonLayers.map(l => l.nama_wilayah).join(', ')
                    );
                }

                // Tutup semua dropdown yang terbuka setelah item diklik
                document.querySelectorAll('.dropdown-menu').forEach(function(menu) {
                    menu.style.display = 'none';
                });
            });
        });
    });
</script>