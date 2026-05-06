<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelWilayah;
use App\Models\ModelSetting;

class Wilayah extends BaseController
{
    public function __construct()
    {
        $this->ModelWilayah = new ModelWilayah();
        $this->ModelSetting = new ModelSetting();
    }

    public function index()
    {
        $data = [
            'judul' => 'Wilayah',
            'page' => 'Wilayah/v_index',
            'wilayah' => $this->ModelWilayah->AllData(),
            'web' => $this->ModelSetting->DataWeb(),
            ];
        return view('v_template_back_end', $data);
    }


    public function Input()
    {
        $data = [
            'judul' => 'Input Wilayah',
            'menu' => 'wilayah',
            'page' => 'Wilayah/v_input',
        ];
        return view('v_template_back_end', $data);
    }

    public function InsertData()
    {
        if ($this->validate([
            'nama_wilayah' => [
                'label' => 'Nama Wilayah',
                'rules' => 'required',
                'errors'=> [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'geojson' => [
                'label' => 'Data GeoJSON',
                'rules' => 'required',
                'errors'=> [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
            'warna' => [
                'label' => 'Warna',
                'rules' => 'required',
                'errors'=> [
                    'required' => '{field} Wajib Diisi !!'
                ]
            ],
        ])) {
            // jika validasi berhasil
            $data = [
                'nama_wilayah' => $this->request->getPost('nama_wilayah'),
                'warna' => $this->request->getPost('warna'),
                'geojson' => $this->request->getPost('geojson'),
            ];
            $this->ModelWilayah->InsertData($data);
            session()->setFlashdata('insert', 'Data Berhasil Ditambahkan !!');
            return redirect()->to('Wilayah');
        } else {
            // jika validasi gagal
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
    }

    public function Edit($id_wilayah)
{
    $data = [
        'judul'   => 'Edit Wilayah',
        'page'    => 'wilayah/v_edit',
        // Tambahkan baris di bawah ini untuk mengambil data berdasarkan ID
        'wilayah' => $this->ModelWilayah->DetailData($id_wilayah), 
    ];
    return view('v_template_back_end', $data);
}
public function UpdateData($id_wilayah)
    {
        $rules = [
            'nama_wilayah' => [
                'label' => 'Nama Wilayah',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'warna' => [
                'label' => 'Warna',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
            'geojson' => [
                'label' => 'GeoJson',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!']
            ],
        ];

        // Memeriksa validasi
        if ($this->validate($rules)) {
            // JIKA VALIDASI BERHASIL
            $data = [
                'id_wilayah' => $id_wilayah,
                'nama_wilayah' => $this->request->getPost('nama_wilayah'),
                'warna'        => $this->request->getPost('warna'),
                'geojson'      => $this->request->getPost('geojson'),
            ];
            
            $this->ModelWilayah->UpdateData($data);
            session()->setFlashdata('update', 'Data Berhasil Diupdate !!');
            return redirect()->to('wilayah');
            
        } else {
            // JIKA VALIDASI GAGAL
            // withInput() mengirimkan data form kembali agar bisa dibaca fungsi old()
            return redirect()->to('Wilayah/Input')->withInput();
        }
    }

    }
