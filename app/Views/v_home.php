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

    window.map = L.map('map', {
        center: [<?= $web['coordinat_wilayah'] ?>],
        zoom: <?= $web['zoom_view'] ?>,
        layers: [peta1]
    });

    var baseMaps = { "OSM": peta1, "Satellite": peta2, "Light": peta3, "Dark": peta4 };
    L.control.layers(baseMaps).addTo(window.map);

    window.defaultCenter = [<?= $web['coordinat_wilayah'] ?>];
    window.defaultZoom = <?= $web['zoom_view'] ?>;

    window.geojsonLayers = [];
    window.faskesMarkers = [];

    // ── STATE FILTER AKTIF (kunci sinkronisasi kedua dropdown) ──────────────
    window.filterKecamatanAktif = 'all';
    window.filterIdKecamatanAktif = '';
    window.filterJenisAktif = 'ALL';

    function normalisasiKategori(teks) {
        return String(teks || '').toLowerCase().replace(/\s+/g, '');
    }

    function normalisasiNama(nama) {
        return String(nama || '')
            .toLowerCase()
            .replace(/kecamatan/g, '')
            .replace(/kec\./g, '')
            .replace(/kec\s/g, '')
            .replace(/[.,]/g, '')
            .replace(/\s+/g, ' ')
            .trim();
    }

    var petaIconKategori = {};
    <?php foreach ($kategori as $k) { ?>
        petaIconKategori[normalisasiKategori(<?= json_encode($k['kategori']) ?>)] = <?= json_encode($k['marker']) ?>;
    <?php } ?>

    // =========================================================================
    // POLYGON WILAYAH (KECAMATAN)
    // =========================================================================
    <?php foreach ($wilayah as $key => $value) { ?>
        try {
            var geojsonData = <?= json_encode(json_decode($value['geojson'])) ?: 'null' ?>;
            if (!geojsonData) throw new Error("Data GeoJSON kosong / tidak valid dari database");

            var layerWilayah = L.geoJSON(geojsonData, {
                style: function(feature) {
                    return { fillColor: <?= json_encode($value['warna']) ?>, fillOpacity: 0.4, color: 'white', weight: 1 };
                },
                onEachFeature: function(feature, layer) {
                    layer.options.originalColor = <?= json_encode($value['warna']) ?>;
                    layer.bindPopup("<b>Kecamatan: <?= esc($value['nama_wilayah']) ?></b>");
                }
            }).addTo(window.map);

            layerWilayah.id_wilayah = <?= json_encode($value['id_wilayah'] ?? '') ?>;
            layerWilayah.nama_wilayah = <?= json_encode($value['nama_wilayah']) ?>;
            window.geojsonLayers.push(layerWilayah);

        } catch (error) {
            console.error("Gagal memuat GeoJSON untuk wilayah: <?= esc($value['nama_wilayah']) ?>. Error:", error);
        }
    <?php } ?>

    // =========================================================================
    // MARKER FASKES (RUMAH SAKIT / PUSKESMAS / KLINIK)
    // =========================================================================
    <?php foreach ($faskes as $key => $f) { ?>
        try {
            var koordinatMentah = <?= json_encode($f['koordinat']) ?>;
            var pecahKoordinat = String(koordinatMentah).split(',');
            var lat = parseFloat(pecahKoordinat[0]);
            var lng = parseFloat(pecahKoordinat[1]);

            if (isNaN(lat) || isNaN(lng)) throw new Error("Koordinat tidak valid: " + koordinatMentah);

            var jenisFaskes = normalisasiKategori(<?= json_encode($f['jenis'] ?? '') ?>);
            var namaFileIcon = petaIconKategori[jenisFaskes];

            var iconMarker;
            if (namaFileIcon) {
                iconMarker = L.icon({
                    iconUrl: <?= json_encode(base_url('marker')) ?> + '/' + namaFileIcon,
                    iconSize: [32, 40],
                    iconAnchor: [16, 40],
                    popupAnchor: [0, -35]
                });
            } else {
                iconMarker = new L.Icon.Default();
            }

            var isiPopup = '<div style="min-width:180px">'
                + '<b><?= esc($f['nama_faskes']) ?></b><br>'
                + '<?= esc($f['jenis'] ?? '') ?> - <?= esc($f['status'] ?? '') ?><br>'
                + '<?= esc($f['alamat'] ?? '') ?>'
                + '</div>';

            var markerFaskes = L.marker([lat, lng], { icon: iconMarker })
                .bindPopup(isiPopup)
                .addTo(window.map);

            markerFaskes.id_kecamatan = <?= json_encode($f['id_kecamatan'] ?? '') ?>;
            markerFaskes.nama_wilayah = <?= json_encode($f['nama_kecamatan'] ?? '') ?>;
            markerFaskes.nama_faskes = <?= json_encode($f['nama_faskes'] ?? '') ?>;
            // BARU: simpan jenis faskes (sudah dinormalisasi) untuk difilter
            markerFaskes.jenis_faskes = jenisFaskes;

            window.faskesMarkers.push(markerFaskes);

        } catch (error) {
            console.error("Gagal memuat marker faskes: <?= esc($f['nama_faskes'] ?? 'tanpa nama') ?>. Error:", error);
        }
    <?php } ?>

    console.log('DEBUG faskesMarkers:', window.faskesMarkers.map(function(m) {
        return {
            nama_faskes: m.nama_faskes,
            id_kecamatan: m.id_kecamatan,
            nama_wilayah: m.nama_wilayah,
            jenis_faskes: m.jenis_faskes
        };
    }));

    // =========================================================================
    // FUNGSI FILTER GABUNGAN (dipanggil ulang tiap dropdown manapun diklik)
    // =========================================================================
    var styleNonAktif = { fillColor: '#cccccc', fillOpacity: 0, color: '#999999', weight: 1 };

    function terapkanFilter() {
        var rawPilihanKec = window.filterKecamatanAktif;
        var kecamatanDipilih = normalisasiNama(rawPilihanKec);
        var idKecamatanDipilih = window.filterIdKecamatanAktif;
        var jenisDipilih = normalisasiKategori(window.filterJenisAktif);

        var matchedBounds = null;

        window.geojsonLayers.forEach(function(layer) {
            let namaLayer = normalisasiNama(layer.nama_wilayah);

            if (rawPilihanKec === 'all') {
                layer.eachLayer(function(l) {
                    l.setStyle({ fillColor: l.options.originalColor, fillOpacity: 0.4, color: 'white', weight: 1 });
                });
            } else if (namaLayer === kecamatanDipilih) {
                layer.eachLayer(function(l) {
                    l.setStyle({ fillColor: l.options.originalColor, fillOpacity: 0.4, color: 'white', weight: 1 });
                });
                matchedBounds = matchedBounds ? matchedBounds.extend(layer.getBounds()) : layer.getBounds();
            } else {
                layer.eachLayer(function(l) {
                    l.setStyle(styleNonAktif);
                });
            }
        });

        var jumlahMarkerTampil = 0;

        window.faskesMarkers.forEach(function(marker) {
            let namaMarker = normalisasiNama(marker.nama_wilayah);
            let idMarker = String(marker.id_kecamatan || '').trim();

            let cocokKecamatan =
                rawPilihanKec === 'all' ||
                (idKecamatanDipilih !== '' && idMarker !== '' && idMarker === idKecamatanDipilih) ||
                (namaMarker !== '' && namaMarker === kecamatanDipilih) ||
                (namaMarker !== '' && kecamatanDipilih !== '' && namaMarker.includes(kecamatanDipilih));

            let cocokJenis = (jenisDipilih === 'all') || (marker.jenis_faskes === jenisDipilih);

            let cocok = cocokKecamatan && cocokJenis;

            if (cocok) {
                if (!window.map.hasLayer(marker)) window.map.addLayer(marker);
                jumlahMarkerTampil++;
            } else {
                if (window.map.hasLayer(marker)) window.map.removeLayer(marker);
            }
        });

        if (jumlahMarkerTampil === 0) {
            console.warn('Tidak ada marker faskes yang cocok untuk kombinasi filter: kecamatan="' + rawPilihanKec + '", jenis="' + window.filterJenisAktif + '"');
        }

        if (rawPilihanKec === 'all') {
            window.map.setView(window.defaultCenter, window.defaultZoom);
        } else if (matchedBounds && matchedBounds.isValid()) {
            window.map.fitBounds(matchedBounds);
        }
    }

    // =========================================================================
    // EVENT LISTENER DROPDOWN
    // =========================================================================
    document.addEventListener('DOMContentLoaded', function() {

        document.querySelectorAll('.filter-kecamatan').forEach(function(tombol) {
            tombol.addEventListener('click', function(e) {
                e.preventDefault();

                window.filterKecamatanAktif = String(tombol.dataset.kecamatan || '').trim().toLowerCase();
                window.filterIdKecamatanAktif = String(tombol.dataset.id || '').trim();

                terapkanFilter();

                document.querySelectorAll('.dropdown-menu').forEach(function(menu) {
                    menu.style.display = 'none';
                });
            });
        });

        document.querySelectorAll('.btn-filter-jenis').forEach(function(tombol) {
            tombol.addEventListener('click', function(e) {
                e.preventDefault();

                window.filterJenisAktif = String(tombol.dataset.jenis || 'ALL').trim();

                var labelAktif = document.getElementById('text-filter-aktif');
                if (labelAktif) {
                    labelAktif.textContent = (window.filterJenisAktif === 'ALL') ? '' : ' (' + tombol.textContent.trim() + ')';
                }

                terapkanFilter();

                document.querySelectorAll('.dropdown-menu').forEach(function(menu) {
                    menu.style.display = 'none';
                });
            });
        });
    });
</script>