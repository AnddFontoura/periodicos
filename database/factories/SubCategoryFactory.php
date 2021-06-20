<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name(150),
        'description' => $faker->text(150),
        'image' => $faker->imageUrl(),
    ];
});
