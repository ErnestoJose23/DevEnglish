<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\ProblemType;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(ProblemType::class, function (Faker $faker) {
    return [
        'type' => $faker->word,
    ];
});
