<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialData extends Seeder
{
    public function run()
    {
        // Add categories
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Electronic devices and components'
            ],
            [
                'name' => 'Office Supplies',
                'description' => 'Items used in office environments'
            ],
            [
                'name' => 'Furniture',
                'description' => 'Chairs, tables, and other furniture items'
            ]
        ];

        foreach ($categories as $category) {
            $this->db->table('categories')->insert($category);
        }

        // Add some sample items
        $items = [
            [
                'name' => 'Laptop',
                'description' => 'High-performance business laptop',
                'quantity' => 10,
                'price' => 999.99,
                'category_id' => 1
            ],
            [
                'name' => 'Office Chair',
                'description' => 'Ergonomic office chair',
                'quantity' => 5,
                'price' => 149.99,
                'category_id' => 3
            ],
            [
                'name' => 'Printer',
                'description' => 'All-in-one laser printer',
                'quantity' => 3,
                'price' => 299.99,
                'category_id' => 1
            ],
            [
                'name' => 'Notebook',
                'description' => 'Pack of 5 spiral notebooks',
                'quantity' => 20,
                'price' => 12.99,
                'category_id' => 2
            ]
        ];

        foreach ($items as $item) {
            $this->db->table('items')->insert($item);
        }
    }
}