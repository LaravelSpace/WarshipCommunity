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
    Route::get('/', 'ArticleController@index')->name('articles.index');
    Route::get('/create', 'ArticleController@create')->name('articles.create');
    Route::post('/', 'ArticleController@store')->name('articles.store');
    Route::get('/{id}', 'ArticleController@show')->where('id', '[1-9]+\d*')->name('articles.show');
    Route::get('/{id}/edit', 'ArticleController@edit')->where('id', '[1-9]+\d*')->name('articles.edit');
    Route::put('/{id}', 'ArticleController@update')->where('id', '[1-9]+\d*')->name('articles.update');
    Route::delete('/{id}', 'ArticleController@destroy')->where('id', '[1-9]+\d*')->name('articles.destroy');

    // Route::get('/{id?}', 'ArticleController@articlePage')->where('id','[1-9]+\d*'); // id >= 0;
});

Route::prefix('permissions')->namespace('Community')->group(function () {
    Route::get('/', 'PermissionController@indexPermission')->name('permissions.index');
    Route::post('/', 'PermissionController@storePermission')->name('permissions.store');
});

Route::prefix('roles')->namespace('Community')->group(function () {
    Route::get('/', 'PermissionController@indexRole')->name('roles.index');
    Route::post('/', 'PermissionController@storeRole')->name('roles.store');
});

Route::prefix('users/register')->namespace('Community')->group(function () {
    Route::get('/', 'UserController@registerPage');
    Route::get('sign-check', 'UserController@signCheck');
    Route::post('sign-in', 'UserController@signIn');
    Route::get('sign-out', 'UserController@signOut');
    Route::post('sign-up', 'UserController@signUp');
});

if (env('APP_DEBUG')) {
    Route::get('/test', 'Test\TestController@test');
    Route::get('/test/sensitive-word', 'Test\TestSensitiveWordController@test');
    Route::get('/test/algorithm-demo/sort', 'Test\TestAlgorithmDemoController@sort');
    Route::get('/test/algorithm-demo/climbing-steps', 'Test\TestAlgorithmDemoController@climbingSteps');
    Route::get('/test/algorithm-demo/minimum-path', 'Test\TestAlgorithmDemoController@minimumPath');
    Route::get('/test/algorithm-demo/give-change', 'Test\TestAlgorithmDemoController@giveChange');
}
