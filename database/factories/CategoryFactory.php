<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\SubCategory;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    $subCategoryId = Factory(SubCategory::class)->create()->id();

    return [
        'subcategory_id' => $subCategoryId,
        'name' => $faker->unique()->name(150),
        'description' => $faker->text(150),
        'image' => $faker->imageUrl(),
    ];
});
