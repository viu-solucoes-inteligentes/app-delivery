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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group([
    'prefix' => 'users',
    'as' => 'users',
    'middleware' => 'auth'
], function () {

    Route::get('/', 'UsersController@index')->name('');
    Route::get('/create', 'UsersController@create')->name('.create');
    Route::get('/{id}', 'UsersController@show')->name('.show');
    Route::get('/{id}/edit', 'UsersController@edit')->name('.edit');
    Route::delete('/{id}', 'UsersController@destroy')->name('.destroy');
    Route::put('/{id}', 'UsersController@update')->name('.update');
    Route::post('', 'UsersController@store')->name('.store');
    Route::post('/search', 'UsersController@search')->name('.search');

    Route::group([
        'prefix' => 'trashed',
        'as' => '.trashed'
    ], function () {
        Route::get('users', 'UsersTrashedController@index')->name('');
        Route::post('users/search', 'UsersTrashedController@search')->name('.search');
        Route::put('users/{id}', 'UsersTrashedController@update')->name('.update');

    });
});



Route::group([
    'prefix' => 'categories',
    'as' => 'categories',
    'middleware' => 'auth'
], function () {

    Route::get('/', 'CategoriesController@index')->name('');
    Route::get('/create', 'CategoriesController@create')->name('.create');
    Route::get('/{id}', 'CategoriesController@show')->name('.show');
    Route::get('/{id}/edit', 'CategoriesController@edit')->name('.edit');
    Route::delete('/{id}', 'CategoriesController@destroy')->name('.destroy');
    Route::put('/{id}', 'CategoriesController@update')->name('.update');
    Route::post('', 'CategoriesController@store')->name('.store');
    Route::post('/search', 'CategoriesController@search')->name('.search');


    Route::group([
        'prefix' => 'trashed',
        'as' => '.trashed'
    ], function () {

        Route::get('categories', 'CategoriesTrashedController@index')->name('');
        Route::post('categories/search', 'CategoriesTrashedController@search')->name('.search');
        Route::put('categories/{id}', 'CategoriesTrashedController@update')->name('.update');
    });
});



Route::group([
    'prefix' => 'products',
    'as' => 'products',
    'middleware' => 'auth'
], function () {

    Route::get('/', 'ProductsController@index')->name('');
    Route::get('/create', 'ProductsController@create')->name('.create');
    Route::get('/{id}', 'ProductsController@show')->name('.show');
    Route::get('/{id}/edit', 'ProductsController@edit')->name('.edit');
    Route::delete('/{id}', 'ProductsController@destroy')->name('.destroy');
    Route::put('/{id}', 'ProductsController@update')->name('.update');
    Route::post('', 'ProductsController@store')->name('.store');
    Route::post('/search', 'ProductsController@search')->name('.search');


    Route::group([
        'prefix' => 'trashed',
        'as' => '.trashed'
    ], function () {

        Route::get('products', 'ProductsTrashedController@index')->name('');
        Route::post('products/search', 'ProductsTrashedController@search')->name('.search');
        Route::put('products/{id}', 'ProductsTrashedController@update')->name('.update');
    });
});


Route::group([
    'prefix' => 'clients',
    'as' => 'clients',
    'middleware' => 'auth'
], function () {

    Route::get('/', 'ClientsController@index')->name('');
    Route::get('/create', 'ClientsController@create')->name('.create');
    Route::get('/{id}', 'ClientsController@show')->name('.show');
    Route::get('/{id}/edit', 'ClientsController@edit')->name('.edit');
    Route::delete('/{id}', 'ClientsController@destroy')->name('.destroy');
    Route::put('/{id}', 'ClientsController@update')->name('.update');
    Route::post('', 'ClientsController@store')->name('.store');
    Route::post('/search', 'ClientsController@search')->name('.search');
});

