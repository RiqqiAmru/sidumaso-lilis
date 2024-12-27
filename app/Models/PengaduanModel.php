<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaduanModel extends Model
{
    protected $table = 'pengaduan';
    protected $primaryKey = 'id_pengaduan';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'jenis_pengaduan',
        'rincian',
        'status_aduan',
        'ket',
        'gang',
        'id_user',
        'detail_lokasi'
    ];


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

    protected $fotoPengaduanModel;

    public function __construct()
    {
        parent::__construct();
        $this->fotoPengaduanModel = new FotoPengaduanModel();
    }

    public function getPengaduanWithUser()
    {
        return $this->select('pengaduan.*, tbl_user.nama ')
            ->join('tbl_user', 'tbl_user.id_user = pengaduan.id_user')
            ->where('pengaduan.ket', 0)
            ->findAll();
    }
    public function getPengaduanByOneUser($userId)
    {
        $result = $this
            ->select('pengaduan.*, DATE_FORMAT(pengaduan.created_at, "%d-%m-%Y %H:%i:%s") AS created_at, foto_pengaduan.foto, tbl_user.nama')
            ->join('foto_pengaduan', 'foto_pengaduan.id_pengaduan = pengaduan.id_pengaduan', 'left')
            ->join('tbl_user', 'tbl_user.id_user = pengaduan.id_user', 'left')
            ->where('pengaduan.id_user', $userId)
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
            $id = $row['id_pengaduan'];

            if (!isset($data[$id])) {
                // Buat array pengaduan baru jika belum ada
                $data[$id] = [
                    'id' => $row['id_pengaduan'],
                    'nama' => $row['nama'],
                    'jenis_pengaduan' => $row['jenis_pengaduan'],
                    'rincian' => $row['rincian'],
                    'gang' => $row['gang'],
                    'detail_lokasi' => $row['detail_lokasi'],
                    'ket' => $row['ket'],
                    'created_at' => $row['created_at'],
                    'foto' => [] // Siapkan array untuk foto
                ];
            }

            // Tambahkan foto jika ada
            if (!empty($row['foto'])) {
                $data[$id]['foto'] = is_array($row['foto']) ? $row['foto'] : [$row['foto']];
            }
        }

        // Return data sebagai indexed array
        return array_values($data);
    }

    public function getPengaduanWithUserWhereKetIs($ket)
    {

        $result = $this
            ->select('pengaduan.*, DATE_FORMAT(pengaduan.created_at, "%d-%m-%Y %H:%i:%s") AS created_at, foto_pengaduan.foto, tbl_user.nama')
            ->join('foto_pengaduan', 'foto_pengaduan.id_pengaduan = pengaduan.id_pengaduan', 'left')
            ->join('tbl_user', 'tbl_user.id_user = pengaduan.id_user', 'left')
            ->whereIn('pengaduan.ket', $ket)
            ->orderBy('pengaduan.created_at', 'DESC')
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
            ->join('tbl_user', 'tbl_user.id_user = pengaduan.id_user')
            ->where('pengaduan.id_pengaduan', $id)
            ->first();
    }
    public function getPengaduan($id)
    {
        return $this->find($id); // Mengambil data pengaduan berdasarkan primary key
    }

    public function getPengaduanByDateRange($start_date, $end_date)
    {
        // Menambahkan waktu pada end_date agar mencakup seluruh hari
        $end_date = $end_date . ' 23:59:59'; // Menambahkan waktu ke tanggal akhir

        // Query dengan kondisi tanggal
        return $this->select('pengaduan.*, DATE_FORMAT(pengaduan.created_at, "%d-%m-%Y %H:%i:%s") AS created_at, foto_pengaduan.foto, tbl_user.nama,
        IFNULL((SELECT tanggapan.rincian 
                                 FROM tanggapan 
                                 WHERE tanggapan.id_pengaduan = pengaduan.id_pengaduan
                                 ORDER BY tanggapan.created_at DESC 
                                 LIMIT 1), "Tidak ada tanggapan") AS tanggapan_rincian')
            ->join('foto_pengaduan', 'foto_pengaduan.id_pengaduan = pengaduan.id_pengaduan', 'left')
            ->join('tbl_user', 'tbl_user.id_user = pengaduan.id_user', 'left')
            ->where("pengaduan.created_at BETWEEN '$start_date' AND '$end_date'")
            ->get()
            ->getResultArray();
        // Pastikan hasilnya adalah array
        if (!is_array($result)) {
            return [];
        }
    }
    public function getAllPengaduan()
    {
        // Query untuk mengambil semua data pengaduan
        return $this->select('pengaduan.*, 
                         DATE_FORMAT(pengaduan.created_at, "%d-%m-%Y %H:%i:%s") AS created_at, 
                         foto_pengaduan.foto, 
                         tbl_user.nama, 
                         IFNULL((SELECT tanggapan.rincian 
                                 FROM tanggapan 
                                 WHERE tanggapan.id_pengaduan = pengaduan.id_pengaduan
                                 ORDER BY tanggapan.created_at DESC 
                                 LIMIT 1), "Tidak ada tanggapan") AS tanggapan_rincian')
            ->join('foto_pengaduan', 'foto_pengaduan.id_pengaduan = pengaduan.id_pengaduan', 'left')
            ->join('tbl_user', 'tbl_user.id_user = pengaduan.id_user', 'left')
            ->get()
            ->getResultArray();
    }


    public function getPengaduanWithTanggapan($status = [], $start_date = null, $end_date = null)
    {
        if ($end_date) {
            $end_date .= ' 23:59:59';
        }

        $builder = $this->select('pengaduan.*, 
        DATE_FORMAT(pengaduan.created_at, "%d-%m-%Y %H:%i:%s") AS created_at, 
        foto_pengaduan.foto, 
        tbl_user.nama, 
        IFNULL((SELECT tanggapan.rincian 
                FROM tanggapan 
                WHERE tanggapan.id_pengaduan = pengaduan.id_pengaduan 
                ORDER BY tanggapan.created_at DESC 
                LIMIT 1), "Tidak ada tanggapan") AS tanggapan_rincian')
            ->join('foto_pengaduan', 'foto_pengaduan.id_pengaduan = pengaduan.id_pengaduan', 'left')
            ->join('tbl_user', 'tbl_user.id_user = pengaduan.id_user', 'left');

        if (!empty($status)) {
            $builder->whereIn('pengaduan.ket', $status);
        }

        if ($start_date && $end_date) {
            $builder->where('pengaduan.created_at >=', $start_date)
                ->where('pengaduan.created_at <=', $end_date);
        }

        return $builder->get()->getResultArray();
    }


    public function getPengaduanByStatus($status)
    {
        return $this->select('pengaduan.*, 
        DATE_FORMAT(pengaduan.created_at, "%d-%m-%Y %H:%i:%s") AS created_at, 
        foto_pengaduan.foto, 
        tbl_user.nama, 
         IFNULL((SELECT tanggapan.rincian 
                                 FROM tanggapan 
                                 WHERE tanggapan.id_pengaduan = pengaduan.id_pengaduan
                                 ORDER BY tanggapan.created_at DESC 
                                 LIMIT 1), "Tidak ada tanggapan") AS tanggapan_rincian')
            ->join('foto_pengaduan', 'foto_pengaduan.id_pengaduan = pengaduan.id_pengaduan', 'left')
            ->join('tbl_user', 'tbl_user.id_user = pengaduan.id_user', 'left')
            ->where('pengaduan.ket', $status)
            ->get()
            ->getResultArray();
    }

    public function getPengaduanByDateRangeAndStatus($start_date, $end_date, $status)
    {
        $builder = $this->select('pengaduan.*, 
            DATE_FORMAT(pengaduan.created_at, "%d-%m-%Y %H:%i:%s") AS created_at, 
            foto_pengaduan.foto, 
            tbl_user.nama, 
            IFNULL((SELECT tanggapan.rincian 
                                 FROM tanggapan 
                                 WHERE tanggapan.id_pengaduan = pengaduan.id_pengaduan
                                 ORDER BY tanggapan.created_at DESC 
                                 LIMIT 1), "Tidak ada tanggapan") AS tanggapan_rincian')
            ->join('foto_pengaduan', 'foto_pengaduan.id_pengaduan = pengaduan.id_pengaduan', 'left')
            ->join('tbl_user', 'tbl_user.id_user = pengaduan.id_user', 'left')
            ->where('pengaduan.ket', $status) // Pastikan filter status diterapkan dengan benar
            ->where('pengaduan.created_at >=', $start_date)
            ->where('pengaduan.created_at <=', $end_date);

        return $builder->get()->getResultArray();
    }
}
