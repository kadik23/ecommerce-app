<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity',
        'dateOrder',
        'paymentMethod',
        'deliveryMethod',
        'orderBy',
        'productOrdered',
        'state'
    ];
    public function users(){
        return $this->hasMany('App\Models\User','orderBy','id');
    }

    public function product()
    {
        return $this->hasOne('App\Models\Product','id','productOrdered');
    }

    protected static function booted()
    {
        static::saved(function ($order) {
            if ($order->state === 'complete') {
                $product = Product::find($order->productOrdered);
                $price = $product ? $product->price : 0;
                $amount = $order->quantity * $price;
                
                $idempotencyKey = 'order_payment_' . $order->id;

                WalletTransaction::firstOrCreate(
                    ['idempotency_key' => $idempotencyKey],
                    [
                        'user_id' => $order->orderBy,
                        'order_id' => $order->id,
                        'amount' => $amount,
                        'type' => 'order_payment',
                    ]
                );
            }
        });
    }
}