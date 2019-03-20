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
Route::get('/report', function () {
    return view('report');
});
Route::get('/report2', function () {
    return view('report2');
});
Route::get('/report3', function () {
    return view('report3');
});
Route::post('/ajax/{id}', function ($id) {
    $article = \Illuminate\Support\Facades\DB::connection('mysql')
        ->table('articles')
        ->where('id', $id)
        ->first();
    return response()->json($article);
});

Route::get('A-url/{id}', 'AurlController@index');
//Route::get('show/{id}','ShowController@index');
//Route::get('frame/{id}','IframeController@index');
Route::post('getArticle/{id}', 'ShowController@getArticle');
Route::post('updateEvent/{id}', 'ShowController@updateEvent');

Route::get('/update/article/{id}', 'CacheFile\CacheFileController@index');

Route::any('tt',function (){
  return view('tt', [
      'url'=>'http://www.shows.com/bb'
  ]);
});
Route::any('bb',function (){
    return view('bb');
});
