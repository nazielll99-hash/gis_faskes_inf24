<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model // Perbaikan: Ganti nama class menjadi ModelUser (U besar)
{
    public function AllData()
    {
        return $this->db->table('tbl_user')
            ->get()->getResultArray();
    }

    public function InsertData($data)
    {
        $this->db->table('tbl_user')->insert($data);
    }

    // === PERBAIKAN FUNGSI DETAIL DATA USER ===
    public function DetailData($id_user)
    {
        // Diubah agar mengambil data dari tbl_user berdasarkan id_user
        return $this->db->table('tbl_user')
            ->where('id_user', $id_user)
            ->get()
            ->getRowArray();
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_user')
            ->where('id_user', $data['id_user'])
            ->update($data);
    }

    public function deleteData($data)
    {
        $this->db->table('tbl_user')
            ->where('id_user', $data['id_user'])
            ->delete($data); // Catatan: Di CI4, delete() untuk Query Builder tidak perlu melempar parameter $data lagi, cukup ->delete() saja jika where sudah ditentukan
    }
}