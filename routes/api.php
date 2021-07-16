<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$group = [
    //'middleware' => 'auth:api',
];

Route::group($group, function () {
    Route::group(['prefix' => 'subcategory'], function () {
        Route::post('delete', 'Api\SubCategoryApiController@delete');
    });
});