<?php

namespace App\Controllers;

class Test extends BaseController
{
    public function index()
    {
        return view('test/form');
    }
    
    public function process()
    {
        // Debug: log all request data
        log_message('debug', 'Test form submitted: ' . json_encode($this->request->getPost()));
        
        // Check if we're receiving item data (has category_id, price, quantity)
        if ($this->request->getPost('category_id') && $this->request->getPost('price') !== null) {
            // This appears to be item data - let's save it
            $db = \Config\Database::connect();
            $builder = $db->table('items');
            
            $item_data = [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description') ?: '',
                'category_id' => $this->request->getPost('category_id'),
                'quantity' => $this->request->getPost('quantity') ?: 0,
                'price' => $this->request->getPost('price') ?: 0
            ];
            
            // Check if this is an edit operation
            if ($this->request->getPost('edit_operation') && $this->request->getPost('item_id')) {
                $item_id = $this->request->getPost('item_id');
                log_message('debug', 'Updating item #' . $item_id);
                
                if ($builder->update($item_data, ['id' => $item_id])) {
                    return redirect()->to('/item')->with('message', 'Item updated successfully via test controller');
                } else {
                    log_message('error', 'Failed to update item: ' . json_encode($db->error()));
                    return redirect()->to('/item')->with('error', 'Failed to update item');
                }
            } else {
                // This is a new item
                if ($builder->insert($item_data)) {
                    // Success - redirect to items list
                    return redirect()->to('/item')->with('message', 'Item added successfully via test controller');
                } else {
                    log_message('error', 'Failed to insert item: ' . json_encode($db->error()));
                    return redirect()->to('/item')->with('error', 'Failed to add item');
                }
            }
        }
        
        // Check if we're receiving category data (has name but no category_id or price)
        if ($this->request->getPost('name') && !$this->request->getPost('category_id') && $this->request->getPost('price') === null) {
            // This appears to be category data - let's save it
            $db = \Config\Database::connect();
            $builder = $db->table('categories');
            
            $category_data = [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description') ?: ''
            ];
            
            // Check if this is an edit operation
            if ($this->request->getPost('edit_operation') && $this->request->getPost('category_id')) {
                $category_id = $this->request->getPost('category_id');
                log_message('debug', 'Updating category #' . $category_id);
                
                if ($builder->update($category_data, ['id' => $category_id])) {
                    return redirect()->to('/category')->with('message', 'Category updated successfully via test controller');
                } else {
                    log_message('error', 'Failed to update category: ' . json_encode($db->error()));
                    return redirect()->to('/category')->with('error', 'Failed to update category');
                }
            } else {
                // This is a new category
                if ($builder->insert($category_data)) {
                    // Success - redirect to categories list
                    return redirect()->to('/category')->with('message', 'Category added successfully via test controller');
                } else {
                    log_message('error', 'Failed to insert category: ' . json_encode($db->error()));
                    return redirect()->to('/category')->with('error', 'Failed to add category');
                }
            }
        }
        
        // Just echo the data back to confirm it was received
        echo '<pre>';
        print_r($this->request->getPost());
        echo '</pre>';
        echo '<p><a href="' . site_url('test') . '">Back to form</a></p>';
    }
}
