<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model
{
    protected $table         = 'tbl_feedback';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['nama', 'email', 'rating', 'pesan'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
}