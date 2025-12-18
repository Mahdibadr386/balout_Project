<?php

namespace App\Interface;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

interface AuthRepositoryInterface
{
    /** Revoke all active authentication tokens of the given user */
    public function revokeTokens(User $user);

    /** Update the profile and addresses of the given user */
    public function updateProfile(
        Authenticatable|User $user,
        array $data,
        array $addresses = []
    );

    /** Check if a user exists and is active based on phone number */
    public function checkUser(mixed $tel);

    /** Send a verification code to the user's phone */
    public function sendCode(array $data);

    /** Verify the submitted code and authenticate the user */
    public function checkCode(array $data);
}
