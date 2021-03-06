<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Medium;
use Faker\Generator as Faker;

$factory->define(Medium::class, function (Faker $faker) {
    return [
        'media_id' => $faker->numberBetween(10000000000000000, 99999999999999999),
        'media_url' => $faker->imageUrl(),
        'permalink' => $faker->url,
        'caption' => $faker->paragraph(1),
    ];
});
