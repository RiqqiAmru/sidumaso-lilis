<?= $this->extend('templates/head'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Daftar Pengaduan</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('/pengaduan') ?>">Home</a></li>
        <li class="breadcrumb-item active">Pengaduan</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">


        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Daftar Pengaduan</h5>
            <a href="<?= base_url('pengaduan/tambah'); ?>" button type="button"
              class="btn btn-primary rounded-pill" style="margin-bottom: 25px;">Tambah
              Pengaduan</a>


            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Perihal</th>
                  <th scope="col">Rincian</th>
                  <th scope="col">Status Pengirim</th>
                  <th scope="col">Status </th>
                  <th scope="col">Foto Bukti</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($pengaduan) && is_array($pengaduan)): ?>
                  <?php $no = 1;
                  foreach ($pengaduan as $p): ?>
                    <tr>
                      <th scope="row"><?= $no++ ?></th>
                      <td><?= $p['p']['jenis_pengaduan'] ?></td>
                      <td><?= $p['p']['rincian'] ?></td>
                      <td><?= $p['p']['status_aduan'] ?></td>
                      <td>
                        <?php if ($p['p']['ket'] == 0) : ?>
                          <span class="badge rounded-pill text-bg-primary">Menunggu</span>
                        <?php elseif ($p['p']['ket'] == 1) : ?>
                          <span class="badge rounded-pill text-bg-warning">Proses</span>
                        <?php elseif ($p['p']['ket'] == 2) : ?>
                          <span class="badge rounded-pill text-bg-warning">Selesai</span>
                        <?php endif ?>
                      </td>
                      <td>
                        <?php foreach ($p['foto'] as $foto) : ?>
                          <img src="<?= base_url('uploads/bukti/' . $foto['foto']) ?>" alt="Foto bukti" class="img-thumbnail"
                            width="100">
                        <?php endforeach ?>
                      </td>
                      <td>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeletePengaduan" data-bs-id='<?= $p['p']['id'] ?>'>
                          hapus</button>
                        <button class="btn btn-outline-info ">
                          <a href="<?= base_url('pengaduan/edit/' . $p['p']['id']) ?>">edit</a></button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="9" class="text-center">Belum ada data pengaduan.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="modal fade" id="modalDeletePengaduan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus pengaduan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>apakah anda yakin ingin menghapus pengaduan <span id="nama_modal"></span> ?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class=" btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="/manageuser" method="post" id="form_hapus_pengaduan">
                  <button type="submit" name="submit" class="btn btn-primary">Hapus</button>
                </form>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
  </section>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Mendapatkan elemen modal
      var modal = document.getElementById('modalDeletePengaduan');
      // Menangkap event show.bs.modal
      modal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget; // Tombol yang membuka modal

        // Mengambil data dari tombol (data-bs-name dan data-bs-email)
        var id = button.getAttribute('data-bs-id');
        console.log(id);

        // Memasukkan data ke dalam input di dalam modal
        document.getElementById('form_hapus_pengaduan').action = "<?= base_url('/pengaduan/delete') ?>" + "/" + id
      });


    })
  </script>


</main><!-- End #main -->
<?= $this->endSection(); ?>