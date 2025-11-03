<?php

namespace App\Repositories\User\Eloquent;

use App\Models\User;
use App\Repositories\User\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    public function revokeTokens(User $user): void
    {
        $user->tokens()->delete();
    }


    public function updatePassword($user, $password)
    {
        $user->password = bcrypt($password);
        $user->save();
        return $user;
    }

    public function updateProfile($user, array $data)
    {
        $user->fill($data);
        $user->save();
        return $user;
    }

}
