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
}
