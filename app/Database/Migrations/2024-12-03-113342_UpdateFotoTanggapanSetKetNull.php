<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateFotoTanggapanSetKetNull extends Migration
{
    public function up()
    {
        $fields = [
            'ket' => [
                'type'       => 'VARCHAR',
                'constraint' => 255, // Sesuaikan dengan ukuran kolom aslinya
                'null'       => true, // Mengizinkan NULL
            ],
        ];

        $this->forge->modifyColumn('foto_tanggapan', $fields);
    }

    public function down()
    {
        $fields = [
            'ket' => [
                'type'       => 'VARCHAR',
                'constraint' => 255, // Sesuaikan dengan ukuran kolom aslinya
                'null'       => false, // Kembali ke NOT NULL
            ],
        ];

        $this->forge->modifyColumn('foto_tanggapan', $fields);
    }
}
