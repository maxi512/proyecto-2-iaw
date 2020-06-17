<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Song;
use App\Artist;
use Faker\Generator as Faker;

$factory->define(Song::class, function (Faker $faker) {
    $faker->addProvider(new \RauweBieten\PhpFakerMusic\Reggae($faker));
    return [
        'name' => $faker->musicReggaeAlbum(),
        'duration' => 10,
        'album_id' => 1,
        'youtube_link'=> $faker->url
    ];
});

$factory->afterCreating(Song::class, function ($song) {
    $song->artists()->save(factory(Artist::class)->create());
});
