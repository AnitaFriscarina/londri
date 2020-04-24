<main>
    <div class="container-fluid">
        <h1 class="mt-4"><?= $judul ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Selamat Datang <?= $this->session->userdata('username') ?> (<?= $this->session->userdata('role') ?>) </li>
        </ol>
        <div class="row">
        </div>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Data Transaksi</div>
            <?= $this->session->flashdata('pesan'); ?>
            <div class="card-body">
                <?php if ($this->session->userdata('role') == 'admin' or  $this->session->userdata('role') == 'kasir') : ?>
                    <a class="btn btn-primary" href="<?= base_url('transaksi/') ?>tambahData">Tambah Data Transaksi</a>
                <?php endif; ?>
                <br><br>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">

                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th class="text-center">Kode Invoice</th>
                                <th class="text-center">Nama Pemesan</th>
                                <th class="text-center">Tanggal </th>
                                <th class="text-center">Status Pekerjaan</th>
                                <th class="text-center">Status Pembayaran</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($transaksi as $m) : ?>
                                <tr>
                                    <td class="text-center"><?= $no ?></td>
                                    <td class="text-center"><?= $m['kode_invoice'] ?></td>
                                    <td class="text-center">
                                        <?= $m['nama'] ?>
                                    </td>
                                    <td class="text-center"> <?= $m['tgl'] ?></td>
                                    <td class="text-center">

                                        <?php if ($m['status'] == 'baru') :  ?>
                                            <?php echo '<div class="alert alert-warning small" >
                                            <b>Baru</b>
                                        </div>'; ?>
                                        <?php elseif ($m['status'] == 'proses') : ?>
                                            <?php echo '<div class="alert alert-secondary small">
                                            <b>Proses</b>
                                        </div>'; ?>
                                        <?php elseif ($m['status'] == 'diambil') : ?>
                                            <?php echo '<div class="alert alert-success small">
                                            <b>Diambil</b>
                                        </div>'; ?>
                                        <?php elseif ($m['status'] == 'selesai') : ?>
                                            <?php echo '<div class="alert alert-primary small">
                                            <b>Selesai</b>
                                        </div>'; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($m['status_pembayaran'] == 'belum dibayar') : ?>
                                            <?php echo '<div class="alert alert-danger small">
                                            <b>Belum Dibayar</b>
                                        </div>'; ?>
                                        <?php elseif ($m['status_pembayaran'] == 'dibayar') : ?>
                                            <?php echo '<div class="alert alert-success small">
                                            <b>Telah Dibayar</b>
                                        </div>'; ?>
                                        <?php endif; ?>


                                    </td>

                                    <td class="text-center">
                                        <?php if ($this->session->userdata('role') == 'kasir') : ?>
                                            <a href="" class="badge badge-primary" role="button" data-toggle="modal" data-id="<?= $m['id'] ?>" data-target="#modal_bayar<?php echo $m['id']; ?>">BAYAR</a>
                                            <a href="<?= base_url('transaksi/pdf/') . $m['id'] ?>" class=" badge badge-success  " role="button">PRINT</a><br>
                                            <a href="" class="badge badge-dark" role="button" data-toggle="modal" data-id="<?= $m['id'] ?>" data-target="#modal_status<?php echo $m['id']; ?>">STATUS</a>
                                            <a href="<?= base_url('Transaksi/detail/') . $m['id'] ?>" class="badge badge-secondary" role="button" data-id="<?= $m['id'] ?>" ">DETAIL</a>
                                            <?php elseif ($this->session->userdata('role') == 'admin') : ?>
                                                <a href="" class=" badge badge-danger" role="button" data-toggle="modal" data-target="#modal_hapus<?php echo $m['id']; ?>">DELETE</a>
                                            <a href="<?= base_url('transaksi/pdf/') . $m['id'] ?>" class=" badge badge-success  " role="button">PRINT</a><br>
                                            <a href=" <?= base_url('Transaksi/detail/') . $m['id'] ?>" class="badge badge-secondary" role="button" data-id="<?= $m['id'] ?>" ">DETAIL</a>
                                                <a href="" class=" badge badge-primary" role="button" data-toggle="modal" data-id="<?= $m['id'] ?>" data-target="#modal_bayar<?php echo $m['id']; ?>">BAYAR</a>
                                            <a href="" class="badge badge-dark" role="button" data-toggle="modal" data-id="<?= $m['id'] ?>" data-target="#modal_status<?php echo $m['id']; ?>">STATUS</a>
                                        <?php elseif ($this->session->userdata('role') == 'owner') : ?>
                                            <a href="<?= base_url('Transaksi/detail/') . $m['id'] ?>" class="badge badge-secondary" role="button" data-id="<?= $m['id'] ?>" ">DETAIL</a>
                                            <a href=" <?= base_url('transaksi/pdf/') . $m['id'] ?>" class=" badge badge-success  " role="button">PRINT</a>
                                        <?php endif; ?>
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




<!----delete modal->>>>
<!---Modal delete menu--->
<?php foreach ($transaksi as $m) : ?>
    <div class=" modal fade" id="modal_hapus<?= $m['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <form class="form-horizontal" method="post" action="<?= base_url('Transaksi/delete') ?>">
                    <div class="modal-body">
                        <p><b>Anda yakin ingin menghapus data Transaksi yang terpilih? </b></p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="idtransaksi" id="id" value="<?php echo $m['id']; ?>" readonly>

                        <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>
                        <button class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!---Bayar---->
<?php foreach ($transaksi as $m) : ?>
    <div class="modal fade" id="modal_bayar<?= $m['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">



                <form method="post" action="<?= base_url('Transaksi/bayar') ?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bayar Transaksi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class='row'>
                                <div class="col col-lg-10">
                                    <div class="form-group">
                                        <label for="NoInvoice">No Invoice</label>
                                        <input type="text" class="form-control" id="NoInvoice" name="noinv" value="<?= $m['kode_invoice'] ?>" readonly>
                                        <?= form_error('noinv', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class='row'>
                                <div class="col col-lg-10">
                                    <div class="form-group">
                                        <label for="namapemesan">Nama Pemesan</label>
                                        <input type="text" class="form-control" id="namapemesan" name="namapemesan" value="<?= $m['nama'] ?>" readonly>
                                        <?= form_error('noinv', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="col col-lg-10">
                                    <div class="form-group">
                                        <label for="totalharga">Total Harga</label>
                                        <input type="text" class="form-control" id="totalharga<?= $m['id'] ?>" name="totalharga" value="Rp. <?= number_format($m['total_harga'], 0, ',', '.') ?>" readonly>
                                        <?= form_error('totalharga', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="col col-lg-10">
                                    <div class="form-group">
                                        <label for="totalharga">Tanggal Bayar :</label>
                                        <input type="date" class="form-control" name="tanggalbayar">
                                        <?= form_error('tanggalbayar', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="col col-lg-4">
                                    <div class="form-group">
                                        <label for="pajak">Pajak (%)</label>
                                        <input type="number" class="form-control" id="pajak<?= $m['id'] ?>" name="pajak">
                                        <?= form_error('pajak', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col col-lg-4">
                                    <div class="form-group">
                                        <label for="diskon">Diskon (%)</label>
                                        <input type="number" class="form-control" id="diskon<?= $m['id'] ?>" name="diskon">
                                        <?= form_error('diskon', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>

                                <div class="col col-lg-4">
                                    <div class="form-group">
                                        <label for="biayatambahan">Biaya Tambahan</label>
                                        <input type="number" class="form-control" id="biayatambahan<?= $m['id'] ?>" name="biayatambahan">
                                        <?= form_error('biayatambahan', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="col col-lg-10">
                                    <div class="form-group">
                                        <label for="takhir">Total Harga Akhir</label>
                                        <input type="number" class="form-control" id="takhir<?= $m['id'] ?>" name="takhir" value="" readonly>
                                        <?= form_error('takhir', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <input name="idheader" id="idheader" type="hidden" value="<?= $m['id'] ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name='submit' class="btn btn-primary">Bayar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>




<!---STATUS---->
<?php foreach ($transaksi as $m) : ?>
    <div class="modal fade" id="modal_status<?= $m['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="<?= base_url('Transaksi/ubahStatus') ?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Status Transaksi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class='row'>
                                <div class="col col-lg-10">
                                    <div class="form-group">
                                        <label for="NoInvoice">No Invoice</label>
                                        <input type="text" class="form-control" id="NoInvoice" name="noinv" value="<?= $m['kode_invoice'] ?>" readonly>
                                        <?= form_error('noinv', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="col col-lg-10">
                                    <div class="form-group">
                                        <label for="namapemesan">Nama Pemesan</label>
                                        <input type="text" class="form-control" id="namapemesan" name="namapemesan" value="<?= $m['nama'] ?>" readonly>
                                        <?= form_error('noinv', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="col col-lg-10">
                                    <div class="form-group">
                                        <label for="namapemesan">Status Saat ini</label>
                                        <?php if ($m['status'] == 'baru') :  ?>
                                            <?php echo '<div class="alert alert-warning small" >
                                            <b>Baru</b>
                                        </div>'; ?>
                                        <?php elseif ($m['status'] == 'proses') : ?>
                                            <?php echo '<div class="alert alert-secondary small">
                                            <b>Proses</b>
                                        </div>'; ?>
                                        <?php elseif ($m['status'] == 'diambil') : ?>
                                            <?php echo '<div class="alert alert-success small">
                                            <b>Diambil</b>
                                        </div>'; ?>
                                        <?php elseif ($m['status'] == 'selesai') : ?>
                                            <?php echo '<div class="alert alert-primary small">
                                            <b>Selesai</b>
                                        </div>'; ?>
                                        <?php endif; ?>
                                        <?= form_error('noinv', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-lg-4">
                                    <div class="input-group mb-3 ">
                                        <label>Ubah Status </label>
                                        <select class="custom-select" id="statuspekerjaan" name="statuspekerjaan">
                                            <option disabled selected>Status</option>
                                            <option value="baru">Baru</option>
                                            <option value="proses">Proses</option>
                                            <option value="selesai">Selesai</option>
                                            <option value="diambil">Diambil</option>
                                        </select>
                                        <?= form_error('statuspekerjaan', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <input name="idtransheader" type="hidden" value="<?= $m['id'] ?>">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name='submit' class="btn btn-primary">Ubah Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>