<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'avatar',
        'org',
        'country',
        'city',
        'zip',
        'address',
        'lang',
        'phone',
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
    ];

    static $rules = [
        'firstname' => 'required',
        'lastname' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'sometimes|min:8',
        'org' => 'required',
        'country' => 'required',
        'city' => 'required',
        'zip' => 'required',
        'address' => 'required',
        'lang' => 'required',
        'phone' => 'required|digits:10',
    ];

    // public function getAvatarAttribute()
    // {
    //     return !empty($this->avatar) ? storage_path("avatars/{$this->avatar}") : asset('assets/img/avatars/defult.png');
    // }
    
    /**
     * Interact with the user's first name.
     */
    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => !empty($value) ? url("storage/avatars/{$value}") : asset('assets/img/avatars/defult.png'),
            // set: fn (string $value) => strtolower($value),
        );
    }

}
