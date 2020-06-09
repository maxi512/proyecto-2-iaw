<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    public function albums()
    {
        return $this->belongsToMany('App\Album',);
    }

    public function songs()
    {
        return $this->belongsToMany('App\Song');
    }
}
