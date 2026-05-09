<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelFaskes extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_faskes')
            ->get()->getResultArray();
    }

    public function InsertData($data)
    {
        $this->db->table('tbl_faskes')->insert($data);
    }

    public function DetailData($id_faskes)
    {
        return $this->db->table('tbl_faskes')
            ->where('id_faskes', $id_faskes)
            ->get()->getRowArray();
    }
    public function UpdateData($data)
{
    $this->db->table('tbl_faskes')
        ->where('id_faskes', $data['id_faskes'])
        ->update($data);
}
 public function deleteData($data)
{
    $this->db->table('tbl_faskes')
        ->where('id_faskes', $data['id_faskes'])
        ->delete($data);
}

}