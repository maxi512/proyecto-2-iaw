<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Artist extends Model
{
    protected $fillable = ['name', 'country'];
    protected $table = 'artists';

    public function albums()
    {
        return $this->belongsToMany('App\Album','album_artist');
    }

    public function songs()
    {
        return $this->belongsToMany('App\Song');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($artist) {
            $artist->songs()->detach();
            $artist->albums()->detach();

            $allSongs = Song::all();
            $allAlbums = Album::All();

            foreach ($allAlbums as $album) {
                if($album->artists->count() == 0){
                    foreach($album->songs as $song){
                        $song->delete();
                   }
                   $album->delete();
                }
            }

            foreach ($allSongs as  $song) {
                if($song->artists->count() == 0){
                    $song->delete();
                }
            }

            
        });
    }
}
