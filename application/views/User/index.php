<main>
    <div class="container-fluid">
        <h1 class="mt-4"><?= $judul ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Selamat Datang <?= $this->session->userdata('username') ?> (<?= $this->session->userdata('role') ?>) </li>
        </ol>
        <div class="row">
        </div>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Data User</div>
            <?= $this->session->flashdata('pesan'); ?>
            <div class="card-body">

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Tambah Data User
                </button>


                <br><br>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">

                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center"> ID Outlet </th>
                                <th class="text-center">Username</th>
                                <th class="text-center"> Role </th>

                                <th class="text-center">Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($user as $m) : ?>
                                <tr>
                                    <td class="text-center"><?= $no ?></td>
                                    <td class="text-center"><?= $m['id_outlet'] ?></td>
                                    <td class="text-center"><?= $m['nama'] ?></td>
                                    <td class="text-center"><?= $m['role'] ?></td>
                                    <td class="text-center">
                                        <a href="" class="badge badge-success" role="button" data-toggle="modal" data-target="#modal_edit<?php echo $m['id']; ?>">EDIT</a>
                                        <a href="" class="badge badge-danger" role="button" data-toggle="modal" data-target="#modal_hapus<?php echo $m['id']; ?>">DELETE</a>
                                    </td>

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

            <form method="post" action="<?= base_url('User/index') ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class='row'>
                            <div class="col col-lg-10">
                                <div class="form-group">
                                    <label for="nama">Username</label>
                                    <input type="text" class="form-control" id="nama" name="username">
                                    <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-lg-4">
                                <div class="input-group mb-3 ">
                                    <select class="custom-select" id="inputGroupSelect01" name="role">
                                        <option disabled selected>Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="kasir">Kasir</option>
                                        <option value="owner">Owner</option>
                                    </select>
                                    <?= form_error('role', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col col-lg-4">
                                <div class="input-group mb-3 ">
                                    <select class="custom-select" id="inputGroupSelect02" name="id_outlet">
                                        <option disabled selected>Outlet</option>
                                        <?php foreach ($outlet as $o) : ?>
                                            <option value="<?= $o['id'] ?>"><?= $o['nama'] ?></option>
                                        <?php endforeach; ?>

                                    </select>
                                    <?= form_error('id_outlet', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        </div>



                        <div class='row'>
                            <div class="col col-lg-10">
                                <div class="form-group">
                                    <label for="password1">Password</label>
                                    <input type="password" class="form-control" id="password1" name="password1">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class="col col-lg-10">
                                <div class="form-group">
                                    <label for="password2">Ulangi Password</label>
                                    <input type="password" class="form-control" id="password2" name="password2">
                                    <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
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
<?php foreach ($user as $m) : ?>
    <div class="modal fade" id="modal_hapus<?= $m['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <form class="form-horizontal" method="post" action="<?= base_url('user/deleteData') ?>">
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
<?php foreach ($user as $m) : ?>
    <div class="modal fade" id="modal_edit<?php echo $m['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form method="post" action="<?= base_url('User/editData') ?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class='row'>
                                <div class="col col-lg-10">
                                    <div class="form-group">
                                        <label for="nama">Username</label>
                                        <input type="text" class="form-control" id="nama" name="username1" value="<?= $m['nama'] ?>" readonly>
                                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-lg-4">
                                    <div class="input-group mb-3 ">
                                        <select class="custom-select" id="inputGroupSelect01" name="role" value="<?= $m['role'] ?>">
                                            <option disabled selected>Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="kasir">Kasir</option>
                                            <option value="owner">Owner</option>
                                        </select>
                                        <?= form_error('role', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col col-lg-4">
                                    <div class="input-group mb-3 ">
                                        <select class="custom-select" id="inputGroupSelect02" name="id_outlet" value="<?= $m['id_outlet'] ?>">
                                            <option disabled selected>Outlet</option>
                                            <?php foreach ($outlet as $o) : ?>
                                                <option value="<?= $o['id'] ?>"><?= $o['nama'] ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                        <?= form_error('id_outlet', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>



                            <div class='row'>
                                <div class="col col-lg-10">
                                    <div class="form-group">
                                        <label for="password1">Password</label>
                                        <input type="password" class="form-control" id="password1" name="password1">
                                        <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="col col-lg-10">
                                    <div class="form-group">
                                        <label for="password2">Ulangi Password</label>
                                        <input type="password" class="form-control" id="password2" name="password2">
                                        <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <input type="hidden" class="form-control" id="id_data" name="id_data" value="<?= $m['id'] ?>" readonly>
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