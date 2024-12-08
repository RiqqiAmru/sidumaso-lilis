<?= $this->extend('templates/head'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Akun Saya</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Informasi Akun</h5>

                        <form action="/akun/update" method="POST">
                            <div class="row mb-3">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="<?= esc($user['nama']); ?>" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username"
                                        value="<?= esc($user['username']); ?>" disabled>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="no_hp" name="no_hp"
                                        value="<?= esc($user['no_hp']); ?>" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="user_ktp" class="col-sm-2 col-form-label">Foto KTP</label>
                                <div class="col-sm-10">
                                    <img src="<?= base_url('uploads/ktp/' . esc($user['user_ktp'])); ?>" alt="Foto KTP"
                                        class="img-thumbnail" width="150">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary rounded-pill">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

<?= $this->endSection(); ?>