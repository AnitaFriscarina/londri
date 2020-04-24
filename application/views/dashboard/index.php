<main>
    <div class="container-fluid">
        <h1 class="mt-4">Halaman Utama</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Selamat Datang <?= $this->session->userdata('username') ?></li>
        </ol>

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?= base_url('assets/img/3.jpg') ?>" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('assets/img/1.jpg') ?>" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="<?= base_url('assets/img/2.jpg') ?>" class="d-block w-100" alt="...">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>



        <br><br>







        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Jumlah Transaksi</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <?php foreach ($transaksi as $transaksi) : ?>
                            <h5 style="text-align: center;"><?= $transaksi['frem'] ?></h5>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Pekerjaan Belum Selesai</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">

                        <?php foreach ($sls as $sls) : ?>
                            <h5 style="text-align: center;"><?= $sls['frem'] ?></h5>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Total Pendapatan</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <?php foreach ($jmlh as $jmlh) : ?>
                            <h5 style="text-align: center;">Rp. <?= number_format($jmlh['frem'], 0, ',', '.') ?></h5>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body"> Jumlah Transaksi Belum Dibayar</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <?php foreach ($blm as $blm) : ?>
                            <h5 style="text-align: center;"><?= $blm['frem'] ?></h5>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    </div>
</main>