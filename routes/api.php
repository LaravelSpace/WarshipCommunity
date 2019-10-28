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

// Route::namespace('V1\Api')->middleware(['request_log','request_throttle'])->group(function(){}
Route::namespace('V1\Api')->middleware(['request_log','request_throttle'])->group(function(){
    Route::post('article/store', 'ArticleController@store');
    Route::get('article', 'ArticleController@index');
    Route::get('article/{id}', 'ArticleController@show')->where('id', '[1-9]+\d*');
    Route::get('article/{id}/edit', 'ArticleController@edit')->where('id', '[1-9]+\d*');
    Route::put('article/{id}/update', 'ArticleController@update')->where('id', '[1-9]+\d*');
    Route::delete('article/{id}/destroy', 'ArticleController@destroy')->where('id', '[1-9]+\d*');
    Route::get('article/{id}/comment', 'ArticleController@comment')->where('id', '[1-9]+\d*');

    Route::post('comment/store', 'CommentController@store');
    Route::get('comment', 'CommentController@index');
    Route::get('comment/{id}', 'CommentController@show')->where('id', '[1-9]+\d*');
    Route::get('comment/{id}/edit', 'CommentController@edit')->where('id', '[1-9]+\d*');
    Route::put('comment/{id}/update', 'CommentController@update')->where('id', '[1-9]+\d*');
    Route::delete('comment/{id}/destroy', 'CommentController@destroy')->where('id', '[1-9]+\d*');
});
