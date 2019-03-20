<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
/**
 * Class Tag
 * @package App
 */
class Tag extends Model
{
    /**
     * Table name in DB
     * @var string
     */
    protected $table = 'tags';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function recipes()
    {
        return $this->belongsToMany('App\Recipe');
=======
class Tag extends Model
{

    public function recipes()
    {
        return $this->belongsToMany('App\Recipe::class')->withTimestamps();
>>>>>>> origin/master
    }
}
