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

Route::get('/register', function() {
    return view('layouts.error');
});

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

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
        Route::match(['get','post'], '/', 'CategoryController@list');
        Route::get('form', 'CategoryController@create');
        Route::get('form/{id}','CategoryController@create');
        Route::post('save', 'CategoryController@store');
        Route::post('save/{id}', 'CategoryController@update');
        Route::get('view/{id}', 'CategoryController@view');
        Route::get('delete/{id}', 'CategoryController@delete');
    });

    Route::group(['prefix' => 'article'], function() {
        Route::match(['get','post'], '/', 'ArticleController@list');
        Route::get('form', 'ArticleController@create');
        Route::get('form/{id}','ArticleController@create');
        Route::post('save', 'ArticleController@store');
        Route::post('save/{id}', 'ArticleController@update');
        Route::get('view/{id}', 'ArticleController@view');
        Route::get('delete/{id}', 'ArticleController@delete');
    });

    Route::group(['prefix' => 'page'], function() {
        Route::match(['get','post'], '/', 'PageController@list');
        Route::get('form', 'PageController@create');
        Route::get('form/{id}','PageController@create');
        Route::post('save', 'PageController@store');
        Route::post('save/{id}', 'PageController@update');
        Route::get('view/{id}', 'PageController@view');
        Route::get('delete/{id}', 'PageController@delete');
    });
});

Route::get('/', 'SiteController@index');
Route::get('page/{id}', 'SiteController@index');
Route::get('category/{id}', 'SiteController@subcategoryList');
Route::get('subcategory/{id}', 'SiteController@articleList');
Route::get('article/{id}', 'SiteController@articleView');
