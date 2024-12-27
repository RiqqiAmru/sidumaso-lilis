<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablePengumuman extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pengumuman'                => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'tanggal'   => [
                'type'           => 'DATETIME',
            ],
            'deskripsi'           => [
                'type'           => 'TEXT',
            ],
            'judul' => [
                'type' => 'VARCHAR',
                'constraint'     => '50',

            ],
            'dokumen' => [
                'type' => 'VARCHAR',
                'constraint'     => '50',

            ],

            'updated_at'        => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id_pengumuman');
        $this->forge->createTable('pengumuman');
    }

    public function down()
    {
        $this->forge->dropTable('pengumuman');
    }
}
