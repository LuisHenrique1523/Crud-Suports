<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Priority;
use App\Models\Commentary\Commentary;
use App\Models\Operation\Operation;
use App\Models\Ticket\Ticket;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasRoles, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable;

    /** @use HasFactory<\Database\Factories\UserFactory> */

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'priority' => Priority::class,
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function replies()
    {
        return $this->hasOne(Reply::class);
    }
    public function commentaries()
    {
        return $this->hasMany(Commentary::class);
    }
    public function operations()
    {
        return $this->hasMany(Operation::class);
    } 
}
