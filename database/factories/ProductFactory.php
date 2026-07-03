<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $categories = Category::pluck('name')->toArray();
        $admin = User::whereHas('roles', function($q) {
            $q->where('name', 'admin');
        })->first() ?? User::first();

        $category = !empty($categories) ? fake()->randomElement($categories) : 'Electronics';

        $productNames = [
            'Wireless Mouse', 'Gaming Keyboard', 'Bluetooth Speaker', 'HD Monitor',
            'Smart Watch', 'Running Shoes', 'Leather Wallet', 'Coffee Maker',
            'Kitchen Blender', 'Yoga Mat', 'Backpack', 'Sunglasses',
            'Desk Lamp', 'Phone Charger', 'Water Bottle', 'Wireless Earbuds'
        ];

        return [
            'name' => substr(fake()->randomElement($productNames) . ' ' . fake()->word(), 0, 20),
            'price' => fake()->numberBetween(10, 1000),
            'description' => fake()->paragraph(),
            'profileImage' => 'product_' . fake()->numberBetween(1, 10) . '.jpg',
            'category' => $category,
            'rating' => fake()->randomFloat(2, 1, 5),
            'quantity' => fake()->numberBetween(5, 100),
            'sold' => fake()->numberBetween(0, 100),
            'createdBy' => $admin ? $admin->id : null,
            'updatedBy' => $admin ? $admin->id : null,
        ];
    }
}
