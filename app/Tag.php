<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    }
}
