<?= $this->extend('templates/head'); ?>
<?= $this->section('content'); ?>
<?= helper('form'); ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Halaman Tambah Pengaduan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('pengaduan/daftarPengaduan') ?>">Daftar Pengaduan</a></li>
                <li class="breadcrumb-item active">Tambah Pengaduan</li>
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
                        <h5 class="card-title">Form Tambah Pengaduan</h5>

                        <!-- General Form Elements -->
                        <form method="post" action="/pengaduan/store" enctype="multipart/form-data">

                            <div class="row mb-3">
                                <label for="jenis_pengaduan" class="col-sm-2 col-form-label">Jenis Pengaduan</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="jenis_pengaduan" id="jenis_pengaduan" required>
                                        <option value="Infrastukrur" <?= set_select('jenis_pengaduan', 'Infrastukrur') ?>>Infrastukrur</option>
                                        <option value="Sengketa Lahan" <?= set_select('jenis_pengaduan', 'Sengketa Lahan') ?>>Sengketa Lahan</option>
                                        <option value="keamanan dan ketertiban" <?= set_select('jenis_pengaduan', 'keamanan dan ketertiban') ?>>keamanan dan ketertiban</option>
                                        <option value="lingkungan" <?= set_select('jenis_pengaduan', 'lingkungan') ?>>lingkungan</option>
                                        <option value="pengelolaan dana desa" <?= set_select('jenis_pengaduan', 'pengelolaan dana desa') ?>>pengelolaan dana desa</option>
                                        <option value="lainnya" <?= set_select('jenis_pengaduan', 'lainnya') ?>>lainnya</option>
                                    </select>

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="rincian" class="col-sm-2 col-form-label">Rincian</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="rincian" id="rincian"><?= set_value('rincian') ?></textarea>
                                    <small class="text-muted">isikan rincian kasus yang ditemukan, jelaskan dengan sedetail mungkin</small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="status_pengaduan" class="col-sm-2 col-form-label">status Pengaduan</label>
                                <div class="col-sm-10">

                                    <select class="form-select" name="status_pengaduan" id="status_pengaduan" required>
                                        <option <?= set_select('status_pengaduan', 'publik') ?> value="publik">publik</option>
                                        <option <?= set_select('status_pengaduan', 'privat') ?> value="privat">privat</option>
                                    </select>
                                    <small class="text-muted">publik berarti admin dapat melihat nama pengirim, privat berarti admin tidak dapat melihat nama pengirim </small>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="user_ktp" class="col-sm-2 col-form-label">Upload Foto Bukti</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="bukti" name="bukti[]" multiple onchange="previewImages()" required>
                                    <small class="text-muted">Maksimal 512 KB. boleh lebih dari 1 bukti</small>
                                    <div class="form-group">
                                        <label>Preview:</label>
                                        <div id="image-preview-container" style="display: flex; flex-wrap: wrap;">
                                            <!-- Preview gambar akan muncul di sini -->
                                        </div>
                                    </div>
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
<script>
    function previewImages() {
        var previewContainer = document.getElementById('image-preview-container');
        previewContainer.innerHTML = ''; // Clear preview container sebelum menampilkan gambar baru

        var files = document.getElementById('bukti').files;

        if (files.length === 0) {
            previewContainer.innerHTML = '<p>No file selected</p>';
            return;
        }

        Array.from(files).forEach(function(file) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '150px'; // Atur ukuran gambar
                img.style.margin = '10px';
                img.style.borderRadius = '8px';
                img.style.objectFit = 'contain';
                previewContainer.appendChild(img);
            };

            reader.readAsDataURL(file); // Membaca file gambar sebagai URL data
        });
    }
</script>


<?= $this->endSection(); ?>