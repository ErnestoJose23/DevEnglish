<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Resource;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(Resource::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'url' => $faker->url,
        'description' => $faker->text,
        'topic_id' => 2,
        'isActive' => $faker->boolean,
        'token' => Str::random(10),
        'type' => 1
    ];
});