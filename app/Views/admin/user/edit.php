<?= $this->extend('templates/head'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Data Pengguna</h1>
  </div>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Informasi Pengguna</h5>

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

            <form action="<?= site_url('admin/manageuser/update/' . $user['id_user']); ?>" method="post">
              <?= csrf_field(); ?>

              <!-- Input Nama -->
              <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="nama" name="nama"
                    value="<?= old('nama', $user['nama']); ?>" required>
                </div>
              </div>

              <!-- Input No HP -->
              <div class="row mb-3">
                <label for="no_hp" class="col-sm-2 col-form-label">No Handphone</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="no_hp" name="no_hp"
                    value="<?= old('no_hp', $user['no_hp']); ?>" required>
                </div>
              </div>

              <!-- Input Role -->
              <div class="row mb-3">
                <label for="role" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                  <select class="form-control" id="role" name="role" required>
                    <option value="Admin" <?= $user['role'] == 'Admin' ? 'selected' : ''; ?>>Admin
                    </option>
                    <option value="Kepala_dusun" <?= $user['role'] == 'Kepala_dusun' ? 'selected' : ''; ?>>Kepala Dusun
                    </option>
                    <option value="Masyarakat" <?= $user['role'] == 'Masyarakat' ? 'selected' : ''; ?>>
                      Masyarakat</option>
                  </select>
                </div>
              </div>

              <!-- Input Status Pengguna -->
              <div class="row mb-3">
                <label for="row_status" class="col-sm-2 col-form-label">Status Pengguna</label>
                <div class="col-sm-10">
                  <select class="form-control" id="row_status" name="row_status" required>
                    <option value="Menunggu" <?= $user['row_status'] == 'Menunggu' ? 'selected' : ''; ?>>Menunggu
                    </option>
                    <option value="Aktif" <?= $user['row_status'] == 'Aktif' ? 'selected' : ''; ?>>
                      Aktif</option>
                    <option value="Non-aktif" <?= $user['row_status'] == 'Non-aktif' ? 'selected' : ''; ?>>Non-aktif
                    </option>
                  </select>
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