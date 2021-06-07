<?php

namespace Tests\Feature;

use App\Http\Controllers\SubCategoryController;
use App\SubCategory;
use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Request;
use PHPUnit\Framework\TestCase;

class SubCategoryControllerUnitTest extends TestCase
{
    private $controller;

    function __construct()
    {
        $this->controller = new SubCategoryController();
    }


    public function testStoreSuccess()
    {
        $faker = new Faker();

        $name = $faker->name;
        $description = $faker->text(500);

        $request = new Request([
            'name' => $name,
            'description' => $description
        ]);

        $this->controller->store($request);

        $confirmStore = SubCategory::where('name', $name)->where('description', $description)->first();

        $this->assertIsEqual($confirmStore->name, $name);
    }
}
