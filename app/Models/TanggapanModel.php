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
    protected $allowedFields    = ['id_aduan', 'jenis_tanggapan', 'rincian_admin', 'rincian_pengirim', 'ket'];

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
        // $fotoTanggapanModel = new FotoTanggapanModel();
        // $tanggapan = $this->where('id_aduan', $idAduan)->findAll();
        // $data = [
        //     []
        // ];
        // foreach ($tanggapan as $p) {
        //     $foto = $fotoTanggapanModel->getByTanggapanId($p['id']);
        //     array_push(
        //         $data['tanggapan'],
        //         ['p' => $p, 'foto' => $foto]
        //     );
        // }

        $result = $this->db->table('tanggapan')
            ->select('tanggapan.*, foto_tanggapan.foto')
            ->join('foto_tanggapan', 'foto_tanggapan.tanggapan_id = tanggapan.id', 'left')
            ->where('tanggapan.id_aduan', $idAduan)
            ->get()
            ->getResultArray();

        // Susun data tanggapan dengan foto sebagai array
        $tanggapanData = [];
        foreach ($result as $row) {
            $id = $row['id'];

            if (!isset($tanggapanData[$id])) {
                // Buat array tanggapan baru jika belum ada
                $tanggapanData[$id] = [
                    'id'           => $row['id'],
                    'id_aduan'     => $row['id_aduan'],
                    'jenis_tanggapan'     => $row['jenis_tanggapan'],
                    'rincian_admin'    => $row['rincian_admin'],
                    'rincian_pengirim'    => $row['rincian_pengirim'],
                    'ket'    => $row['ket'],
                    'created_at'    => $row['created_at'],
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
