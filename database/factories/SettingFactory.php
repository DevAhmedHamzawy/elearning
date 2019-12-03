<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Setting;
use Faker\Generator as Faker;

$factory->define(Setting::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'logo' => $faker->imageUrl(),
        'lat' => $faker->latitude(),
        'lng' => $faker->longitude(),
        'post_code' => $faker->randomNumber(3),
        'telephone' => $faker->e164PhoneNumber,
        'email' => $faker->email,
        'website' => $faker->url,
        'facebook' => $faker->url,
        'twitter' => $faker->url,
        'instagram' => $faker->url,
        'youtube' => $faker->url,
        'whatsapp' => $faker->url,
        'telegram' => $faker->url,
        'vat_rate' => $faker->randomNumber(1),
    ];
});
