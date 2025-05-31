<?php

namespace App\Controllers;

use App\Models\Category as CategoryModel;

class Category extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Categories',
            'categories' => $this->categoryModel->findAll()
        ];
        
        return view('templates/header', $data)
            . view('category/index', $data)
            . view('templates/footer');
    }

    public function create()
    {
        $data = [
            'title' => 'Add New Category'
        ];

        if ($this->request->getMethod() === 'post') {
            // Get form data directly
            $category_data = [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description') ?: ''
            ];
            
            // Debug log
            log_message('info', 'DIRECT INSERT: Creating new category: ' . json_encode($category_data));
            
            // Insert the data directly using query builder
            $db = \Config\Database::connect();
            $builder = $db->table('categories');
            
            try {
                if ($builder->insert($category_data)) {
                    // Success
                    return redirect()->to('/category')->with('message', 'Category added successfully');
                } else {
                    // Failed
                    $data['error'] = 'Failed to add category. Database error: ' . json_encode($db->error());
                    log_message('error', 'Failed to add category DB error: ' . json_encode($db->error()));
                }
            } catch (\Exception $e) {
                // Exception occurred
                $data['error'] = 'Exception: ' . $e->getMessage();
                log_message('error', 'Exception adding category: ' . $e->getMessage());
            }
        }

        return view('templates/header', $data)
            . view('category/create', $data)
            . view('templates/footer');
    }

    public function edit($id = null)
    {
        if ($id == null) {
            return redirect()->to('/category');
        }

        $category = $this->categoryModel->find($id);
        
        if (!$category) {
            return redirect()->to('/category')->with('error', 'Category not found');
        }

        $data = [
            'title' => 'Edit Category',
            'category' => $category
        ];

        if ($this->request->getMethod() === 'post') {
            // Get form data directly
            $category_data = [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description') ?: ''
            ];
            
            // Debug log
            log_message('info', 'DIRECT UPDATE: Updating category #' . $id . ': ' . json_encode($category_data));
            
            // Update the data directly using query builder
            $db = \Config\Database::connect();
            $builder = $db->table('categories');
            
            try {
                if ($builder->update($category_data, ['id' => $id])) {
                    // Success
                    return redirect()->to('/category')->with('message', 'Category updated successfully');
                } else {
                    // Failed
                    $data['error'] = 'Failed to update category. Database error: ' . json_encode($db->error());
                    log_message('error', 'Failed to update category DB error: ' . json_encode($db->error()));
                }
            } catch (\Exception $e) {
                // Exception occurred
                $data['error'] = 'Exception: ' . $e->getMessage();
                log_message('error', 'Exception updating category: ' . $e->getMessage());
            }
        }

        return view('templates/header', $data)
            . view('category/edit', $data)
            . view('templates/footer');
    }

    public function delete($id = null)
    {
        if ($id == null) {
            return redirect()->to('/category');
        }

        if ($this->categoryModel->delete($id)) {
            return redirect()->to('/category')->with('message', 'Category deleted successfully');
        } else {
            return redirect()->to('/category')->with('error', 'Failed to delete category');
        }
    }
}
