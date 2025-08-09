<?php

namespace App\Repositories;

interface CategoryRepositoryInterface
{
    public function All();
    public function findById($id);
}
