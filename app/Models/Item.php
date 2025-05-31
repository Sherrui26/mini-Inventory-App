<?php

namespace App\Models;

use CodeIgniter\Model;

class Item extends Model
{
    protected $table         = 'items';
    protected $primaryKey    = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['name', 'description', 'quantity', 'price', 'category_id', 'created_at', 'updated_at'];
    protected $returnType    = 'array';
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    
    protected $validationRules = [
        'name'        => 'required|min_length[3]|max_length[255]',
        'description' => 'permit_empty|max_length[1000]',
        'quantity'    => 'required|integer|greater_than_equal_to[0]',
        'price'       => 'required|numeric|greater_than_equal_to[0]',
        'category_id' => 'required|integer|is_not_unique[categories.id]',
    ];
}
