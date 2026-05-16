<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>

        <div class="card-body">
            <?php
            $validation = session()->getFlashdata('validation') ?? \Config\Services::validation();
            ?>

            <?= form_open_multipart('faskes/updatedata/' . $faskes['id_faskes']) ?>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nama Faskes</label>
                        <input type="text" name="nama_faskes" value="<?= old('nama_faskes', $faskes['nama_faskes']) ?>" placeholder="Nama Faskes" class="form-control">
                        <p class="text-danger"><?= $validation->getError('nama_faskes') ?></p>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Akreditasi</label>
                        <input type="text" name="akreditasi" value="<?= old('akreditasi', $faskes['akreditasi']) ?>" placeholder="Akreditasi" class="form-control">
                        <p class="text-danger"><?= $validation->getError('akreditasi') ?></p>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="">-- Pilih Status --</option>
                            <option value="Negeri" <?= old('status', $faskes['status']) == 'Negeri' ? 'selected' : '' ?>>Negeri</option>
                            <option value="Swasta" <?= old('status', $faskes['status']) == 'Swasta' ? 'selected' : '' ?>>Swasta</option>
                        </select>
                        <p class="text-danger"><?= $validation->getError('status') ?></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Jenis Faskes</label>
                        <select name="jenis" class="form-control">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="puskesmas" <?= old('jenis', $faskes['jenis']) == 'puskesmas' ? 'selected' : '' ?>>Puskesmas</option>
                            <option value="klinik" <?= old('jenis', $faskes['jenis']) == 'klinik' ? 'selected' : '' ?>>Klinik</option>
                            <option value="rumah sakit" <?= old('jenis', $faskes['jenis']) == 'rumah sakit' ? 'selected' : '' ?>>Rumah Sakit</option>
                        </select>
                        <p class="text-danger"><?= $validation->getError('jenis') ?></p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div id="map" style="width: 100%; height: 500px;"></div>
            </div>

            <div class="form-group">
                <label>Koordinat</label>
                <input type="text" id="coordinat" name="coordinat" value="<?= old('coordinat', $faskes['koordinat']) ?>" placeholder="Koordinat Faskes" class="form-control" readonly>
                <p class="text-danger"><?= $validation->getError('coordinat') ?></p>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Provinsi</label>
                        <select name="id_provinsi" id="id_provinsi" class="form-control select2">
                            <option value="">-- Pilih Provinsi --</option>
                            <?php foreach ($provinsi as $key => $value) { ?>
                                <option value="<?= $value['id_provinsi'] ?>" <?= old('id_provinsi', $faskes['id_provinsi']) == $value['id_provinsi'] ? 'selected' : '' ?>><?= $value['nama_provinsi'] ?></option>
                            <?php } ?>
                        </select>
                        <p class="text-danger"><?= $validation->getError('id_provinsi') ?></p>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Kabupaten</label>
                        <select name="id_kabupaten" id="id_kabupaten" class="form-control select2">
                            <option value="">-- Pilih Kabupaten --</option>
                        </select>
                        <p class="text-danger"><?= $validation->getError('id_kabupaten') ?></p>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Kecamatan</label>
                        <select name="id_kecamatan" id="id_kecamatan" class="form-control select2">
                            <option value="">-- Pilih Kecamatan --</option>
                        </select>
                        <p class="text-danger"><?= $validation->getError('id_kecamatan') ?></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" placeholder="Alamat Faskes" class="form-control" rows="3"><?= old('alamat', $faskes['alamat']) ?></textarea>
                        <p class="text-danger"><?= $validation->getError('alamat') ?></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Ganti Foto Faskes (Biarkan Kosong Jika Tidak Diganti)</label>
                        <input type="file" accept=".jpg,.jpeg,.png" name="foto" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6 text-center">
                    <label>Foto Lama</label><br>
                    <img src="<?= base_url('foto/' . $faskes['foto']) ?>" width="150px" height="100px" class="img-thumbnail">
                </div>
            </div>

            <div class="form-group mt-3">
                <button class="btn btn-primary btn-flat" type="submit">Simpan Perubahan</button>
                <a href="<?= base_url('faskes') ?>" class="btn btn-success btn-flat">Kembali</a>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

<link href="https://jsdelivr.net" rel="stylesheet" />
<script src="https://jsdelivr.net"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4',
            placeholder: '-- Pilih --',
            allowClear: true,
            width: '100%'
        });

        var id_provinsi_lama = "<?= old('id_provinsi', $faskes['id_provinsi']) ?>";
        var id_kabupaten_lama = "<?= old('id_kabupaten', $faskes['id_kabupaten']) ?>";
        var id_kecamatan_lama = "<?= old('id_kecamatan', $faskes['id_kecamatan']) ?>";

        if (id_provinsi_lama != '') {
            $.ajax({
                type: "GET",
                url: "<?= base_url('faskes/getKabupaten') ?>/" + id_provinsi_lama,
                success: function(response) {
                    $('#id_kabupaten').html(response);
                    $('#id_kabupaten').val(id_kabupaten_lama).trigger('change');
                }
            });
        }

        $('#id_provinsi').change(function() {
            var id_provinsi = $(this).val();
            if (id_provinsi != '') {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url('faskes/getKabupaten') ?>/" + id_provinsi,
                    success: function(response) {
                        $('#id_kabupaten').html(response);
                        $('#id_kecamatan').html('<option value="">-- Pilih Kecamatan --</option>');
                    }
                });
            }
        });

        $('#id_kabupaten').change(function() {
            var id_kabupaten = $(this).val();
            if (id_kabupaten != '' && id_kabupaten != null) {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url('faskes/getKecamatan') ?>/" + id_kabupaten,
                    success: function(response) {
                        $('#id_kecamatan').html(response);
                        if (id_kecamatan_lama != '' && $('#id_kabupaten').val() == id_kabupaten_lama) {
                            $('#id_kecamatan').val(id_kecamatan_lama).trigger('change');
                        }
                    }
                });
            }
        });
    }); 

    var peta1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    });

    var coordinatInput = document.getElementById("coordinat");
    var curLocation = coordinatInput.value.split(",");

    var markerLat = parseFloat(curLocation[0]);
    var markerLng = parseFloat(curLocation[1]);

    var map = L.map('map', {
        center: [markerLat, markerLng],
        zoom: 14,
        layers: [peta1]
    });

    var marker = new L.marker([markerLat, markerLng], {
        draggable: true
    }).addTo(map);

    marker.on('dragend', function(e) {
        var position = marker.getLatLng();
        marker.setLatLng(position).bindPopup(position.lat + "," + position.lng).update();
        coordinatInput.value = position.lat + "," + position.lng;
    });

    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        marker.setLatLng(e.latlng);
        coordinatInput.value = lat + "," + lng;
    });

    setTimeout(function() {
        map.invalidateSize();
    }, 500);
</script>
