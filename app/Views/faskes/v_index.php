<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
            <div class="card-tools">
                <a href="<?= base_url('faskes/input') ?>" class="btn btn-flat btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah
                </a>
            </div>
        </div>

        <div class="card-body">
        <?php
        if (session()->getFlashdata('pesan')) {
            echo '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> ' . session()->getFlashdata('pesan') . '</h5></div>';
        }
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
            <h5><i class="icon fas fa-ban"></i> ' . session()->getFlashdata('delete') . '</h5></div>';
        }
        ?>


            <table id="example2" class="table table-sm table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Nama faskes</th>
                        <th>Jenis</th>
                        <th>Status</th>
                        <th>Akreditasi</th>
                        <th>Alamat</th>
                        <th>Foto</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($faskes as $key => $value) { ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $value['nama_faskes'] ?></td>
                            <td class="text-center"><?= ucwords($value['jenis'] ?? '') ?></td>
                            <td class="text-center"><?= $value['status'] ?></td>
                            <td class="text-center"><?= $value['akreditasi'] ?></td>
                            <td><?= $value['alamat'] ?></td>
                            <td class="text-center"><img src="<?= base_url('foto/' . $value['foto']) ?>" alt="" width="150px" height="100px"></td>

                            <td class="text-center">
                                <a href="<?= base_url('faskes/edit/' . $value['id_faskes']) ?>" class="btn btn-xs btn-success btn-flat"><i class="fas fa-eye"></i></a>
                                <a href="<?= base_url('faskes/edit/' . $value['id_faskes']) ?>" class="btn btn-xs btn-warning btn-flat"><i class="fas fa-pencil-alt"></i></a>
                                <a href="<?= base_url('faskes/delete/' . $value['id_faskes']) ?>" onclick="return confirm('Yakin Hapus Data..?')" class="btn btn-xs btn-danger btn-flat"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#example2').DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true
        });
    });
</script>
