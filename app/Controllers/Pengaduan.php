<?php

namespace App\Controllers;

class Pengaduan extends BaseController
{
    public function __construct()
    {

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
        return view('masyarakat/pengaduan/index');
    }
}
