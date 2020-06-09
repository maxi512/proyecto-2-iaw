<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public function artists()
    {
        return $this->belongsToMany('App\Artist','album_artist');
    }

    public function songs()
    {
        return $this->hasMany('App\Song');
    }
}
