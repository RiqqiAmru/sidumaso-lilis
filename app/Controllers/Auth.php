<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index(): string
    {
        return view('auth/index');
    }
    public function register(): string
    {
        return view('auth/register');
    }

    public function login()
    {
        // Mengambil data dari form login
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validasi form login
        if (!$this->validate([
            'username' => 'required|min_length[3]|max_length[20]',
            'password' => 'required|max_length[255]'
        ])) {
            // Jika validasi gagal, kembali ke form login dengan pesan error
            return redirect()->to('/auth')->withInput()->with('errors', $this->validator->getErrors());
        }

        // Proses validasi login (misalnya, memeriksa username dan password)
        if ($this->userModel->verifyUser($username, $password)) {
            // Redirect ke halaman dashboard atau halaman utama jika login sukses

            return redirect()->to('/pengaduan');
        } else {

            // Jika login gagal, tampilkan pesan error
            return redirect()->back()->with('error', 'Username atau Password salah');
        }
    }

    // Fungsi untuk mengecek username dan password


    // Fungsi untuk logout (optional)
    public function logout()
    {
        // Hapus session dan redirect ke halaman login
        session()->destroy();
        return redirect()->to('home');
    }
}
