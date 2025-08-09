<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function All()
    {
        return Category::all();
    }

    public function findById($id)
    {
        return Category::findOrFail($id);
    }
}
