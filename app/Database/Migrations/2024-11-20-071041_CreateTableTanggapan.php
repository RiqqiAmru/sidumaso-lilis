<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableTanggapan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'id_aduan'                => [
                'type'           => 'INT',
            ],
            'jenis_tanggapan'   => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'rincian_admin'           => [
                'type'           => 'TEXT',
            ],
            'rincian_pengirim'           => [
                'type'           => 'TEXT',
            ],
            'ket'   => [
                'type'           => 'int',
                'constraint'     => 1,
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
        $this->forge->addForeignKey('id_aduan', 'pengaduan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tanggapan');

        // Membuat tabel foto_pengaduan untuk menyimpan foto
        $this->forge->addField([
            'id'                => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'tanggapan_id'      => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'ket' => [
                'type' => 'INT',
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
        $this->forge->addForeignKey('tanggapan_id', 'tanggapan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('foto_tanggapan');
    }

    public function down()
    {
        $this->forge->dropTable('foto_tanggapan');
        $this->forge->dropTable('tanggapan');
    }
}
