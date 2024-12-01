<?php

namespace App\Controllers;

use App\Models\FotoPengaduanModel;
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
        $this->fotoTanggapanModel = new TanggapanModel();


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
        $pengaduan = $this->pengaduanModel->where('id_pengirim', session('user_id')['id'])->findAll();
        $data = [
            'pengaduan' => []
        ];
        foreach ($pengaduan as $p) {
            $foto = $this->fotoPengaduanModel->getByPengaduanId($p['id']);
            array_push(
                $data['pengaduan'],
                ['p' => $p, 'foto' => $foto]
            );
        }
        // dd($data);
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
        if (session()->get('user_id')['role'] != 'Admin') {
            // Jika tidak, redirect ke halaman login
            return redirect()->to('/pengaduan');
        }

        $pengaduan = $this->pengaduanModel->getPengaduanWithUser();
        $data = [
            'pengaduan' => []
        ];
        foreach ($pengaduan as $p) {
            $foto = $this->fotoPengaduanModel->getByPengaduanId($p['id']);
            array_push(
                $data['pengaduan'],
                ['p' => $p, 'foto' => $foto]
            );
        }

        return view('admin/pengaduan/masuk', $data);
    }
    public function daftarProses()
    {
        if (session()->get('user_id')['role'] != 'Admin') {
            // Jika tidak, redirect ke halaman login
            return redirect()->to('/pengaduan');
        }

        $pengaduan = $this->pengaduanModel->getPengaduanWithUserWhereKetIs(1);
        $data = [
            'pengaduan' => []
        ];
        foreach ($pengaduan as $p) {
            $foto = $this->fotoPengaduanModel->getByPengaduanId($p['id']);
            array_push(
                $data['pengaduan'],
                ['p' => $p, 'foto' => $foto]
            );
        }

        return view('admin/pengaduan/daftarProses', $data);
    }

    public function proses($id)
    {
        if (session()->get('user_id')['role'] != 'Admin') {
            // Jika tidak, redirect ke halaman login
            return redirect()->to('/pengaduan');
        }
        $pengaduan = $this->pengaduanModel->getPengaduanById($id);
        $foto = $this->fotoPengaduanModel->getByPengaduanId($pengaduan['id']);
        $data = [
            'pengaduan' => ['p' => $pengaduan, 'foto' => $foto]
        ];

        return view('admin/pengaduan/detail', $data);
    }

    public function storeTanggapanAdmin()
    {
        $idAduan = $this->request->getPost('id_aduan');
        $idAdmin = session('user_id')['id'];


        $db = \Config\Database::connect();
        $db->transBegin();
        try {
            // edit ket aduan jadi 1, inputkan id_admin field
            $this->pengaduanModel->update($idAduan, ['ket' => 1, 'id_admin' => $idAdmin]);

            $data = [
                'id_aduan' => $this->request->getPost('id_aduan'),
                'jenis_tanggapan' => $this->request->getPost('jenis_tanggapan'),
                'rincian_admin' => $this->request->getPost('rincian'),
                'ket' => 0,
            ];
            // input tanggapan = id_aduan, jenis_tanggapan, rincian admin, 

            if ($this->tanggapanModel->save($data)) {

                // Mengambil file yang di-upload
                $uploadedFiles = $this->request->getFileMultiple('bukti');
                // input foto tanggapan jika ada
                if ($uploadedFiles) {
                    $tanggapanId = $this->tanggapanModel->getInsertID();
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
                        $this->fotoTanggapanModel->save(['foto' => $img, 'tanggapan_id' => $tanggapanId]);
                    }
                    $db->transCommit();

                    return redirect()->to('/pengaduan')->with('success', 'berhasil menanggapi aduan');
                };
                dd($this->pengaduanModel->errors());
                return 'eror ketika input pengaduan';
            }
        } catch (\Throwable $th) {
            $db->transRollback();
            // Tampilkan pesan error atau kembalikan form dengan error
            return redirect()->to('/pengaduan/tambah')->with('error', 'Terjadi kesalahan, silakan coba lagi');
        }
    }

    public function getByPengaduanId($id)
    {
        $tanggapan = $this->tanggapanModel->where('id_aduan', $id)->findAll();
        return $this->response->setJSON($tanggapan);
    }
}
