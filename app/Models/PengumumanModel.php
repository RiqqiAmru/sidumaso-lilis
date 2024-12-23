<?php

namespace App\Models;

use CodeIgniter\Model;

class PengumumanModel extends Model
{
    protected $table = 'pengumuman';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tanggal', 'judul', 'deskripsi', 'dokumen'];

    protected $useTimestamps = true;
    protected $createdField = '';  // Kosongkan jika tidak ada created_at
    protected $updatedField = 'updated_at'; // Gunakan updated_at
    protected $dateFormat = 'datetime'; // Format datetime
    
    // Ambil pengumuman dengan pagination
    public function getPengumuman($perPage = 5, $page = 1)
    {
        return $this->orderBy('tanggal', 'DESC') // Urutkan berdasarkan tanggal terbaru
                    ->paginate($perPage, 'default', $page); // Menampilkan 5 pengumuman per halaman
    }

    // Mendapatkan total pengumuman untuk pagination
    public function getTotalPengumuman()
    {
        return $this->countAllResults(); // Menghitung total pengumuman
    }

}
