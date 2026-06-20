<?php

namespace App\Models;

use CodeIgniter\Model;

class Modeluser extends Model
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

   public function DetailData($id_faskes)
{
    return $this->db->table('tbl_user')
        ->select('
            tbl_faskes.*,
            tbl_kecamatan.nama_kecamatan AS kecamatan,
            tbl_kabupaten.nama_kabupaten AS kabupaten,
            tbl_provinsi.nama_provinsi AS provinsi
        ')
        ->where('tbl_faskes.id_faskes', $id_faskes)
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
        ->delete($data);
}
}