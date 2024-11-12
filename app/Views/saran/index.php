<?= $this->extend('templates/head'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Saran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">General</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">


                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Saran</h5>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal Saran</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">No Telepon</th>
                                    <th scope="col">Isi Saran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($sarans) && is_array($sarans)): ?>
                                    <?php $no = 1;
                                    foreach ($sarans as $saran): ?>
                                        <tr>
                                            <th scope="row"><?= $no++ ?></th>
                                            <td><?= $saran['created_at'] ?></td>
                                            <td><?= $saran['nama'] ?></td>
                                            <td><?= $saran['no_hp'] ?></td>
                                            <td><?= $saran['saran'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada saran.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </section>


</main><!-- End #main -->
<?= $this->endSection(); ?>