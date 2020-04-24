<main>
    <div class="container-fluid">
        <h1 class="mt-4"><?= $judul ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Selamat Datang <?= $this->session->userdata('username') ?> (<?= $this->session->userdata('role') ?>) </li>
        </ol>
        <div class="row">
        </div>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Tambah Data Transaksi</div>
            <?= $this->session->flashdata('pesan'); ?>
            <div class="card-body">
                <form method="post" action="<?= base_url('transaksi/tambahData') ?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Transaksi</h5>

                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col col-lg-3">
                                    <div class="input-group mb-3 ">
                                        <select class="custom-select" id="inputGroupSelect01" name="id_outlet">
                                            <option disabled selected>Pilih Outlet</option>
                                            <?php foreach ($outlet as $o) : ?>
                                                <option value="<?= $o['id'] ?>"><?= $o['nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <?= form_error('id_outlet', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col col-lg-4">
                                    <div class="input-group mb-3 ">
                                        <select class="custom-select" id="inputGroupSelect01" name="id_member">
                                            <option disabled selected>Pilih Member</option>
                                            <?php foreach ($member as $o) : ?>
                                                <option value="<?= $o['id'] ?>"><?= $o['nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?= form_error('id_member', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col col-lg-3">
                                    <div class="input-group mb-3">
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal :</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal_paket">
                                            <?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-3">
                                    <div class="input-group mb-3">
                                        <div class="form-group">
                                            <label for="tanggal">Estimasi Selesai, Tanggal :</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal_batas">
                                            <?= form_error('tanggal_batas', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <button type="button" class="btn btn-primary mb-3" id="tombol">Tambah Baris</button>
                                <button type="button" class="btn btn-danger mb-3" id="deleteBaris">Hapus Baris</button>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th style="width: 200px;" class="text-center">Nama Paket</th>
                                            <th style="width: 80px;">Quantity (kg) </th>
                                            <th style="width: 200px;" class="text-center">Sub Total</th>
                                            <th style="width: 400px;" class="text-center">Keterangan</th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                        <tr>
                                            <td>1</td>
                                            <td class="text-center" id="paket">
                                            </td>
                                            <td class="text-center">

                                                <input pattern="^\d*(\.\d{0,2})?$" class="form-control inputsm" id="qty" name="qty[]" value="">
                                                <?= form_error('qty[]', '<small class="text-danger pl-3">', '</small>'); ?>

                                            </td>
                                            <td class="text-center"><input class="form-control inputsm" name="subtotal[]" id="subtotal" value=" " readonly>
                                            </td>
                                            <td class="text-center">
                                                <input type="text" class="form-control" id="keterangan" name="keterangan[]">
                                                <?= form_error('keterangan[]', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary">Batal</button>
                        <button type=" submit" name='submit' class="btn btn-primary">Tambah Transaksi</button>
                    </div>
                </form>



                <br><br>

            </div>
        </div>
    </div>
</main>

<?php 
/*
$outlet = $this->input->post('id_outlet');
$member = $this->input->post('id_member');
$nonmem = $this->input->post('nonmember');
$tanggal = $this->input->post('tanggal');
$biaya = $this->input->post('biayatambahan');
$qty = $this->input->post('qty[]');
$subtotal = $this->input->post('subtotal[]');
$ket = $this->input->post('keterangan[]');
$paket = $this->input->post('paket[]');
$dataheader = [
    'id_outlet' => $outlet,
    'kode_invoice' => 'invoice',
    'id_member' => $member,
    'pembeli_nonmember' => $nonmem,
    'tgl' => $tanggal,
    'batas_waktu' => '',
    'tgl_bayar' => '',
    'biya_tambahan' => $biaya,
    'diskon' => '',
    'pajak' => '',
    'total_harga' => '',
    'status' => '',
    'status_pembayaran' => '',
    'id_user' => ''
];
var_dump($dataheader);

$datadetail = [];
$i = 0;
foreach ($paket as $p) {
    array_push($datadetail, [
        'id_transaksi' => 1,
        'id_paket' => $paket[$i],
        'qty' => $qty[$i],
        'subtotal' => $subtotal[$i],
        'keterangan' => $ket[$i]
    ]);
    $i++;
}
var_dump($datadetail);




?>
*/
