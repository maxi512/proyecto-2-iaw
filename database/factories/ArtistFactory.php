<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Artist;
use Faker\Generator as Faker;


$factory->define(Artist::class, function (Faker $faker) {
    $faker->addProvider(new \RauweBieten\PhpFakerMusic\Metal($faker));
    return [
        'name' => $faker->musicMetalArtist(),
        'country' => $faker->country
    ];
});
