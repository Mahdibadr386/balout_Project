<?php

namespace App\Repositories\User\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * Create a new user
     *
     * @param array $data
     * @return User
     */
    public function create(array $data);

    /**
     * Find a user by email
     *
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email);

    /**
     * Find a user by ID
     *
     * @param int $id
     * @return User|null
     */
    public function findById(int $id);

    /**
     * Revoke all tokens of a user
     *
     * @param User $user
     * @return void
     */
    public function revokeTokens(User $user);

    /**
     * Update a user's password
     *
     * @param User $user
     * @param string $password
     * @return User
     */
    public function updatePassword(User $user, string $password);

    /**
     * Update a user's profile
     *
     * @param User $user
     * @param array $data
     * @return User
     */
    public function updateProfile(User $user, array $data);
}
