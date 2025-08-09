<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'profileImage',
        'createdBy',
        'sold'
    ];
    
    public function getPhotoAttribute($val){
        return ($val !== null) ? asset('assets/images/products/'.$val) : "";
    }

    public function users(){
        return $this->hasMany('App\Models\User','updatedBy','id');
    }

    public function users_P()
    {
        return $this->belongsToMany(User::class, 'product_user', 'product_id', 'user_id','id')->withPivot('isRead');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function orders()
    {
        return $this->belongsTo(Order::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
