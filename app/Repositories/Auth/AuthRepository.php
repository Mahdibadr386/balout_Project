<?php

namespace App\Repositories\Auth;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Morilog\Jalali\Jalalian;

class AuthRepository
{

    public function revokeTokens(User $user): void
    {
        $user->tokens()->delete();
    }


    public function updateProfile(Authenticatable|User $user, array $data, array $addresses = [])
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

    public function checkUser(mixed $tel)
    {
        $user = User::where('tel', $tel)->first();
        $userExists = $user && $user->status == 1 && $user->is_active == 1;

        return  $userExists;
    }


    public function sendCode(array $data)
    {
        $user = User::where('tel', $data['tel'])->first();
        $isNewUser = !$user || $user->status != 1;

        if ($isNewUser) {
            $this->prepareUserForRegistration($data);
        }

        $code = random_int(100000, 999999);
        Cache::put($data['tel'], $code, 300);


        Log::info('کد فعالسازی برای کاربر:', [
            'tel' => $data['tel'],
            'code' => $code,
            'is_new_user' => $isNewUser,
        ]);

        return (object)[
            'user' => $user,
            'isNewUser' => $isNewUser,
            'code' => $code,
        ];
    }

    public function checkCode(array $data)
    {
        $tel = $data['tel'];
        $code = $data['code'];

        $cachedCode = Cache::get($tel);
        Log::debug("Cached code for {$tel}: " . $cachedCode);

        if (!$cachedCode || $cachedCode != $code) {
            return [
                'success' => false,
                'message' => 'کد وارد شده صحیح نمی‌باشد',
            ];
        }

        $user = User::where('tel', $tel)->first();

        if (!$user) {
            Log::error("User not found for tel: {$tel}");
            return [
                'success' => false,
                'message' => 'خطا در پردازش درخواست',
            ];
        }

        $isNewUser = $user->status != 1;

        $date = Jalalian::fromCarbon(now())->format('Y/m/d H:i:s');

        if ($isNewUser) {
            $user->update([
                'status' => 1,
                'last_login_date' => $date,
            ]);
            Log::info("New user activated: {$user->tel}");
        }


        $token = $user->createToken('Token-User')->accessToken;

        Cache::forget($tel);
        Log::debug("Verification code for {$tel} cleared from cache");

        return [
            'success' => true,
            'user' => $user,
            'is_new_user' => $isNewUser,
            'token' => $token,
        ];
    }


    private function prepareUserForRegistration(array $data )
    {
        $data = collect($data)->only(['first_name', 'last_name', 'tel'])->toArray();
        $data['status'] = 0;

        User::where('tel', $data['tel'])->where('status', '!=', 1)->delete();

        $user = User::create($data);

        if (! $user->hasAnyRole()) {
            $user->assignRole('user');
        }
    }

}
