<?= $this->extend('templates/head'); ?>
<?= $this->section('content'); ?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Halaman Tambah Pengumuman</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Tambah Pengumuman</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>


    <section class="section">
        <div class="row">
            <div class="col-lg-12" auto-mx>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Tambah Pengumuman</h5>

                        <!-- General Form Elements -->
                        <form method="post" action="/pengumuman/store" enctype="multipart/form-data">

                            <div class="row mb-3">
                                <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="judul" id="judul"
                                        value="<?= old('judul') ?>" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4"
                                        required><?= old('deskripsi') ?></textarea>
                                </div>
                            </div>



                            <div class="row mb-3">
                                <label for="dokumen" class="col-sm-2 col-form-label">Dokumen</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="dokumen" id="dokumen" required>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">Submit Form</button>
                                </div>
                            </div>
                        </form>
                        <!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<?= $this->endSection(); ?>