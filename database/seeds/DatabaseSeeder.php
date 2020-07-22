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
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

        $this->call([
            UsersTableSeeder::class,
        ]);

        factory(Album::class,18)->create()->each(function ($album){
            $album->songs()->saveMany(factory(Song::class,2)->create()->each(function ($song){
                $song->artists()->save(factory(Artist::class)->create());
            }));

            foreach($album->songs as $song){
                    foreach($song->artists as $artist){
                        $album->artists()->attach($artist->id);
                    }
                }
 
        });

    }
}
