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

Route::get('/storeRatings/{ratings}', [
    'uses' => 'HomeController@saveRatings',
    'as' => 'storeRatings'
]);

Route::get('/prediction/{user_id}', [
    'uses' => 'PredictionPageController@load',
    'as' => 'PredictionPage'
]);

Route::get('/movie/{user_id}/{movie_id}', [
    'uses' => 'MovieController@load',
    'as' => 'MoviePage'
]);
