<?php

namespace App\Repositories\User;

use App\Models\User;

interface UserRepositoryInterface
{
    /** Get all users who are not 'user' role */
    public function all();

    /** Find a user by ID */
    public function find(int $id);

    /** Delete a user */
    public function delete(User $user);

    /** Toggle the active status of a user */
    public function deactivate(User $user);

    /** Create a new admin user if no roles assigned */
    public function create(array $data);

    /** Update a user by ID */
    public function update(int $id, array $data);

    /** Send an SMS to a user */
    public function sendSms(User $user, string $message);
}
