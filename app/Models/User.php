<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

// import Traits Laravel Spatie Permission HasRoles
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// import JWTSubject
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject // <-- tambahkan 
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
            return [$pr['name'] => true];
        });
    }

    // 
    /**
     * getJWTIdentifier
     * 
     * @return void
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * getJWTCustomClaims
     * 
     * @return void 
     */
    public function getJWTCustomClaims() {
        return [];
    }

    // 1 user memiliki banyak post
    /**
     * posts
     * 
     * @return void
     */
    public function posts() {
        return $this->hasMany(Post::class);
    }

    // 1 user memilik banyak product
    /**
     * products
     * 
     * @return void
     */
    public function products() {
        return $this->hasMany(Product::class);
    }

    // 1 user memiliki banyak page
    /**
     * pages
     * 
     * @return void
     */
    public function pages() {
        return $this->hasMany(Page::class);
    }
}
