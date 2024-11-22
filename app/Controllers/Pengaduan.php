<?php

namespace App\Controllers;

use App\Models\FotoPengaduanModel;
use App\Models\PengaduanModel;

class Pengaduan extends BaseController
{
    protected $pengaduanModel;
    protected $fotoPengaduanModel;
    public function __construct()
    {
        $this->pengaduanModel = new PengaduanModel();
        $this->fotoPengaduanModel = new FotoPengaduanModel();

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
        $data['pengaduan'] = $this->pengaduanModel->where('id_pengirim', session('user_id')['id'])->find();
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
                        $file->move(WRITEPATH . 'uploads', $newName);

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
}
