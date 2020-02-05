<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\UserTopic;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(UserTopic::class, function (Faker $faker) {
    return [
        'user_id' => 2,
        'topic_id' => 2
    ];
});
