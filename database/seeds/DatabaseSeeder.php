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
        factory(Album::class,10)->create()->each(function ($album){
            $album->artists()->saveMany(factory(Artist::class,4)->create());
        });
    }
}
