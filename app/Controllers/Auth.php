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

    // public function login()
    // {
    //     // Mengambil data dari form login
    //     $username = $this->request->getPost('username');
    //     $password = $this->request->getPost('password');

    //     // Validasi form login
    //     if (
    //         !$this->validate([
    //             'username' => 'required|min_length[3]|max_length[20]',
    //             'password' => 'required|max_length[255]'
    //         ])
    //     ) {
    //         // Jika validasi gagal, kembali ke form login dengan pesan error
    //         return redirect()->to('/auth')->withInput()->with('errors', $this->validator->getErrors());
    //     }

    //     // Proses validasi login (misalnya, memeriksa username dan password)
    //     $user = $this->userModel->verifyUser($username, $password);
    //     if ($user) {
    //         // Redirect ke halaman dashboard atau halaman utama jika login sukses
    //         // dd($user);
    //         if ($user['row_status'] == 'Non-aktif') {
    //             return redirect()->back()->with('errors', ['username' => 'Mohon maaf ktp anda invalid, silahkan menghubungi admin untuk informasi lebih lanjut']);
    //         }
    //         return redirect()->to('/pengaduan');
    //     } else {
    //         // Jika login gagal, tampilkan pesan error
    //         return redirect()->back()->with('errors', ['username' => 'Username atau Password salah']);
    //     }
    // }
    public function login()
    {
        // Periksa apakah form login telah dikirim
        if ($this->request->getMethod() === 'post') {
            // Mengambil data dari form login
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            // Validasi form login
            if (
                !$this->validate([
                    'username' => 'required|min_length[3]|max_length[20]',
                    'password' => 'required|max_length[255]'
                ])
            ) {
                // Jika validasi gagal, kembali ke form login dengan pesan error
                return redirect()->to('/auth')->withInput()->with('errors', $this->validator->getErrors());
            }

            // Proses validasi login (misalnya, memeriksa username dan password)
            $user = $this->userModel->verifyUser($username, $password);
            if ($user) {
                session()->set('role', $user['role']);
                // Redirect ke halaman dashboard atau halaman utama jika login sukses
                if ($user['row_status'] == 'Non-aktif') {
                    return redirect()->back()->with('errors', ['username' => 'Mohon maaf KTP Anda invalid, silakan menghubungi admin untuk informasi lebih lanjut']);
                }
                return redirect()->to('/dashboard');
            } else {
                // Jika login gagal, tampilkan pesan error
                return redirect()->back()->with('errors', ['username' => 'Username atau Password salah']);
            }
        }

        // Tampilkan halaman login (GET request)
        return view('auth/index');
    }


    // Fungsi untuk mengecek username dan password


    // Fungsi untuk logout (optional)
    public function logout()
    {
        // Hapus session dan redirect ke halaman login
        session()->destroy();
        // dd(session());
        return redirect()->to(base_url('/home'));
    }

    public function create()
    {
        // Form validation
        if (
            !$this->validate([
                'nama' => 'required|min_length[3]|max_length[20]|is_unique[tbl_user.nama]',
                'username' => 'required|min_length[3]|max_length[20]|is_unique[tbl_user.username]',
                'password' => 'required|min_length[8]',
                'password_confirm' => 'matches[password]',
                'user_ktp' => 'uploaded[user_ktp]|max_size[user_ktp,512]|ext_in[user_ktp,jpg,jpeg,png]',
                'no_hp' => 'required|numeric|min_length[10]',

            ])
        ) {
            // If validation fails, return to the form with the errors
            // dd($this->validator->getErrors());
            return redirect()->to('/auth/register')->withInput()->with('errors', $this->validator->getErrors());
        }

        // uplod file
        $fileKTP = $this->request->getFile('user_ktp');
        $namaFileKTP = $fileKTP->getRandomName(); // Generate nama file random
        $fileKTP->move('uploads/ktp', $namaFileKTP);
        // If validation is successful, proceed to save the user data
        $userData = [
            'username' => $this->request->getPost('username'),
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'user_ktp' => $namaFileKTP,
            'no_hp' => $this->request->getPost('no_hp'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT), // Encrypt password
        ];

        // Insert the user data into the database
        if ($this->userModel->insert($userData)) {
            // Redirect to login page or show success message
            return redirect()->to('/auth/login')->with('message', 'Daftar Akun Berhasil. Silahkan login.');
        } else {
            // If insertion failed, show an error message
            return redirect()->to('/auth/register')->with('errors', ['nama' => 'There was an issue with registration.'])->withInput();
        }
    }

}
