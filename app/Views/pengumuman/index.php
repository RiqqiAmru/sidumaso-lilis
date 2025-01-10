<?= $this->extend('templates/head'); ?>
<?= $this->section('content'); ?>
<main id="main" class="main">
  <!-- Menampilkan pesan flash jika ada -->
  <?php if (session()->getFlashdata('message')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= session()->getFlashdata('message'); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>
  <div class="pagetitle">
    <h1>Daftar Pengumuman</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Halaman Pengumuman</h5>
            <a href="<?= base_url('pengumuman/create'); ?>" class="btn btn-primary rounded-pill"
              style="margin-bottom: 25px;">Tambah Pengumuman</a>
            <?php if (session()->getFlashdata('error')): ?>
              <div class="alert alert-danger">
                <?= session()->getFlashdata('error'); ?>
              </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('success')): ?>
              <div class="alert alert-success">
                <?= session()->getFlashdata('success'); ?>
              </div>
            <?php endif; ?>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Judul</th>
                  <th scope="col">Deskripsi</th>
                  <th scope="col">Dokumen</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($pengumuman as $p): ?>
                  <tr>
                    <td><?= $p['id_pengumuman'] ?></td>
                    <td><?= $p['tanggal'] ?></td>
                    <td><?= $p['judul'] ?></td>
                    <td>
                      <!-- Tampilkan cuplikan deskripsi -->
                      <?= esc(strlen($p['deskripsi']) > 100 ? substr($p['deskripsi'], 0, 100) . '...' : $p['deskripsi']); ?>
                    </td>
                    <td>
                      <?php if ($p['dokumen']): ?>
                        <a href="/uploads/pengumuman/<?= $p['dokumen'] ?>">Download</a>
                      <?php endif; ?>
                    </td>
                    <td>
                      <!-- Tombol Edit -->
                      <form action="/pengumuman/edit/<?= $p['id_pengumuman'] ?>" method="post"
                        class="d-inline-block mr-2">
                        <button class="btn btn-primary">Edit</button>
                      </form>
                      <!-- Tombol Detail untuk mengarahkan ke halaman detail -->
                      <a href="/pengumuman/detail/<?= $p['id_pengumuman']; ?>"
                        class="btn btn-info d-inline-block">Detail</a>
                    </td>

                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </section>
</main><!-- End #main -->

<?= $this->endSection(); ?>