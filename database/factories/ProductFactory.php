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

        $catalog = [
            ['name' => 'Wireless Mouse', 'category' => 'Electronics', 'image' => 'mouse.jpg'],
            ['name' => 'Gaming Keyboard', 'category' => 'Electronics', 'image' => 'keyboard.jpg'],
            ['name' => 'Bluetooth Speaker', 'category' => 'Electronics', 'image' => 'speaker.jpg'],
            ['name' => 'HD Monitor', 'category' => 'Electronics', 'image' => 'monitor.jpg'],
            ['name' => 'Smart Watch', 'category' => 'Electronics', 'image' => 'smartwatch.jpg'],
            ['name' => 'Running Shoes', 'category' => 'Sports & Outdoors', 'image' => 'shoes.jpg'],
            ['name' => 'Leather Wallet', 'category' => 'Fashion', 'image' => 'wallet.jpg'],
            ['name' => 'Coffee Maker', 'category' => 'Home & Kitchen', 'image' => 'coffee_maker.jpg'],
            ['name' => 'Kitchen Blender', 'category' => 'Home & Kitchen', 'image' => 'blender.jpg'],
            ['name' => 'Yoga Mat', 'category' => 'Sports & Outdoors', 'image' => 'yoga_mat.jpg'],
            ['name' => 'Travel Backpack', 'category' => 'Fashion', 'image' => 'backpack.jpg'],
            ['name' => 'Classic Sunglasses', 'category' => 'Fashion', 'image' => 'sunglasses.jpg'],
            ['name' => 'Desk Lamp', 'category' => 'Home & Kitchen', 'image' => 'desk_lamp.jpg'],
            ['name' => 'Fast Phone Charger', 'category' => 'Electronics', 'image' => 'charger.jpg'],
            ['name' => 'Sports Water Bottle', 'category' => 'Sports & Outdoors', 'image' => 'water_bottle.jpg'],
            ['name' => 'Wireless Earbuds', 'category' => 'Electronics', 'image' => 'earbuds.jpg'],
        ];

        $item = fake()->randomElement($catalog);
        $name = substr($item['name'] . ' ' . fake()->word(), 0, 20);

        return [
            'name' => $name,
            'price' => fake()->numberBetween(15, 600),
            'description' => fake()->paragraph(),
            'profileImage' => $item['image'],
            'category' => $item['category'],
            'rating' => fake()->randomFloat(2, 3, 5),
            'quantity' => fake()->numberBetween(5, 100),
            'sold' => fake()->numberBetween(0, 100),
            'createdBy' => $admin ? $admin->id : null,
            'updatedBy' => $admin ? $admin->id : null,
        ];
    }
}
