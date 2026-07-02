<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    /**
     * Get registration stats for a given range (e.g. today, yesterday, 7days, 30days, 90days).
     *
     * @param string $range
     * @return array
     */
    public function getRegistrationStats(string $range): array;

    /**
     * Get the latest registered customers with their total revenue.
     *
     * @param int $limit
     * @return array
     */
    public function getLatestCustomersWithRevenue(int $limit = 3): array;
}
