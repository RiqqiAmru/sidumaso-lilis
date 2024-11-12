<?php

namespace App\Controllers;

class Pengaduan extends BaseController
{
    public function __construct()
    {
        // Memeriksa apakah pengguna sudah login sebelum melakukan apa pun di controller ini
        if (!session()->get('logged_in')) {
            // Jika tidak, redirect ke halaman login
            return redirect()->to('/login');
        }
    }
    public function index(): string
    {
        return view('templates/head');
    }
}
