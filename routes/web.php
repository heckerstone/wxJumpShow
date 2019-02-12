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
Route::get('A-url/{id}', 'AurlController@index');
Route::get('show/{id}','ShowController@index');
Route::get('frame/{id}','IframeController@index');
Route::post('getArticle/{id}', 'ShowController@getArticle');
Route::post('updateEvent/{id}', 'ShowController@updateEvent');
