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

            $user_id = session()->get('user_id')['id_user']; // Ambil user_id yang disimpan di session

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
        $userId = session()->get('user_id')['id_user'];  // Mengambil ID user yang login
        $user = $userModel->find($userId);  // Mengambil data user berdasarkan ID

        return view('editprofile', ['user' => $user]);
    }

    public function update()
    {
        $userModel = new UserModel();
        $userId = session()->get('user_id')['id_user'];  // Mengambil ID user yang login

        $data = [
            'nama'    => $this->request->getPost('nama'),
            'no_hp'   => $this->request->getPost('no_hp'),
        ];

        $userModel->update($userId, $data);  // Update data berdasarkan ID
        session()->setFlashdata('success', 'Akun berhasil diperbarui');
        return redirect()->to('/profile');
    }

    public function changePasswordView()
    {
        // jika method get maka kembalikan view changePassword
        // jika method post maka lakukan validasi dan update password
        return view('ubahpassword');
    }

    public function changePassword()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'current_password' => 'required|min_length[6]',
            'new_password'     => 'required|min_length[6]',
            'confirm_password' => 'required|matches[new_password]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Mendapatkan data dari input form
        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');
        $userId = session()->get('user_id')['id_user'];  // Mengambil user_id dari session

        $userModel = new UserModel();
        $user = $userModel->find($userId);

        // Cek apakah password lama cocok
        if (!password_verify($currentPassword, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Password lama tidak sesuai.');
        }

        // Update password
        $userModel->update($userId, ['password' => $newPassword]);

        return redirect()->back()->with('success', 'Password berhasil diubah.');
    }
}
