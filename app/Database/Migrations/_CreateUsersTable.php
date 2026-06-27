<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * CreateUsersTable
 *
 * Jalankan dengan: php spark migrate
 * Rollback: php spark migrate:rollback
 */
class CreateUsersTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => false,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
                'unique'     => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
                'default'    => null,
                'unique'     => true,
            ],
            'no_nik' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'default'    => null,
                'unique'     => true,
                'comment'    => 'Nomor Induk Kependudukan / NIP pegawai',
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['admin','dokter','perawat','apoteker','resepsionis'],
                'default'    => 'resepsionis',
            ],
            'unit_kerja' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'default'    => null,
                'comment'    => 'Contoh: Poli Umum, IGD, Farmasi',
            ],
            'avatar' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'default'    => 'default.png',
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'last_login' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => null,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => null,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => null,
            ],
            'deleted_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => null,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('username');
        $this->forge->createTable('users');
    }

    public function down(): void
    {
        $this->forge->dropTable('users', true);
    }
}
