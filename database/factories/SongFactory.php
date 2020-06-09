<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Song;
use Faker\Generator as Faker;

$factory->define(Song::class, function (Faker $faker) {
    return [
        'name' => Str::random(10),
        'duration' => 10,
        'album_id' => 1,
        'youtube_link'=> $faker->url
    ];
});
