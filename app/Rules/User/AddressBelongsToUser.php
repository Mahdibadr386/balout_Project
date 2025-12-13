<?php

namespace App\Rules\User;

use Illuminate\Contracts\Validation\Rule;
use App\Models\UserAddress;

class AddressBelongsToUser implements Rule
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function passes($attribute, $value)
    {
        return UserAddress::where('user_id', $this->userId)
            ->exists();
    }

    public function message()
    {
        return 'آدرس انتخاب شده متعلق به کاربر نیست.';
    }
}
