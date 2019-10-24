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

    Route::get('article', 'ArticleController@index');
    Route::get('article/create', 'ArticleController@create');
    Route::get('article/{id}', 'ArticleController@show')->where('id', '[1-9]+\d*');
    Route::get('article/{id}/edit', 'ArticleController@edit')->where('id', '[1-9]+\d*');
});

Route::prefix('permissions')->namespace('User')->group(function () {
    Route::get('/', 'PermissionController@indexPermission')->name('permissions.index');
    Route::post('/', 'PermissionController@storePermission')->name('permissions.store');
});

Route::prefix('roles')->namespace('User')->group(function () {
    Route::get('/', 'PermissionController@indexRole')->name('roles.index');
    Route::post('/', 'PermissionController@storeRole')->name('roles.store');
});

Route::prefix('users/register')->namespace('User')->group(function () {
    Route::get('/', 'UserController@registerPage');
    Route::get('sign-check', 'UserController@signCheck');
    Route::post('sign-in', 'UserController@signIn');
    Route::get('sign-out', 'UserController@signOut');
    Route::post('sign-up', 'UserController@signUp');
});

if (env('APP_DEBUG')) {
    Route::get('/test', 'Test\TestController@test');

    Route::prefix('test/dynamic-programming')->namespace('Test')->group(function () {
        Route::get('king-and-gold-mine', 'TestDynamicProgrammingController@kingAndGoldMine');
        Route::get('longest-common-sequence', 'TestDynamicProgrammingController@longestCommonSequence');
        Route::get('give-change', 'TestDynamicProgrammingController@giveChange');
        Route::get('minimum-path', 'TestDynamicProgrammingController@minimumPath');
        Route::get('climbing-steps', 'TestDynamicProgrammingController@climbingSteps');
    });

    Route::get('/test/sort', 'Test\TestSortController@sort');

    Route::get('/test/sensitive-word', 'Test\TestSensitiveWordController@test');
}
