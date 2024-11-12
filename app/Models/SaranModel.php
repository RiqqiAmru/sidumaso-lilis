<?php

namespace App\Models;

use CodeIgniter\Model;

class SaranModel extends Model
{
    protected $table = 'sarans'; // Nama tabel di database
    protected $primaryKey = 'id'; // Kolom auto increment
    protected $allowedFields = ['nama', 'no_hp', 'saran', 'created_at']; // Kolom yang bisa diisi
    protected $useTimestamps = false; // Agar otomatis mengisi created_at
    protected $createdField = 'created_at'; // Nama kolom untuk created_at
}
