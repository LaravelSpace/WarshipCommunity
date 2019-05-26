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

Route::prefix('articles')->namespace('Community')->group(function () {
    Route::get('/{id?}', 'ArticleController@articlePage')->where('id','[1-9]+\d*'); // id >= 0;

});

Route::prefix('user')->namespace('Community')->group(function () {
    Route::get('register', 'UserController@registerPage');

    Route::post('register/sign-check', 'UserController@signCheck');
    Route::post('register/sign-up', 'UserController@signUp');
    Route::post('register/sign-in', 'UserController@signIn');
    Route::post('register/sign-out', 'UserController@signOut');
});

if (env('APP_DEBUG')) {
    Route::get('/test', 'Test\TestController@test');
}
