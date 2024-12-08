<?= $this->extend('templates/head'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Akun Saya</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Informasi Akun</h5>

                        <div class="row mb-3">
                            <!-- Foto KTP -->
                            <div class="col-sm-3">
                                <img src="<?= base_url('uploads/ktp/' . esc($user['user_ktp'])); ?>" alt="Foto KTP"
                                    class="img-thumbnail" width="150" data-bs-toggle="modal" data-bs-target="#ktpModal">
                            </div>

                            <!-- Kolom Nama, Username, dan No HP -->
                            <div class="col-sm-9">
                                <div class="row mb-3">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama"
                                            value="<?= esc($user['nama']); ?>" disabled>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="username"
                                            value="<?= esc($user['username']); ?>" disabled>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="no_hp"
                                            value="<?= esc($user['no_hp']); ?>" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Edit dan Ubah Password di bawah No HP -->
                        <div class="row mb-3">
                            <div class="col-sm-10 offset-sm-4">
                                <a href="<?= base_url('AkunController/edit') ?>"
                                    class="btn btn-primary rounded-pill me-2">Edit Akun</a>
                                <a href="/akun/ubah-password" class="btn btn-secondary rounded-pill">Ubah Password</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Modal untuk menampilkan Foto KTP -->
<div class="modal fade" id="ktpModal" tabindex="-1" aria-labelledby="ktpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ktpModalLabel">Foto KTP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="<?= base_url('uploads/ktp/' . esc($user['user_ktp'])); ?>" alt="Foto KTP" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>