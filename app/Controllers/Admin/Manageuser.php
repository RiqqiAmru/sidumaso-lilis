<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Manageuser extends BaseController
{
    public function index(): string
    {
        $userModel = new UserModel();

        // Fetch all users from the database
        $data['users'] = $userModel->findAll();

        // Load the view and pass the user data to it
        return view('admin/user/index', $data);
    }

    public function addUser(): string
    {
        return view('admin/user/tambah');
    }
    

    public function storeUser()
    {
        $userModel = new UserModel();
        $validation = \Config\Services::validation();
        // Validasi input form
        $validation->setRules([
            'nama' => 'required',
            'username' => 'required|is_unique[tbl_user.username]',
            'no_hp' => 'required|numeric|min_length[10]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
            'user_ktp' => 'uploaded[user_ktp]|max_size[user_ktp,512]|ext_in[user_ktp,jpg,jpeg,png]',
            'role' => 'required',
            'row_status' => 'required',
        ]);

        // Cek apakah validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // dd('');
        // Upload file KTP
        $fileKTP = $this->request->getFile('user_ktp');
        $namaFileKTP = $fileKTP->getRandomName(); // Generate nama file random
        $fileKTP->move('uploads/ktp', $namaFileKTP); // Pindahkan file ke folder uploads/ktp

        // Data yang akan disimpan ke database
        $data = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'no_hp' => $this->request->getPost('no_hp'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'user_ktp' => $namaFileKTP,
            'role' => $this->request->getPost('role'),
            'row_status' => $this->request->getPost('row_status'),
        ];

        // Simpan data
        $userModel->save($data);

        // Redirect ke halaman daftar user setelah berhasil menyimpan
        return redirect()->to('admin/user/index')->with('success', 'User berhasil ditambahkan');
    }
    public function edit($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengguna tidak ditemukan');
        }

        return view('admin/user/edit', ['user' => $user]); // Path view sesuai dengan yang Anda sebutkan
    }

    public function update($id)
    {
        $userModel = new UserModel();
        $validation = \Config\Services::validation();

        // Set rules untuk validasi
        $validation->setRules([
            'nama' => 'required',
            'no_hp' => 'required|numeric',
            'role' => 'required',
            'row_status' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kirim kembali dengan flashdata error
            return redirect()->to('admin/user/edit/' . $id)->withInput()->with('error', 'Data tidak valid.');
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'no_hp' => $this->request->getPost('no_hp'),
            'role' => $this->request->getPost('role'),
            'row_status' => $this->request->getPost('row_status'),
        ];

        if ($userModel->update($id, $data)) {
            session()->setFlashdata('success', 'Data pengguna berhasil diperbarui');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui data pengguna');
        }

        return redirect()->to('admin/user/edit/' . $id);
    }

    public function deleteUser($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);
        return redirect()->to('admin/user/index')->with('success', 'User berhasil dihapus');
    }

    public function verifikasi($id)
    {
        $userModel = new UserModel();

        $status = $this->request->getPost('status');
        if ($status == "terima") {
            $data = [
                'row_status' => 'Aktif'
            ];
            $userModel->update($id, $data);
        } else {
            $data = [
                'row_status' => 'Non-aktif'
            ];
            $userModel->update($id, $data);
        }
        return redirect()->to('admin/user/index')->with('success', 'berhasil verifikasi user');
    }

}
