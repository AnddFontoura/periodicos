<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Model;
use App\SubCategory;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name(150),
        'description' => $faker->text(150),
        'image' => $faker->imageUrl(),
    ];
});
