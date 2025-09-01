<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories
        $breakfast = Category::where('name', 'Breakfast')->first();
        $lunch = Category::where('name', 'Lunch')->first();
        $dinner = Category::where('name', 'Dinner')->first();
        $beverages = Category::where('name', 'Beverages')->first();
        $desserts = Category::where('name', 'Desserts')->first();

        $menuItems = [
            // Breakfast items
            [
                'name' => 'Margherita Pizza',
                'description' => 'Classic pizza with tomato, mozzarella, and basil',
                'price' => 4.50,
                'icon' => '🍕',
                'category_id' => $breakfast->id,
                'is_available' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Caesar Salad',
                'description' => 'Fresh romaine lettuce with caesar dressing and croutons',
                'price' => 3.20,
                'icon' => '🥗',
                'category_id' => $breakfast->id,
                'is_available' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'Classic Burger',
                'description' => 'Beef patty with lettuce, tomato, and our special sauce',
                'price' => 6.00,
                'icon' => '🍔',
                'category_id' => $breakfast->id,
                'is_available' => true,
                'sort_order' => 3
            ],
            [
                'name' => 'French Fries',
                'description' => 'Crispy golden french fries',
                'price' => 2.50,
                'icon' => '🍟',
                'category_id' => $breakfast->id,
                'is_available' => true,
                'sort_order' => 4
            ],

            // Lunch items
            [
                'name' => 'Grilled Chicken',
                'description' => 'Seasoned grilled chicken breast with herbs',
                'price' => 8.50,
                'icon' => '🍗',
                'category_id' => $lunch->id,
                'is_available' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Fish Tacos',
                'description' => 'Fresh fish tacos with cabbage slaw and lime',
                'price' => 7.25,
                'icon' => '🌮',
                'category_id' => $lunch->id,
                'is_available' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'Pasta Carbonara',
                'description' => 'Creamy pasta with bacon and parmesan cheese',
                'price' => 9.75,
                'icon' => '🍝',
                'category_id' => $lunch->id,
                'is_available' => true,
                'sort_order' => 3
            ],

            // Dinner items
            [
                'name' => 'Ribeye Steak',
                'description' => 'Premium ribeye steak cooked to perfection',
                'price' => 15.99,
                'icon' => '🥩',
                'category_id' => $dinner->id,
                'is_available' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Salmon Fillet',
                'description' => 'Grilled salmon with lemon and herbs',
                'price' => 12.50,
                'icon' => '🐟',
                'category_id' => $dinner->id,
                'is_available' => true,
                'sort_order' => 2
            ],

            // Beverages
            [
                'name' => 'Coffee',
                'description' => 'Freshly brewed coffee',
                'price' => 2.00,
                'icon' => '☕',
                'category_id' => $beverages->id,
                'is_available' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Orange Juice',
                'description' => 'Fresh squeezed orange juice',
                'price' => 3.50,
                'icon' => '🍊',
                'category_id' => $beverages->id,
                'is_available' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'Coca Cola',
                'description' => 'Classic Coca Cola',
                'price' => 1.75,
                'icon' => '🥤',
                'category_id' => $beverages->id,
                'is_available' => true,
                'sort_order' => 3
            ],

            // Desserts
            [
                'name' => 'Chocolate Cake',
                'description' => 'Rich chocolate cake with chocolate frosting',
                'price' => 4.25,
                'icon' => '🍰',
                'category_id' => $desserts->id,
                'is_available' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Ice Cream',
                'description' => 'Vanilla ice cream with toppings',
                'price' => 3.00,
                'icon' => '🍨',
                'category_id' => $desserts->id,
                'is_available' => true,
                'sort_order' => 2
            ]
        ];

        foreach ($menuItems as $item) {
            MenuItem::create($item);
        }
    }
}
