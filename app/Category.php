<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['name', 'description'];
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
