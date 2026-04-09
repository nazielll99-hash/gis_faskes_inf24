<div id="map" style="width: 100%; height: 800px;"></div>

<script>
var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=YOUR_TOKEN', {
    attribution: 'Map data © OpenStreetMap contributors, Imagery © Mapbox',
    id: 'mapbox/streets-v11'
});

var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=YOUR_TOKEN', {
    attribution: 'Map data © OpenStreetMap contributors, Imagery © Mapbox',
    id: 'mapbox/satellite-v9'
});

var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
});

var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=YOUR_TOKEN', {
    attribution: 'Map data © OpenStreetMap contributors, Imagery © Mapbox',
    id: 'mapbox/dark-v10'
});

// Inisialisasi map (CUKUP SEKALI)
var map = L.map('map', {
    center: [-7.282942510438273, 109.05719608128057],
    zoom: 12,
    layers: [peta1]
});

// Base layer control
var baseLayers = {
    "Streets": peta1,
    "Satellite": peta2,
    "OSM": peta3,
    "Dark": peta4
};

// Tambahkan kontrol layer
L.control.layers(baseLayers).addTo(map);
</script>