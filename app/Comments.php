<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    // Comments table in Db.
    protected $guarded = [];

    // Commenting user.
    public function author()
    {
        return $this->belongsTo('App\User', 'from_user');
    }

    // Return post of any comment.
    public function recipe()
    {
        return $this->belongsTo('App\Recipe', 'on_post');
    }
}
