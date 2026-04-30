<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelWilayah;

class Wilayah extends BaseController
{
    public function __construct()
    {
        $this->ModelWilayah = new ModelWilayah();
    }

    public function index()
    {
          $data = [
            'judul' => 'Wilayah',
            'page' => 'Wilayah/v_index',
            'wilayah' => $this->ModelWilayah->AllData(),
        ];
        return view('v_template_back_end', $data);
    }
}