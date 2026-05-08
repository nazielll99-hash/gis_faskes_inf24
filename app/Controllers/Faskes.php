<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelWilayah;
use App\Models\ModelSetting;

class Faskes extends BaseController 
{
    public function index()
    {
        $data = [
            'judul' => 'Faskes',
            'menu' => 'faskes',
            'page' => 'faskes/v_index',
            ];
        return view('v_template_back_end', $data);
    }
}