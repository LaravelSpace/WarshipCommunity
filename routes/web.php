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

Route::namespace('V1\Web')->group(function () {
    // 根目录
    Route::get('/', 'IndexController@index');

    Route::prefix('user')->group(function () {
        Route::get('register', 'UserController@register');
        Route::get('login', 'UserController@login');
    });

    Route::prefix('article')->group(function () {
        Route::get('/', 'ArticleController@index');
        Route::get('create', 'ArticleController@create');
        Route::get('{id}', 'ArticleController@show')->where('id', '[1-9]+\d*');
        Route::get('{id}/edit', 'ArticleController@edit')->where('id', '[1-9]+\d*');
    });
});

if (env('APP_DEBUG')) {
    Route::get('/test', 'Test\TestController@test');
    Route::get('/test/sensitive-word', 'Test\TestSensitiveWordController@test');
}
