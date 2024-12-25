<?php

namespace App\Models;

use CodeIgniter\Model;

class TanggapanModel extends Model
{
    protected $table = 'tanggapan';
    protected $primaryKey = 'id_tanggapan';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['id_pengaduan', 'jenis_tanggapan', 'rincian', 'id_user', 'ket'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function getTanggapanByPengaduanid($idAduan)
    {

        $result = $this->db->table('tanggapan')
            ->select('tanggapan.*,DATE_FORMAT(tanggapan.created_at, "%d-%m-%Y %H:%i:%s") AS created_at, foto_tanggapan.foto, tbl_user.nama')
            ->join('foto_tanggapan', 'foto_tanggapan.id_tanggapan = tanggapan.id_tanggapan', 'left')
            ->join('tbl_user', 'tbl_user.id_user = tanggapan.id_user', 'left')
            ->where('tanggapan.id_pengaduan', $idAduan)
            ->orderBy('tanggapan.created_at', 'ASC')
            ->get()
            ->getResultArray();


        // Susun data tanggapan dengan foto sebagai array
        $tanggapanData = [];
        foreach ($result as $row) {
            $id = $row['id_tanggapan'];

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
                    'id' => $row['id_tanggapan'],
                    'id_aduan' => $row['id_pengaduan'],
                    'nama' => $row['nama'],
                    'jenis_tanggapan' => $row['jenis_tanggapan'],
                    'rincian' => $row['rincian'],

                    'created_at' => $row['created_at'],
                    'warna' => $warna,
                    'foto' => [] // Siapkan array untuk foto
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
    public function countByStatus($status)
    {
        return $this->where('jenis_tanggapan', $status)->countAllResults();
    }
    public function getTanggapanPengaduanId($pengaduan_id)
    {
        // Ambil data tanggapan berdasarkan pengaduan_id
        return $this->where('pengaduan_id', $pengaduan_id)
            ->first(); // Ambil tanggapan pertama yang cocok
    }
}
