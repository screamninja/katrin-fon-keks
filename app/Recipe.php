<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo('App\User::class', 'author_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag::class')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany('App\Comments::class', 'on_recipe');
    }
}
