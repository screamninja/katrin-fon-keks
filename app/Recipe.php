<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    // Forbids changing columns.
    protected $guarded = [];

    // Return all comments to post.
    public function comments()
    {
        return $this->hasMany('App\Comments', 'on_recipe');
    }

    // Return author (user) profile.
    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }
}
