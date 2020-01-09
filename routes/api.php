<?php

// use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::namespace('V1\Api')->middleware(['request_throttle','request_log'])->group(function(){});
Route::namespace('V1\Api')->middleware('request_log')->group(function () {
    Route::prefix('user')->group(function () {
        Route::post('register', 'UserController@register');
        Route::post('login', 'UserController@login');
        Route::post('logout', 'UserController@logout');
    });

    Route::prefix('article')->group(function () {
        Route::post('store', 'ArticleController@store');
        Route::get('', 'ArticleController@index');
        Route::get('{id}', 'ArticleController@show')->where('id', '[1-9]+\d*');
        Route::get('{id}/edit', 'ArticleController@edit')->where('id', '[1-9]+\d*');
        Route::put('{id}/update', 'ArticleController@update')->where('id', '[1-9]+\d*');
        Route::delete('{id}/destroy', 'ArticleController@destroy')->where('id', '[1-9]+\d*');
        Route::get('{id}/comment', 'ArticleController@comment')->where('id', '[1-9]+\d*');
    });

    Route::prefix('comment')->group(function () {
        Route::post('store', 'CommentController@store');
        Route::get('', 'CommentController@index');
        Route::get('{id}', 'CommentController@show')->where('id', '[1-9]+\d*');
        Route::get('{id}/edit', 'CommentController@edit')->where('id', '[1-9]+\d*');
        Route::put('{id}/update', 'CommentController@update')->where('id', '[1-9]+\d*');
        Route::delete('{id}/destroy', 'CommentController@destroy')->where('id', '[1-9]+\d*');
    });

    Route::prefix('image')->group(function () {
        Route::post('store', 'ImageController@store');
        Route::post('user', 'ImageController@listUserImage');
    });
});
