<?php

namespace App\Controllers;

use App\Models\FeedbackModel;

class Feedback extends BaseController
{
    public function simpan()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }

        $rules = [
            'nama'   => 'required|min_length[3]|max_length[100]',
            'email'  => 'permit_empty|valid_email|max_length[120]',
            'rating' => 'permit_empty|in_list[1,2,3,4,5]',
            'pesan'  => 'required|min_length[5]|max_length[1000]',
        ];

        if (! $this->validate($rules)) {
            return $this->response->setStatusCode(422)->setJSON([
                'status' => 'error',
                'errors' => $this->validator->getErrors(),
                'token'  => csrf_hash(),
            ]);
        }

        (new FeedbackModel())->insert([
            'nama'   => $this->request->getPost('nama'),
            'email'  => $this->request->getPost('email') ?: null,
            'rating' => $this->request->getPost('rating') ?: null,
            'pesan'  => $this->request->getPost('pesan'),
        ]);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Terima kasih! Feedback kamu sudah terkirim.',
            'token'   => csrf_hash(),
        ]);
    }
}