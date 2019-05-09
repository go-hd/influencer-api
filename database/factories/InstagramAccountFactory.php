<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\InstagramAccount;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(InstagramAccount::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'label' => $faker->userName,
        'ig_business_id' => $faker->numberBetween(10000000000000000, 99999999999999999),
        'page_access_token' => Str::random(185),
    ];
});
