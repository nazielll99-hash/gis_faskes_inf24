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

    public function insertdata()
    {
        if ($this->validate([
            'nama_faskes' => [
                'label' => 'Nama Faskes',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'akreditasi' => [
                'label' => 'Akreditasi',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'status' => [
                'label' => 'Status',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            // Tambahkan validasi jenis teks
            'jenis' => [
                'label' => 'Jenis Faskes',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'coordinat' => [
                'label' => 'Koordinat',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'id_provinsi' => [
                'label' => 'Provinsi',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'id_kabupaten' => [
                'label' => 'Kabupaten',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'id_kecamatan' => [
                'label' => 'Kecamatan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'administrasi' => [
                'label' => 'Wilayah Administrasi',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
        ])) {
            $fileFoto = $this->request->getFile('foto');
            $namaFoto = '';

            if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
                $namaFoto = $fileFoto->getRandomName();
                $fileFoto->move('foto/', $namaFoto);
            }

            $data = [
                'nama_faskes'  => $this->request->getPost('nama_faskes'),
                'akreditasi'   => $this->request->getPost('akreditasi'),
                'jenis'        => $this->request->getPost('jenis'), // Tangkap inputan jenis faskes
                'status'       => $this->request->getPost('status'),
                'koordinat'    => $this->request->getPost('coordinat'),
                'id_provinsi'  => $this->request->getPost('id_provinsi'),
                'id_kabupaten' => $this->request->getPost('id_kabupaten'),
                'id_kecamatan' => $this->request->getPost('id_kecamatan'),
                'alamat'       => $this->request->getPost('alamat'),
                'foto'         => $namaFoto,
            ];
            
            $this->ModelFaskes->InsertData($data);
            session()->setFlashdata('pesan', 'Data Berhasil Disimpan');
            return redirect()->to(base_url('faskes'));
        } else {
            return redirect()->to(base_url('faskes/input'))->withInput()->with('validation', \Config\Services::validation());
        }
    }

    public function edit($id_faskes)
    {
        $data = [
            'judul' => 'Edit Data Faskes',
            'menu'  => 'faskes',
            'page'  => 'faskes/v_edit',
            'web' => $this->ModelSetting->DataWeb(),
            'provinsi' => $this->ModelFaskes->allProvinsi(),
            'faskes' => $this->ModelFaskes->DetailData($id_faskes),
            'validation' => \Config\Services::validation(),
        ];
        return view('v_template_back_end', $data);
    }

    public function updatedata($id_faskes)
    {
        if ($this->validate([
            'nama_faskes' => [
                'label' => 'Nama Faskes',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'akreditasi' => [
                'label' => 'Akreditasi',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'status' => [
                'label' => 'Status',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'jenis' => [
                'label' => 'Jenis Faskes',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'coordinat' => [
                'label' => 'Koordinat',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'id_provinsi' => [
                'label' => 'Provinsi',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'id_kabupaten' => [
                'label' => 'Kabupaten',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'id_kecamatan' => [
                'label' => 'Kecamatan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
        ])) {
            $fileFoto = $this->request->getFile('foto');
            $faskesLama = $this->ModelFaskes->DetailData($id_faskes);
            $namaFoto = $faskesLama['foto'];

            if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
                if ($faskesLama['foto'] != '' && file_exists('foto/' . $faskesLama['foto'])) {
                    unlink('foto/' . $faskesLama['foto']);
                }
                $namaFoto = $fileFoto->getRandomName();
                $fileFoto->move('foto/', $namaFoto);
            }

            $data = [
                'id_faskes'    => $id_faskes,
                'nama_faskes'  => $this->request->getPost('nama_faskes'),
                'akreditasi'   => $this->request->getPost('akreditasi'),
                'jenis'        => $this->request->getPost('jenis'),
                'status'       => $this->request->getPost('status'),
                'koordinat'    => $this->request->getPost('coordinat'),
                'id_provinsi'  => $this->request->getPost('id_provinsi'),
                'id_kabupaten' => $this->request->getPost('id_kabupaten'),
                'id_kecamatan' => $this->request->getPost('id_kecamatan'),
                'alamat'       => $this->request->getPost('alamat'),
                'foto'         => $namaFoto,
            ];
            
            $this->ModelFaskes->UpdateData($data);
            session()->setFlashdata('pesan', 'Data Berhasil Diupdate');
            return redirect()->to(base_url('faskes'));
        } else {
            return redirect()->to(base_url('faskes/edit/' . $id_faskes))->withInput()->with('validation', \Config\Services::validation());
        }
    }

    public function delete($id_faskes)
    {
        $faskes = $this->ModelFaskes->DetailData($id_faskes);
        
        if ($faskes['foto'] != '' && file_exists('foto/' . $faskes['foto'])) {
            unlink('foto/' . $faskes['foto']);
        }

        $data = [
            'id_faskes' => $id_faskes
        ];
        
        $this->ModelFaskes->DeleteData($data);
        session()->setFlashdata('delete', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('faskes'));
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
