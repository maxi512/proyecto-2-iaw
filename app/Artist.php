<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    public function albums()
    {
        return $this->belongsToMany('App\Album','album_artist');
    }

    public function songs()
    {
        return $this->belongsToMany('App\Song');
    }
}
