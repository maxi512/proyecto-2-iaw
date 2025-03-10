<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Album;
use Faker\Generator as Faker;

$factory->define(Album::class, function (Faker $faker) {
    $faker->addProvider(new \RauweBieten\PhpFakerMusic\Metal($faker));
    return [
       'name' => $faker->musicMetalAlbum(),
       'year' => $faker->year($max = 'now'),
       'image' => fileToBase64("https://picsum.photos/300/300")
    ];
});

function fileToBase64($url){
    $image = file_get_contents($url);
    return base64_encode($image);
}


