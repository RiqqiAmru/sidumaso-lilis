<?php

namespace App\Models;

use CodeIgniter\Model;

class TanggapanModel extends Model
{
    protected $table            = 'tanggapan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_aduan', 'jenis_tanggapan', 'rincian', 'id_user', 'ket'];

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

    public function getTanggapanByPengaduanid($idAduan)
    {

        $result = $this->db->table('tanggapan')
            ->select('tanggapan.*, foto_tanggapan.foto, tbl_user.nama')
            ->join('foto_tanggapan', 'foto_tanggapan.tanggapan_id = tanggapan.id', 'left')
            ->join('tbl_user', 'tbl_user.id = tanggapan.id_user', 'left')
            ->where('tanggapan.id_aduan', $idAduan)
            ->orderBy('tanggapan.created_at', 'ASC')
            ->get()
            ->getResultArray();

        // Susun data tanggapan dengan foto sebagai array
        $tanggapanData = [];
        foreach ($result as $row) {
            $id = $row['id'];

            if (!isset($tanggapanData[$id])) {
                // Buat array tanggapan baru jika belum ada
                $warna = 'secondary';
                switch ($row['jenis_tanggapan']) {
                    case 'Selesai':
                        $warna = 'success';
                        break;
                    case 'Tidak Valid':
                        $warna = 'danger';
                        break;
                    case 'Menunggu Kelengkapan data':
                        $warna = 'warning';
                        break;
                }
                $tanggapanData[$id] = [
                    'id'           => $row['id'],
                    'id_aduan'     => $row['id_aduan'],
                    'nama'     => $row['nama'],
                    'jenis_tanggapan'     => $row['jenis_tanggapan'],
                    'rincian'    => $row['rincian'],
                    'ket'    => $row['ket'],
                    'created_at'    => $row['created_at'],
                    'warna'    => $warna,
                    'foto'         => [] // Siapkan array untuk foto
                ];
            }

            // Tambahkan foto jika ada
            if (!empty($row['foto'])) {
                $tanggapanData[$id]['foto'][] = $row['foto'];
            }
        }

        // Return data sebagai indexed array
        return array_values($tanggapanData);
        return $data;
    }
}
