<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Topic;
use Faker\Generator as Faker;

$factory->define(\App\Topic::class, function (Faker $faker) {
    return [
        'name' => $this->faker->word,
        'isActive' => $this->faker->boolean,
        'avatar' => $this->faker->word,
        'created_at' => now(),
    ];
});
