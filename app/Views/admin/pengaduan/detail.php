<?= $this->extend('templates/head'); ?>
<?= $this->section('content'); ?>
<?= helper('form'); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Proses Pengaduan</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('/pengaduan') ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('/pengaduan/masuk') ?>">Pengaduan Masuk</a></li>
        <li class="breadcrumb-item active">proses</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section proses-pengaduan">
    <div class="row">


      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->

            <div class="tab-content pt-2">

              <div class="tab-pane fade show active pengaduan-overview" id="pengaduan-overview">
                <!-- pengaduan detail -->
                <div class="aduan">
                  <h5 class="card-title">Proses Pengaduan</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Jenis Pengaduan</div>
                    <div class="col-lg-9 col-md-8"><?= $pengaduan['p']['jenis_pengaduan'] ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Status Aduan</div>
                    <div class="col-lg-9 col-md-8"><?= $pengaduan['p']['status_aduan'] ?>[<?= ($pengaduan['p']['status_aduan'] == 'publik') ? $pengaduan['p']['nama'] : '' ?>]</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Rincian</div>
                    <div class="col-lg-9 col-md-8"><?= $pengaduan['p']['rincian'] ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Gambar</div>
                    <div class="col-lg-9 col-md-8">
                      <?php foreach ($pengaduan['foto'] as $foto) : ?>
                        <img src="<?= base_url('uploads/bukti/' . $foto['foto']) ?>" alt="Foto bukti" class="img-thumbnail"
                          width="200">
                      <?php endforeach ?>
                    </div>
                  </div>
                </div>

                <hr>

                <?php if (session()->getFlashdata('errors')): ?>
                  <div class="alert alert-danger" role="alert">
                    <ul>
                      <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                  <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                  </div>
                <?php endif; ?>

                <!-- tanggapan admin -->
                <div id="tanggapan-admin">
                  <h5 class="card-title">Tambahkan Tanggapan</h5>
                  <form method="post" action="/pengaduan/storeTanggapanAdmin" enctype="multipart/form-data">
                    <input type="hidden" name="id_aduan" value="<?= $pengaduan['p']['id'] ?>">
                    <div class="row mb-3">
                      <label for="jenis_tanggapan" class="col-sm-2 col-form-label">jenis Tanggapan</label>
                      <div class="col-sm-10">
                        <select class="form-select" name="jenis_tanggapan" id="jenis_tanggapan" required>
                          <option value="Proses" <?= set_select('jenis_tanggapan', 'Proses') ?>>Proses</option>
                          <option value="Kurang Gambar" <?= set_select('jenis_tanggapan', 'Kurang Gambar') ?>>Kurang Gambar</option>
                          <option value="Kurang Rincian" <?= set_select('jenis_tanggapan', 'Kurang Rincian') ?>>Kurang Rincian</option>
                          <option value="Selesai" <?= set_select('jenis_tanggapan', 'Selesai') ?>>Selesai</option>
                        </select>

                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="rincian_admin" class="col-sm-2 col-form-label">Rincian Tanggapan</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="rincian_admin" id="rincian_admin" required><?= set_value('rincian') ?></textarea>
                        <small class="text-muted">isikan rincian terkait tanggapan, agar bisa dilihat oleh pengirim aduan</small>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="user_ktp" class="col-sm-2 col-form-label">Upload Foto Tanggapan</label>
                      <div class="col-sm-10">
                        <small class="text-muted">Upload foto tanggapan/bukti penyelesaian pengaduan [opsional]</small>
                        <input type="file" class="form-control" id="bukti" name="bukti[]" multiple onchange="previewImages()">
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
                </div>

              </div>


            </div><!-- End Bordered Tabs -->

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