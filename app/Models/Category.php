<?php

namespace App\Models;

use CodeIgniter\Model;

class Category extends Model
{
    protected $table         = 'categories';
    protected $primaryKey    = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['name', 'description', 'created_at', 'updated_at'];
    protected $returnType    = 'array';
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    
    protected $validationRules = [
        'name'        => 'required|min_length[3]|max_length[100]|is_unique[categories.name,id,{id}]',
        'description' => 'permit_empty|max_length[500]',
    ];
}
