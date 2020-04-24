<main>
    <div class="container-fluid">
        <h1 class="mt-4"><?= $judul ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Selamat Datang <?= $this->session->userdata('username') ?> (<?= $this->session->userdata('role') ?>) </li>
        </ol>
        <div class="row">
        </div>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Dataa Pelanggan</div>
            <?= $this->session->flashdata('pesan'); ?>
            <div class="card-body">
                <?php if ($this->session->userdata('role') == 'admin' or  $this->session->userdata('role') == 'kasir') : ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Tambah Data Pelanggan
                    </button>
                <?php endif; ?>
                <br><br>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">

                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>No. Telpon</th>
                                <?php if ($this->session->userdata('role') == 'admin' or  $this->session->userdata('role') == 'kasir') : ?>
                                    <th>Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($member as $m) : ?>
                                <tr>
                                    <td class="text-center"><?= $no ?></td>
                                    <td class="text-center"><?= $m['nama'] ?></td>
                                    <td> <?= $m['alamat'] ?></td>
                                    <td class="text-center"><?= $m['jenis_kelamin'] ?></td>
                                    <td class="text-center"><?= $m['tlp'] ?></td>
                                    <?php if ($this->session->userdata('role') == 'admin' or  $this->session->userdata('role') == 'kasir') : ?>
                                        <td class="text-center">
                                            <a href="" class="badge badge-success" role="button" data-toggle="modal" data-target="#modal_edit<?php echo $m['id']; ?>">EDIT</a>

                                            <a href="" class="badge badge-danger" role="button" data-toggle="modal" data-target="#modal_hapus<?php echo $m['id']; ?>">DELETE</a>

                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <?php $no += 1 ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>




<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="post" action="<?= base_url('Pelanggan/index') ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class='row'>
                            <div class="col col-lg-10">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama">
                                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class="col col-lg-10">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat">
                                    <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class="col col-lg-10">
                                <div class="form-group">
                                    <label for="tlp">No. Telpon</label>
                                    <input type="number" class="form-control" id="tlp" name="tlp">
                                    <?= form_error('tlp', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-lg-4">
                                <div class="input-group mb-3 ">
                                    <select class="custom-select" id="inputGroupSelect01" name="gender">
                                        <option disabled selected>Gender</option>
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                    <?= form_error('gender', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name='submit' class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>




<!----delete modal->>>>
<!---Modal delete menu--->
<?php foreach ($member as $m) : ?>
    <div class="modal fade" id="modal_hapus<?= $m['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <form class="form-horizontal" method="post" action="<?= base_url('Pelanggan/deleteData') ?>">
                    <div class="modal-body">
                        <p><b>Anda yakin ingin menghapus data yang terpilih? </b></p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="id" value="<?php echo $m['id']; ?>" readonly>

                        <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>
                        <button class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>



<!--Modal EDIT-->
<?php foreach ($member as $m) : ?>
    <div class="modal fade" id="modal_edit<?php echo $m['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form method="post" action="<?= base_url('Pelanggan/editData') ?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Pelanggan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class='row'>
                                <div class="col col-lg-10">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $m['nama'] ?> ">
                                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="col col-lg-10">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $m['alamat'] ?> ">
                                        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="col col-lg-10">
                                    <div class="form-group">
                                        <label for="tlp">No. Telpon</label>
                                        <input type="text" class="form-control" id="tlp" name="tlp" value="<?= $m['tlp'] ?> ">
                                        <?= form_error('tlp', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-lg-4">
                                    <div class="input-group mb-3 ">
                                        <select class="custom-select" id="inputGroupSelect01" name="gender" value="<?= $m['jenis_kelamin'] ?> ">
                                            <option disabled selected>Gender</option>
                                            <option value="L">Laki-Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        <?= form_error('gender', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="id_data" name="id_data" value="<?= $m['id'] ?> ">

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name='submit' class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>