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

Route::namespace('V1\Web')->group(function () {
    // 起始页面
    Route::get('/', 'IndexController@index');

    Route::prefix('user')->group(function () {
        // 注册
        Route::get('register', 'UserController@register');
        // 登录
        Route::get('login', 'UserController@login');
        // 个人中心
        Route::get('index', 'UserController@index');
        // 个人信息
        Route::get('info', 'UserController@info');
        // 个人头像
        Route::get('avatar', 'UserController@avatar');
    });

    Route::prefix('article')->group(function () {
        // 帖子列表
        Route::get('/', 'ArticleController@index');
        // 帖子创建
        Route::get('create', 'ArticleController@create');
        // 帖子展示
        Route::get('{id}', 'ArticleController@show')->where('id', '[1-9]+\d*');
        // 帖子编辑
        Route::get('{id}/edit', 'ArticleController@edit')->where('id', '[1-9]+\d*');
    });
});

if (env('APP_DEBUG')) {
    // 测试路由
    Route::get('/test', 'Test\TestController@test');
}
