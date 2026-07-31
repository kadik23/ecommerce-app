<?php

namespace App\Repositories;

interface SliderRepositoryInterface
{
    public function all(): mixed;
    public function create(array $data): mixed;
    public function delete(int $id): bool;
}
