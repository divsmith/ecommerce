<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function() {
    return view('index');
});

Route::get('/lightSwitch', function() {
    return view('lightSwitch');
});

Route::group(['prefix' => 'ecommerce'], function() {
    Route::auth();

    Route::get('/', function() {
       return redirect()->route('catalogue.index');
    });

    Route::get('/cart', ['as' => 'cart.index', 'uses' => 'CartController@index']);

    Route::post('/cart/{product}', ['as' => 'cart.store', 'uses' => 'CartController@store']);

    Route::delete('/cart/{product}', ['as' => 'cart.remove', 'uses' => 'CartController@remove']);

    Route::delete('/cart', ['as' => 'cart.destroy', 'uses' => 'CartController@destroy']);

    Route::get('/catalogue', ['as' => 'catalogue.index', 'uses' => 'Catalogue@index']);

    Route::get('/catalogue/{product}', ['as' => 'catalogue.show', 'uses' => 'Catalogue@show']);
});

