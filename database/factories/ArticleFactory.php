<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use App\SubCategory;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {

    $subCategory = Factory(SubCategory::class)->create();

    return [
        'subcategory_id' => $subCategory->id,
        'name' => $faker->name,
        'path' => $faker->imageUrl(),
        'authors' => $faker->name . ', ' . $faker->name,
        'resume' => $faker->text(500),
        'abstract' => $faker->text(500),
        'keywords' => $faker->text(200),
        'image' => $faker->imageUrl(),
        'pages' => rand(1,12)
    ];
});
