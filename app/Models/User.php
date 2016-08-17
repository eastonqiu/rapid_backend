<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject as AuthenticatableUserContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable implements AuthenticatableUserContract
{
    // enable the relation with Role and add the following methods roles(), hasRole($name), can($permission), and ability($roles, $permissions, $options)
    use EntrustUserTrait;

    protected $guarded = ['id', 'remember_token'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'platform', 'platform_id',
    ];

    /**
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Eloquent model method
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get all of the tasks for the user.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public static $rules = [
        'name' => 'required',
        'email' => 'required|unique:users',
        'password' => 'required'
    ];
}
