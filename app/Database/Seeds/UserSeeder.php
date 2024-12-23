<?php

namespace App\Database\Seeds;


use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $factories = [
            [
                'nama'    => 'admin',
                'username'     => 'admin',
                'no_hp'   => '085566644477',
                'password'    => password_hash('admin', PASSWORD_DEFAULT),
                'user_ktp'    => 'default.jpg',
                'role'    => 'Admin',
                'row_status'    => 'Aktif',
            ],
            [
                'nama'    => 'masyarakat',
                'username'     => 'masyarakat',
                'no_hp'   => '085566644477',
                'password'    => password_hash('masyarakat', PASSWORD_DEFAULT),
                'user_ktp'    => 'default.jpg',
                'role'    => 'Masyarakat',
                'row_status'    => 'Aktif',
            ],
            [
                'nama'    => 'Masyarakat Non Aktif',
                'username'     => 'masyarakat',
                'no_hp'   => '085566644477',
                'password'    => password_hash('masyarakat', PASSWORD_DEFAULT),
                'user_ktp'    => 'default.jpg',
                'role'    => 'Masyarakat',
                'row_status'    => 'Non-Aktif',
            ],
            [
                'nama'    => 'Masyarakat Menunggu',
                'username'     => 'masyarakat',
                'no_hp'   => '085566644477',
                'password'    => password_hash('masyarakat', PASSWORD_DEFAULT),
                'user_ktp'    => 'default.jpg',
                'role'    => 'Masyarakat',
                'row_status'    => 'Menunggu',
            ],
            [
                'nama'    => 'Kepala Dusun',
                'username'     => 'kepala_dusun',
                'no_hp'   => '085566644477',
                'password'    => password_hash('kepala_dusun', PASSWORD_DEFAULT),
                'user_ktp'    => 'default.jpg',
                'role'    => 'Kepala_dusun',
                'row_status'    => 'Aktif',
            ],
        ];

        $builder = $this->db->table('tbl_user');

        foreach ($factories as $factory) {
            $builder->insert($factory);
        }
    }
}