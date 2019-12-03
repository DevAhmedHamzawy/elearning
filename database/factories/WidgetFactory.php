<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Widget;
use Faker\Generator as Faker;

$factory->define(Widget::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'type' => $faker->name,
        'body' => $faker->paragraph(3),
        'link' => $faker->url
    ];
});
