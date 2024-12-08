<?= $this->extend('templates/head'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Detail Pengumuman</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/pengumuman">Pengumuman</a></li>
                <li class="breadcrumb-item active">Detail Pengumuman</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body text-center">
                        <!-- Foto atau Dokumen -->
                        <div class="mb-4">
                            <?php 
                                $fileExtension = pathinfo($pengumuman['dokumen'], PATHINFO_EXTENSION);
                                if ($pengumuman['dokumen']): 
                                    // Jika file adalah gambar
                                    if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])): 
                            ?>
                                        <img src="<?= base_url('/uploads/pengumuman/' . $pengumuman['dokumen']); ?>" alt="Dokumen Pengumuman" class="img-fluid" style="max-height: 300px;">
                                    <?php 
                                    // Jika file adalah PDF
                                    elseif ($fileExtension == 'pdf'): 
                                    ?>
                                        <iframe src="<?= base_url('/uploads/pengumuman/' . $pengumuman['dokumen']); ?>" width="100%" height="500px"></iframe>
                                    <?php else: ?>
                                        <p>Dokumen tidak dapat dipreview.</p>
                                    <?php endif; ?>
                            <?php else: ?>
                                <p>Tidak ada dokumen untuk pengumuman ini.</p>
                            <?php endif; ?>
                        </div>

                        <!-- Judul Pengumuman -->
                        <h2 class="mb-3"><?= esc($pengumuman['judul']); ?></h2>

                        <!-- Tanggal Pengumuman -->
                        <p class="text-muted"><?= date('Y-m-d H:i:s', strtotime($pengumuman['tanggal'])); ?></p>

                        <!-- Deskripsi Pengumuman -->
                        <div class="mt-4">
                            <h5>Deskripsi:</h5>
                            <p><?= nl2br(esc($pengumuman['deskripsi'])); ?></p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<?= $this->endSection(); ?>
