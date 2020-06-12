<?php

use Illuminate\Database\Seeder;
use App\Artist;
use App\Album;
use App\Song;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Album::class,5)->create()->each(function ($album){
            $album->songs()->saveMany(factory(Song::class,2)->create()->each(function ($song){
                $song->artists()->save(factory(Artist::class)->create());
            }));
        });
    }
}
