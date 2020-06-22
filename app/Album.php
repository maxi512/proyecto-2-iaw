<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{

    protected $fillable = ['name', 'cover','artists'];
    protected $table = 'albums';

    public function artists()
    {
        return $this->belongsToMany('App\Artist','album_artist');
    }

    public function songs()
    {
        return $this->hasMany('App\Song');
    }
}
