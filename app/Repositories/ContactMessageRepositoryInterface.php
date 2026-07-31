<?php

namespace App\Repositories;

interface ContactMessageRepositoryInterface
{
    public function create(array $data): mixed;
    public function getPaginatedMessages(?string $status = null, int $perPage = 15);
    public function getCounts(): array;
    public function toggleStatus(int $id): mixed;
}
