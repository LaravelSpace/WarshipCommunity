<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('users')) {
            echo "Table users Is Already Exist! \n";
            return;
        }
        // \DB::connection()->enableQueryLog();
        Schema::create('users', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->increments('id');
            $table->string('name', 32); // 昵称
            $table->string('email', 64)->unique(); // 邮箱地址
            $table->timestamp('email_verified_at')->nullable(); // 邮箱地址验证时间
            $table->string('phone', 32)->unique(); // 手机号码
            $table->timestamp('phone_verified_at')->nullable(); // 手机号码验证时间
            $table->string('password', 64); // 密码 hash 处理
            $table->string('avatar', 128); // 头像图片地址
            $table->string('api_token', 64); // api token
            $table->rememberToken();
            $table->timestamps();
            $table->unique('name');
            $table->index('email');
            $table->index('phone');
        });
        // \Log::debug(\DB::getQueryLog());

        // create table `users` (
        // `id` int unsigned not null auto_increment primary key,
        // `name` varchar(32) not null,
        // `email` varchar(64) not null,
        // `email_verified_at` timestamp null,
        // `phone` varchar(32) not null,
        // `phone_verified_at` timestamp null,
        // `password` varchar(64) not null,
        // `avatar` varchar(128) not null,
        // `api_token` varchar(64) not null,
        // `remember_token` varchar(100) null,
        // `created_at` timestamp default CURRENT_TIMESTAMP null,
        // `updated_at` timestamp ON UPDATE CURRENT_TIMESTAMP null
        // ) default character set utf8mb4 collate 'utf8mb4_unicode_ci'

        // alter table `users` add unique `users_name_unique`(`name`)
        // alter table `users` add unique `users_email_index`(`email`)
        // alter table `users` add unique `users_phone_index`(`phone`)
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!env('APP_DEBUG')) {
            echo "Not In Test Environment! \n";
            return;
        }
        Schema::dropIfExists('users');
    }
}
