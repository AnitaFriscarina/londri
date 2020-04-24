<main>
    <div class="container-fluid">
        <h1 class="mt-4"><?= $judul ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Selamat Datang <?= $this->session->userdata('username') ?> (<?= $this->session->userdata('role') ?>) </li>
        </ol>
        <div class="row">
        </div>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Detail Transaksi</div>
            <?= $this->session->flashdata('pesan'); ?>
            <div class="card-body">
                <?php foreach ($header as $h) : ?>
                    <div class="row">
                        <div class="col lg-3">
                            <label class="text-center">No. Invoice:</label>
                            <div class="alert alert-info text-center">
                                <b><?= $h['kode_invoice'] ?></b>
                            </div>
                        </div>


                        <div class="col lg-3">
                            <label class="text-center">Nama Pemesan: </label>
                            <div class="alert alert-info text-center">
                                <b><?= $h['namamember'] ?></b>
                            </div>
                        </div>
                        <div class="col lg-3">
                            <label class="text-center">Nama Outlet: </label>
                            <div class="alert alert-info text-center">
                                <b><?= $h['nama'] ?></b>
                            </div>
                            </>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col lg-3">
                            <label class="text-center">Tanggal :</label>
                            <div class="alert alert-info text-center">
                                <b><?= $h['tgl'] ?></b>
                            </div>
                        </div>

                        <div class="col lg-3">
                            <label class="text-center">Tanggal Bayar: </label>
                            <?php if ($h['tgl_bayar'] == '0000-00-00') : ?>
                                <div class="alert alert-danger text-center">
                                    <b><?= $h['status_pembayaran'] ?></b>
                                </div>
                            <?php else : ?>
                                <div class="alert alert-info text-center">
                                    <b><?= $h['tgl_bayar'] ?></b>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="col lg-3">
                            <label class="text-center">Tanggal Batas : </label>
                            <div class="alert alert-info text-center">
                                <b><?= $h['batas_waktu'] ?></b>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col lg-6">
                            <label class="text-center">Status :</label>
                            <?php if ($h['status'] == 'baru') : ?>
                                <div class="alert alert-warning text-center">
                                    <b>Baru</b>
                                </div>
                            <?php elseif ($h['status'] == 'proses') : ?>
                                <div class="alert alert-secondary text-center">
                                    <b>Proses</b>
                                </div>
                            <?php elseif ($h['status'] == 'selesai') : ?>
                                <div class="alert alert-primary text-center">
                                    <b>Proses</b>
                                </div>
                            <?php elseif ($h['status'] == 'diambil') : ?>
                                <div class="alert alert-success text-center">
                                    <b>Diambil</b>
                                </div>
                            <?php endif; ?>
                        </div>


                        <div class="col lg-6">
                            <label class="text-center">Status Pembayaran : </label>
                            <?php if ($h['status_pembayaran'] == 'dibayar') : ?>
                                <div class="alert alert-info text-center">
                                    <b>Dibayar</b>
                                </div>
                            <?php else : ?>
                                <div class="alert alert-danger text-center">
                                    <b>Belum Dibayar</b>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col lg-3">
                            <label class="text-center">Total Harga </label>
                            <div class="alert alert-info text-center">
                                <b><?= 'Rp ' . number_format($h['total_harga'], 0, ',', '.') ?></b>
                            </div>
                        </div>
                        <div class="col lg-2">
                            <label class="text-center">Pajak :</label>
                            <div class="alert alert-info text-center">
                                <b><?= $h['pajak'] . '%' ?></b>
                            </div>
                        </div>

                        <div class="col lg-3">
                            <label class="text-center">Diskon : </label>
                            <div class="alert alert-info text-center">
                                <b><?= $h['diskon'] . '%' ?></b>
                            </div>
                        </div>
                        <div class="col lg-3">
                            <label class="text-center">Biaya Tambahan : </label>

                            <div class="alert alert-info text-center">
                                <b><?= 'Rp ' . number_format($h['biaya_tambahan'], 0, ',', '.') ?></b>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    <?php endforeach; ?>



    <a href="<?= base_url('transaksi/pdf/') . $id ?>"> Print Nota Disini</a>


    <br><br>
    <div class="table-responsive">




        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">

            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th class="text-center">Paket</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Harga </th>
                    <th class="text-center">Subtotal</th>

                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($detail as $m) : ?>
                    <tr>
                        <td class="text-center"><?= $no ?></td>
                        <td class="text-center"><?= $m['nama_paket'] ?></td>
                        <td class="text-center"><?= $m['qty'] ?></td>
                        <td class="text-center"> <?= 'Rp.' . number_format($m['harga'], 0, ',', '.') ?></td>
                        <td class="text-center"><?= 'Rp. ' . number_format($m['subtotal'], 0, ',', '.') ?></td>
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