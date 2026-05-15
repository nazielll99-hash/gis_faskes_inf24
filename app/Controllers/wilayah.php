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
            'menu' => 'wilayah',
            'page' => 'Wilayah/v_index',
            'wilayah' => $this->ModelWilayah->AllData(),
            'web' => $this->ModelSetting->DataWeb(),
        ];
        return view('v_template_back_end', $data);
    }

    public function input()
    {
        $data = [
            'judul' => 'Input Wilayah',
            'menu' => 'wilayah',
            'page' => 'Wilayah/v_input',
        ];
        return view('v_template_back_end', $data);
    }

    public function insertdata()
    {
        if (
            $this->validate([
                'nama_wilayah' => [
                    'label' => 'Nama Wilayah',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib Diisi !!'
                    ]
                ],
                'geojson' => [
                    'label' => 'Data GeoJSON',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib Diisi !!'
                    ]
                ],
                'warna' => [
                    'label' => 'Warna',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Wajib Diisi !!'
                    ]
                ],
            ])
        ) {
            $data = [
                'nama_wilayah' => $this->request->getPost('nama_wilayah'),
                'warna' => $this->request->getPost('warna'),
                'geojson' => $this->request->getPost('geojson'),
            ];
            $this->ModelWilayah->InsertData($data);
            session()->setFlashdata('insert', 'Data Berhasil Ditambahkan !!');
            return redirect()->to('wilayah');
        } else {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
    }

    public function edit($id_wilayah)
    {
        $data = [
            'judul' => 'Edit Wilayah',
            'menu' => 'wilayah',
            'page' => 'wilayah/v_edit',
            'wilayah' => $this->ModelWilayah->DetailData($id_wilayah),
        ];
        return view('v_template_back_end', $data);
    }

    public function updatedata($id_wilayah)
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

        if ($this->validate($rules)) {
            $data = [
                'id_wilayah' => $id_wilayah,
                'nama_wilayah' => $this->request->getPost('nama_wilayah'),
                'warna' => $this->request->getPost('warna'),
                'geojson' => $this->request->getPost('geojson'),
            ];

            $this->ModelWilayah->UpdateData($data);
            session()->setFlashdata('update', 'Data Berhasil Diupdate !!');
            return redirect()->to('wilayah');

        } else {
            return redirect()->to('wilayah/input')->withInput();
        }
    }

    public function delete($id_wilayah)
    {
        $data = [
            'id_wilayah' => $id_wilayah,
        ];

        $this->ModelWilayah->deleteData($data);
        session()->setFlashdata('delete', 'Data Berhasil Didelete !!');
        return redirect()->to('wilayah');
    }
}
