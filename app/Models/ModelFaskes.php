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
        ->select('
            tbl_faskes.*,
            tbl_kecamatan.nama_kecamatan AS kecamatan,
            tbl_kabupaten.nama_kabupaten AS kabupaten,
            tbl_provinsi.nama_provinsi AS provinsi
        ')
        ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_faskes.id_kategori', 'left')
        ->join('tbl_provinsi', 'tbl_provinsi.id_provinsi = tbl_faskes.id_provinsi', 'left')
        ->join('tbl_kabupaten', 'tbl_kabupaten.id_kabupaten = tbl_faskes.id_kabupaten', 'left')
        ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan = tbl_faskes.id_kecamatan', 'left')
        ->join('tbl_wilayah', 'tbl_wilayah.id_wilayah = tbl_faskes.id_wilayah', 'left')
        ->where('tbl_faskes.id_faskes', $id_faskes)
        ->get()
        ->getRowArray();
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

//provinsi
public function allProvinsi()
{
    return $this->db->table('tbl_provinsi')
        ->orderBy('id_provinsi', 'ASC')
        ->get()->getResultArray();
}
public function allKabupaten($id_provinsi)
{
    return $this->db->table('tbl_kabupaten')
        ->where('id_provinsi', $id_provinsi)
        ->get()->getResultArray();
}
public function allKecamatan($id_kabupaten)
{
    return $this->db->table('tbl_kecamatan')
        ->where('id_kabupaten', $id_kabupaten)
        ->get()->getResultArray();
}

}