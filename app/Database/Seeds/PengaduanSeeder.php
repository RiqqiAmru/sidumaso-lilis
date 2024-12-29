<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PengaduanSeeder extends Seeder
{

    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $pengaduanModel = new \App\Models\PengaduanModel();
        $fotoModel = new \App\Models\FotoPengaduanModel();
        $tanggapanModel = new \App\Models\TanggapanModel();
        $fotoTanggapanModel = new \App\Models\FotoTanggapanModel();
        $data = [];

        for ($i = 0; $i <= 10; $i++) {
            $data = [
                'jenis_pengaduan' => $faker->randomElement(['Infrastruktur', 'Sengketa Lahan', 'Keamanan dan Ketertiban', 'lingkungan', 'pengelolaan dana desa', 'lainnya']),
                'rincian' => $faker->text(200),
                'ket' => 0,
                'gang' => $faker->randomElement([1, 2, 3, 4, 5]),
                'detail_lokasi' => $faker->address,
                'id_user' => $faker->numberBetween(5, 15),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now', 'Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now', 'Asia/Jakarta')->format('Y-m-d H:i:s'),
            ];
            $pengaduanModel->insert($data);

            // get inserted id
            $id_pengaduan = $pengaduanModel->getInsertID();
            $created_pengaduan = $pengaduanModel->find($id_pengaduan)->first()->created_at;
            $id_user_pengadu = $pengaduanModel->find($id_pengaduan)->first()->id_user;
            // insert foto
            $no = $faker->numberBetween(0, 3);
            for ($j = 0; $j < $no; $j++) {
                $foto = [
                    'id_pengaduan' => $id_pengaduan,
                    'foto' => 'default.jpg',
                    'created_at' => $faker->dateTimeBetween($created_pengaduan, 'now', 'Asia/Jakarta')->format('Y-m-d H:i:s'),
                    'updated_at' => $faker->dateTimeBetween($created_pengaduan, 'now', 'Asia/Jakarta')->format('Y-m-d H:i:s'),
                ];
                $this->db->table('foto_pengaduan')->insert($foto);
            }

            // insert tanggapan
            for ($k = 0; $k < $faker->numberBetween(0, 3); $k++) {
                $tanggapan = [
                    'id_pengaduan' => $id_pengaduan,
                    'jenis_tanggapan' => $faker->randomElement(['Proses', 'Selesai', 'Tidak Valid']),
                    'rincian' => $faker->text(200),
                    'id_user' => $faker->numberBetween(5, 15),
                    'created_at' => $faker->dateTimeBetween($created_pengaduan, 'now', 'Asia/Jakarta')->format('Y-m-d H:i:s'),
                    'updated_at' => $faker->dateTimeBetween($created_pengaduan, 'now', 'Asia/Jakarta')->format('Y-m-d H:i:s'),
                ];
                $tanggapanModel->insert($tanggapan);

                // get inserted id
                $id_tanggapan = $tanggapanModel->getInsertID();
                $created_tanggapan = $tanggapanModel->find($id_tanggapan)->first()->created_at;
                // insert foto tanggapan
                $no = $faker->numberBetween(0, 3);
                for ($j = 0; $j < $no; $j++) {
                    $foto = [
                        'id_tanggapan' => $id_tanggapan,
                        'foto' => 'default.jpg',
                        'created_at' => $faker->dateTimeBetween($created_tanggapan, 'now', 'Asia/Jakarta')->format('Y-m-d H:i:s'),
                        'updated_at' => $faker->dateTimeBetween($created_tanggapan, 'now', 'Asia/Jakarta')->format('Y-m-d H:i:s'),
                    ];
                    $this->db->table('foto_tanggapan')->insert($foto);
                }
            }
        }

        // input foto

    }
}
