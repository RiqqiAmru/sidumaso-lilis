<?php

namespace App\Controllers;

use App\Models\SaranModel;

class SaranController extends BaseController
{
    public function index()
    {
        // Inisialisasi model
        $saranModel = new SaranModel();

        // Ambil semua data saran dari database
        $data['sarans'] = $saranModel->findAll();

        // Kirim data ke view
        return view('saran/index', $data);
    }

    public function create()
    {
        return view('landing');
    }

    public function store()
    {
        $saranModel = new SaranModel();

        $data = [
            'nama' => $this->request->getPost('nama'),
            'no_hp' => $this->request->getPost('no_hp'),
            'saran' => $this->request->getPost('saran'),
            // 'created_at' => date('Y-m-d H:i:s'),
        ];

        // $data, $saranModel->insert($data, true);
        $saranModel->insert($data);

        return redirect()->to('/saran/create');

    }
}
