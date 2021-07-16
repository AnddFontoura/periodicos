<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'subcategory'], function() {
        Route::match(['get','post'], '/', 'SubCategoryController@list');
        Route::get('form', 'SubCategoryController@create');
        Route::get('form/{id}','SubCategoryController@create');
        Route::post('save', 'SubCategoryController@store');
        Route::post('save/{id}', 'SubCategoryController@update');
        Route::get('view/{id}', 'SubCategoryController@view');
        Route::get('delete/{id}', 'SubCategoryController@delete');
    });

    Route::group(['prefix' => 'category'], function() {
        Route::match(['get','post'], '/', 'SubCategoryController@list');
        Route::get('form', 'SubCategoryController@create');
        Route::get('form/{id}','SubCategoryController@edit');
        Route::post('save', 'SubCategoryController@store');
        Route::post('save/{id}', 'SubCategoryController@update');
    });

    Route::group(['prefix' => 'article'], function() {
        Route::match(['get','post'], '/', 'SubCategoryController@list');
        Route::get('form', 'SubCategoryController@create');
        Route::get('form/{id}','SubCategoryController@edit');
        Route::post('save', 'SubCategoryController@store');
        Route::post('save/{id}', 'SubCategoryController@update');
    });

    Route::group(['prefix' => 'page'], function() {
        Route::match(['get','post'], '/', 'SubCategoryController@list');
        Route::get('form', 'SubCategoryController@create');
        Route::get('form/{id}','SubCategoryController@edit');
        Route::post('save', 'SubCategoryController@store');
        Route::post('save/{id}', 'SubCategoryController@update');
    });
});

