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

    // Inisialisasi map (CUKUP SEKALI)
    var map = L.map('map', {
        center: [<?= $web['coordinat_wilayah'] ?>],
        zoom: <?= $web['zoom_view'] ?>,
        layers: [peta1]
    });

    // Base layer control
    var baseMaps = {
        "OSM": peta1,
        "Satellite": peta2,
        "Light": peta3,
        "Dark": peta4
    };

    // Tambahkan kontrol layer
    L.control.layers(baseMaps).addTo(map);
    <?php foreach ($wilayah as $key => $value) { ?>
        L.geoJSON(<?= $value['geojson'] ?>, {
            fillColor: '<?= $value['warna'] ?>',
            fillOpacity: 0.5,
            color: 'white',
            weight: 1
        })
            .bindPopup("<b><?= $value['nama_wilayah'] ?></b>")
            .addTo(map);
    <?php } ?>

</script>