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

Route::namespace('V1\Api')->group(function(){
    Route::get('article', 'ArticleController@index');
    Route::post('article/store', 'ArticleController@store');
    Route::get('article/{id}', 'ArticleController@show')->where('id', '[1-9]+\d*');
    Route::post('article/{id}/update', 'ArticleController@update')->where('id', '[1-9]+\d*');
    Route::post('article/{id}/destroy', 'ArticleController@destroy')->where('id', '[1-9]+\d*');
});
