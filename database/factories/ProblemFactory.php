<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Problem;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(Problem::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'problem_type_id' =>  2,
        'content' => $faker->word,
        'isActive' => 1,
        'topic_id' => 2,
        'token' => $faker->word,
    ];
});
