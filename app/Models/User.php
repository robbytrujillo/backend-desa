<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

// import Traits Laravel Spatie Permission HasRoles
use Spatie\Permission\Models\HasRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles; // tambahkan HasRoles

    // add guard_name
    /**
     * guard_name
     *
     * @var string
     */
    protected $guard_name = 'api';

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
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // add getPermissionArray
    /**
     * getPermissionArray
     * 
     * @return void
     */
    public function getPermissionArray() {
        return $this->getAllPermissions()->mapWithKeys(function($pr) {
            return [$pr->name => true];
        });
    }
}
