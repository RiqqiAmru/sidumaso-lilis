<?= $this->extend('templates/head'); ?>
<?= $this->section('content'); ?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Halaman Tambah Pengguna</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/admin/manageuser/') ?>">Daftar Pengguna</a>
                </li>
                <li class="breadcrumb-item active">Tambah Pengguna</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- Menampilkan pesan error jika ada -->
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger" role="alert">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <section class="section">
        <div class="row">
            <div class="col-lg-12" auto-mx>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Tambah Pengguna</h5>

                        <!-- General Form Elements -->
                        <form method="post" action="/admin/user/store" enctype="multipart/form-data">

                            <div class="row mb-3">
                                <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        value="<?= old('nama') ?>" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="username" id="username"
                                        value="<?= old('username') ?>" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="no-hp" class="col-sm-2 col-form-label">No Handphone</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="no_hp" id="no-hp"
                                        value="<?= old('no_hp') ?>" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="password" id="password" required>
                                    <small class="text-muted">Minimal 6 karakter.</small>
                                </div>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="confirm_password"
                                        id="confirm_password" placeholder="Konfirmasi password" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="user_ktp" class="col-sm-2 col-form-label">Upload Foto KTP</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="user_ktp" id="user_ktp" required>
                                    <small class="text-muted">Maksimal 512 KB.</small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="role" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="role" id="role" required>
                                        <option value="Admin">Admin</option>
                                        <option value="Kepala_dusun">Kepala Dusun</option>
                                        <option value="Masyarakat">Masyarakat</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="row_status" class="col-sm-2 col-form-label">Status Pengguna</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="row_status" id="row_status" required>
                                        <option value="Menunggu">Menunggu</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Non-aktif">Non-aktif</option>
                                    </select>
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