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
        'productOrdered'
    ];
    public function users(){
        return $this->hasMany('App\Models\User','orderBy','id');
    }
}
