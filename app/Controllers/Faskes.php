<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelWilayah;
use App\Models\ModelSetting;
use App\Models\ModelFaskes;
$this->ModelWilayah = new ModelWilayah();


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
            'faskes'=> $this->ModelFaskes->AllData(),
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
        
        ];
    return view('v_template_back_end', $data);
    }
}