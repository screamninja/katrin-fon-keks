<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
    /**
     * Users table in DB.
     *
     * @var string
     */
    protected $table = 'users';
    /**
     * Attributes.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];
    /**
     * Hidden attributes from model of JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    // From one to many user recipe
    public function recipes()
    {
        return $this->hasMany('App\Recipe::class', 'author_id');
    }

    // From one to many user comments
    public function comments()
    {
        return $this->hasMany('App\Comments::class', 'from_user');
    }

    // Check who can publish
    public function canPublish()
    {
        $role = $this->role;
        return $role === 'author' || $role === 'admin';
    }

    // Check is admin
    public function isAdmin()
    {
        $role = $this->role;
        return $role === 'admin';
    }
}
