<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class SyncProductImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:sync-real-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync all products to matching real images and categories based on product name';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Starting product image and category synchronization...');

        $mappings = [
            'mouse'      => ['image' => 'mouse.jpg', 'category' => 'Electronics'],
            'keyboard'   => ['image' => 'keyboard.jpg', 'category' => 'Electronics'],
            'speaker'    => ['image' => 'speaker.jpg', 'category' => 'Electronics'],
            'monitor'    => ['image' => 'monitor.jpg', 'category' => 'Electronics'],
            'watch'      => ['image' => 'smartwatch.jpg', 'category' => 'Electronics'],
            'shoe'       => ['image' => 'shoes.jpg', 'category' => 'Sports & Outdoors'],
            'running'    => ['image' => 'shoes.jpg', 'category' => 'Sports & Outdoors'],
            'wallet'     => ['image' => 'wallet.jpg', 'category' => 'Fashion'],
            'leather'    => ['image' => 'wallet.jpg', 'category' => 'Fashion'],
            'coffee'     => ['image' => 'coffee_maker.jpg', 'category' => 'Home & Kitchen'],
            'blender'    => ['image' => 'blender.jpg', 'category' => 'Home & Kitchen'],
            'kitchen'    => ['image' => 'blender.jpg', 'category' => 'Home & Kitchen'],
            'yoga'       => ['image' => 'yoga_mat.jpg', 'category' => 'Sports & Outdoors'],
            'mat'        => ['image' => 'yoga_mat.jpg', 'category' => 'Sports & Outdoors'],
            'backpack'   => ['image' => 'backpack.jpg', 'category' => 'Fashion'],
            'sunglass'   => ['image' => 'sunglasses.jpg', 'category' => 'Fashion'],
            'glasses'    => ['image' => 'sunglasses.jpg', 'category' => 'Fashion'],
            'lamp'       => ['image' => 'desk_lamp.jpg', 'category' => 'Home & Kitchen'],
            'charger'    => ['image' => 'charger.jpg', 'category' => 'Electronics'],
            'phone'      => ['image' => 'charger.jpg', 'category' => 'Electronics'],
            'bottle'     => ['image' => 'water_bottle.jpg', 'category' => 'Sports & Outdoors'],
            'water'      => ['image' => 'water_bottle.jpg', 'category' => 'Sports & Outdoors'],
            'earbud'     => ['image' => 'earbuds.jpg', 'category' => 'Electronics'],
            'headphone'  => ['image' => 'earbuds.jpg', 'category' => 'Electronics'],
        ];

        $categoryDefaults = [
            'Electronics'       => ['mouse.jpg', 'keyboard.jpg', 'speaker.jpg', 'monitor.jpg', 'smartwatch.jpg', 'earbuds.jpg', 'charger.jpg'],
            'Fashion'           => ['wallet.jpg', 'backpack.jpg', 'sunglasses.jpg'],
            'Home & Kitchen'    => ['coffee_maker.jpg', 'blender.jpg', 'desk_lamp.jpg'],
            'Sports & Outdoors' => ['shoes.jpg', 'yoga_mat.jpg', 'water_bottle.jpg'],
        ];

        $allRealImages = [
            'mouse.jpg', 'keyboard.jpg', 'speaker.jpg', 'monitor.jpg', 'smartwatch.jpg',
            'shoes.jpg', 'wallet.jpg', 'coffee_maker.jpg', 'blender.jpg', 'yoga_mat.jpg',
            'backpack.jpg', 'sunglasses.jpg', 'desk_lamp.jpg', 'charger.jpg', 'water_bottle.jpg', 'earbuds.jpg'
        ];

        $products = Product::all();
        if ($products->isEmpty()) {
            $this->warn('No products found in the database.');
            return Command::SUCCESS;
        }

        $updatedCount = 0;
        foreach ($products as $index => $product) {
            $nameLower = strtolower($product->name ?? '');
            $matched = false;

            foreach ($mappings as $keyword => $data) {
                if (str_contains($nameLower, $keyword)) {
                    $product->profileImage = $data['image'];
                    $product->category = $data['category'];
                    $matched = true;
                    break;
                }
            }

            if (!$matched) {
                if (isset($categoryDefaults[$product->category])) {
                    $options = $categoryDefaults[$product->category];
                    $product->profileImage = $options[$index % count($options)];
                } else {
                    $product->profileImage = $allRealImages[$index % count($allRealImages)];
                }
            }

            $product->save();
            $updatedCount++;
            $this->line("✔ [ID: {$product->id}] '{$product->name}' -> {$product->profileImage} ({$product->category})");
        }

        $this->info("Successfully synchronized {$updatedCount} products with real images!");
        return Command::SUCCESS;
    }
}
