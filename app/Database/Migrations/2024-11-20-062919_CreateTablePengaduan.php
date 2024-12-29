<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablePengaduan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pengaduan'                => [
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
            'ket'   => [
                'type'           => 'int',
                'constraint'     => 1,
            ],
            'gang' => [
                'type'           => 'ENUM',
                'constraint'     => "'1','2','3','4','5'",
                'default'        => '1',
            ],
            'detail_lokasi'           => [
                'type'           => 'TEXT',
            ],
            'id_user'   => [
                'constraint'     => 5,
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
        $this->forge->addPrimaryKey('id_pengaduan');
        $this->forge->addForeignKey('id_user', 'tbl_user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pengaduan');

        // Membuat tabel foto_pengaduan untuk menyimpan foto
        $this->forge->addField([
            'id_foto_pengaduan'                => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'id_pengaduan'      => [
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
            'updated_at'        => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id_foto_pengaduan');
        $this->forge->addForeignKey('id_pengaduan', 'pengaduan', 'id_pengaduan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('foto_pengaduan');
    }

    public function down()
    {
        $this->forge->dropTable('foto_pengaduan');
        $this->forge->dropTable('pengaduan');
    }
}