<div class="col-md-12">
    <div class="card card-outline card-primary">

        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>

        <div class="card-body">

            <?php
            session();
            $validation = session()->get('validation') ?? \Config\Services::validation();
            ?>

            <?= form_open_multipart('Faskes/InsertData') ?>

            <!-- ROW 1 (Nama, Akreditasi, Status) -->
            <div class="row">
                <!-- Nama Faskes -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nama Faskes</label>
                        <input type="text" name="nama_faskes" value="<?= old('nama_faskes') ?>" placeholder="Nama Faskes" class="form-control">
                        <p class="text-danger"><?= $validation->hasError('nama_faskes') ? $validation->getError('nama_faskes') : '' ?></p>
                    </div>
                </div>

                <!-- Akreditasi -->
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Akreditasi</label>
                        <input type="text" name="akreditasi" value="<?= old('akreditasi') ?>" placeholder="Akreditasi" class="form-control">
                        <p class="text-danger"><?= $validation->hasError('akreditasi') ? $validation->getError('akreditasi') : '' ?></p>
                    </div>
                </div>

                <!-- Status -->
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="">-- Pilih Status --</option>
                            <option value="Negeri" <?= old('status') == 'Negeri' ? 'selected' : '' ?>>Negeri</option>
                            <option value="Swasta" <?= old('status') == 'Swasta' ? 'selected' : '' ?>>Swasta</option>
                        </select>
                        <p class="text-danger"><?= $validation->hasError('status') ? $validation->getError('status') : '' ?></p>
                    </div>
                </div>
            </div>

            <!-- MAP SECTION -->
            <div class="form-group">
                <div id="map" style="width: 100%; height: 500px;"></div>
            </div>

            <!-- KOORDINAT (Disembunyikan otomatis jika ingin bersih, atau biarkan readonly) -->
            <div class="form-group">
                <input type="text" id="coordinat" name="coordinat" value="<?= old('coordinat') ?>" placeholder="Coordinat Faskes" class="form-control" readonly>
                <p class="text-danger"><?= $validation->hasError('coordinat') ? $validation->getError('coordinat') : '' ?></p>
            </div>

            <!-- ROW 2 (Provinsi, Kabupaten, Kecamatan) -->
            <div class="row">
                <!-- Provinsi -->
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Provinsi</label>
                        <select name="id_provinsi" class="form-control">
                            <option value="">-- Pilih Provinsi --</option>
                        </select>
                        <p class="text-danger"><?= $validation->hasError('id_provinsi') ? $validation->getError('id_provinsi') : '' ?></p>
                    </div>
                </div>

                <!-- Kabupaten -->
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Kabupaten</label>
                        <select name="id_kabupaten" class="form-control">
                            <option value="">-- Pilih Kabupaten --</option>
                        </select>
                        <p class="text-danger"><?= $validation->hasError('id_kabupaten') ? $validation->getError('id_kabupaten') : '' ?></p>
                    </div>
                </div>

                <!-- Kecamatan -->
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Kecamatan</label>
                        <select name="id_kecamatan" class="form-control">
                            <option value="">-- Pilih Kecamatan --</option>
                        </select>
                        <p class="text-danger"><?= $validation->hasError('id_kecamatan') ? $validation->getError('id_kecamatan') : '' ?></p>
                    </div>
                </div>
            </div>

            <!-- ROW 3 (Alamat & Wilayah Administrasi Sejajar) -->
            <div class="row">
                <!-- Alamat -->
                <div class="col-sm-8">
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" placeholder="Alamat Faskes" class="form-control" rows="3"><?= old('alamat') ?></textarea>
                        <p class="text-danger"><?= $validation->hasError('alamat') ? $validation->getError('alamat') : '' ?></p>
                    </div>
                </div>
                <!-- Wilayah Administrasi -->
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Wilayah Administrasi</label>
                        <select name="id_wilayah" class="form-control">
                            <option value="">-- Pilih Wilayah --</option>
                        </select>
                        <p class="text-danger"><?= $validation->hasError('id_wilayah') ? $validation->getError('id_wilayah') : '' ?></p>
                    </div>
                </div>
            </div>

            <!-- ROW 4 (Foto Faskes) -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Foto Faskes</label>
                        <input type="file" accept=".jpg" name="foto" class="form-control">
                        <p class="text-danger"><?= $validation->hasError('foto') ? $validation->getError('foto') : '' ?></p>
                    </div>
                </div>
            </div>

            <!-- BUTTON ACTIONS -->
            <div class="form-group mt-3">
                <button class="btn btn-primary btn-flat" type="submit">Simpan</button>
                <a href="<?= base_url('faskes') ?>" class="btn btn-success btn-flat">Kembali</a>
            </div>

            <?= form_close() ?>

        </div>
    </div>
</div>

<script>
    // Inisialisasi Basemap Leaflet
    var peta1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    });

    var peta2 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri'
    });

    var peta3 = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; OpenStreetMap & CartoDB'
    });

    // Inisialisasi Peta Utama (Gunakan peta satelit peta2 sebagai default agar menyerupai target gambar)
    var map = L.map('map', {
        center: [-7.28294, 109.05719],
        zoom: 13,
        layers: [peta2]
    });

    var baseMaps = {
        "Satelit (Esri)": peta2,
        "OpenStreetMap": peta1,
        "Light Carto": peta3
    };

    L.control.layers(baseMaps).addTo(map);

    // Penanda Marker Dinamis untuk menangkap data koordinat klik ke Input Form
    var marker;
    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        
        if (marker) {
            map.removeLayer(marker);
        }
        
        marker = L.marker([lat, lng]).addTo(map);
        document.getElementById('coordinat').value = lat + "," + lng;
    });
</script>
