<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Breakfast',
                'description' => 'Morning meals and breakfast items',
                'icon' => '🌅',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Lunch',
                'description' => 'Lunch meals and afternoon dishes',
                'icon' => '🌞',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'Dinner',
                'description' => 'Evening meals and dinner dishes',
                'icon' => '🌙',
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'name' => 'Beverages',
                'description' => 'Drinks and beverages',
                'icon' => '🥤',
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'name' => 'Desserts',
                'description' => 'Sweet treats and desserts',
                'icon' => '🍰',
                'is_active' => true,
                'sort_order' => 5
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
