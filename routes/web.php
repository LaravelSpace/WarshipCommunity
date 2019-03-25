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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'Community\Index\IndexController@index');

Route::prefix('community/index')->namespace('Community\Index')->group(function () {
    Route::get('/', 'IndexController@index');
});

Route::prefix('community/article')->namespace('Community\Article')->group(function () {
    Route::get('list', 'ArticleController@getArticleList');
});

if (env('APP_DEBUG')) {
    Route::get('/test', 'Test\TestController@test');
}