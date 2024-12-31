<?php

namespace App\Controllers;

use App\Models\FotoPengaduanModel;
use App\Models\FotoTanggapanModel;
use App\Models\PengaduanModel;
use App\Models\TanggapanModel;

use Dompdf\Dompdf;


class Pengaduan extends BaseController
{
    protected $pengaduanModel;
    protected $fotoPengaduanModel;
    protected $tanggapanModel;
    protected $fotoTanggapanModel;
    protected $db;

    public function __construct()
    {
        $this->pengaduanModel = new PengaduanModel();
        $this->fotoPengaduanModel = new FotoPengaduanModel();
        $this->tanggapanModel = new TanggapanModel();
        $this->fotoTanggapanModel = new FotoTanggapanModel();
        $this->db = \Config\Database::connect();

        // Memeriksa apakah pengguna sudah login sebelum melakukan apa pun di controller ini
        if (session()->get('logged_in') == null) {
            // Jika tidak, redirect ke halaman login
            return redirect()->to('/auth/login');
        }
    }
    public function index()
    {
        if (session()->get('logged_in') == null) {
            // Jika tidak, redirect ke halaman login
            return redirect()->to('/auth/login');
        }
        return view('templates/head');
    }

    public function daftarPengaduan()
    {
        $data = [
            'pengaduan' => $this->pengaduanModel->getPengaduanByOneUser(session('user_id')['id_user'])
        ];
        return view('masyarakat/pengaduan/index', $data);
    }
    public function tambah()
    {
        return view('masyarakat/pengaduan/tambah');
    }
    public function store()
    {
        // Mengambil semua file yang di-upload
        $validation = \Config\Services::validation();
        // Validasi file gambar
        $rules = [
            'jenis_pengaduan' => 'required',
            'rincian' => 'required',
            'gang' => 'required',
            'detail_lokasi' => 'required',

            'bukti' => 'max_size[bukti,541024]|mime_in[bukti,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/jpg,image/jpeg,image/png,image/gif]|ext_in[bukti,pdf,doc,docx,jpg,jpeg,png,gif]'
        ];

        // Memvalidasi file gambar
        if (!$this->validate($rules)) {
            // Menampilkan error jika validasi gagal
            return redirect()->to('/pengaduan/tambah')->withInput()->with('errors', $validation->getErrors());
        }

        $db = \Config\Database::connect();
        $db->transBegin();
        try {
            $data = [
                'jenis_pengaduan' => $this->request->getPost('jenis_pengaduan'),
                'rincian' => $this->request->getPost('rincian'),
                'gang' => $this->request->getPost('gang'),
                'detail_lokasi' => $this->request->getPost('detail_lokasi'),
                'ket' => 0,
                'id_user' => session('user_id')['id_user']
            ];
            if ($this->pengaduanModel->save($data)) {
                $pengaduanId = $this->pengaduanModel->getInsertID();


                // Mengambil file yang di-upload
                $uploadedFiles = $this->request->getFileMultiple('bukti');
                // Array untuk menyimpan path gambar yang di-upload
                $imagePaths = [];

                // Menyimpan gambar ke server
                foreach ($uploadedFiles as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        // Membuat nama file yang unik
                        $newName = $file->getRandomName();
                        // Memindahkan file ke folder yang diinginkan
                        $file->move('uploads/bukti', $newName);

                        // Menyimpan path file yang telah di-upload
                        $imagePaths[] = $newName;
                    }
                }
                foreach ($imagePaths as $img) {

                    $this->fotoPengaduanModel->save(['foto' => $img, 'id_pengaduan' => $pengaduanId]);
                }
                $db->transCommit();

                return redirect()->to('/pengaduan/daftarPengaduan')->with('success', 'berhasil menambah aduan');
            };
            dd($this->pengaduanModel->errors());
            return 'eror ketika input pengaduan';
        } catch (\Throwable $th) {
            $db->transRollback();
            // Tampilkan pesan error atau kembalikan form dengan error
            return redirect()->to('/pengaduan/tambah')->with('error', 'Terjadi kesalahan, silakan coba lagi');
        }

        // Menampilkan halaman sukses upload dan menampilkan gambar yang telah di-upload
    }

    public function delete($id)
    {
        $this->pengaduanModel->delete($id);
        return redirect()->to('pengaduan/daftarPengaduan')->with('success', 'pengaduan berhasil dihapus');
    }

    public function edit($id)
    {
        // Ambil data pengaduan berdasarkan ID
        $pengaduan = $this->pengaduanModel->findPengaduanAndFotoByIdPengaduan($id);

        if (!$pengaduan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengaduan tidak ditemukan');
        }

        // Kirim data pengaduan ke view
        return view('masyarakat/pengaduan/edit', [
            'pengaduan' => $pengaduan[0]
        ]);
    }

    public function update($id)
    {
        // Aturan validasi untuk input pengaduan
        $rules = [
            'jenis_pengaduan' => 'required',
            'rincian' => 'required',
            'detail_lokasi' => 'required',
            'gang' => 'required',
            'bukti' => 'permit_empty|mime_in[dokumen,application/pdf,application/msword,image/png,image/jpeg]|max_size[dokumen,2048]',
        ];

        // Validasi input
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data input
        $data = [
            'jenis_pengaduan' => $this->request->getVar('jenis_pengaduan'),
            'rincian' => $this->request->getVar('rincian'),
            'detail_lokasi' => $this->request->getVar('detail_lokasi'),
            'gang' => $this->request->getVar('gang'),
        ];

        // Mulai transaksi
        $this->db->transBegin();

        try {
            // Ambil data pengaduan lama berdasarkan ID
            $pengaduan = $this->pengaduanModel->find($id);

            // Tangani file bukti (foto) pengaduan
            $fileBukti = $this->request->getFileMultiple('bukti'); // Ambil banyak file jika ada

            // Jika ada file bukti yang diupload
            if (!empty($fileBukti) && $fileBukti[0]->isValid()) {
                // Simpan file ke folder uploads
                $imagePaths = [];
                foreach ($fileBukti as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        // Membuat nama file yang unik
                        $newName = $file->getRandomName();
                        // Memindahkan file ke folder yang diinginkan
                        if (!$file->move('uploads/bukti', $newName)) {
                            throw new \Exception('Gagal memindahkan file.');
                        }

                        // Menyimpan path file yang telah di-upload
                        $imagePaths[] = $newName;
                    }
                }

                // Hapus file lama jika ada
                $fotoPengaduan = $this->fotoPengaduanModel->getByPengaduanId($id);
                foreach ($fotoPengaduan as $foto) {
                    // Pastikan file ada sebelum dihapus
                    $filePath = 'uploads/bukti/' . $foto['foto'];
                    if (file_exists($filePath)) {
                        unlink($filePath); // Hapus file
                    }
                    $this->fotoPengaduanModel->delete($foto['id_foto_pengaduan']); // Hapus dari database
                }

                // Input foto baru ke database
                foreach ($imagePaths as $img) {
                    $this->fotoPengaduanModel->insert(['foto' => $img, 'id_pengaduan' => $id]);
                }
            }

            // Update data pengaduan di database
            if (!$this->pengaduanModel->update($id, $data)) {
                throw new \Exception('Gagal memperbarui data pengaduan.');
            }

            // Commit transaksi jika semuanya berhasil
            $this->db->transCommit();

            // Redirect dengan pesan sukses
            return redirect()->to('/pengaduan/daftarPengaduan')->with('success', 'Pengaduan berhasil diperbarui');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            $this->db->transRollback();

            // Menangkap error dan mengirimkan pesan error ke halaman sebelumnya
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui pengaduan: ' . $e->getMessage());
        }
    }



    public function masuk()
    {

        if (session('user_id')['role'] == 'Masyarakat') {
            return redirect()->to('/pengaduan/daftarPengaduan');
        }

        $data = [
            'pengaduan' => $this->pengaduanModel->getPengaduanWithUserWhereKetIs([0])
        ];

        return view('admin/pengaduan/masuk', $data);
    }

    public function invalid()
    {
        $data = [
            'pengaduan' => $this->pengaduanModel->getPengaduanWithUserWhereKetIs([4])
        ];

        return view('admin/pengaduan/invalid', $data);
    }
    public function selesai()
    {
        $data = [
            'pengaduan' => $this->pengaduanModel->getPengaduanWithUserWhereKetIs([3])
        ];

        return view('admin/pengaduan/selesai', $data);
    }
    public function daftarProses()
    {
        $data = [
            'pengaduan' => $this->pengaduanModel->getPengaduanWithUserWhereKetIs([1, 2, 5, 6])
        ];
        return view('admin/pengaduan/daftarProses', $data);
    }

    public function proses($id, $status = 0)
    {
        $pengaduan = $this->pengaduanModel->getPengaduanById($id);
        $tanggapan = $this->tanggapanModel->getTanggapanByPengaduanid($id);

        $foto = $this->fotoPengaduanModel->getByPengaduanId($pengaduan['id_pengaduan']);
        $data = [
            'pengaduan' => ['p' => $pengaduan, 'foto' => $foto],
            'status' => $status,
            'tanggapan' => $tanggapan
        ];

        return view('admin/pengaduan/detail', $data);
    }

    public function storeTanggapanAdmin()
    {
        $idAduan = $this->request->getPost('id_aduan');

        $validation = \Config\Services::validation();

        $rules = [
            'jenis_tanggapan' => 'required',
            'rincian' => 'required',
        ];
        // Memvalidasi file gambar
        if (!$this->validate($rules)) {
            // Menampilkan error jika validasi gagal
            return redirect()->to('/pengaduan/proses/' . $idAduan)->withInput()->with('errors', $validation->getErrors());
        }

        $db = \Config\Database::connect();
        $db->transBegin();
        try {
            // edit ket aduan jadi 1, inputkan id_admin field
            $status = $this->request->getPost('jenis_tanggapan');
            $ket = 1;
            switch ($status) {
                case 'Menunggu Kelengkapan data':
                    $ket = '2';
                    break;
                case 'Selesai':
                    $ket = '3';
                    break;
                case 'Tidak Valid':
                    $ket = '4';
                    break;
                case 'Melengkapi Data':
                    $ket = '5';
                    break;
                case 'Komentar':
                    $ket = '6';
                    break;
            }


            $this->pengaduanModel->update($idAduan, ['ket' => $ket]);


            $data = [
                'id_pengaduan' => (int) $this->request->getPost('id_aduan'),
                'jenis_tanggapan' => $status,
                'rincian' => $this->request->getPost('rincian'),
                'id_user' => session('user_id')['id_user'],
            ];

            // input tanggapan = id_aduan, jenis_tanggapan, rincian admin, 
            if ($this->tanggapanModel->save($data)) {
                $tanggapanId = $this->tanggapanModel->getInsertID();
                // Array untuk menyimpan path gambar yang di-upload
                $imagePaths = [];

                // Menyimpan gambar ke server
                // Mengambil file yang di-upload
                $uploadedFiles = $this->request->getFileMultiple('bukti');

                foreach ($uploadedFiles as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        // input foto tanggapan jika ada
                        if ($file->getSize() > 554496) { // 541 KB dalam byte
                            return redirect()->back()->withInput()->with('error', 'Ukuran file tidak boleh lebih dari 541 KB.');
                        }

                        // (Opsional) Tambahkan validasi lainnya, seperti tipe MIME
                        if (!$file->isValid() || !$file->getMimeType() === 'image/jpeg') {
                            return redirect()->back()->withInput()->with('error', 'File harus berupa gambar JPEG.');
                        }
                        // Membuat nama file yang unik
                        $newName = $file->getRandomName();
                        // Memindahkan file ke folder yang diinginkan
                        $file->move('uploads/bukti', $newName);

                        // Menyimpan path file yang telah di-upload
                        $imagePaths[] = $newName;
                    }
                }
                foreach ($imagePaths as $img) {
                    $this->fotoTanggapanModel->insert(['foto' => $img, 'id_tanggapan' => $tanggapanId]);
                }
                $db->transCommit();

                return redirect()->to('/pengaduan/masuk')->with('success', 'berhasil menanggapi aduan');
            };
            dd($this->tanggapanModel->errors());
            return redirect()->to('/pengaduan/proses/' . $idAduan)->with('error', 'Terjadi kesalahan input, silakan coba lagi');
        } catch (\Throwable $th) {
            $db->transRollback();
            // Tampilkan pesan error atau kembalikan form dengan error
            return redirect()->to('/pengaduan/proses/' . $idAduan)->with('error', 'terjadi kesalahan' . $th);
        }
    }

    //  /tanggapan/idaduan
    public function getByPengaduanId($id)
    {
        $tanggapan = $this->tanggapanModel->getTanggapanByPengaduanid($id);
        return $this->response->setJSON($tanggapan);
    }
    public function laporan()
    {

        $pengaduanModel = new PengaduanModel();
        $tanggapanModel = new TanggapanModel();

        // Ambil semua pengaduan dengan status tertentu
        $pengaduans = $pengaduanModel->getPengaduanWithTanggapan([1, 2, 3, 4, 5, 6]);

        // Kirim data ke view
        $data = [
            'pengaduan' => $pengaduans
        ];

        return view('laporan', $data);
    }


    public function filterLaporan()
    {
        // Mengambil parameter tanggal dan status dari URL
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');
        $status = $this->request->getGet('status'); // Menangkap parameter status
        $perihal = $this->request->getGet('perihal'); // Menangkap parameter status
        if ($end_date) {
            $start_date = date('Y-m-d 00:00:00', strtotime($start_date));
            $end_date = date('Y-m-d 23:59:59', strtotime($end_date));
        }
        $status_map = [
            'Menunggu' => 0,
            'Proses' => 1,
            'Menunggu kelengkapan data' => 2,
            'Selesai' => 3,
            'Invalid' => 4,
            'Menunggu admin' => 6
        ];
        // Mapping status teks ke nilai numerik yang ada di field 'ket'

        $pengaduan = $this->pengaduanModel->getFilteredPengaduan($start_date, $end_date, ($status) ? $status_map[$status] : '', $perihal);
        // // Mengecek apakah parameter tanggal ada
        // if ($start_date && $end_date) {
        //     // Ubah format tanggal ke format MySQL
        //     $start_date = date('Y-m-d 00:00:00', strtotime($start_date));
        //     $end_date = date('Y-m-d 23:59:59', strtotime($end_date));

        //     // Memanggil model dengan filter berdasarkan tanggal dan status
        //     if ($status && isset($status_map[$status])) {
        //         $status_numerik = $status_map[$status];
        //         $pengaduan = $this->pengaduanModel->getPengaduanByDateRangeAndStatus($start_date, $end_date, $status_numerik);
        //     } else {
        //         $pengaduan = $this->pengaduanModel->getPengaduanByDateRange($start_date, $end_date);
        //     }
        // } else {
        //     // Jika tidak ada filter tanggal, ambil data berdasarkan status
        //     if ($status && isset($status_map[$status])) {
        //         $status_numerik = $status_map[$status];
        //         $pengaduan = $this->pengaduanModel->getPengaduanByStatus($status_numerik);
        //     } else {
        //         $pengaduan = $this->pengaduanModel->getAllPengaduan();
        //     }
        // }

        // Kirim data ke view
        return view('laporan', ['pengaduan' => $pengaduan, 'start_date' => date('Y-m-d', strtotime($start_date)), 'end_date' => date('Y-m-d', strtotime($end_date)), 'status' => $status, 'perihal' => $perihal]);
    }


    public function printLaporan()
    {
        // Mengambil parameter dari URL
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');
        $status = $this->request->getGet('status');



        // Mapping status ke nilai numerik
        $status_map = [
            'Menunggu' => 0,
            'Proses' => 1,
            'Menunggu kelengkapan data' => 2,
            'Selesai' => 3,
            'Invalid' => 4,
            'Menunggu admin' => 5
        ];

        // Query berdasarkan filter
        if ($start_date && $end_date) {
            $start_date = date('Y-m-d 00:00:00', strtotime($start_date));
            $end_date = date('Y-m-d 23:59:59', strtotime($end_date));
            if ($status && isset($status_map[$status])) {
                $status_numerik = $status_map[$status];
                $pengaduan = $this->pengaduanModel->getPengaduanByDateRangeAndStatus($start_date, $end_date, $status_numerik);
            } else {
                $pengaduan = $this->pengaduanModel->getPengaduanByDateRange($start_date, $end_date);
            }
        } else {
            if ($status && isset($status_map[$status])) {
                $status_numerik = $status_map[$status];
                $pengaduan = $this->pengaduanModel->getPengaduanByStatus($status_numerik);
            } else {
                $pengaduan = $this->pengaduanModel->getAllPengaduan();
            }
        }

        // Mempersiapkan data untuk PDF
        $filter_keterangan = "Laporan berdasarkan filter: ";

        if ($start_date && $end_date) {
            $filter_keterangan .= "Tanggal: $start_date sampai $end_date; ";
        } else {
            $filter_keterangan .= "Semua Pengaduan; ";
        }
        if ($status && isset($status_map[$status])) {
            $filter_keterangan .= "Status: $status";
        }

        // Menyusun HTML untuk laporan
        $html = "
<html>
    <head>
        <style>
            @page {
                margin: 12mm; /* Margin A4 default */
            }
            body {
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
            }
            .kop-surat { 
                text-align: center; 
                font-size: 16px; 
                margin-bottom: 20px; 
            }
            .laporan-title { 
                text-align: center; 
                font-size: 18px; 
                font-weight: bold; 
                margin-bottom: 20px; 
            }
            .filter-info { 
                margin-bottom: 20px; 
                font-size: 14px; 
            }
            table {
                width: 100%; /* Lebar tabel 100% dari lebar halaman */
                border-collapse: collapse; /* Hilangkan spasi antar border */
                table-layout: fixed; /* Menggunakan table-layout fixed untuk kontrol lebar kolom */
            }
            th, td {
                border: 1px solid black;
                padding: 8px;
                text-align: left;
                word-wrap: break-word; /* Memastikan teks dalam kolom dibungkus */
            }
            th {
                font-weight: bold;
            }
            /* Kolom dengan lebar yang lebih disesuaikan */
            td:nth-child(1), th:nth-child(1) {
                width: 8%; /* Kolom nomor */
            }
            td:nth-child(2), th:nth-child(2) {
                width: 23%; /* Kolom jenis pengaduan */
            }
            td:nth-child(3), th:nth-child(3) {
                width: 24%; /* Kolom rincian */
            }
            td:nth-child(4), th:nth-child(4) {
                width: 15%; /* Kolom status */
            }
            td:nth-child(5), th:nth-child(5) {
                width: 22%; /* Kolom tanggal pengaduan */
            }
            td:nth-child(6), th:nth-child(6) {
                width: 18%; /* Kolom nama pengirim */
            }
            td:nth-child(7), th:nth-child(7) {
                width: 12%; /* Kolom foto */
            }
            td:nth-child(8), th:nth-child(8) {
                width: 23%; /* Kolom tanggapan */
            }
            td img {
                max-width: 100%; /* Mengatur gambar agar tidak meluap */
                height: auto;
            }
        </style>
    </head>
    <body>
         <div class='kop-surat'>
            <img src='http://localhost:8080/logo.png' alt='Logo Kabupaten'>
            <h3>PEMERINTAH KABUPATEN PEKALONGAN</h3>
            <h3>KECAMATAN BUARAN</h3>
            <h3>KEPALA DESA WONOYOSO</h3>
            <p>Sekretariat Jalan Desa Wonoyoso Kecamatan Buaran Kabupaten Pekalongan 51171</p>
        </div>
        <hr class='garis-pemisah'>
        
        <!-- Judul Laporan -->
        <div class='laporan-title'>
            <h4>Data Laporan Pengaduan Masyarakat</h4>
        </div>
        <div class='filter-info'>
            <p><strong>Filter:</strong> $filter_keterangan</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Pengaduan</th>
                    <th>Rincian</th>
                    <th>Status</th>
                    <th>Tanggal Pengaduan</th>
                    <th>Nama Pengirim</th>
                    <th>Foto</th>
                    <th>Tanggapan</th>
                </tr>
            </thead>
            <tbody>";

        $no = 1;
        foreach ($pengaduan as $laporan) {
            $html .= "
    <tr>
        <td>{$no}</td>
        <td>{$laporan['jenis_pengaduan']}</td>
        <td>{$laporan['rincian']}</td>
        <td>" . ($laporan['ket'] == 0 ? 'Menunggu' : ($laporan['ket'] == 1 ? 'Proses' : ($laporan['ket'] == 3 ? 'Selesai' : 'Invalid'))) . "</td>
        <td>{$laporan['created_at']}</td>
        <td>{$laporan['nama']}</td>
        <td><img src='http://localhost:8080/uploads/bukti/{$laporan['foto']}' width='100' /></td>
        <td>{$laporan['tanggapan_rincian']}</td>
    </tr>";
            $no++;
        }

        $html .= "
            </tbody>
        </table>
    </body>
</html>";

        // Load DomPDF
        $dompdf = new Dompdf();
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->set_option('isPhpEnabled', true);
        $dompdf->set_option('log-output-file', 'log.txt');
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output PDF (download atau tampilkan)
        $dompdf->stream("Laporan_Pengaduan_" . date('Ymd') . ".pdf", array("Attachment" => 0)); // 0 untuk preview, 1 untuk download
    }
}
