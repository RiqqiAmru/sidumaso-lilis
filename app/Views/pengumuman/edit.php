<?= $this->extend('templates/head'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Pengumuman</h1>
    </div>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="/pengumuman/update/<?= $pengumuman['id'] ?>" enctype="multipart/form-data">
        <div class="row mb-3">
            <label for="judul" class="col-sm-2 col-form-label">Judul</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="judul" id="judul"
                    value="<?= old('judul', $pengumuman['judul']) ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="deskripsi" id="deskripsi"
                    required><?= old('deskripsi', $pengumuman['deskripsi']) ?></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label for="dokumen" class="col-sm-2 col-form-label">Dokumen</label>
            <div class="col-sm-10">
                <input class="form-control" type="file" name="dokumen" id="dokumen">
                <small>Dokumen saat ini: <?= $pengumuman['dokumen'] ?></small>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-primary" style="border-radius: 20px;">Update</button>
            </div>
        </div>
    </form>
</main>

<?= $this->endSection(); ?>