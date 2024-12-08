<?php

namespace App\Controllers;

use App\Models\UserModel;

class AkunController extends BaseController
{
    public function index()
    { {
            if (!session()->get('logged_in')) {
                return redirect()->to('/login');
            }

            $user_id = session()->get('user_id')['id']; // Ambil user_id yang disimpan di session

            $userModel = new UserModel();
            $user = $userModel->find($user_id); // Ambil data user berdasarkan user_id

            if (!$user) {
                // Jika data user tidak ditemukan, redirect ke halaman lain atau tampilkan pesan error
                return redirect()->to('/error'); // Misalnya ke halaman error
            }

            return view('profile', ['user' => $user]);
        }

    }
    public function edit()
    {
        $userModel = new UserModel();
        $userId = session()->get('user_id')['id'];  // Mengambil ID user yang login
        $user = $userModel->find($userId);  // Mengambil data user berdasarkan ID

        return view('editprofile', ['user' => $user]);
    }

    public function update()
    {
        $userModel = new UserModel();
        $userId = session()->get('user_id')['id'];  // Mengambil ID user yang login

        $data = [
            'nama'    => $this->request->getPost('nama'),
            'no_hp'   => $this->request->getPost('no_hp'),
        ];

        $userModel->update($userId, $data);  // Update data berdasarkan ID
        session()->setFlashdata('success', 'Akun berhasil diperbarui');
        return redirect()->to('/profile');
    }
}
