<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user'                => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'nama'   => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'username'   => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'no_hp'   => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'password'   => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'user_ktp'   => [
                'type'           => 'varchar',
                'constraint'     => '50',
            ],
            'role' => [
                'type'           => 'ENUM',
                'constraint'     => "'Admin','Masyarakat','Kepala_dusun'",
                'default'        => 'Masyarakat',
            ],
            'row_status' => [
                'type'           => 'ENUM',
                'constraint'     => "'Menunggu','Aktif','Non-Aktif'",
                'default'        => 'Menunggu',
            ],
            'created_at'        => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at'        => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id_user');
        $this->forge->createTable('tbl_user', true);
    }

    public function down()
    {
        $this->forge->dropTable('tbl_user', true);
    }
}
