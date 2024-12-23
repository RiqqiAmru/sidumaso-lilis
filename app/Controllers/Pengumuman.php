<?php

namespace App\Controllers;

use App\Models\PengumumanModel;
use CodeIgniter\Controller;

class Pengumuman extends Controller
{
    protected $pengumumanModel;

    public function __construct()
    {
        $this->pengumumanModel = new PengumumanModel();
        helper('session');
    }

    public function index()
    {
        $model = new PengumumanModel();

        // Pagination setup
        $pager = \Config\Services::pager();
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        // Get data for the current page
        $data['pengumuman'] = $model->paginate(10, 'default', $currentPage);
        $data['pager'] = $model->pager;

        return view('pengumuman/index', $data);
    }

    public function create()
    {
        return view('pengumuman/tambah');
    }

    public function store()
    {
        // Validasi input
        $validation = $this->validate([
            'judul' => 'required|max_length[255]',
            'deskripsi' => 'required',
            'dokumen' => [
                'uploaded[dokumen]',
                'mime_in[dokumen,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,image/jpg,image/jpeg,image/png,image/gif]',
                'max_size[dokumen,5120]', // Maksimal ukuran file 5MB
            ],
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Upload dokumen jika ada
        $file = $this->request->getFile('dokumen');
        $fileName = $file->getRandomName();
        $file->move('uploads/pengumuman', $fileName);

        // Simpan data ke database
        $this->pengumumanModel->save([
            'tanggal' => date('Y-m-d H:i:s'),
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'dokumen' => $fileName,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->to('/pengumuman')->with('success', 'Pengumuman berhasil ditambahkan.');
    }
    public function edit($id)
    {
        // Ambil data pengumuman berdasarkan ID
        $pengumumanModel = new \App\Models\PengumumanModel();
        $pengumuman = $pengumumanModel->find($id);

        // Jika data tidak ditemukan, tampilkan error 404
        if (!$pengumuman) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Pengumuman dengan ID $id tidak ditemukan.");
        }

        // Tampilkan view edit dengan data pengumuman
        return view('pengumuman/edit', ['pengumuman' => $pengumuman]);
    }

    public function update($id)
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required|max_length[255]',
            'deskripsi' => 'required',
            'dokumen' => 'permit_empty|mime_in[dokumen,application/pdf,application/msword,image/png,image/jpeg]|max_size[dokumen,2048]',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Proses update data
        $pengumumanModel = new \App\Models\PengumumanModel();

        // Cek apakah ada file baru yang diunggah
        $fileDokumen = $this->request->getFile('dokumen');
        if ($fileDokumen && $fileDokumen->isValid()) {
            // Simpan file ke folder uploads
            $fileName = $fileDokumen->getRandomName();
            $fileDokumen->move('uploads', $fileName);

            // Update dengan dokumen baru
            $data = [
                'judul' => $this->request->getPost('judul'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'dokumen' => $fileName,
            ];
        } else {
            // Update tanpa dokumen baru
            $data = [
                'judul' => $this->request->getPost('judul'),
                'deskripsi' => $this->request->getPost('deskripsi'),
            ];
        }

        // Update data di database
        $pengumumanModel->update($id, $data);

        // Redirect dengan pesan sukses
        return redirect()->to('/pengumuman')->with('success', 'Pengumuman berhasil diperbarui.');
    }
    public function detail($id)
    {
        $pengumumanModel = new PengumumanModel();
        $pengumuman = $pengumumanModel->find($id);
        

        if (!$pengumuman) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengumuman tidak ditemukan');
        }

        return view('pengumuman/detail', ['pengumuman' => $pengumuman]);
    }



}
