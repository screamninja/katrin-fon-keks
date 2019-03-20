<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Recipe
 * @package App
 */
class Recipe extends Model
{
    /**
     * Forbids changing columns
     * @var array
     */
    protected $guarded = [];

    /**
     * Return author (user) profile
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    /**
     * Return tags to recipe
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'recipe_tag', 'recipe_id', 'tag_id')->withTimestamps();
    }

    /**
     * Return comments to recipe
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comments', 'on_recipe');
    }
}
