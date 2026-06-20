<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>

        <div class="card-body">
            <div class="row">

                <!-- MAP -->
                <div class="col-sm-6">
                    <div id="map" style="width:100%; height:500px;"></div>
                </div>

                <!-- DETAIL FASKES -->
                <div class="col-sm-6">
                    <img src="<?= base_url('foto/' . $faskes['foto']) ?>" alt="">

                </div>

            </div class="col-sm-12">
            <table class="table table-boardered">
                <tr>
                    <th>Nama Faskes</th>
                    <th>:</th>
                    <td><?= $faskes['nama_faskes'] ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <th>:</th>
                    <td><?= $faskes['status'] ?></td>
                </tr>
                <tr>
                    <th>Akreditasi</th>
                    <th>:</th>
                    <td><?= $faskes['akreditasi'] ?></td>
                </tr>
                <tr>
                    <th>Jenis Faskes</th>
                    <th>:</th>
                    <td><?= $faskes['jenis'] ?></td>
                </tr>
                <tr>
                    <th>Alamat Faskes</th>
                    <th>:</th>
                    <td><?= $faskes['alamat'] ?>,<?= $faskes['kecamatan'] ?>,<?= $faskes['kabupaten'] ?>,<?= $faskes['provinsi'] ?>
                    </td>
                </tr>
            </table>
            <a href="<?= base_url('faskes') ?>" class="btn btn-success btn-flat">Kembali</a>
        </div>
    </div>
</div>
</div>

<script>
    var koordinat = "<?= $faskes['koordinat'] ?>";
    var lokasi = koordinat.split(",");

    var lat = parseFloat(lokasi[0]);
    var lng = parseFloat(lokasi[1]);

    var peta1 = L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            attribution: '&copy; OpenStreetMap'
        }
    );

    var map = L.map('map', {
        center: [lat, lng],
        zoom: 15,
        layers: [peta1]
    });

    L.marker([lat, lng])
        .addTo(map)
        .bindPopup("<?= $faskes['nama_faskes'] ?>")
        .openPopup();

    setTimeout(function () {
        map.invalidateSize();
    }, 300);
</script>