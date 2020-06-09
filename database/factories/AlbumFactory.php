<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Album;
use Faker\Generator as Faker;

$factory->define(Album::class, function (Faker $faker) {
    $faker->addProvider(new \RauweBieten\PhpFakerMusic\Metal($faker));
    return [
       'name' => $faker->musicMetalAlbum()
    ];
});
