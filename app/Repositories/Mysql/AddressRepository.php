<?php

namespace App\Repositories\Mysql;

use App\Interface\AddressRepositoryInterface;
use App\Models\UserAddress;

class AddressRepository implements AddressRepositoryInterface
{

    public function allForUser(int $userId)
    {
        return UserAddress::where('user_id', $userId)
            ->with(['city', 'district'])
            ->get();
    }


    public function store(array $data)
    {
        return UserAddress::create($data);
    }


    public function delete(int $id, int $userId): bool
    {
        $address = UserAddress::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();
        $address->delete();
        return true;
    }
}
