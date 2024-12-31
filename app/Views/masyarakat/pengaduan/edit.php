<?= $this->extend('templates/head'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Pengaduan</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('pengaduan/daftarPengaduan') ?>">Daftar Pengaduan</a>
        </li>
        <li class="breadcrumb-item active">Edit Pengaduan</li>
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
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Form Edit Pengaduan</h5>

            <!-- Menampilkan pesan error atau sukses -->
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


            <form action="<?= site_url('pengaduan/update/' . $pengaduan['id']); ?>" method="post"
              enctype="multipart/form-data">
              <?= csrf_field(); ?>

              <!-- Jenis Pengaduan -->
              <div class="row mb-3">
                <label for="jenis_pengaduan" class="col-sm-2 col-form-label">Jenis Pengaduan</label>
                <div class="col-sm-10">
                  <select class="form-select" name="jenis_pengaduan" id="jenis_pengaduan" required>
                    <option value="Infrastukrur"
                      <?= $pengaduan['jenis_pengaduan'] == 'Infrastukrur' ? 'selected' : ''; ?>>Infrastukrur</option>
                    <option value="Sengketa Lahan"
                      <?= $pengaduan['jenis_pengaduan'] == 'Sengketa Lahan' ? 'selected' : ''; ?>>Sengketa Lahan
                    </option>
                    <option value="Keamanan dan Ketertiban"
                      <?= $pengaduan['jenis_pengaduan'] == 'Keamanan dan Ketertiban' ? 'selected' : ''; ?>>Keamanan dan
                      Ketertiban</option>
                    <option value="Lingkungan" <?= $pengaduan['jenis_pengaduan'] == 'Lingkungan' ? 'selected' : ''; ?>>
                      Lingkungan</option>
                    <option value="Pengelolaan Dana Desa"
                      <?= $pengaduan['jenis_pengaduan'] == 'Pengelolaan Dana Desa' ? 'selected' : ''; ?>>Pengelolaan
                      Dana Desa</option>
                    <option value="Lainnya" <?= $pengaduan['jenis_pengaduan'] == 'Lainnya' ? 'selected' : ''; ?>>Lainnya
                    </option>
                  </select>
                </div>
              </div>

              <!-- Rincian Pengaduan -->
              <div class="row mb-3">
                <label for="rincian" class="col-sm-2 col-form-label">Rincian</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="rincian" id="rincian"
                    required><?= old('rincian', $pengaduan['rincian']); ?></textarea>
                </div>
              </div>


              <!-- Detail Lokasi -->
              <div class="row mb-3">
                <label for="detail_lokasi" class="col-sm-2 col-form-label">Detail Lokasi</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="detail_lokasi" id="detail_lokasi"
                    required><?= old('detail_lokasi', $pengaduan['detail_lokasi']); ?></textarea>
                </div>
              </div>

              <!-- Gang -->
              <div class="row mb-3">
                <label for="gang" class="col-sm-2 col-form-label">Gang</label>
                <div class="col-sm-10">
                  <select class="form-select" name="gang" id="gang" required>
                    <option value="1" <?= $pengaduan['gang'] == '1' ? 'selected' : ''; ?>>1</option>
                    <option value="2" <?= $pengaduan['gang'] == '2' ? 'selected' : ''; ?>>2</option>
                    <option value="3" <?= $pengaduan['gang'] == '3' ? 'selected' : ''; ?>>3</option>
                    <option value="4" <?= $pengaduan['gang'] == '4' ? 'selected' : ''; ?>>4</option>
                    <option value="5" <?= $pengaduan['gang'] == '5' ? 'selected' : ''; ?>>5</option>
                  </select>
                </div>
              </div>

              <!-- Upload Foto Bukti -->
              <div class="row mb-3">
                <label for="bukti" class="col-sm-2 col-form-label">Upload Foto Bukti</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="bukti" name="bukti[]" multiple onchange="previewImages()">
                  <small class="text-muted">Maksimal 512 KB. Boleh lebih dari 1 bukti.
                    Opsional</small>
                  <div class="form-group">
                    <label>Preview:</label>
                    <div id="image-preview-container" style="display: flex; flex-wrap: wrap; gap: 20px;">
                      <!-- Tampilkan gambar yang sudah ada -->
                      <?php if (!empty($pengaduan['foto'])): ?>

                        <?php foreach ($pengaduan['foto'] as $foto): ?>
                          <?php
                          // Dapatkan ekstensi file
                          $file_extension = pathinfo($foto, PATHINFO_EXTENSION);
                          // Daftar ekstensi gambar yang diperbolehkan
                          $allowed_image_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                          // Periksa apakah file tersebut termasuk dalam ekstensi gambar
                          if (in_array(strtolower($file_extension), $allowed_image_extensions)):
                          ?>
                            <!-- Jika file adalah gambar, tampilkan gambar -->
                            <img src="<?= base_url('uploads/bukti/' . $foto) ?>" alt="Foto bukti" class="img-thumbnail"
                              width="100" data-bs-toggle="modal" data-bs-target="#imageModal">
                          <?php else: ?>
                            <!-- Jika bukan gambar, tampilkan sesuatu lain (misalnya teks atau icon) -->
                            <a href="<?= base_url('uploads/bukti/' . $foto) ?>" target="_blank"
                              rel="noopener noreferrer">download
                              <?= $file_extension ?></a>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>


              <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2">
                  <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
              </div>
            </form>

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
        var fileType = file.type;
        console.log(fileType);
        if (fileType.startsWith('image/')) {
          var img = document.createElement('img');
          img.src = e.target.result;
          img.style.width = '150px'; // Atur ukuran gambar
          img.style.margin = '10px';
          img.style.borderRadius = '8px';
          img.style.objectFit = 'contain';

          previewContainer.appendChild(img);
        } else {
          var link = document.createElement('a');
          // link border

          link.href = event.target.result;
          link.target = '_blank';
          link.textContent = 'download ' + file.name;
          previewContainer.appendChild(link);

        }
      };

      reader.readAsDataURL(file); // Membaca file gambar sebagai URL data
    });
  }
</script>

<?= $this->endSection(); ?>