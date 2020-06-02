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

Route::get('/', 'DashboardController@index');
Route::get('/add-location', 'PlaceController@index');
Route::post('/add-location', 'PlaceController@add');
Route::get('/list-location', 'PlaceController@list');
Route::get('/search-location', 'PlaceController@search');
Route::get('/search-location-detail', 'PlaceController@getNearest');
Route::get('/location-detail/{id}/lat/{lat}/long/{long}', 'PlaceController@detail');
