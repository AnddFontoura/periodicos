<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Articles;
use App\SubCategory;
use Faker\Generator as Faker;

$factory->define(Articles::class, function (Faker $faker) {

    $subCategoryId = Factory(SubCategory::class)->create()->id;

    return [
        'subcategory_id' => $subCategoryId,
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
