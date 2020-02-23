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

Route::namespace('V1\Api')->group(function () {
    Route::prefix('user')->group(function () {
        // 注册
        Route::post('register', 'UserController@register');
        // 登录
        Route::post('login', 'UserController@login');
        // 登录状态验证
        Route::post('login_check', 'UserController@loginCheck');
        // 登出
        Route::post('logout', 'UserController@logout');
    });

    Route::prefix('article')->group(function () {
        // 获取帖子列表
        Route::get('/', 'ArticleController@listModel');
        // 新建帖子
        Route::post('create', 'ArticleController@createModel');
        // 获取帖子内容
        Route::get('{id}', 'ArticleController@showModel')->where('id', '[1-9]+\d*');
        // 获取帖子内容，原文数据
        Route::get('{id}/edit', 'ArticleController@editModel')->where('id', '[1-9]+\d*');
        // 修改帖子内容
        Route::put('{id}/update', 'ArticleController@updateModel')->where('id', '[1-9]+\d*');
        // 删除帖子
        Route::delete('{id}/delete', 'ArticleController@deleteModel')->where('id', '[1-9]+\d*');
    });

    Route::prefix('comment')->group(function () {
        // 获取评论列表
        Route::get('/', 'CommentController@listModel');
        // 新建评论
        Route::post('create', 'CommentController@createModel');
        // 获取评论内容
        Route::get('{id}', 'CommentController@showModel')->where('id', '[1-9]+\d*');
        // 获取评论内容，原文数据
        Route::get('{id}/edit', 'CommentController@editModel')->where('id', '[1-9]+\d*');
        // 修改评论内容
        Route::put('{id}/update', 'CommentController@updateModel')->where('id', '[1-9]+\d*');
        // 删除评论
        Route::delete('{id}/delete', 'CommentController@deleteModel')->where('id', '[1-9]+\d*');
    });

    Route::prefix('discussion')->group(function () {
        // 获取讨论列表
        Route::get('/', 'DiscussionController@listModel');
        // 新建讨论
        Route::post('create', 'DiscussionController@createModel');
    });

    Route::prefix('image')->group(function () {
        // 获取用户图片列表
        Route::post('user', 'ImageController@listUserImage');
        // 上传图片
        Route::post('create', 'ImageController@create');
    });

    Route::prefix('assess')->group(function () {
        // 获取用户星标和收藏状态
        Route::get('/', 'AssessController@getAssess');
        // 星标状态切换
        Route::post('star/toggle', 'AssessController@starToggle');
        // 收藏状态切换
        Route::post('bookmark/toggle', 'AssessController@bookmarkToggle');
    });
});
