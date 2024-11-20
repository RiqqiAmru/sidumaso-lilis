<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablePengaduan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'jenis_pengaduan'   => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'rincian'           => [
                'type'           => 'TEXT',
            ],
            'status_aduan'            => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'default'        => 'publik',  // Status default
            ],
            'ket'   => [
                'type'           => 'int',
                'constraint'     => 1,
            ],
            'id_pengirim'   => [
                'type'           => 'int',
            ],
            'id_admin'   => [
                'type'           => 'int',
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
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_pengirim', 'tbl_user', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_admin', 'tbl_user', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pengaduan');

        // Membuat tabel foto_pengaduan untuk menyimpan foto
        $this->forge->addField([
            'id'                => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'pengaduan_id'      => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'foto'              => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'created_at'        => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('pengaduan_id', 'pengaduan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('foto_pengaduan');
    }

    public function down()
    {
        $this->forge->dropTable('foto_pengaduan');
        $this->forge->dropTable('pengaduan');
    }
}
