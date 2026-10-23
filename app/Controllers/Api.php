<?php

namespace App\Controllers;

use App\Models\ModelFaskes;

class Api extends BaseController
{
    public function index()
    {
        return $this->response->setJSON([
            'status' => 'success',
            'endpoints' => [
                'GET /api/faskes',
                'GET /api/faskes/map',
                'GET /api/faskes/{id}',
            ],
        ]);
    }

    public function faskes()
    {
        $builder = db_connect()->table('tbl_faskes');

        foreach (['jenis', 'status', 'id_provinsi', 'id_kabupaten', 'id_kecamatan'] as $field) {
            $value = $this->request->getGet($field);
            if ($value !== null && $value !== '') {
                $builder->where($field, $value);
            }
        }

        $search = $this->request->getGet('q');
        if ($search !== null && $search !== '') {
            $builder->groupStart()
                ->like('nama_faskes', $search)
                ->orLike('alamat', $search)
                ->groupEnd();
        }

        $data = $builder->get()->getResultArray();

        return $this->response->setJSON([
            'status' => 'success',
            'total' => count($data),
            'data' => $data,
        ]);
    }

    public function faskesMap()
    {
        $faskes = (new ModelFaskes())->AllDataMap();
        $features = [];

        foreach ($faskes as $item) {
            $coordinates = array_map('trim', explode(',', (string) ($item['koordinat'] ?? '')));
            if (count($coordinates) !== 2 || ! is_numeric($coordinates[0]) || ! is_numeric($coordinates[1])) {
                continue;
            }

            $features[] = [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [(float) $coordinates[1], (float) $coordinates[0]],
                ],
                'properties' => $item,
            ];
        }

        return $this->response->setJSON([
            'type' => 'FeatureCollection',
            'features' => $features,
        ]);
    }

    public function faskesDetail(int $id)
    {
        $data = (new ModelFaskes())->DetailData($id);
        if ($data === null) {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'Data fasilitas kesehatan tidak ditemukan.',
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}
