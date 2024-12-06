<?php

namespace App\Controllers;

use App\Models\FotoPengaduanModel;
use App\Models\FotoTanggapanModel;
use App\Models\PengaduanModel;
use App\Models\TanggapanModel;

class Pengaduan extends BaseController
{
    protected $pengaduanModel;
    protected $fotoPengaduanModel;
    protected $tanggapanModel;
    protected $fotoTanggapanModel;

    public function __construct()
    {
        $this->pengaduanModel = new PengaduanModel();
        $this->fotoPengaduanModel = new FotoPengaduanModel();
        $this->tanggapanModel = new TanggapanModel();
        $this->fotoTanggapanModel = new FotoTanggapanModel();


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
            'pengaduan' =>  $this->pengaduanModel->getPengaduanByOneUser(session('user_id')['id'])
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
        $validation =  \Config\Services::validation();

        // Validasi file gambar
        $rules = [
            'jenis_pengaduan' => 'required',
            'rincian' => 'required',
            'status_pengaduan' => 'required',
            'bukti' => 'uploaded[bukti]|max_size[bukti,2048]|is_image[bukti]|mime_in[bukti,image/jpg,image/jpeg,image/png,image/gif]',
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
                'status_aduan' => $this->request->getPost('status_pengaduan'),
                'ket' => 0,
                'id_pengirim' => session('user_id')['id']
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
                        $imagePaths[] =  $newName;
                    }
                }
                foreach ($imagePaths as $img) {
                    $this->fotoPengaduanModel->save(['foto' => $img, 'pengaduan_id' => $pengaduanId]);
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

    public function edit($id) {}

    public function masuk()
    {

        if (session('user_id')['role'] == 'Masyarakat') {
            return redirect()->to('/pengaduan/daftarPengaduan');
        }

        $data = [
            'pengaduan' =>  $this->pengaduanModel->getPengaduanWithUserWhereKetIs([0])
        ];

        return view('admin/pengaduan/masuk', $data);
    }

    public function invalid()
    {
        $data = [
            'pengaduan' =>  $this->pengaduanModel->getPengaduanWithUserWhereKetIs([4])
        ];

        return view('admin/pengaduan/invalid', $data);
    }
    public function selesai()
    {
        $data = [
            'pengaduan' =>  $this->pengaduanModel->getPengaduanWithUserWhereKetIs([3])
        ];

        return view('admin/pengaduan/selesai', $data);
    }
    public function daftarProses()
    {
        $data = [
            'pengaduan' =>  $this->pengaduanModel->getPengaduanWithUserWhereKetIs([1, 2, 5])
        ];
        return view('admin/pengaduan/daftarProses', $data);
    }

    public function proses($id, $status = 0)
    {
        $pengaduan = $this->pengaduanModel->getPengaduanById($id);
        $tanggapan = $this->tanggapanModel->getTanggapanByPengaduanid($id);

        $foto = $this->fotoPengaduanModel->getByPengaduanId($pengaduan['id']);
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
        $idAdmin = session('user_id')['id'];
        $validation =  \Config\Services::validation();

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
            }

            if (session('user_id')['role'] == 'Admin') {
                $this->pengaduanModel->update($idAduan, ['ket' => $ket, 'id_admin' => $idAdmin]);
            } else {
                $this->pengaduanModel->update($idAduan, ['ket' => $ket]);
            }

            $data = [
                'id_aduan' => $this->request->getPost('id_aduan'),
                'jenis_tanggapan' => $status,
                'rincian' => $this->request->getPost('rincian'),
                'id_user' => session('user_id')['id'],
                'ket' => 0,
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
                        $imagePaths[] =  $newName;
                    }
                }
                foreach ($imagePaths as $img) {
                    $this->fotoTanggapanModel->insert(['foto' => $img, 'tanggapan_id' => $tanggapanId]);
                }
                $db->transCommit();

                return redirect()->to('/pengaduan/masuk')->with('success', 'berhasil menanggapi aduan');
            };

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
}
