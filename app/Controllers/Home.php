<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {

        // Ambil data pengumuman
        $pengumumanModel = new \App\Models\PengumumanModel();

        // Ambil 4 pengumuman terbaru
        $pengumuman = $pengumumanModel->orderBy('updated_at', 'DESC')->findAll(4);

        // Kirim data ke view
        return view('landing', ['pengumuman' => $pengumuman]);


    }
    public function saran(): string
    {
        return view('saran/index');
    }
}
