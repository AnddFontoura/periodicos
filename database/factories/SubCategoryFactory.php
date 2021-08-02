<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\SubCategory;
use Faker\Generator as Faker;

$factory->define(SubCategory::class, function (Faker $faker) {
    $category = Factory(Category::class)->create();

    return [
        'category_id' => $category->id,
        'name' => $faker->unique()->name(150),
        'description' => $faker->text(150),
        'image' => $faker->imageUrl(),
    ];
});
