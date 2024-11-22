<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tbl_user'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key dari tabel

    protected $allowedFields = [
        'nama',
        'username',
        'no_hp',
        'password',
        'user_ktp',
        'role',
        'row_status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Hash password sebelum menyimpan
    protected function setPassword(string $password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    // Simpan user baru
    public function saveUser($data)
    {
        $data['password'] = $this->setPassword($data['password']);
        return $this->save($data);
    }

    public function verifyUser($username, $password)
    {
        // Query untuk mencari user berdasarkan username
        $user = $this->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set('logged_in', true);  // Tandai pengguna sudah login
            session()->set('user_id', $user);
            return $user;
        }
        return false;
    }
}
