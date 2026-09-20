<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUser;

class User extends BaseController 
{ 
    protected $ModelUser;

    public function __construct()
    {
        $this->ModelUser = new ModelUser();
    }    

    public function index()
    {
        $data = [
            'judul' => 'User',
            'menu'  => 'user',
            'page'  => 'user/v_index',
            'user'  => $this->ModelUser->AllData(),
        ];
        return view('v_template_back_end', $data);
    }

    public function edit($id_user = null)
    {
        $data = [
            'judul' => 'Edit User',
            'menu'  => 'user',
            'page'  => 'user/v_edit',
            'user'  => $this->ModelUser->DetailData($id_user), 
        ];
        return view('v_template_back_end', $data);
    }

    // === PASTIKAN FUNGSI INI SUDAH ADA DAN HURUF KECIL SEMUA ===
    public function update($id_user)
    {
        $data = [
            'id_user'   => $id_user,
            'nama_user' => $this->request->getPost('nama_user'),
            'email'     => $this->request->getPost('email'),
            'password'  => $this->request->getPost('password'),
        ];

        // Logika upload foto
        $fileFoto = $this->request->getFile('foto');
        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $userLama = $this->ModelUser->DetailData($id_user);
            
            if (!empty($userLama['foto']) && file_exists('foto/' . $userLama['foto'])) {
                unlink('foto/' . $userLama['foto']);
            }

            $namaFotoBaru = $fileFoto->getRandomName();
            $fileFoto->move('foto', $namaFotoBaru);
            $data['foto'] = $namaFotoBaru;
        }

        // Simpan perubahan ke database
        $this->ModelUser->UpdateData($data);

        session()->setFlashdata('pesan', 'Data User Berhasil Diupdate.');
        return redirect()->to(base_url('user'));
    }
}