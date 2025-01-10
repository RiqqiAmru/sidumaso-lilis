<?= $this->extend('templates/head'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Daftar Pengaduan</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('/Dashboard') ?>">Dashboard</a></li>
        <li class="breadcrumb-item active">Pengaduan Selesai</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">


        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Daftar Pengaduan Selesai</h5>

            <?= $this->include('templates/tablePengaduan'); ?>

          </div>
        </div>

        <div class="modal fade" id="modalDeletePengaduan" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
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
    document.addEventListener('DOMContentLoaded', function () {
      // Mendapatkan elemen modal
      var modal = document.getElementById('modalDeletePengaduan');
      // Menangkap event show.bs.modal
      modal.addEventListener('show.bs.modal', function (event) {
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