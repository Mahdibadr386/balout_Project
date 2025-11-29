<?php

namespace App\Repositories\Admin\User;

use App\Models\User;

class UserRepository
{
    public function all()
    {
        return User::latest()->get();
    }

    public function find(int $id): ?User
    {
        return User::with('addresses')->find($id);
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }

}
