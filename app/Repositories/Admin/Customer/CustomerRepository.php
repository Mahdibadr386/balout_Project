<?php

namespace App\Repositories\Admin\Customer;

use App\Models\User;
use App\Models\UserAddress;
use App\Services\Sms\Facades\Sms;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CustomerRepository
{
    public function all()
    {
        return User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->get();
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

    public function update(Authenticatable|User $user, array $data, array $addresses = [])
    {
        return DB::transaction(function () use ($user, $data, $addresses) {


            if (isset($data['password']) && $data['password']) {
                $data['password'] = Hash::make($data['password']);
            }
            $user->update($data);


            $existingAddressIds = $user->addresses()->pluck('id')->toArray();
            $submittedAddressIds = [];

            foreach ($addresses as $addressData) {
                // If ID exists, update
                if (!empty($addressData['id']) && in_array($addressData['id'], $existingAddressIds)) {
                    $address = UserAddress::find($addressData['id']);
                    $address->update([
                        'city_id' => $addressData['city_id'] ?? null,
                        'address' => $addressData['address'] ?? $address->address,
                        'tel' => $addressData['tel'] ?? $address->tel,
                    ]);
                    $submittedAddressIds[] = $address->id;
                } else {
                    // New address
                    $newAddress = $user->addresses()->create([
                        'city_id' => $addressData['city_id'] ?? null,
                        'address' => $addressData['address'],
                        'tel' => $addressData['tel'] ?? null,
                    ]);
                    $submittedAddressIds[] = $newAddress->id;
                }
            }


            $user->addresses()->whereNotIn('id', $submittedAddressIds)->delete();


            $user->load('addresses.city');

            Log::info("User profile updated: {$user->id}");

            return $user;
        });
    }


    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            if (isset($data['password']) && $data['password']) {
                $data['password'] = Hash::make($data['password']);
            }

            $user = User::create($data);

            $submittedAddressIds = [];

            foreach ($data['addresses'] as $addressData) {
                $newAddress = $user->addresses()->create([
                    'city_id' => $addressData['city_id'] ?? null,
                    'address' => $addressData['address'],
                    'tel' => $addressData['tel'] ?? null,
                ]);
                $submittedAddressIds[] = $newAddress->id;
            }

            $user->load('addresses.city');

            Log::info("User profile created: {$user->id}");

            return $user;
        });
    }

    public function sendSms(User $user , string $message)
    {
        $number = $user->tel;
        Sms::send($number, $message);

        return true;
    }

}
