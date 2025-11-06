<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable ,HasRoles;

    protected $fillable = [
        'is_active',
        'password',
        'first_name',
        'last_name',
        'name_en',
        'tel',
        'national_code',
        'description',
        'code',
        'status',
        'birth_date',
        'marriage_date',
        'last_login_date',
    ];

    protected $with = ['addresses' , 'feedbacks'];

    protected $guarded = [
        'id',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
        'code',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
        'is_active' => 'boolean',
        'status' => 'integer',
        'birth_date' => 'date',
        'marriage_date' => 'date',
        'last_login_date' => 'datetime',
    ];

    public function addresses()
    {
        return $this->hasMany(UserAddress::class, 'user_id', 'id');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'user_id', 'id');
    }

    public function getCitiesAttribute()
    {
        return $this->addresses
            ->filter(fn($address) => $address->city)
            ->map(fn($address) => $address->city)
            ->unique('id')
            ->values();
    }
}
