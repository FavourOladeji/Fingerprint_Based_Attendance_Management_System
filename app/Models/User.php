<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'matric_number',
        'department'
    ];

    /**
     * the accessors to append to the model's array form
     *
     * @var array
     */
    protected $appends = [
        'user_type_colour_code'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'user_type' => UserType::class,
    ];

    public function userTypeColourCode(): Attribute
    {
        $colourCodeMap = [
            UserType::Lecturer->value => 'secondary',
            UserType::Admin->value => 'danger',
            UserType::Student->value => 'success'
        ];
        return Attribute::make(
            get: function ($value, $attributes) use ($colourCodeMap) {
                return $colourCodeMap[$attributes['user_type']];
            }
        );
    }
}
