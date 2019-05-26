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

Route::prefix('articles')->namespace('Community')->group(function () {
    Route::post('article', 'ArticleController@article');
    Route::get('article/{id}', 'ArticleController@article')->where('id','[1-9]+\d*');
    Route::put('article/{id}', 'ArticleController@article')->where('id','[1-9]+\d*');
    Route::delete('article/{id}', 'ArticleController@article')->where('id','[1-9]+\d*');

    Route::get('list', 'ArticleController@articleList');
});
