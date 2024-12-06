<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateTanggapanAddIdUser extends Migration
{
    public function up()
    {
        // Hapus kolom rincian_admin dan rincian_pengirim
        $this->forge->dropColumn('tanggapan', ['rincian_admin', 'rincian_pengirim']);

        // Tambahkan kolom rincian dan id_user
        $fields = [
            'rincian' => [
                'type' => 'TEXT',
                'null' => true, // Boleh kosong
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true, // Boleh kosong, sesuaikan jika wajib
                'unsigned' => true,
            ]
        ];

        $this->forge->addForeignKey('id_user', 'tbl_user', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addColumn('tanggapan', $fields);
    }

    public function down()
    {
        //
    }
}
