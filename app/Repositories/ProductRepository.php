<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function all(array $filters = []): mixed
    {
        $query = Product::query();

        if (!empty($filters['category_id'])) {
            $query->where('name', $filters['name']);
        }

        if (!empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        return $query->get();
    }

    public function find(int $id): mixed
    {
        return Product::findOrFail($id);
    }

    public function create(array $data): mixed
    {
        return Product::create($data);
    }

    public function update(int $id, array $data): mixed
    {
        $product = $this->find($id);
        $product->update($data);
        return $product;
    }

    public function delete(int $id): bool
    {
        $product = $this->find($id);
        return $product->delete();
    }

    public function searchByCategoryAndName(?string $category, ?string $search)
    {
        $query = Product::query();
    
        if (!empty($search)) {
            $query->where('name', 'like', "%{$search}%");
        }
    
        if (!empty($category) && $category !== 'All categories') {
            $query->where('category', $category);
        }
    
        return $query->get();
    }

     public function where($column, $operator, $value)
    {
        return Product::where($column, $operator, $value)->get();
    }

    public function orderBy($column, $direction = 'asc')
    {
        return Product::orderBy($column, $direction)->get();
    }
        
}
