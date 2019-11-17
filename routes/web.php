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

Route::namespace('V1\Web')->group(function(){
    Route::get('/', 'IndexController@index');

    Route::get('user/register', 'UserController@register');
    Route::get('user/login', 'UserController@login');

    Route::get('article', 'ArticleController@index');
    Route::get('article/store', 'ArticleController@store');
    Route::get('article/{id}', 'ArticleController@show')->where('id', '[1-9]+\d*');
    Route::get('article/{id}/edit', 'ArticleController@edit')->where('id', '[1-9]+\d*');
});

if (env('APP_DEBUG')) {
    Route::get('/test', 'Test\TestController@test');
    Route::get('/test/sensitive-word', 'Test\TestSensitiveWordController@test');
}
