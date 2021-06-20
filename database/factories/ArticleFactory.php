<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {

    $categoryId = Factory(Category::class)->create()->id;

    return [
        'category_id' => $categoryId,
        'name' => $faker->name,
        'path' => $faker->imageUrl(),
        'authors' => $faker->name . ', ' . $faker->name,
        'resume' => $faker->text(500),
        'abstract' => $faker->text(500),
        'keywords' => $faker->text(200),
        'image' => $faker->imageUrl(),
    ];
});
