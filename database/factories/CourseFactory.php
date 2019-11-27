<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\User;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'user_id' => function(){ return User::all()->random(); },
        'category_id' => function(){ return Category::all()->random(); },
        'name' => $name,
        'slug' => str_slug($name),
        'description' => $faker->paragraph(),
        'visible' => 0,
        'thumbnail' => $faker->imageUrl(),
        'price' => $faker->randomNumber(2),
        'language'  => 'English',
        'faq' => $faker->paragraph(5),
        'what_will_students_learn' => $faker->paragraph(5),
        'target_students' => $faker->paragraph(5),
        'requirements' => $faker->paragraph(5),
        'promo_video_url' => 'https://www.youtube.com/watch?v=g_aMpyMvQ9k',
        'start_date' => $faker->dateTime(),
        'end_date' => $faker->dateTime(),
        'hours_number' => $faker->randomNumber(3)
    ];
});
