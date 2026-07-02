<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Rating;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding categories (non-destructively)...');

        $categoriesData = [
            ['name' => 'Electronics', 'icon' => 'electronics.svg'],
            ['name' => 'Fashion', 'icon' => 'fashion.svg'],
            ['name' => 'Home & Kitchen', 'icon' => 'kitchen.svg'],
            ['name' => 'Sports & Outdoors', 'icon' => 'sports.svg'],
            ['name' => 'Beauty', 'icon' => 'beauty.svg'],
            ['name' => 'Books', 'icon' => 'books.svg'],
            ['name' => 'Toys & Games', 'icon' => 'toys.svg'],
            ['name' => 'Automotive', 'icon' => 'automotive.svg'],
        ];

        foreach ($categoriesData as $catData) {
            Category::firstOrCreate(
                ['name' => $catData['name']],
                ['icon' => $catData['icon']]
            );
        }

        $admin = User::whereHas('roles', function ($q) {
            $q->where('name', 'admin');
        })->first();

        if (!$admin) {
            $this->command->info('Creating default admin user...');
            $admin = User::create([
                'username' => 'admin',
                'email' => 'admin@app.com',
                'password' => bcrypt('password'),
                'fullName' => 'Admin User',
                'phone' => 123456789,
                'city' => 'Algiers',
                'address' => '123 Admin St',
                'country' => 'Algeria'
            ]);
            $adminRole = \App\Models\Role::where('name', 'admin')->first();
            if ($adminRole) {
                $admin->addRole($adminRole);
            }
        }

        $this->command->info('Seeding client users...');
        $newUsersCount = 20;
        User::factory()->count($newUsersCount)->create();

        $this->command->info('Seeding products...');
        $newProductsCount = 40;
        Product::factory()->count($newProductsCount)->create();

        $this->command->info('Seeding orders...');
        $newOrdersCount = 100;
        Order::factory()->count($newOrdersCount)->create();

        $this->command->info('Seeding product ratings...');
        $users = User::all();
        $products = Product::all();

        if ($users->isNotEmpty() && $products->isNotEmpty()) {
            foreach ($products as $product) {
                // 60% chance a product receives ratings from 1-3 users
                if (fake()->boolean(60)) {
                    $ratingCount = fake()->numberBetween(1, 3);
                    $ratedUsers = $users->random(min($ratingCount, $users->count()));
                    foreach ($ratedUsers as $user) {
                        Rating::updateOrCreate(
                            ['user_id' => $user->id, 'product_id' => $product->id],
                            ['rating' => fake()->numberBetween(1, 5)]
                        );
                    }
                }
            }
        }

        $this->command->info('Database seeding completed successfully!');
    }
}