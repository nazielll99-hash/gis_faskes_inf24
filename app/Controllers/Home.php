<?php

namespace App\Controllers;
use App\Models\ModelSetting;
use App\Models\ModelWilayah;
use App\Models\ModelFaskes;
use App\Models\ModelKategori;

class Home extends BaseController
{
    public function __construct()
    {
        $this->ModelSetting  = new ModelSetting();
        $this->ModelWilayah  = new ModelWilayah();
        $this->ModelFaskes   = new ModelFaskes();
        $this->ModelKategori = new ModelKategori();
    }

    public function index($id_wilayah = null)
    {
        if ($id_wilayah !== null) {
            $wilayahData = $this->ModelWilayah->DetailData($id_wilayah);

            // Diperbaiki: pakai AllDataMap-style join, filter berdasarkan id_kecamatan
            $faskesData = $this->ModelFaskes->db->table('tbl_faskes')
                ->select('
                    tbl_faskes.*,
                    tbl_kecamatan.nama_kecamatan AS nama_kecamatan
                ')
                ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan = tbl_faskes.id_kecamatan', 'left')
                ->where('tbl_faskes.id_kecamatan', $id_wilayah)
                ->get()->getResultArray();
        } else {
            $wilayahData = $this->ModelWilayah->AllData();
            $faskesData  = $this->ModelFaskes->AllDataMap();
        }

        $data = [
            'judul'    => 'Home',
            'page'     => 'v_home',
            'web'      => $this->ModelSetting->DataWeb(),
            'wilayah'  => $wilayahData,
            'faskes'   => $faskesData,
            'kategori' => $this->ModelKategori->AllData(),
        ];

        return view('v_template_front_end', $data);
    }
}