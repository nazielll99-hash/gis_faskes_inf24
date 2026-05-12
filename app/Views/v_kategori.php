<div class="col-md-12">
    <div class="card card-outline card-primary">

        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>

        <div class="card-body">

            <?php
            // Notifikasi berhasil
            if (session()->getFlashdata('insert')) {
                echo '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> ' . session()->getFlashdata('insert') . '</h5>
                    </div>';
            }

            if (session()->getFlashdata('update')) {
                echo '<div class="alert alert-primary alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> ' . session()->getFlashdata('update') . '</h5>
                    </div>';
            }

            if (session()->getFlashdata('delete')) {
                echo '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> ' . session()->getFlashdata('delete') . '</h5>
                    </div>';
            }
            ?>

            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Kategori</th>
                        <th>Marker</th>
                        <th width="200px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($kategori as $key => $value) { ?>

                        <tr>
                            <td class="text-center"><?= $no++ ?></td>

                            <td><?= $value['kategori'] ?></td>

                            <td class="text-center">
                                <img src="<?= base_url('marker/' . $value['marker']) ?>" width="75px">
                            </td>

                            <td class="text-center">

                                <button data-toggle="modal" data-target="#edit<?= $value['id_kategori'] ?>"
                                    class="btn btn-sm btn-warning btn-flat">

                                    <i class="fas fa-map-marker-alt"></i>
                                    Ganti Marker
                                </button>

                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>


<!-- Modal Edit -->
<?php foreach ($kategori as $key => $value) { ?>

    <div class="modal fade" id="edit<?= $value['id_kategori'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">
                        Ganti Marker <?= $value['kategori'] ?>
                    </h4>

                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <?= form_open_multipart('Kategori/UpdateData/' . $value['id_kategori']) ?>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Upload Marker</label>

                        <input type="file" name="marker" class="form-control">
                    </div>

                    <div class="form-group text-center">

                        <img src="<?= base_url('marker/' . $value['marker']) ?>" width="100px">

                    </div>

                </div>

                <div class="modal-footer justify-content-between">

                    <button type="button" class="btn btn-default" data-dismiss="modal">

                        Close
                    </button>

                    <button type="submit" class="btn btn-primary">

                        Simpan
                    </button>

                </div>

                <?= form_close() ?>

            </div>
        </div>
    </div>

<?php } ?>