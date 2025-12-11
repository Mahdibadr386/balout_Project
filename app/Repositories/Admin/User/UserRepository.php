<?php

namespace App\Repositories\Admin\User;

use App\Models\User;
use App\Services\Sms\Facades\Sms;

class UserRepository
{
    public function all()
    {
        return User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'user');
        })->get();
    }

    public function find(int $id): ?User
    {
        return User::find($id);
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


    public function update(int $id, array $data)
    {
        $user = $this->find($id);
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
