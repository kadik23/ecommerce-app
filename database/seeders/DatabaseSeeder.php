<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (\App\Models\Role::count() === 0) {
            $this->call(LaratrustSeeder::class);
        }

        $this->call(StoreSeeder::class);
    }
}
