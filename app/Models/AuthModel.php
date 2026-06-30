<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table            = 'tbl_user';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    // Tambahkan 'role' ke dalam allowed fields
    protected $allowedFields    = [
        'nama_user',
        'email',
        'password',
        'foto',
        'role', // Sesuai dengan database baru Anda
    ];

    protected $useTimestamps = false; 

    protected $validationRules = [
        'email'    => 'required|valid_email',
        'password' => 'required|min_length[6]',
    ];

    public function findByUsername(string $identifier): ?array
    {
        return $this->where('email', $identifier)
                    ->first();
    }

    public function verifyPassword(string $plain, string $hashed): bool
    {
        return sha1($plain) === $hashed;
    }

    public function recordLastLogin(int $userId): bool
    {
        return true; 
    }

    public function hashPassword(string $plain): string
    {
        return sha1($plain);
    }
}