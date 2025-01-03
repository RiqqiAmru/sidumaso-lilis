<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {

        // Ambil data pengumuman
        $pengumumanModel = new \App\Models\PengumumanModel();
        $tanggapanModel = new \App\Models\TanggapanModel();

        // Ambil 4 pengumuman terbaru
        $pengumuman = $pengumumanModel->orderBy('updated_at', 'DESC')->findAll(4);
        $jumlahProses = $tanggapanModel->countByStatus('Proses');
        // Kirim data ke view
        return view('landing', ['pengumuman' => $pengumuman, 'jumlahProses' => $jumlahProses]);
    }
    public function saran(): string
    {
        return view('saran/index');
    }
}
