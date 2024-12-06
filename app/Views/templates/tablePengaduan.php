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
        <tr data-id="<?= $p['id'] ?>">
          <th scope="row"><?= $no++ ?></th>
          <td><?= $p['created_at'] ?></td>
          <td><?= $p['jenis_pengaduan'] ?></td>
          <td><?= $p['rincian'] ?></td>
          <td>
            <?= $p['nama'] ?>
          </td>
          <td>
            <button class="btn">
              <?php if ($p['ket'] == 0) : ?>
                <span class="badge rounded-pill text-bg-primary btn-tanggapan" data-id="<?= $p['id']; ?>">Menunggu</span>
              <?php elseif ($p['ket'] == 1) : ?>
                <span class="badge rounded-pill text-bg-secondary btn-tanggapan" data-id="<?= $p['id']; ?>">Proses</span>
              <?php elseif ($p['ket'] == 2) : ?>
                <span class="badge rounded-pill text-bg-warning  btn-tanggapan" data-id="<?= $p['id']; ?>">menunggu kelengkapan data</span>
              <?php elseif ($p['ket'] == 3) : ?>
                <span class="badge rounded-pill text-bg-success  btn-tanggapan" data-id="<?= $p['id']; ?>">Selesai</span>
              <?php elseif ($p['ket'] == 4) : ?>
                <span class="badge rounded-pill text-bg-danger  btn-tanggapan" data-id="<?= $p['id']; ?>">Invalid</span>
              <?php elseif ($p['ket'] == 5) : ?>
                <span class="badge rounded-pill text-bg-secondary  btn-tanggapan" data-id="<?= $p['id']; ?>">menunggu admin</span>
              <?php endif ?>
            </button>
          </td>
          <td>
            <?php foreach ($p['foto'] as $foto) : ?>
              <img src="<?= base_url('uploads/bukti/' . $foto) ?>" alt="Foto bukti" class="img-thumbnail"
                width="100">
            <?php endforeach ?>
          </td>

          <?php if (session('user_id')['role'] == 'Masyarakat' && $p['ket'] == 0): ?>
            <td>
              <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeletePengaduan" data-bs-id='<?= $p['id'] ?>'>
                hapus</button>
              <button class="btn btn-outline-info ">
                <a href="<?= base_url('pengaduan/edit/' . $p['id']) ?>">edit</a></button>
            </td>
          <?php elseif (session('user_id')['role'] == 'Admin' && $p['ket'] == 0): ?>
            <td>
              <button class="btn btn-outline-success">
                <a href="<?= base_url('pengaduan/proses/' . $p['id']) ?>">Proses</a></button>
            </td>
          <?php endif ?>

        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr>
        <td colspan="9" class="text-center">Belum ada data pengaduan .</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>

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
                <td></td>
                                <td colspan="6">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                                <th>Rincian</th>
                                                <th>Foto</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            ${data.map((tanggapan,index) => `
                                                <tr>
                                                    <td>${tanggapan.created_at}</td>
                                                    
                                                    <td>
                                                    <span class="badge rounded-pill text-bg-${tanggapan.warna} ">${tanggapan.jenis_tanggapan}</span>
                                                    
                                                    </td>
                                                    <td>${tanggapan.rincian}</td>
                                                    <td>
                                                    ${tanggapan.foto && tanggapan.foto.length > 0
                                                    ? tanggapan.foto.map(foto => `
                                                    <img src="<?= base_url('uploads/bukti/') ?>${foto}" alt="Foto" style="width: 50px; margin-right: 5px; " class="img-thumbnail">
                                                    `).join('')
                                                    : 'Tidak Ada'}
                                                    </td>
                                                    <td>${tanggapan.nama}</td>
                                                    <td>
                                        ${index=== data.length-1 && (tanggapan.jenis_tanggapan=='Proses'|tanggapan.jenis_tanggapan=='Melengkapi Data' ) && '<?= session('user_id')['role'] ?>'== 'Admin'? `
                                                     <a href="<?= base_url('pengaduan/proses/') ?>${tanggapan.id_aduan}/selesai" class="btn badge rounded-pill text-bg-success " >tandai selesai</a> </br>
                                                     <a href="<?= base_url('pengaduan/proses/') ?>${tanggapan.id_aduan}/kurang" class="btn badge rounded-pill text-bg-warning " >data kurang lengkap</a></br>
                                                     <a href="<?= base_url('pengaduan/proses/') ?>${tanggapan.id_aduan}/invalid" class="btn badge rounded-pill text-bg-danger " >laporan tidak valid</a>
                                                     `:''}
                                                     ${index=== data.length-1 && tanggapan.jenis_tanggapan=='Menunggu Kelengkapan data' && '<?= session('user_id')['role'] ?>'== 'Masyarakat'?`
                                                     <a href="<?= base_url('pengaduan/proses/') ?>${tanggapan.id_aduan}/lengkapi" class="btn badge rounded-pill text-bg-info " >lengkapi data</a>
                                                     `:''}
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