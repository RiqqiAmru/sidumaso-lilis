<?= $this->extend('templates/head'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Daftar Pengaduan yang di Proses</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('/pengaduan') ?>">Home</a></li>
        <li class="breadcrumb-item active">Pengaduan di Proses</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">


        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Daftar Pengaduan di Proses</h5>


            <table class="table table-bordered" id="pengaduanTable">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Perihal</th>
                  <th scope="col">Rincian</th>
                  <th scope="col">Pengirim</th>
                  <th scope="col">Status </th>
                  <th scope="col">Foto Bukti</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($pengaduan) && is_array($pengaduan)): ?>
                  <?php $no = 1;
                  foreach ($pengaduan as $p): ?>
                    <tr data-id="<?= $p['p']['id'] ?>">
                      <th scope="row"><?= $no++ ?></th>
                      <td><?= $p['p']['created_at'] ?></td>
                      <td><?= $p['p']['jenis_pengaduan'] ?></td>
                      <td><?= $p['p']['rincian'] ?></td>
                      <td>
                        <?= $p['p']['nama'] ?>
                      </td>
                      <td>
                        <?php if ($p['p']['ket'] == 0) : ?>
                          <span class="badge rounded-pill text-bg-primary">Menunggu</span>
                        <?php elseif ($p['p']['ket'] == 1) : ?>
                          <button class="btn " data-id="<?= $p['p']['id']; ?>">
                            <span class="badge rounded-pill text-bg-warning btn-tanggapan" data-id="<?= $p['p']['id']; ?>">Proses</span>
                          </button>
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
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="9" class="text-center">Belum ada data pengaduan yang sedang di proses.</td>
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
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const table = document.getElementById('pengaduanTable');
      table.addEventListener('click', function(e) {

        if (e.target && e.target.classList.contains('btn-tanggapan')) {
          const idAduan = e.target.dataset.id;
          console.log(idAduan);
          const row = e.target.closest('tr');

          // Periksa apakah sudah ada tanggapan di bawahnya
          if (row.nextElementSibling && row.nextElementSibling.classList.contains('tanggapan-row')) {
            row.nextElementSibling.remove();
            return;
          }

          // Hapus semua tanggapan lain yang terbuka
          document.querySelectorAll('.tanggapan-row').forEach(el => el.remove());

          // Fetch tanggapan dari server
          fetch(`/tanggapan/${idAduan}`)
            .then(response => response.json())
            .then(data => {
              console.log(data);
              if (data) {
                const tanggapanRow = document.createElement('tr');
                tanggapanRow.classList.add('tanggapan-row');
                tanggapanRow.innerHTML = `
                                <td colspan="5">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Jenis Tanggapan</th>
                                                <th>Rincian</th>
                                                <th>Foto</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            ${data.map(tanggapan => `
                                                <tr>
                                                    <td>${tanggapan.created_at}</td>
                                                    <td>${tanggapan.jenis_tanggapan}</td>
                                                    <td>${tanggapan.rincian_admin}</td>
                                                    <td>
                                                         ${tanggapan.foto && tanggapan.foto.length > 0
                ? tanggapan.foto.map(foto => `
                    <img src="<?= base_url('uploads/bukti/') ?>${foto}" alt="Foto" style="width: 100px; margin-right: 5px; " class="img-thumbnail">
                `).join('')
                : 'Tidak Ada'}
                                                    </td>
                                                </tr>
                                            `).join('')}
                                        </tbody>
                                    </table>
                                </td>
                            `;
                row.after(tanggapanRow);
              } else {
                alert('Tidak ada tanggapan untuk pengaduan ini.');
              }
            })
            .catch(err => console.error('Error fetching tanggapan:', err));
        }
      });
    });
  </script>


</main><!-- End #main -->
<?= $this->endSection(); ?>