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

    protected $fotoPengaduanModel;

    public function __construct()
    {
        parent::__construct();
        $this->fotoPengaduanModel = new FotoPengaduanModel();
    }

    public function getPengaduanWithUser()
    {
        return $this->select('pengaduan.*, tbl_user.nama ')
            ->join('tbl_user', 'tbl_user.id = pengaduan.id_pengirim')
            ->where('pengaduan.ket', 0)
            ->findAll();
    }
    public function getPengaduanByOneUser($userId)
    {
        $result = $this
            ->select('pengaduan.*, foto_pengaduan.foto, tbl_user.nama')
            ->join('foto_pengaduan', 'foto_pengaduan.pengaduan_id = pengaduan.id', 'left')
            ->join('tbl_user', 'tbl_user.id = pengaduan.id_pengirim', 'left')
            ->where('pengaduan.id_pengirim', $userId)
            ->orderBy('pengaduan.created_at', 'DESC')
            ->get()
            ->getResultArray();

        // Susun data tanggapan dengan foto sebagai array
        return $this->gabungDataPengaduanDanFoto($result);
    }

    public function gabungDataPengaduanDanFoto($resultArray)
    {
        $data = [];
        foreach ($resultArray as $row) {
            $id = $row['id'];

            if (!isset($data[$id])) {
                // Buat array pengaduan baru jika belum ada
                $data[$id] = [
                    'id'           => $row['id'],
                    'nama'     => $row['nama'],
                    'jenis_pengaduan'     => $row['jenis_pengaduan'],
                    'status_aduan'     => $row['status_aduan'],
                    'rincian'    => $row['rincian'],
                    'ket'    => $row['ket'],
                    'created_at'    => $row['created_at'],
                    'foto'         => [] // Siapkan array untuk foto
                ];
            }

            // Tambahkan foto jika ada
            if (!empty($row['foto'])) {
                $data[$id]['foto'][] = $row['foto'];
            }
        }

        // Return data sebagai indexed array
        return array_values($data);
    }

    public function getPengaduanWithUserWhereKetIs($ket)
    {

        $result = $this
            ->select('pengaduan.*, foto_pengaduan.foto, tbl_user.nama')
            ->join('foto_pengaduan', 'foto_pengaduan.pengaduan_id = pengaduan.id', 'left')
            ->join('tbl_user', 'tbl_user.id = pengaduan.id_pengirim', 'left')
            ->whereIn('pengaduan.ket', $ket)
            ->get()
            ->getResultArray();

        // Susun data tanggapan dengan foto sebagai array
        return $this->gabungDataPengaduanDanFoto($result);
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
