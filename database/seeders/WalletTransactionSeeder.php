<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\WalletTransaction;
use Illuminate\Database\Seeder;

class WalletTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::whereIn('state', ['complete', 'completed'])->get();
        $count = 0;

        foreach ($orders as $order) {
            $product = Product::find($order->productOrdered);
            $price = $product ? $product->price : 0;
            $amount = $order->quantity * $price;

            $idempotencyKey = 'order_payment_' . $order->id;

            $transaction = WalletTransaction::firstOrCreate(
                ['idempotency_key' => $idempotencyKey],
                [
                    'user_id' => $order->orderBy,
                    'order_id' => $order->id,
                    'amount' => $amount,
                    'type' => 'order_payment',
                ]
            );

            if ($transaction->wasRecentlyCreated) {
                $count++;
            }
        }

        $this->command->info("Seeded {$count} new wallet transactions from complete orders.");
    }
}
