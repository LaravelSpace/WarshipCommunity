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

Route::get('/', 'Community\IndexController@index');

Route::prefix('users')->namespace('Community')->group(function () {
    Route::get('register', 'UserController@registerPage');

    Route::post('register/sign-check', 'UserController@signCheck');
    Route::post('register/sign-up', 'UserController@signUp');
    Route::post('register/sign-in', 'UserController@signIn');
    Route::post('register/sign-out', 'UserController@signOut');
});

Route::prefix('articles')->namespace('Community')->group(function () {
    Route::get('/', 'ArticleController@index')->name('articles.index');
    Route::get('/create', 'ArticleController@create')->name('articles.create');
    Route::post('/', 'ArticleController@store')->name('articles.store');
    Route::get('/{id}', 'ArticleController@show')->where('id', '[1-9]+\d*')->name('articles.show');
    Route::get('/{id}/edit', 'ArticleController@edit')->where('id', '[1-9]+\d*')->name('articles.edit');
    Route::put('/{id}', 'ArticleController@update')->where('id', '[1-9]+\d*')->name('articles.update');
    Route::delete('/{id}', 'ArticleController@destroy')->where('id', '[1-9]+\d*')->name('articles.destroy');

    // Route::get('/{id?}', 'ArticleController@articlePage')->where('id','[1-9]+\d*'); // id >= 0;
});

if (env('APP_DEBUG')) {
    Route::get('/test', 'Test\TestController@test');
}
