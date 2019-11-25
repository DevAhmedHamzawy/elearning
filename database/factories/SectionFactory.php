<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\Section;
use Faker\Generator as Faker;

$factory->define(Section::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'course_id' => function(){ return Course::all()->random(); },
        'name' => $name,
        'slug' => str_slug($name),
        'description' => $faker->paragraph(3)
    ];
});
