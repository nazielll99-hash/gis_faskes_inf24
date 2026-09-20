<?php

namespace App\Controllers;

use App\Models\ModelSetting;

class Admin extends BaseController
{
    protected $ModelSetting;

    public function __construct()
    {
        $this->ModelSetting = new ModelSetting();
    }

public function index()
{
    // 1. Ambil input filter dari URL (?kategori=...)
    $kategori_filter = $this->request->getVar('kategori');

    $db = \Config\Database::connect();
    
    // 2. Total Stat Cards (Selalu Tetap/Statis)
    $totalFaskes     = $db->table('tbl_faskes')->countAllResults();
    $totalRumahSakit = $db->table('tbl_faskes')->where('jenis', 'rumah sakit')->countAllResults();
    $totalPuskesmas  = $db->table('tbl_faskes')->where('jenis', 'puskesmas')->countAllResults();
    $totalKlinik     = $db->table('tbl_faskes')->where('jenis', 'klinik')->countAllResults();

    // 3. Query Terfilter (Dipakai Bersama oleh Chart.js DAN Tabel Data)
    $builderData = $db->table('tbl_faskes');
    if (!empty($kategori_filter)) {
        if ($kategori_filter == 'rumahsakit') {
            $builderData->where('jenis', 'rumah sakit');
        } else {
            $builderData->where('jenis', $kategori_filter);
        }
    }
    
    // Ambil semua kolom untuk isi tabel faskes di bawah chart
    $dataFaskesTerfilter = $builderData->get()->getResultArray();

    // 4. Query khusus hitung total kelompok grafik Chart.js (Ikut terfilter)
    $builderChart = $db->table('tbl_faskes');
    if (!empty($kategori_filter)) {
        if ($kategori_filter == 'rumahsakit') {
            $builderChart->where('jenis', 'rumah sakit');
        } else {
            $builderChart->where('jenis', $kategori_filter);
        }
    }
    $queryChart = $builderChart->select('jenis as kategori, COUNT(id_faskes) as total')
                               ->groupBy('jenis')
                               ->get()
                               ->getResultArray();

    // 5. Kirim data ke view v_dashboard
    $data = [
        'judul'           => 'Dashboard',
        'menu'            => 'dashboard',
        'page'            => 'v_dashboard',
        'total_faskes'    => $totalFaskes,
        'total_rs'        => $totalRumahSakit,
        'total_puskesmas' => $totalPuskesmas,
        'total_klinik'    => $totalKlinik,
        'kategori_aktif'  => $kategori_filter,
        'data_chart'      => $queryChart,
        'faskes_list'     => $dataFaskesTerfilter // DATA BARU UNTUK TABEL
    ];

    return view('v_template_back_end', $data);
}

    public function Setting()
    {
        return view('v_template_back_end', [
            'judul' => 'Setting',
            'menu'  => 'setting',
            'page'  => 'v_setting',
            'web'   => $this->ModelSetting->DataWeb(),
        ]);
    }

    public function updateSetting()
    {
        $data = [
            'id'                => 1,
            'nama_web'          => $this->request->getPost('nama_web'),
            'coordinat_wilayah' => $this->request->getPost('coordinat_wilayah'),
            'zoom_view'         => $this->request->getPost('zoom_view'),
        ];
        $this->ModelSetting->UpdateData($data);
        session()->setFlashdata('pesan', 'Settingan Web Telah Diupdate !!!');
        return redirect()->to('admin/setting');
    }
}