<?php

use Illuminate\Database\Seeder;
use App\Artist;
use App\Album;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        /**
         * factory(Artist::class,10)->create()->each(function ($artist){
            $artist->albums()->save(factory(Album::class,2)->create());
        });
         */
        
    }
}
