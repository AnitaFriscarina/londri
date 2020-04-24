<main>
    <div class="container-fluid">
        <h1 class="mt-4"><?= $judul ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Selamat Datang <?= $this->session->userdata('username') ?> (<?= $this->session->userdata('role') ?>) </li>
        </ol>
        <div class="row">
        </div>
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Riwayat Log </div>
            <?= $this->session->flashdata('pesan'); ?>
            <div class="card-body">
                <br><br>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover tabelLog" id="dataTable" width="100%" cellspacing="0">

                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Waktu</th>
                                <th class="text-center">User</th>
                                <th class="text-center">Tipe</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php $no = 1 ?>
                            <?php foreach ($log as $l) : ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td> <?= $l['log_time'] ?></td>
                                    <td><?= $l['log_user'] ?></td>
                                    <td><?= $l['log_tipe'] ?></td>
                                    <td><?= $l['log_aksi'] ?></td>
                                </tr>
                                <?php $no++ ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>