<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
