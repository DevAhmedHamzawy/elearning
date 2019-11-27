<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\Lecture;
use App\Section;
use Faker\Generator as Faker;

$factory->define(Lecture::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'course_id' => function(){ return Course::all()->random(); },
        'section_id' => function(){ return Section::all()->random(); },
        'name' => $name,
        'slug' => str_slug($name),
        'description' => $faker->paragraph(5),
        'video' => 'https://www.youtube.com/watch?v=g_aMpyMvQ9k',
        'duration' => $faker->randomNumber(2),
        'episode_number' => $faker->randomNumber(2),
        'premium' => $faker->boolean(),
    ];
});
