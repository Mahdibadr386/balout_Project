<?php

namespace App\Repositories\Auth\Contracts;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

interface AuthRepositoryInterface
{
    /**
     * Revoke all tokens of a user
     */
    public function revokeTokens(User $user);


    /**
     * Update a user's profile
     */
    public function updateProfile(Authenticatable|User $user, array $data, array $addresses = []);

    /**
     * Check User
     */
    public function checkUser(mixed $tel);

    /**
     * Send VerifyCode
     */
    public function sendCode(array $data);

    /**
     * Check VerifyCode
     */
    public function checkCode(array $data);

}

