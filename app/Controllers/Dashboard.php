<?php

namespace App\Controllers;

use App\Models\Item as ItemModel;
use App\Models\Category as CategoryModel;

class Dashboard extends BaseController
{
    protected $itemModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        // Get total inventory value
        $items = $this->itemModel->findAll();
        $totalValue = 0;
        $itemsByCategory = [];
        
        foreach ($items as $item) {
            $totalValue += $item['quantity'] * $item['price'];
            
            // Group items by category
            if (!isset($itemsByCategory[$item['category_id']])) {
                $itemsByCategory[$item['category_id']] = [
                    'count' => 0,
                    'value' => 0
                ];
            }
            
            $itemsByCategory[$item['category_id']]['count']++;
            $itemsByCategory[$item['category_id']]['value'] += $item['quantity'] * $item['price'];
        }
        
        // Get low stock items (less than 5 in quantity)
        $lowStockItems = $this->itemModel->where('quantity <', 5)->findAll();
        
        $data = [
            'title' => 'Dashboard',
            'totalItems' => count($items),
            'totalCategories' => count($this->categoryModel->findAll()),
            'totalValue' => $totalValue,
            'categories' => $this->categoryModel->findAll(),
            'itemsByCategory' => $itemsByCategory,
            'lowStockItems' => $lowStockItems
        ];
        
        return view('templates/header', $data)
            . view('dashboard/index', $data)
            . view('templates/footer');
    }
}
