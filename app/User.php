<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    public function recipes()
    {
        return $this->hasMany('App\Recipe::class', 'author_id');
<<<<<<< HEAD
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
=======
>>>>>>> origin/master
    }
}
