<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $users = User::pluck('id')->toArray();
        $products = Product::pluck('id')->toArray();

        return [
            'state' => fake()->randomElement(['complete', 'cancel', 'confirm', 'pending']),
            'dateOrder' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'quantity' => fake()->numberBetween(1, 5),
            'paymentMethod' => fake()->randomElement(['Credit Card', 'PayPal', 'Cash on Delivery', 'Bank Transfer']),
            'deliveryMethod' => fake()->randomElement(['Standard Shipping', 'Express Delivery', 'Store Pickup']),
            'orderBy' => !empty($users) ? fake()->randomElement($users) : User::factory(),
            'productOrdered' => !empty($products) ? fake()->randomElement($products) : Product::factory(),
        ];
    }
}
