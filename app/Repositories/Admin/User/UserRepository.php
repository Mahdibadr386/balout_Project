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

    public function deactivate(User $user): User
    {
        if ($user['is_active']){
            $user->update(['is_active' => false]);
        }else{
            $user->update(['is_active' => true]);
        }


        return $user;
    }
}
