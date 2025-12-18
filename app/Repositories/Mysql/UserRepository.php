<?php

namespace App\Repositories\Mysql;

use App\Interface\UserRepositoryInterface;
use App\Models\User;
use App\Services\Sms\Facades\Sms;

class UserRepository implements UserRepositoryInterface
{
    public function all(array $filters = [])
    {
        $perPage = $filters['per_page'] ?? 20;

        if (!empty($filters['search'])) {

            $ids = User::search($filters['search'])->keys();

            if ($ids->isEmpty()) {
                return User::whereRaw('1 = 0')->paginate($perPage);
            }

            return User::whereIn('id', $ids)
                ->whereDoesntHave('roles', function ($query) {
                    $query->where('name', 'user');
                })
                ->paginate($perPage);
        }

        return User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'user');
        })->paginate($perPage);
    }


    public function find(int $id): ?User
    {
        $user = User::where('id', $id)
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'user');
            })
            ->first();

        return $user;
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

    public function create(array $data)
    {
        $user = User::create($data);
        if (! $user->hasAnyRole()) {
            $user->assignRole('admin');
        }
        return $user ;
    }


    public function update(User $user, array $data)
    {
        $user->update($data);
        return $user->fresh();
    }

    public function sendSms(User $user , string $message)
    {
        $number = $user->tel;
        Sms::send($number, $message);

        return true;
    }


}
