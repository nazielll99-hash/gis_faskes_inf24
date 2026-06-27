<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * AuthModel
 * * Mengelola data pengguna dan autentikasi untuk
 * Sistem Informasi Fasilitas Kesehatan.
 */
class AuthModel extends Model
{
    protected $table            = 'tbl_user';
    protected $primaryKey       = 'id_user'; // DIUBAH: Sesuai dengan primary key di phpMyAdmin
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;    // DIUBAH: Karena di tabel tidak ada kolom deleted_at

    protected $allowedFields    = [
        'nama_user',                        // Sesuai DB
        'email',                            // Sesuai DB
        'password',                         // Sesuai DB
        'foto',                             // Sesuai DB
    ];

    // Timestamps dinonaktifkan karena kolom tidak ada di database saat ini
    protected $useTimestamps = false; 

    // Validasi
    protected $validationRules = [
        'email'    => 'required|valid_email',
        'password' => 'required|min_length[6]',
    ];

    /**
     * Cari user berdasarkan email.
     * Karena di tabel Anda tidak ada kolom 'username' atau 'no_nik', 
     * pencarian diubah menggunakan kolom 'email'.
     *
     * @param  string $identifier email pengguna
     * @return array|null
     */
    public function findByUsername(string $identifier): ?array
    {
        return $this->where('email', $identifier)
                    ->first();
    }

    /**
     * Verifikasi password pengguna.
     *
     * @param  string $plain    Kata sandi polos dari form
     * @param  string $hashed   Hash dari database
     * @return bool
     */
    public function verifyPassword(string $plain, string $hashed): bool
    {
        return password_verify($plain, $hashed);
    }

    /**
     * Catat waktu login terakhir.
     * CATATAN: Fungsi ini dinonaktifkan sementara karena tabel Anda tidak punya kolom 'last_login'
     */
    public function recordLastLogin(int $userId): bool
    {
        return true; 
    }

    /**
     * Hash password baru (digunakan saat registrasi / ganti password).
     *
     * @param  string $plain
     * @return string
     */
    public function hashPassword(string $plain): string
    {
        return password_hash($plain, PASSWORD_BCRYPT, ['cost' => 12]);
    }
}