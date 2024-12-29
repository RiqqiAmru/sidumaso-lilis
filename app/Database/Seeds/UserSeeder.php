<?php

namespace App\Database\Seeds;


use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // truncate table

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
                'nama'    => 'Masyarakat Non Aktif',
                'username'     => 'non-aktif',
                'no_hp'   => '085566644477',
                'password'    => password_hash('masyarakat', PASSWORD_DEFAULT),
                'user_ktp'    => 'default.jpg',
                'role'    => 'Masyarakat',
                'row_status'    => 'Non-Aktif',
            ],
            [
                'nama'    => 'Masyarakat Menunggu',
                'username'     => 'menunggu',
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
            [
                'nama'    => 'masyarakat',
                'username'     => 'masyarakat',
                'no_hp'   => '085566644477',
                'password'    => password_hash('masyarakat', PASSWORD_DEFAULT),
                'user_ktp'    => 'default.jpg',
                'role'    => 'Masyarakat',
                'row_status'    => 'Aktif',
            ],
        ];

        $builder = $this->db->table('tbl_user');

        foreach ($factories as $factory) {
            $builder->insert($factory);
        }

        // fake user masyarakat
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 10; $i++) {
            $data = [
                'nama'    => $faker->name,
                'username'     => $faker->userName,
                'no_hp'   => $faker->phoneNumber,
                'password'    => password_hash('masyarakat', PASSWORD_DEFAULT),
                'user_ktp'    => 'default.jpg',
                'role'    => 'Masyarakat',
                'row_status'    => 'Aktif',
            ];
            $builder->insert($data);
        }
    }
}
