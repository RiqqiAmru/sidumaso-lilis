<?= $this->extend('templates/head'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Daftar Pengguna</h1>
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
                        <h5 class="card-title">Daftar Pengguna</h5>
                        <a href="<?= base_url('admin/user/tambah'); ?>" button type="button"
                            class="btn btn-primary rounded-pill" style="margin-bottom: 25px;">Tambah
                            Pengguna</a>


                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">No HP</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Row Status</th>
                                    <th scope="col">Foto KTP</th>
                                    <th scope="col">Tanggal Dibuat</th>
                                    <th scope="col">Tanggal Diupdate</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($users) && is_array($users)): ?>
                                    <?php $no = 1;
                                    foreach ($users as $user): ?>
                                        <tr>
                                            <th scope="row"><?= $no++ ?></th>
                                            <td><?= $user['nama'] ?></td>
                                            <td><?= $user['username'] ?></td>
                                            <td><?= $user['no_hp'] ?></td>
                                            <td><?= ucfirst($user['role']) ?></td>
                                            <td><?= ucfirst($user['row_status']) ?></td>
                                            <td>
                                                <img src="<?= base_url('uploads/ktp/' . $user['user_ktp']) ?>" alt="Foto KTP"
                                                    width="100">
                                            </td>
                                            <td><?= $user['created_at'] ?></td>
                                            <td><?= $user['updated_at'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9" class="text-center">Belum ada data pengguna.</td>
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