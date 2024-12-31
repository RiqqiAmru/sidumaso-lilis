<?= $this->extend('templates/head'); ?>
<?= $this->section('content'); ?>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
  </div>
  <section class="section">
    <div class="row">
      <div class="col-lg-12"></div>


      <?php if (session('user_id')['role'] == 'Masyarakat' && session('user_id')['row_status'] == 'Aktif'): ?>
      <!-- Hanya card pengumuman yang ditampilkan untuk masyarakat -->
      <div class="col-12">
        <div class="row">
          <div class="col-xxl-4 col-xl-4">
            <a href="<?= base_url('pengaduan/daftarProses') ?>" style="text-decoration: none;">
              <div class="card info-card customers-card">
                <div class="card-body text-center">
                  <h5 class="card-title">
                    Jumlah Pengaduan Proses |
                    <span style="font-size: 2em; font-weight: bold; color: blue;"><?= $jumlahProses; ?></span>
                  </h5>
                </div>
              </div>
            </a>
          </div>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Pengumuman</h5>
              <!-- Card Pengumuman -->
              <div class="row">
                <?php foreach ($pengumuman as $p): ?>
                <div class="col-md-4 mb-4">
                  <div class="card shadow-sm">
                    <div class="card-body">
                      <h5 class="card-title"><?= esc($p['judul']); ?></h5>
                      <p class="card-text"><?= date('d-m-Y', strtotime($p['tanggal'])); ?></p>

                      <!-- Preview Gambar jika ada -->
                      <?php if ($p['dokumen']): ?>
                      <img src="/uploads/pengumuman/<?= esc($p['dokumen']); ?>" class="img-fluid mb-3"
                        alt="Dokumen pengumuman">
                      <?php endif; ?>

                      <p class="card-text">
                        <?= esc(strlen($p['deskripsi']) > 100 ? substr($p['deskripsi'], 0, 100) . '...' : $p['deskripsi']); ?>
                        <?php if (strlen($p['deskripsi']) > 100): ?>
                        <a href="/pengumuman/detail/<?= $p['id']; ?>" class="text-primary">Baca
                          selengkapnya</a>
                        <?php endif; ?>
                      </p>

                      <!-- Tautan dokumen jika ada -->
                      <?php if ($p['dokumen']): ?>
                      <a href="/uploads/pengumuman/<?= esc($p['dokumen']); ?>" class="btn btn-link btn-sm">Download
                        Dokumen</a>
                      <?php else: ?>
                      <span>Tidak ada dokumen</span>
                      <?php endif; ?>

                      <!-- Tombol Detail akan digantikan jika deskripsi panjang -->
                      <?php if (strlen($p['deskripsi']) <= 100): ?>
                      <a href="/pengumuman/detail/<?= $p['id_pengumuman']; ?>"
                        class="btn btn-info btn-sm mt-3">Detail</a>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>



        <?php elseif (session('user_id')['role'] != 'Masyarakat'): ?>
        <!-- Card untuk admin dan kepala dusun -->
        <div class="row">
          <div class="col-xxl-4 col-xl-4">
            <a href="<?= base_url('pengaduan/daftarProses') ?>" style="text-decoration: none;">
              <div class="card info-card customers-card">
                <div class="card-body text-center">
                  <h5 class="card-title">
                    Jumlah Pengaduan Proses |
                    <span style="font-size: 2em; font-weight: bold; color: blue;"><?= $jumlahProses; ?></span>
                  </h5>
                </div>
              </div>
            </a>
          </div>

          <div class="col-xxl-4 col-xl-4">
            <a href="<?= base_url('pengaduan/selesai') ?>" style="text-decoration: none;">
              <div class="card info-card customers-card">
                <div class="card-body text-center">
                  <h5 class="card-title">
                    Jumlah Pengaduan Selesai |
                    <span style="font-size: 2em; font-weight: bold; color: green;"><?= $jumlahSelesai; ?></span>
                  </h5>
                </div>
              </div>
            </a>
          </div>

          <div class="col-xxl-4 col-xl-4">
            <a href="<?= base_url('pengaduan/invalid') ?>" style="text-decoration: none;">
              <div class="card info-card customers-card">
                <div class="card-body text-center">
                  <h5 class="card-title">
                    Jumlah Pengaduan Tidak Valid |
                    <span style="font-size: 2em; font-weight: bold; color: red;"><?= $jumlahInvalid; ?></span>
                  </h5>
                </div>
              </div>
            </a>
          </div>
        </div>
        <!-- <php else: ?> -->
        <!-- Tangani jika role tidak valid atau tidak ada
                <div class="alert alert-warning">Role pengguna tidak teridentifikasi dengan benar.</div> -->
        <?php endif; ?>

      </div>
  </section>
</main>
<?= $this->endSection(); ?>