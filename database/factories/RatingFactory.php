<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\Rating;
use App\User;
use Faker\Generator as Faker;

$factory->define(Rating::class, function (Faker $faker) {
    return [
        'user_id' => function(){ return User::all()->random(); },
        'course_id' => function(){ return Course::all()->random(); },
        'rating' => $faker->numberBetween(1,5),
        'comment' => $faker->paragraph(2),
        'spam' => 1,
    ];
});
