<?php

namespace App\Controllers;

use App\Models\Item as ItemModel;
use App\Models\Category as CategoryModel;

class Item extends BaseController
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
        $data = [
            'title' => 'Inventory Items',
            'items' => $this->itemModel->join('categories', 'categories.id = items.category_id')
                ->select('items.*, categories.name as category_name')
                ->findAll()
        ];
        
        return view('templates/header', $data)
            . view('item/index', $data)
            . view('templates/footer');
    }

    public function create()
    {
        $data = [
            'title' => 'Add New Item',
            'categories' => $this->categoryModel->findAll()
        ];

        if ($this->request->getMethod() === 'post') {
            // Get form data directly
            $item_data = [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description') ?: '',
                'category_id' => $this->request->getPost('category_id'),
                'quantity' => $this->request->getPost('quantity') ?: 0,
                'price' => $this->request->getPost('price') ?: 0
            ];
            
            // Debug log
            log_message('info', 'DIRECT INSERT: Creating new item: ' . json_encode($item_data));
            
            // Insert the data directly using query builder (bypassing model validation)
            $db = \Config\Database::connect();
            $builder = $db->table('items');
            
            try {
                if ($builder->insert($item_data)) {
                    // Success
                    return redirect()->to('/item')->with('message', 'Item added successfully');
                } else {
                    // Failed to insert
                    $data['error'] = 'Failed to add item. Database error: ' . json_encode($db->error());
                    log_message('error', 'Failed to add item DB error: ' . json_encode($db->error()));
                }
            } catch (\Exception $e) {
                // Exception occurred
                $data['error'] = 'Exception: ' . $e->getMessage();
                log_message('error', 'Exception adding item: ' . $e->getMessage());
            }
        }

        return view('templates/header', $data)
            . view('item/create', $data)
            . view('templates/footer');
    }

    public function edit($id = null)
    {
        if ($id == null) {
            return redirect()->to('/item');
        }

        $item = $this->itemModel->find($id);
        
        if (!$item) {
            return redirect()->to('/item')->with('error', 'Item not found');
        }

        $data = [
            'title' => 'Edit Item',
            'item' => $item,
            'categories' => $this->categoryModel->findAll()
        ];

        if ($this->request->getMethod() === 'post') {
            // Get form data directly
            $item_data = [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description') ?: '',
                'category_id' => $this->request->getPost('category_id'),
                'quantity' => $this->request->getPost('quantity') ?: 0,
                'price' => $this->request->getPost('price') ?: 0
            ];
            
            // Debug log
            log_message('info', 'DIRECT UPDATE: Updating item #' . $id . ': ' . json_encode($item_data));
            
            // Update the data directly using query builder
            $db = \Config\Database::connect();
            $builder = $db->table('items');
            
            try {
                if ($builder->update($item_data, ['id' => $id])) {
                    // Success
                    return redirect()->to('/item')->with('message', 'Item updated successfully');
                } else {
                    // Failed
                    $data['error'] = 'Failed to update item. Database error: ' . json_encode($db->error());
                    log_message('error', 'Failed to update item DB error: ' . json_encode($db->error()));
                }
            } catch (\Exception $e) {
                // Exception occurred
                $data['error'] = 'Exception: ' . $e->getMessage();
                log_message('error', 'Exception updating item: ' . $e->getMessage());
            }
        }

        return view('templates/header', $data)
            . view('item/edit', $data)
            . view('templates/footer');
    }

    public function delete($id = null)
    {
        if ($id == null) {
            return redirect()->to('/item');
        }

        if ($this->itemModel->delete($id)) {
            return redirect()->to('/item')->with('message', 'Item deleted successfully');
        } else {
            return redirect()->to('/item')->with('error', 'Failed to delete item');
        }
    }
    
    public function simple()
    {
        $data = [
            'title' => 'Add Item (Simple Form)',
            'categories' => $this->categoryModel->findAll()
        ];
        
        return view('templates/header', $data)
            . view('item/simple', $data)
            . view('templates/footer');
    }
}
