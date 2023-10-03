<?php
namespace App\Traits;
use App\Models\Product;

Trait orderBy{
    public function getTavlesByColumn($col,$type,$model)
    {
        $order = $model::orderBy($col, $type)->get();    
        return $order;
    }
}