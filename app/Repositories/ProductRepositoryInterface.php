<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function all(array $filters = []): mixed;
    public function find(int $id): mixed;
    public function create(array $data): mixed;
    public function update(int $id, array $data): mixed;
    public function delete(int $id): bool;
    public function searchByCategoryAndName(?string $category, ?string $search);

}
