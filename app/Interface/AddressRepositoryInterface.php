<?php

namespace App\Interface;

interface AddressRepositoryInterface
{
    /**
     * Get all addresses for a specific user.
     */
    public function allForUser(int $userId);

    /**
     * Store a new address in the database.
     */
    public function store(array $data);

    /**
     * Delete a specific address for a user.
     */
    public function delete(int $id, int $userId): bool;
}
