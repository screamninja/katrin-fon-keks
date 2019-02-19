<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

//use Illuminate\Notifications\Notifiable;
//use Illuminate\Foundation\Auth\User as Authenticatable;


//class User extends Authenticatable
//{
//    use Notifiable;
//
//    /**
//     * The attributes that are mass assignable.
//     *
//     * @var array
//     */
//    protected $fillable = [
//        'name', 'email', 'password',
//    ];
//
//    /**
//     * The attributes that should be hidden for arrays.
//     *
//     * @var array
//     */
//    protected $hidden = [
//        'password', 'remember_token',
//    ];
//
//
//}

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

    // From one to many user posts.
    public function posts()
    {
        return $this->hasMany('App\Recipes', 'author_id');
    }

    // From one to many user comments.
    public function comments()
    {
        return $this->hasMany('App\Comments', 'from_user');
    }

    // Check who can post.
    public function canPost()
    {
        $role = $this->role;
        return $role === 'author' || $role === 'admin';
    }

    // Check is admin.
    public function isAdmin()
    {
        $role = $this->role;
        return $role === 'admin';
    }
}
