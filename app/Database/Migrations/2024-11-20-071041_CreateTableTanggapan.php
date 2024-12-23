<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableTanggapan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tanggapan'                => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'id_pengaduan'                => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'jenis_tanggapan'   => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'rincian'           => [
                'type'           => 'TEXT',
                'null' => true
            ],
            'id_user'   => [
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
        $this->forge->addPrimaryKey('id_tanggapan');
        $this->forge->addForeignKey('id_pengaduan', 'pengaduan', 'id_pengaduan', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_user', 'tbl_user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tanggapan');

        // Membuat tabel foto_pengaduan untuk menyimpan foto
        $this->forge->addField([
            'id_foto_tanggapan'                => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'id_tanggapan'      => [
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
        $this->forge->addPrimaryKey('id_foto_tanggapan');
        $this->forge->addForeignKey('id_tanggapan', 'tanggapan', 'id_tanggapan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('foto_tanggapan');
    }

    public function down()
    {
        $this->forge->dropTable('foto_tanggapan');
        $this->forge->dropTable('tanggapan');
    }
}