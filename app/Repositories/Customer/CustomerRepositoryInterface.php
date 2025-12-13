<?php

namespace App\Repositories\Customer;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

interface CustomerRepositoryInterface
{
    /** Get all users with the 'user' role, paginated */
    public function all();

    /** Find a user by ID with their addresses */
    public function find(int $id): ?User;

    /** Delete a user */
    public function delete(User $user): bool;

    /** Toggle the active status of a user */
    public function deactivate(User $user): User;

    /** Update a user's profile and addresses */
    public function update(Authenticatable|User $user, array $data, array $addresses = []);

    /** Create a new user with addresses */
    public function create(array $data);

    /** Send an SMS to the user */
    public function sendSms(User $user, string $message);
}
