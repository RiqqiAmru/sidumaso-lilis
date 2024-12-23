<?= $this->extend('templates/head'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
  <?php if (session()->getFlashdata('message')): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= session()->getFlashdata('message'); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php endif; ?>
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
            <a href="<?= base_url('admin/user/tambah'); ?>" button type="button" class="btn btn-primary rounded-pill"
              style="margin-bottom: 25px;">Tambah
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
                  <th scope="col"></th>
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
                    <img src="<?= base_url('uploads/ktp/' . $user['user_ktp']) ?>" alt="Foto KTP" width="100">
                  </td>
                  <td>
                    <?php if ($user['row_status'] != 'Non-aktif'): ?>
                    <button data-bs-name='<?= $user['username'] ?>' class="btn btn-danger" data-bs-toggle="modal"
                      data-bs-target="#exampleModal" data-bs-id='<?= $user['id_user'] ?>'>
                      hapus</button>
                    <?php endif ?>
                    <?php if ($user['row_status'] == 'Menunggu'): ?>
                    <button data-bs-name='<?= $user['username'] ?>' class="btn btn-warning" data-bs-toggle="modal"
                      data-bs-target="#modalVerifikasi" data-bs-id='<?= $user['id_user'] ?>'
                      data-bs-ktp="<?= $user['user_ktp'] ?>">
                      verifikasi</button>
                    <?php endif ?>
                    <a href="<?= base_url('admin/manageuser/edit/' . $user['id_user']) ?>"
                      class="btn btn-primary  me-2">Edit
                    </a>
                  </td>
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

        <!-- modal delete user -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>apakah anda yakin ingin menghapus user <span id="nama_modal"></span> ?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class=" btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="/manageuser" method="post" id="form_hapus_user">
                  <button type="submit" name="submit" class="btn btn-primary">Hapus</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- modal verifikasi user -->
        <div class="modal fade" id="modalVerifikasi" tabindex="-1" aria-labelledby="labelModalVerifikasi"
          aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="labelModalVerifikasi">Verifikasi User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" id="form_verifikasi_user" method="post">
                <div class="modal-body">
                  <p>Foto Ktp : <span id="nama_modal"></span> </p>
                  <img src="" alt="Foto KTP" id="foto_ktp" width="400">
                  <div class="form-check mt-2">
                    <input class="form-check-input" type="radio" value="terima" name="status" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                      Terima
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" value="tolak" name="status" id="flexRadioDefault2"
                      checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                      Tolak
                    </label>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class=" btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" name="verifikasi" class="btn btn-primary">Verifikasi</button>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    // Mendapatkan elemen modal
    var modal = document.getElementById('exampleModal');

    // Menangkap event show.bs.modal
    modal.addEventListener('show.bs.modal', function(event) {
      var button = event.relatedTarget; // Tombol yang membuka modal

      // Mengambil data dari tombol (data-bs-name dan data-bs-email)
      var name = button.getAttribute('data-bs-name');
      var id = button.getAttribute('data-bs-id');

      // Memasukkan data ke dalam input di dalam modal
      document.getElementById('nama_modal').innerText = name;
      document.getElementById('form_hapus_user').action = "<?= base_url('/admin/user/delete') ?>" + "/" + id
    });

    var modalVerifikasi = document.getElementById('modalVerifikasi');

    // Menangkap event show.bs.modal
    modalVerifikasi.addEventListener('show.bs.modal', function(event) {
      var button = event.relatedTarget; // Tombol yang membuka modal

      // Mengambil data dari tombol (data-bs-name dan data-bs-email)
      var name = button.getAttribute('data-bs-name');
      var id = button.getAttribute('data-bs-id');
      var ktp = button.getAttribute('data-bs-ktp');


      // Memasukkan data ke dalam input di dalam modal
      document.getElementById('nama_modal').innerText = name;
      document.getElementById('foto_ktp').src = "<?= base_url('/uploads/ktp') ?>" + "/" + ktp;
      document.getElementById('form_verifikasi_user').action = "<?= base_url('/admin/user/verifikasi') ?>" +
        "/" + id
    });
  })
  </script>


</main><!-- End #main -->
<?= $this->endSection(); ?>