<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\UserType;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(UserType::class, function (Faker $faker) {
    return [
        'type' => $faker->word,
    ];
});
