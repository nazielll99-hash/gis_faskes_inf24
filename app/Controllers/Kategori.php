<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelWilayah;
use App\Models\ModelSetting;

class Kategori extends BaseController 
{
    public function index()
    {
        $data = [
            'judul' => 'Kategori',
            'menu' => 'kategori',
            'page' => 'v_kategori',
            ];
        return view('v_template_back_end', $data);
    }
}