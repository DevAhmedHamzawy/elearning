<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'name' => $name,
        'slug' => str_slug($name),
        'description' => $faker->paragraph(),
        'visible' => 1,
        'category_id' => function(){ return Category::all()->random(); },
    ];
});
