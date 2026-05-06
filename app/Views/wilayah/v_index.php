<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
            <div class="card-tools">
                <a href="<?= base_url('wilayah/input') ?>" class="btn btn-flat btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah
                </a>
            </div>
        </div>

        <div class="card-body">
            <?php
            // Menampilkan notifikasi data berhasil disimpan/diupdate
            if (session()->getFlashdata('insert')) {
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> ' . session()->getFlashdata('insert') . '</h5></div>';
            }
            if (session()->getFlashdata('update')) {
                echo '<div class="alert alert-primary alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> ' . session()->getFlashdata('update') . '</h5></div>';
            }
            if (session()->getFlashdata('delete')) {
                echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> ' . session()->getFlashdata('delete') . '</h5></div>';
            }
            ?>

            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Nama Wilayah</th>
                        <th>Warna</th>
                        <th width="100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($wilayah as $key => $value) { ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $value['nama_wilayah'] ?></td>
                            <td style="background-color: <?= $value['warna'] ?>;"></td>
                            <td class="text-center">
                                <a href="<?= base_url('wilayah/edit/' . $value['id_wilayah']) ?>" class="btn btn-sm btn-warning btn-flat"><i class="fas fa-pencil-alt"></i></a>
                                <a href="<?= base_url('wilayah/delete/' . $value['id_wilayah']) ?>" onclick="return confirm('Yakin Hapus Data..?')" class="btn btn-sm btn-danger btn-flat"><i class="fas fa-trash"></i></a>
                                
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-body">
            <div id="map" style="width: 100%; height: 500px;"></div>
        </div>
    </div>
</div>

<script>
    // Inisialisasi Map
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

    var map = L.map('map', {
        center: [-7.282942510438273, 109.05719608128057],
        zoom: 12,
        layers: [peta1]
    });

    var baseMaps = {
        "OSM": peta1,
        "Satellite": peta2,
        "Light": peta3,
        "Dark": peta4
    };

    L.control.layers(baseMaps).addTo(map);

    // Menampilkan GeoJSON dari Database
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

    // Inisialisasi DataTable
    $(function() {
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
