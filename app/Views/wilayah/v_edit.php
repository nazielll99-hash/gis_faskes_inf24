<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>
        
        <div class="card-body">
            <?php
            // 1. Inisialisasi Validasi
            $validation = \Config\Services::validation();

            // 2. Notifikasi
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

            // 3. Membuka Form (HANYA SATU ECHO & HURUF KECIL SEMUA)
            echo form_open('wilayah/updatedata/' . $wilayah['id_wilayah']); 
            ?>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nama Wilayah</label>
                        <input name="nama_wilayah" value="<?= $wilayah['nama_wilayah'] ?>" class="form-control">
                        <p class="text-danger">
                            <?= $validation->hasError('nama_wilayah') ? $validation->getError('nama_wilayah') : '' ?>
                        </p>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Warna Wilayah</label>
                        <input name="warna" value="<?= $wilayah['warna'] ?>" class="form-control my-colorpicker1">
                        <p class="text-danger">
                            <?= $validation->hasError('warna') ? $validation->getError('warna') : '' ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>GeoJSON</label>
                <textarea name="geojson" class="form-control" rows="15"><?= $wilayah['geojson'] ?></textarea>
                <p class="text-danger">
                    <?= $validation->hasError('geojson') ? $validation->getError('geojson') : '' ?>
                </p>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <a href="<?= base_url('Wilayah') ?>" class="btn btn-success btn-flat">Kembali</a>
            </div>

            <?php echo form_close() ?>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('.my-colorpicker1').colorpicker();
    });
</script>
