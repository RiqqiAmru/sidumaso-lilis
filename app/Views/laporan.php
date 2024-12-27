<?= $this->extend('templates/head'); ?>
<?= $this->section('content'); ?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Laporan</h1>
    </div>
    <section class="section">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Laporan</h5>
                    <!-- Form Filter Tanggal -->
                    <form method="get" action="<?= base_url('pengaduan/filterLaporan'); ?>">
                        <div class="row mb-0">
                            <div class="col-md-4">

                                <label for="start_date" class="form-label">Dari Tanggal</label>
                                <input type="date" id="start_date" name="start_date" class="form-control"
                                    value="<?= isset($start_date) && $start_date != '1970-01-01' ? $start_date : '' ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="end_date" class="form-label">Sampai Tanggal</label>
                                <input type="date" id="end_date" name="end_date" class="form-control"
                                    value="<?= isset($end_date) &&  $end_date != '1970-01-01' ? $end_date : '' ?>">
                            </div>

                            <div class="col-md-4">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">Semua Status</option>
                                    <option value="Menunggu" <?= isset($status) && $status == 'Menunggu' ? 'selected' : '' ?>>Menunggu
                                    </option>
                                    <option value="Proses" <?= isset($status) && $status == 'Proses' ? 'selected' : '' ?>>
                                        Proses</option>
                                    <option value="Menunggu kelengkapan data"
                                        <?= isset($status) && $status == 'Menunggu kelengkapan data' ? 'selected' : '' ?>>Menunggu
                                        kelengkapan data</option>
                                    <option value="Selesai" <?= isset($status) && $status == 'Selesai' ? 'selected' : '' ?>>Selesai
                                    </option>
                                    <option value="Invalid" <?= isset($status) && $status == 'Invalid' ? 'selected' : '' ?>>Invalid
                                    </option>
                                    <option value="Menunggu admin" <?= isset($status) && $status == 'Menunggu admin' ? 'selected' : '' ?>>
                                        Menunggu admin</option>
                                </select>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <!-- Tombol Filter -->
                            <div class="d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary mt-4">Filter</button>
                                <button type="button" class="btn btn-primary mt-4 ms-3">
                                    <a href="<?= site_url('pengaduan/printLaporan') ?>" class="text-white text-decoration-none">Cetak
                                        Laporan</a>
                                </button>
                            </div>
                        </div>

                    </form>



                    <table class="table table-bordered" id="pengaduanTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Perihal</th>
                                <th scope="col">Rincian</th>
                                <th scope="col">Gang</th> <!-- Kolom Gang -->
                                <th scope="col">Detail Lokasi</th> <!-- Kolom Detail Lokasi -->
                                <?php if (session('user_id')['role'] != 'Masyarakat'): ?>
                                    <th scope="col">Pengirim</th>
                                <?php endif; ?>
                                <th scope="col">Status</th>
                                <th scope="col">Foto Bukti</th>
                                <th scope="col">Tanggapan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pengaduan) && is_array($pengaduan)): ?>
                                <?php $no = 1;
                                foreach ($pengaduan as $p): ?>
                                    <tr data-id="<?= $p['id_pengaduan'] ?>">
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $p['created_at'] ?></td>
                                        <td><?= $p['jenis_pengaduan'] ?></td>
                                        <td><?= $p['rincian'] ?></td>
                                        <td><?= $p['gang'] ?></td> <!-- Menampilkan data Gang -->
                                        <td><?= $p['detail_lokasi'] ?></td> <!-- Menampilkan data Detail Lokasi -->
                                        <?php if (session('user_id')['role'] != 'Masyarakat' && isset($p['nama'])): ?>
                                            <td><?= $p['nama'] ?></td>
                                        <?php endif; ?>
                                        <td>
                                            <button class="btn">
                                                <?php if ($p['ket'] == 0): ?>
                                                    <span class="badge rounded-pill text-bg-primary btn-tanggapan"
                                                        data-id="<?= $p['id_pengaduan']; ?>">Menunggu</span>
                                                <?php elseif ($p['ket'] == 1): ?>
                                                    <span class="badge rounded-pill text-bg-secondary btn-tanggapan"
                                                        data-id="<?= $p['id_pengaduan']; ?>">Proses</span>
                                                <?php elseif ($p['ket'] == 2): ?>
                                                    <span class="badge rounded-pill text-bg-warning btn-tanggapan"
                                                        data-id="<?= $p['id_pengaduan']; ?>">Menunggu
                                                        kelengkapan
                                                        data</span>
                                                <?php elseif ($p['ket'] == 3): ?>
                                                    <span class="badge rounded-pill text-bg-success btn-tanggapan"
                                                        data-id="<?= $p['id_pengaduan']; ?>">Selesai</span>
                                                <?php elseif ($p['ket'] == 4): ?>
                                                    <span class="badge rounded-pill text-bg-danger btn-tanggapan"
                                                        data-id="<?= $p['id_pengaduan']; ?>">Invalid</span>
                                                <?php elseif ($p['ket'] == 5 || $p['ket'] == 6): ?>
                                                    <span class="badge rounded-pill text-bg-secondary btn-tanggapan"
                                                        data-id="<?= $p['id_pengaduan']; ?>">Menunggu
                                                        admin</span>
                                                <?php endif ?>
                                            </button>
                                        </td>
                                        <td>
                                            <?php if (!empty($p['foto'])): ?>
                                                <?php $fotoArray = explode(',', $p['foto']); // Memisahkan nama file foto jika dipisah dengan koma 
                                                ?>
                                                <?php foreach ($fotoArray as $foto): ?>
                                                    <img src="<?= base_url('uploads/bukti/' . esc($foto)) ?>" alt="Foto Bukti" class="img-thumbnail"
                                                        width="100" data-bs-toggle="modal" data-bs-target="#imageModal">
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <p>No photos available</p>
                                            <?php endif; ?>


                                        </td>
                                        <td>
                                            <!-- Tampilkan tanggapan -->
                                            <?php if (!empty($p['tanggapan_rincian'])): ?>

                                                <p><?= esc($p['tanggapan_rincian']) ?></p>
                                            <?php else: ?>
                                                <p>No Tanggapan</p>
                                            <?php endif; ?>
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
                    <!-- modal image -->
                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img src="" id="modalImage" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.querySelectorAll('img[data-bs-toggle="modal"]').forEach(img => {
                            img.addEventListener('click', function() {
                                const modalImage = document.getElementById('modalImage');
                                modalImage.src = this.src;
                            });
                        });
                    </script>

                </div>
    </section>
</main>
<?= $this->endSection(); ?>