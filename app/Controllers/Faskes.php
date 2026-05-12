<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelWilayah;
use App\Models\ModelSetting;
use App\Models\ModelFaskes;

class Faskes extends BaseController 
{
    public function __construct()
    {
        $this->ModelWilayah = new ModelWilayah();
        $this->ModelSetting = new ModelSetting();
        $this->ModelFaskes = new ModelFaskes();
    }

    public function index()
    {
        $data = [
            'judul' => 'Faskes',
            'menu' => 'faskes',
            'page' => 'faskes/v_index',
            'faskes' => $this->ModelFaskes->AllData(),
        ];
        return view('v_template_back_end', $data);
    }

    public function input()
    {
        $data = [
            'judul' => 'Input Faskes',
            'menu'  => 'faskes',
            'page'  => 'faskes/v_input',
            'web' => $this->ModelSetting->DataWeb(),
            'provinsi' => $this->ModelFaskes->allProvinsi(),
            'validation' => \Config\Services::validation(),
        ];
        return view('v_template_back_end', $data);
    }

    public function insertData()
    {
        if ($this->validate([
            'id_provinsi' => [
                'label' => 'Provinsi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'id_kabupaten' => [
                'label' => 'Kabupaten',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'id_kecamatan' => [
                'label' => 'Kecamatan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'wilayah_administratif' => [
                'label' => 'Wilayah Administrasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
        ])) {
            $data = [
                'id_provinsi' => $this->request->getPost('id_provinsi'),
                'id_kabupaten' => $this->request->getPost('id_kabupaten'),
                'id_kecamatan' => $this->request->getPost('id_kecamatan'),
                'wilayah_administratif' => $this->request->getPost('wilayah_administratif'),
            ];
            $this->ModelFaskes->InsertData($data);
            session()->setFlashdata('pesan', 'Data Berhasil Disimpan');
            return redirect()->to(base_url('faskes'));
        } else {
            return redirect()->to(base_url('faskes/input'))->withInput();
        }
    }

    public function getKabupaten($id_provinsi)
    {
        $kabupaten = $this->ModelFaskes->allKabupaten($id_provinsi);
        echo '<option value="">-- Pilih Kabupaten --</option>';
        foreach ($kabupaten as $key => $value) {
            echo '<option value="' . $value['id_kabupaten'] . '">' . $value['nama_kabupaten'] . '</option>';
        }
    }

    public function getKecamatan($id_kabupaten)
    {
        $kecamatan = $this->ModelFaskes->allKecamatan($id_kabupaten);
        echo '<option value="">-- Pilih Kecamatan --</option>';
        foreach ($kecamatan as $key => $value) {
            echo '<option value="' . $value['id_kecamatan'] . '">' . $value['nama_kecamatan'] . '</option>';
        }
    }
}