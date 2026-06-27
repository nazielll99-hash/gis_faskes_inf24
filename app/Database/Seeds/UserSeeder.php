<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * UserSeeder
 *
 * Isi data awal user untuk testing.
 * Jalankan: php spark db:seed UserSeeder
 */
class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name'       => 'Administrator Sistem',
                'username'   => 'admin',
                'email'      => 'admin@rsudsehatmedika.id',
                'no_nik'     => '1234567890',
                'password'   => password_hash('Admin@123', PASSWORD_BCRYPT, ['cost' => 12]),
                'role'       => 'admin',
                'unit_kerja' => 'IT & Sistem Informasi',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'dr. Budi Santoso, Sp.PD',
                'username'   => 'dr.budi',
                'email'      => 'budi.santoso@rsudsehatmedika.id',
                'no_nik'     => '1987654321',
                'password'   => password_hash('Dokter@123', PASSWORD_BCRYPT, ['cost' => 12]),
                'role'       => 'dokter',
                'unit_kerja' => 'Poli Penyakit Dalam',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Ns. Siti Rahayu, S.Kep',
                'username'   => 'siti.perawat',
                'email'      => 'siti.rahayu@rsudsehatmedika.id',
                'no_nik'     => '1990112233',
                'password'   => password_hash('Perawat@123', PASSWORD_BCRYPT, ['cost' => 12]),
                'role'       => 'perawat',
                'unit_kerja' => 'IGD',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Apt. Ahmad Farida, S.Farm',
                'username'   => 'apt.ahmad',
                'email'      => 'ahmad.farida@rsudsehatmedika.id',
                'no_nik'     => '1985445566',
                'password'   => password_hash('Apoteker@123', PASSWORD_BCRYPT, ['cost' => 12]),
                'role'       => 'apoteker',
                'unit_kerja' => 'Instalasi Farmasi',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Dewi Kartika',
                'username'   => 'dewi.resep',
                'email'      => 'dewi.kartika@rsudsehatmedika.id',
                'no_nik'     => '1995778899',
                'password'   => password_hash('Resep@123', PASSWORD_BCRYPT, ['cost' => 12]),
                'role'       => 'resepsionis',
                'unit_kerja' => 'Pendaftaran & Loket',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($users);

        echo "✅ UserSeeder berhasil: " . count($users) . " user ditambahkan.\n";
    }
}
