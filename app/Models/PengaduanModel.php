<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaduanModel extends Model
{
    protected $table            = 'pengaduan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['jenis_pengaduan', 'rincian', 'status_aduan', 'ket', 'id_pengirim', 'id_admin'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getPengaduanWithUser()
    {
        return $this->select('pengaduan.*, tbl_user.nama ')
            ->join('tbl_user', 'tbl_user.id = pengaduan.id_pengirim')
            ->where('pengaduan.ket', 0)
            ->findAll();
    }
    public function getPengaduanWithUserWhereKetIs($ket)
    {
        return $this->select('pengaduan.*, tbl_user.nama ')
            ->join('tbl_user', 'tbl_user.id = pengaduan.id_pengirim')
            ->where('pengaduan.ket', $ket)
            ->findAll();
    }

    /**
     * Get pengaduan by ID with user information.
     *
     * @param int $id
     * @return array|null
     */
    public function getPengaduanById($id)
    {
        return $this->select('pengaduan.*, tbl_user.nama ')
            ->join('tbl_user', 'tbl_user.id = pengaduan.id_pengirim')
            ->where('pengaduan.id', $id)
            ->first();
    }
}
