<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    public function getPhotoAttribute($val){
        return ($val !== null) ? asset('assets/images/products/'.$val) : "";
    }
}
