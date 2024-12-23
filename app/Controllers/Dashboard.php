<?php

namespace App\Controllers;
use App\Models\TanggapanModel;
use App\Models\PengumumanModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $tanggapanModel = new TanggapanModel();
        $pengumumanModel = new PengumumanModel();

        // Hitung jumlah tanggapan berdasarkan status_aduan
        $jumlahProses = $tanggapanModel->countByStatus('Proses');
        $jumlahSelesai = $tanggapanModel->countByStatus('Selesai');
        $jumlahInvalid = $tanggapanModel->countByStatus('Tidak Valid');

        // Pagination
        $page = $this->request->getVar('page') ?? 1; // Mendapatkan halaman dari query string
        $perPage = 5; // Menampilkan 5 pengumuman per halaman

        // Ambil daftar pengumuman dengan pagination
        $pengumuman = $pengumumanModel->getPengumuman($perPage, $page);

        // Ambil total pengumuman untuk pagination
        $totalPengumuman = $pengumumanModel->getTotalPengumuman();
        // Ambil role pengguna dari session
        $role = session()->get('role');

        // Kirim data ke view
        return view('dashboard', [
            'role' => session()->get('role'), // pastikan role dikirimkan ke view
            'jumlahProses' => $jumlahProses,
            'jumlahSelesai' => $jumlahSelesai,
            'jumlahInvalid' => $jumlahInvalid,
            'pengumuman' => $pengumuman, // Passing data pengumuman ke view
            'pager' => $pengumumanModel->pager, // Pagination object
            'totalPengumuman' => $totalPengumuman,
        ]);
    }
}
